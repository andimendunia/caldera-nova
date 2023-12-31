<div>
    <form wire:submit.prevent="submit" 
        x-data="{
            qty: @entangle('qty'),
            qtype: @entangle('qtype'),
            qty_main: @entangle('qty_main'),
            qty_used: @entangle('qty_used'),
            qty_rep: @entangle('qty_rep'),
            qty_main_after: @entangle('qty_main_after'),
            qty_used_after: @entangle('qty_used_after'),
            qty_rep_after: @entangle('qty_rep_after'),
            price: @entangle('price'),
            get cost() {
                const qty = parseInt(this.qty);
                return (qty && this.qtype == 1) ? qty * this.price : 0;
            },
            calcQty() {
                const qty = parseInt(this.qty)
                this.qty_main_after = (qty && this.qtype == 1) ? this.qty_main + qty : this.qty_main;
                this.qty_used_after = (qty && this.qtype == 2) ? this.qty_used + qty : this.qty_used;
                this.qty_rep_after = (qty && this.qtype == 3) ? this.qty_rep + qty : this.qty_rep;
            }
        }" 
        x-init="
            $watch('qty', () => calcQty());
            $watch('qtype', () => calcQty());
            qty_main_after = qty_main;
            qty_used_after = qty_used;
            qty_rep_after = qty_rep;"
        class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">
        <div class="flex justify-between px-4 py-8 sm:py-4">
            <div class="flex flex-col gap-y-3">
                <div class="flex items-center">
                    <div class="text-4xl" x-text="qty_main_after">{{ $qty_main }}</div>
                    <div class="font-bold ml-2">{{ $uom }}</div>
                    @if ($qty_main_min || $qty_main_max)
                        <div
                            class="sm:grid grid-cols-2 ml-5 gap-x-1 text-xs text-neutral-600 dark:text-neutral-400 hidden">
                            <div>{{ __('Maks:') }}</div>
                            <div>{{ $qty_main_max ? $qty_main_max : 0 }}</div>
                            <div>{{ __('Min:') }}</div>
                            <div>{{ $qty_main_min ? $qty_main_min : 0 }}</div>
                        </div>
                    @endif
                </div>
                <div x-show="qty_used_after || qty_rep_after" x-cloak class="text-sm">
                    <table>
                        <tr x-show="qty_used_after">
                            <td class="text-right" x-text="qty_used_after"></td>
                            <td class="pl-1">{{ $uom }}</td>
                            <td class="px-1">:</td>
                            <td>{{ __('Bekas') . ' ' }}</td>
                        </tr>
                        <tr x-show="qty_rep_after">
                            <td class="text-right" x-text="qty_rep_after"></td>
                            <td class="pl-1">{{ $uom }}</td>
                            <td class="px-1">:</td>
                            <td>{{ __('Diperbaiki') . ' ' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="spinner-group my-auto">
                @if($can_create)
                <x-secondary-button @click="qty == null ? qty = -1 : --qty"><i
                        class="fa fa-fw fa-minus"></i></x-secondary-button>
                <x-text-input-spinner x-model="qty" id="inv-circ-qty" class="w-20 p-2 text-center" name="qty"
                    type="number" value="" placeholder="Qty"></x-text-input-spinner>
                <x-secondary-button @click="qty == null ? qty = 1 : ++qty"><i
                        class="fa fa-fw fa-plus"></i></x-secondary-button>
                @endif
            </div>
        </div>
        <div x-show="parseInt(qty) === 0 || qty > 0 || qty < 0" x-cloak class="px-4 pb-8 sm:pb-5">
            <div x-show="qty < 0 || qty > 0" x-cloak>
                <hr class="border-neutral-300 dark:border-neutral-600 mb-8 sm:mb-4" />
                <div class="flex justify-center">
                    <div x-show="qty < 0" x-cloak>{{ __('Ambil') }}</div>
                    <div x-show="qty > 0" x-cloak>{{ __('Tambah') }}</div>
                    <div x-show="cost" class="flex">
                        <div class="mx-2">•</div>
                        <div class="me-1">{{ $curr }}</div>
                        <div
                            x-text="Math.abs(cost).toLocaleString(undefined, {minimumIntegerDigits: 1, minimumFractionDigits: 2, maximumFractionDigits: 2,})">
                        </div>
                    </div>
                    <div x-show="qtype == 2" class="flex">
                        <div class="mx-2">•</div>
                        <div>{{ __('Bekas') }}</div>
                    </div>
                    <div x-show="qtype == 3" class="flex">
                        <div class="mx-2">•</div>
                        <div>{{ __('Diperbaiki') }}</div>
                    </div>
                </div>
            </div>
            <div x-show="(qty >= 0) || (qty && qty_used_after) || (qty && qty_rep_after) || (!qtype && qty != 0)">
                <x-select x-model="qtype" name="qtype" id="inv-qty-type" class="mt-3">
                    <option value=""></option>
                    <option value="1">{{ __('Qty utama') }}</option>
                    <option value="2">{{ __('Qty bekas') }}</option>
                    <option value="3">{{ __('Qty diperbaiki') }}</option>
                </x-select>
                <div wire:key="error-qtype">
                    @error('qtype')
                        <x-input-error messages="{{ $message }}" class="mt-2" />
                    @enderror
                </div>
            </div>
            <x-text-input wire:model="remarks" id="inv-remarks" class="mt-3" type="text"
                placeholder="{{ __('Keterangan') }}" autocomplete="inv-remarks" />
            <div wire:key="error-remarks">
                @error('remarks')
                    <x-input-error messages="{{ $message }}" class="mt-2" />
                @enderror
            </div>
            @if($invItemEval)
            <div x-data="{ open: false, userq: @entangle('userq').live }" x-on:user-selected="userq = $event.detail; open = false">
                <div x-on:click.away="open = false">
                    <x-text-input-icon x-model="userq" icon="fa fa-fw fa-user" x-ref="userq" x-on:focus="open = true" id="inv-user" class="mt-3" type="text" autocomplete="off" placeholder="{{ __('Delegasikan ke...') }}" />
                    <div class="relative" x-show="open" x-cloak>
                        <div class="absolute top-1 left-0 w-full">
                            <livewire:user-select wire:key="user-select" />
                        </div>
                    </div>
                </div>
                
                <div x-show="qty !== 0" class="flex gap-x-5 my-5">
                    <x-checkbox wire:model="is_immediate"  id="inv-immediate">{{ __('Langsung setujui') }}</x-checkbox>
                </div>
                
            </div>
            @endif
            <x-primary-button type="submit" md class="w-full flex justify-center mt-4">
                <div x-show="qty < 0 || qty > 0" class="flex">
                    <div x-show="qty < 0" x-cloak>
                        <i class="fa fa-minus"></i>
                    </div>
                    <div x-show="qty > 0" x-cloak>
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="mx-2" x-text="Math.abs(qty)"></div>
                    <div>{{ $uom }}</div>
                </div>
                <div x-show="parseInt(qty) === 0"><i class="fa fa-fw fa-code-commit mr-2"></i>{{ __('Catat') }}
                </div>
            </x-primary-button>
        </div>
    </form>
</div>
