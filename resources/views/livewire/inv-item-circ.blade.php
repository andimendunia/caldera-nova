<div>
    <form wire:submit.prevent="submit" 
        x-data="{
            qty: @entangle('qty'),
            qtype: @entangle('qtype'),
            qty_main: @entangle('qty_main'),
            qty_used: @entangle('qty_used'),
            qty_rep: @entangle('qty_rep'),
            qty_main_after: 0,
            qty_used_after: 0,
            qty_rep_after: 0,
            price: @entangle('price'),
            get cost() {
                const qty = parseInt(this.qty);
                return (qty && this.qtype == 'main') ? qty * this.price : 0;
            },
            calcQty() {
                const qty = parseInt(this.qty)
                this.qty_main_after = (qty && this.qtype == 'main') ? this.qty_main + qty : this.qty_main;
                this.qty_used_after = (qty && this.qtype == 'used') ? this.qty_used + qty : this.qty_used;
                this.qty_rep_after = (qty && this.qtype == 'rep') ? this.qty_rep + qty : this.qty_rep;
            }
        }" 
        x-init="
            $watch('qty', () => calcQty());
            $watch('qtype', () => calcQty());
            qty_main_after = qty_main;
            qty_used_after = qty_used;
            qty_rep_after = qty_rep;"
        class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">
        <div class="flex justify-between p-4">
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
                <x-secondary-button @click="qty == null ? qty = -1 : --qty"><i
                        class="fa fa-fw fa-minus"></i></x-secondary-button>
                <x-text-input-spinner x-model="qty" id="inv-circ-qty" class="w-20 p-2 text-center" name="qty"
                    type="number" value="" placeholder="Qty"></x-text-input-spinner>
                <x-secondary-button @click="qty == null ? qty = 1 : ++qty"><i
                        class="fa fa-fw fa-plus"></i></x-secondary-button>
            </div>
        </div>
        <div x-show="parseInt(qty) === 0 || qty > 0 || qty < 0" x-cloak class="px-4 pb-5">
            <div x-show="qty < 0 || qty > 0" x-cloak>
                <hr class="border-neutral-300 dark:border-neutral-600 mb-4" />
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
                    <div x-show="qtype == 'used'" class="flex">
                        <div class="mx-2">•</div>
                        <div>{{ __('Bekas') }}</div>
                    </div>
                    <div x-show="qtype == 'rep'" class="flex">
                        <div class="mx-2">•</div>
                        <div>{{ __('Diperbaiki') }}</div>
                    </div>
                </div>
            </div>
            <div x-show="(qty > 0) || (qty && qty_used_after) || (qty && qty_rep_after) || (!qtype && qty != 0)">
                <x-select x-model="qtype" name="qtype" id="inv-qty-type" class="mt-3">
                    <option value=""></option>
                    <option value="main">{{ __('Qty utama') }}</option>
                    <option value="used">{{ __('Qty bekas') }}</option>
                    <option value="rep">{{ __('Qty diperbaiki') }}</option>
                </x-select>
                @error('qtype')
                    <x-input-error messages="{{ $message }}" class="mt-2" />
                @enderror
            </div>
            <x-text-input wire:model="remarks" id="inv-remarks" class="mt-3" type="text"
                placeholder="{{ __('Keterangan') }}" autocomplete="inv-remarks" />
            @error('remarks')
                <x-input-error messages="{{ $message }}" class="mt-2" />
            @enderror
            <div x-data="{ delegate: @entangle('is_delegated') }" class="">
                <div x-show="delegate" x-cloak>
                    <x-text-input-icon icon="fa fa-fw fa-user" x-ref="user" id="inv-user" class="mt-3" name="user" type="text" placeholder="{{ __('Delegasikan ke...') }}" />
                </div>
                <div class="flex gap-x-5 my-5">
                    <x-checkbox x-model="delegate" @click="$nextTick(() => { delegate ? $refs.user.focus() : false })" id="inv-delegate">{{ __('Delegasikan') }}</x-checkbox>
                    <x-checkbox wire:model="is_immediate" id="inv-immediate">{{ __('Langsung setujui') }}</x-checkbox>
                </div>
            </div>
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
                <div x-show="parseInt(qty) === 0"><i class="far fa-fw fa-flag mr-2"></i>{{ __('Catat Qty') }}
                </div>
            </x-primary-button>
        </div>
    </form>
</div>
