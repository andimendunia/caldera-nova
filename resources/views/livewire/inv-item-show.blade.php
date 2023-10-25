<div class="block sm:flex gap-x-6">
    <div wire:key="photo">
        <livewire:inv-item-photo :id="$inv_item->id" :url="$inv_item->photo ? ('/storage/inv-items/'.$inv_item->photo) : ''" />
        <div class="flex p-4 text-sm text-neutral-600 dark:text-neutral-400">
            <div class="grow">{{ __('Updated:').' '.$inv_item->updated_at->diffForHumans()}}</div>
            <x-link class="uppercase" href="{{ route('inventory.items.edit', ['id' => $inv_item ]) }}"><i class="fa fa-pen"></i></x-link>               
        </div>
    </div>
    <div class="w-full overflow-hidden">
        <div class="px-4">
            <h1 class="text-2xl mb-2 text-neutral-900 dark:text-neutral-100">{{ $inv_item->name }}</h1>   
            <p class="mb-4">{{ $inv_item->desc }}</p>
        </div>
        <div class="text-neutral-600 dark:text-neutral-400">
            <hr class="border-neutral-200 dark:border-neutral-800" />
            <div class="p-4">
                <div class="flex mb-2">
                    <div>{{ $inv_item->code ? $inv_item->code : __('Tak ada kode') }}</div>
                    <div class="mx-2">•</div>
                    <div>{{ $inv_item->price ? ($inv_curr->name . ' ' . number_format($inv_item->price, 2) . ' / ' . $inv_item->inv_uom->name) : __('Tak ada harga') }}</div>
                </div>
                <div>
                    <x-text-button type="button" x-on:click="$dispatch('open-modal', 'edit-loc')" class="mr-4"><i class="fa fa-map-marker-alt mr-2"></i>{{ $loc ? $loc : __('Tak ada lokasi')}}</x-text-button>
                    <x-modal :name="'edit-loc'">
                        <livewire:inv-item-loc :loc="$inv_item->loc()" :inv_area_id="$inv_item->inv_area_id" :id="$inv_item->id" lazy />                
                    </x-modal> 
                    <x-text-button type="button" x-on:click="$dispatch('open-modal', 'edit-tags')"><i class="fa fa-tag mr-2"></i>{{ $tags ? $tags : __('Tak ada tag')}}</x-text-button> 
                    <x-modal :name="'edit-tags'">
                        <livewire:inv-item-tags :tags="$inv_item->tags_array()" :inv_area_id="$inv_item->inv_area_id" :id="$inv_item->id" lazy />                    
                    </x-modal> 

                </div>
            </div>
            <hr class="border-neutral-200 dark:border-neutral-800" />
            <div class="flex p-4 text-sm">
                @if($inv_item->is_active)
                <div>{{ __('Aktif') }}</div>
                @else
                <div class="text-red-500">{{ __('Nonaktif') }}</div>
                @endif
                <div class="mx-2">•</div>
                <div>{{ $inv_item->inv_area->name }}</div>
            </div>
        </div>
        <div x-data="{
            qty: '',
            qtype: {{ ($inv_item->qty_used || $inv_item->qty_rep) ? '""' : '1' }},
            price: {{ $inv_item->price }},
            circs: false,
            calcQty(qtype, qtyBase) {
                const qty = parseInt(this.qty);
                return (qty && parseInt(this.qtype) === qtype) ? qty + qtyBase : qtyBase;
              },
            get cost() {
              const qty = parseInt(this.qty);
              return (qty && parseInt(this.qtype) === 1) ? qty * this.price : 0;
            },
            get qty_main() {
              return this.calcQty(1, {{ $inv_item->qty_main }});
            },
            get qty_used() {
              return this.calcQty(2, {{ $inv_item->qty_used }});
            },
            get qty_rep() {
              return this.calcQty(3, {{ $inv_item->qty_rep }});
            }
          }">
            <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">
                <div class="flex justify-between p-4">
                    <div class="flex flex-col gap-y-3">
                        <div class="flex items-end">
                            <div class="text-4xl mr-2" x-text="qty_main"></div>
                            <div class="font-bold">{{ $inv_item->inv_uom->name }}</div>
                        </div>
                        <div x-show="qty_used || qty_rep" class="text-sm">
                            <table>
                                <tr x-show="qty_used">
                                    <td class="text-right" x-text="qty_used"></td>
                                    <td class="pl-1">{{ $inv_item->inv_uom->name }}</td>
                                    <td class="px-1">:</td>
                                    <td>{{ __('Bekas'. ' ')}}</td>
                                </tr>
                                <tr x-show="qty_rep">
                                    <td class="text-right" x-text="qty_rep"></td>
                                    <td class="pl-1">{{ $inv_item->inv_uom->name }}</td>
                                    <td class="px-1">:</td>
                                    <td>{{ __('Diperbaiki'. ' ')}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="spinner-group my-auto">
                        <x-secondary-button @click="qty == null ? qty = -1 : --qty"><i class="fa fa-fw fa-minus"></i></x-secondary-button>
                        <x-text-input-spinner x-model="qty" id="inv-circ-qty" class="w-24 pl-5 text-center" name="qty" type="number" value="" placeholder="Qty"></x-text-input-spinner>
                        <x-secondary-button @click="qty == null ? qty = 1 : ++qty"><i class="fa fa-fw fa-plus"></i></x-secondary-button>    
                    </div>  
                </div>
                <div x-show="parseInt(qty) === 0 || qty > 0 || qty < 0" x-cloak class="px-4 pb-5">
                    <div x-show="qty < 0 || qty > 0" x-cloak>
                        <hr class="border-neutral-300 dark:border-neutral-600 mb-4" />
                        <div class="flex justify-center">
                            <div x-show="qty < 0" x-cloak>{{__('Ambil')}}</div>
                            <div x-show="qty > 0" x-cloak>{{__('Tambah')}}</div>
                            <div x-show="cost" class="flex">
                                <div class="mx-2">•</div>
                                <div class="me-1">{{ $inv_curr->name }}</div>
                                <div x-text="Math.abs(cost).toLocaleString(undefined, {minimumIntegerDigits: 1, minimumFractionDigits: 2, maximumFractionDigits: 2,})"></div>
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
                    <x-text-input id="inv-remarks" class="mt-3" name="remarks" type="text" placeholder="{{ __('Keterangan') }}" autocomplete="inv-remarks" />
                    <div x-show="(qty > 0) || (qty && qty_used) || (qty && qty_rep) || (!qtype)">
                        <x-select x-model="qtype" name="qtype"  id="inv-qty-type" class="mt-3">
                            <option value=""></option>
                            <option value="1">{{ __('Qty utama') }}</option>
                            <option value="2">{{ __('Qty bekas') }}</option>
                            <option value="3">{{ __('Qty diperbaiki') }}</option>
                        </x-select>
                    </div>
                    <x-primary-button md x-show="qtype" type="button" x:on-click.prevent="notyf.success('Sirkulasi dibuat');" class="w-full flex justify-center mt-4">
                        <div x-show="qty < 0 || qty > 0" class="flex">
                            <div x-show="qty < 0" x-cloak>
                                <i class="fa fa-minus"></i>
                            </div>
                            <div x-show="qty > 0" x-cloak>
                                <i class="fa fa-plus"></i>
                            </div>
                            <div class="mx-2" x-text="Math.abs(qty)"></div>
                            <div>{{ $inv_item->inv_uom->name }}</div>
                        </div>
                        <div x-show="parseInt(qty) === 0"><i class="far fa-fw fa-flag mr-2"></i>{{__('Rekam Qty')}}</div>
                    </x-primary-button>
                </div>
            </div>
            <div class="flex justify-between p-4 mb-4 text-neutral-600 dark:text-neutral-400">
                <div>Diambil 4 hari sekali</div>
                <div><x-text-button @click="circs = !circs" type="button">Sirkulasi<i x-show="!circs" x-cloak class="fa fa-chevron-down ml-2"></i><i x-show="circs" x-cloak class="fa fa-chevron-up ml-2"></i></x-text-button></div>
            </div>
            <div x-show="circs" x-cloak class="text-neutral-600 dark:text-neutral-400 mb-4">
                <hr class="border-neutral-200 dark:border-neutral-800" />
                <div class="p-4">
                    <x-text-button type="button"><i class="fa fa-download mr-2"></i>{{__('Unduh sirkulasi')}}</x-text-button>
                </div>
                <div class="grid grid-col-1">
                    <x-circ-button class="px-4 py-2 text-sm">
                        <div class="flex items-center">
                            <div>
                                <div class="w-24 truncate text-base"><i class="fa fa-plus mr-2"></i>1 EA</div>
                            </div>
                            <div>
                                <div class="w-8 h-8 mr-2 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                </div>
                            </div>
                            <div class="truncate">
                                <div class="truncate">
                                    <div class="text-xs truncate">Andi Permana</div>
                                    <div class="text-base truncate">Pemasangan di mesin okc 5 long ass</div>
                                </div>
                                <div class="text-xs truncate text-neutral-400 dark:text-neutral-600">
                                    3 bulan yang lalu
                                </div>
                            </div>
                        </div>
                    </x-circ-button>
                    <x-circ-button class="px-4 py-2 text-sm">
                        <div class="flex items-center">
                            <div>
                                <div class="w-24 truncate text-base"><i class="fa fa-plus mr-2"></i>1 EA</div>
                            </div>
                            <div>
                                <div class="w-8 h-8 mr-2 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                </div>
                            </div>
                            <div class="truncate">
                                <div class="truncate">
                                    <div class="text-xs truncate">Andi Permana</div>
                                    <div class="text-base truncate">Pemasangan di mesin okc 5 long ass</div>
                                </div>
                                <div class="text-xs truncate text-neutral-400 dark:text-neutral-600">
                                    3 bulan yang lalu
                                </div>
                            </div>
                        </div>
                    </x-circ-button>
                    <x-circ-button class="px-4 py-2 text-sm">
                        <div class="flex items-center">
                            <div>
                                <div class="w-24 truncate text-base"><i class="fa fa-plus mr-2"></i>1 EA</div>
                            </div>
                            <div>
                                <div class="w-8 h-8 mr-2 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                </div>
                            </div>
                            <div class="truncate">
                                <div class="truncate">
                                    <div class="text-xs truncate">Andi Permana</div>
                                    <div class="text-base truncate">Pemasangan di mesin okc 5 long ass</div>
                                </div>
                                <div class="text-xs truncate text-neutral-400 dark:text-neutral-600">
                                    3 bulan yang lalu
                                </div>
                            </div>
                            <div class="ml-auto">
                                <i class="fa fa-fw fa-clock text-xs ml-2"></i>
                            </div>
                        </div>
                    </x-circ-button>
                </div>
            </div>
        </div>    
    </div>
</div>