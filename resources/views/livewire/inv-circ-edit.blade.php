<div class="p-6">
    <div class="flex justify-between items-center text-lg mb-6 font-medium text-neutral-900 dark:text-neutral-100">
        <h2>
            {{ __('Sirkulasi') }}
        </h2>
        <x-text-button type="button" x-on:click="$dispatch('close')"><i class="fa fa-times"></i></x-text-button>
    </div>
    <div class="flex text-sm gap-x-2 p-4 mb-6 border border-neutral-200 dark:border-neutral-700 rounded-lg">
        <div class="grow truncate">
            <div class="flex truncate gap-x-2">
                <div class="truncate font-medium text-neutral-900 dark:text-neutral-100">
                    {{ $circ->inv_item->name }}
                </div>
                <div>•</div>
                <div class="truncate">
                    {{ $circ->inv_item->desc }}
                </div>
            </div>
        </div>
        <div class="flex items-center">
            <x-link href="{{ route('inventory.items.show', ['id' => $circ->inv_item_id]) }}" target="_blank"><i
                    class="fa fa-external-link-alt"></i></x-link>
        </div>
    </div>
    <div wire:key="circ-status-{{ $circ->id }}">
        @if ($circ->status)
            <div class="flex items-center gap-x-2">
                <div>
                    <i class="fa {{ $circ->getDirIcon() }}"></i>
                </div>
                <div class="text-4xl">
                    {{ abs($qty) }}
                </div>
                <div>
                    {{ $uom }}
                </div>
                @if ($circ->qty !== 0 && $amount)
                    <div>
                        •
                    </div>
                    <div>
                        {{ number_format(abs($amount), 2) . ' ' . $curr }}
                    </div>
                @endif
                <div class="ml-auto">
                    {{ $circ->qty_before . ' → ' . $circ->qty_after }}
                </div>
            </div>
            <hr class="border-neutral-200 dark:border-neutral-700 my-6">
            <div class="grid gap-y-6">
                <div class="flex items-start gap-x-3">
                    <div>
                        <div class="w-8 h-8 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                            @if ($circ->user->photo)
                                <img class="w-full h-full object-cover dark:brightness-75"
                                    src="{{ '/storage/users/' . $circ->user->photo }}" />
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25"
                                    viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano">
                                    <path
                                        d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z" />
                                </svg>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="whitespace-normal">
                            <div class="text-xs text-neutral-400 dark:text-neutral-600 mb-1">{{ $circ->user->name }}
                                @if ($circ->assigner_id)
                                    <span
                                        title="{{ __('Didelegasikan oleh:') . ' ' . $circ->assigner->name . ' (' . $circ->assigner->emp_id . ')' }}">•
                                        <i class="fa fa-handshake-angle"></i></span>
                                @endif <span class="mx-1">•</span>{{ $circ->created_at }}
                            </div>
                            <div class="text-base">
                                @if ($circ->qtype !== 1)
                                    <x-badge>{{ $circ->getQtype() }}</x-badge>
                                @endif {{ $circ->remarks }}
                            </div>
                        </div>
                    </div>
                </div>
                @if ($circ->evaluator_id)
                    <div class="flex items-center gap-x-3">
                        <div>
                            <div class="w-8 h-8 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                @if ($circ->evaluator->photo)
                                    <img class="w-full h-full object-cover dark:brightness-75"
                                        src="{{ '/storage/users/' . $circ->evaluator->photo }}" />
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25"
                                        viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano">
                                        <path
                                            d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z" />
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="whitespace-normal">
                                <div class="text-xs text-neutral-400 dark:text-neutral-600 mb-1">
                                    {{ $circ->evaluator->name }}
                                    <span class="mx-1">•</span>{{ $circ->updated_at }}
                                </div>
                                <div class="text-base"><x-badge><i
                                            class="fa {{ $circ->getStatusIcon() }} mr-2"></i>{{ $circ->getStatus() }}</x-badge>
                                    {{ $circ->comment }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
        @canany(['eval', 'update'], $circ)
            <div x-data="{
                qty: @entangle('qty'),
                qtype: @entangle('qtype'),
                price: @entangle('price'),
                get cost() {
                    const qty = parseInt(this.qty);
                    return (qty && this.qtype == 1) ? qty * this.price : 0;
                }
            }">
                <div class="flex mb-6 justify-between">
                    <div class="flex items-center gap-x-1">
                        <div>
                            <i x-show="qty < 0" class="fa fa-fw fa-minus mr-2"></i>
                            <i x-show="qty > 0" class="fa fa-fw fa-plus mr-2"></i>
                            <i x-show="qty == 0" class="fa fa-fw fa-code-commit mr-2"></i>
                        </div>
                        <div>
                            <div class="text-lg" x-show="qty < 0" x-cloak>{{ __('Ambil') }}</div>
                            <div class="text-lg" x-show="qty > 0" x-cloak>{{ __('Tambah') }}</div>
                            <div class="text-lg" x-show="qty == 0" x-cloak>{{ __('Catat') }}</div>
                            <div x-show="cost" class="flex text-xs">
                                <div class="me-1">{{ $curr }}</div>
                                <div
                                    x-text="Math.abs(cost).toLocaleString(undefined, {minimumIntegerDigits: 1, minimumFractionDigits: 2, maximumFractionDigits: 2,})">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="spinner-group my-auto">
                        <x-secondary-button @click="qty == null ? qty = -1 : --qty"><i
                                class="fa fa-fw fa-minus"></i></x-secondary-button>
                        <x-text-input-spinner x-model="qty" id="inv-circ-qty" class="w-20 p-2 text-center"
                            name="qty" type="number" value="" placeholder="Qty"></x-text-input-spinner>
                        <x-secondary-button @click="qty == null ? qty = 1 : ++qty"><i
                                class="fa fa-fw fa-plus"></i></x-secondary-button>
                    </div>
                </div>
                <div>
                    <x-select x-model="qtype" name="qtype" id="inv-qty-type" class="mt-3">
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
                <div x-data="{ open: false, userq: @entangle('userq').live }" x-on:user-selected="userq = $event.detail; open = false">
                    <div x-on:click.away="open = false">
                        <x-text-input-icon x-model="userq" icon="fa fa-fw fa-user" x-on:change="open = true"
                            x-ref="userq" x-on:focus="open = true" id="inv-user-{{ $circ->id }}" class="mt-3" type="text" autocomplete="off"
                            placeholder="{{ __('Delegasikan ke...') }}" />
                        <div class="relative" x-show="open" x-cloak>
                            <div class="absolute top-1 left-0 w-full">
                                <livewire:user-select wire:key="user-select" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-6 gap-x-2">
                    @can('eval', $circ)
                    <div class="btn-group">
                        <x-secondary-button type="button" wire:click="eval('approve')"><i
                                class="fa fa-thumbs-up mr-2"></i>{{ __('Setujui') }}</x-secondary-button>
                        <x-secondary-button x-bind:disabled="!(qty < 0 || qty > 0)" type="button" wire:click="eval('reject')"><i
                                class="fa fa-thumbs-down"></i></x-secondary-button>
                    </div>
                    @endcan
                    @can('update', $circ)
                    <x-secondary-button type="button" wire:click="update">{{ __('Perbarui') }}</x-secondary-button>
                    @endcan
                </div>
            </div>
            @else
            View only
            @endcan
        @endif
    </div>
    <x-spinner-bg wire:loading.class.remove="hidden" wire:target="update"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden"  wire:target="update" class="hidden"></x-spinner>
    <x-spinner-bg wire:loading.class.remove="hidden" wire:target="eval"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden"  wire:target="eval" class="hidden"></x-spinner>
</div>
