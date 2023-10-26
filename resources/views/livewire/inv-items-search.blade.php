<div class="flex flex-col gap-x-4 md:gap-x-8 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-56 px-3 sm:px-0">
            <x-text-input-icon wire:model.live="q" icon="fa fa-fw fa-search" id="inv-q" name="q" type="search"
                placeholder="{{ __('Cari...') }}" autofocus autocomplete="q" />
            <x-select wire:model.live="status" class="mt-3">
                <option value="active">{{ __('Aktif') }}</option>
                <option value="inactive">{{ __('Nonaktif') }}</option>
                <option value="both">{{ __('Aktif dan Nonaktif') }}</option>
            </x-select>
            <x-select wire:model.live="qty" class="mt-3">
                <option value="total">{{ __('Qty total') }}</option>
                <option value="main">{{ __('Qty utama saja') }}</option>
                <option value="used">{{ __('Qty bekas saja') }}</option>
                <option value="rep">{{ __('Qty diperbaiki saja') }}</option>
            </x-select>
            <div x-data="{ filter: @entangle('filter').live }" class="my-5">
                <div class="mx-2 flex justify-between">
                    <div>
                        <x-toggle x-model="filter">{{ __('Filter') }}</x-toggle>
                    </div>
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="focus:outline-none transition ease-in-out duration-150">
                                    <svg class="fill-transparent h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path stroke="#6b7280" stroke-linecap='round' stroke-linejoin='round'
                                            stroke-width='1.5' d='M6 6l4 4 4-4' />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                {{-- <div class="text-sm text-neutral-400 dark:text-neutral-500 p-6 text-center">{{__('Tidak ada filter tersimpan')}}</div> --}}
                                <x-dropdown-link href="#">
                                    <span class="bg-neutral-600 rounded-full px-2 py-1 mr-2"><i
                                            class="fa fa-tag mr-2"></i>okc</span>
                                </x-dropdown-link>
                                <x-dropdown-link href="#" class="flex flex-wrap gap-2">
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap"><i
                                            class="fa fa-search mr-2"></i>e10-19</div>
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap">Tak ada foto
                                    </div>
                                </x-dropdown-link>
                                <x-dropdown-link href="#" class="flex flex-wrap gap-2">
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap"><i
                                            class="fa fa-tag mr-2"></i>okc</div>
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap">Nonaktif</div>
                                </x-dropdown-link>
                                <x-dropdown-link href="#" class="flex flex-wrap gap-2">
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap"><i
                                            class="fa fa-map-marker-alt mr-2"></i>G1.2.3</div>
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap"><i
                                            class="fa fa-tag mr-2"></i>ym laser</div>
                                </x-dropdown-link>
                                <hr class="border-neutral-300 dark:border-neutral-600" />
                                <x-dropdown-link :href="route('account.edit')">
                                    {{ __('Kelola') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <div x-show="filter" x-cloak>
                    <x-text-input-icon wire:model.live="loc" icon="fa fa-fw fa-map-marker-alt" id="inv-loc"
                        class="mt-3" type="search" placeholder="{{ __('Lokasi') }}" list="qlocs" />
                        <datalist id="qlocs">
                            @if(count($qlocs))
                                @foreach($qlocs as $qloc)
                                    <option wire:key="{{ 'qloc'.$loop->index }}" value="{{ $qloc }}">
                                @endforeach
                            @endif
                        </datalist>
                    <x-text-input-icon wire:model.live="tag" icon="fa fa-fw fa-tag" class="mt-3" id="inv-tag"
                        type="search" placeholder="{{ __('Tag') }}" list="qtags" />
                        <datalist id="qtags">
                            @if(count($qtags))
                                @foreach($qtags as $qtag)
                                    <option wire:key="{{ 'qtag'.$loop->index }}" value="{{ $qtag }}">
                                @endforeach
                            @endif
                        </datalist>
                    <x-select wire:model.live="without" name="filter" class="mt-3">
                        <option value=""></option>
                        <option value="loc">{{ __('Tak ada lokasi') }}</option>
                        <option value="tags">{{ __('Tak ada tag') }}</option>
                        <option value="photo">{{ __('Tak ada foto') }}</option>
                        <option value="code">{{ __('Tak ada kode') }}</option>
                        <option value="qty_min">{{ __('Tak ada min qty utama') }}</option>
                        <option value="qty_max">{{ __('Tak ada maks qty utama') }}</option>
                    </x-select>
                    <div class="m-3">
                        <x-text-button type="button" class="text-sm"><i
                                class="fa fa-fw mr-2 fa-save"></i>{{ __('Simpan filter') }}</x-text-button>
                    </div>
                </div>
            </div>
            <hr class="my-5 border-neutral-300 dark:border-neutral-700" />
            <div class="m-3">
                @foreach ($areas as $area)
                    <x-checkbox wire:model.live="area_ids" wire:key="inv-area-{{ $area->id }}" id="inv-area-{{ $area->id }}"
                        value="{{ $area->id }}">{{ $area->name }}</x-checkbox>
                @endforeach
            </div>
            <hr class="my-5 border-neutral-300 dark:border-neutral-700" />

            <div wire:key="reset-search">
                @if ($q || $status != 'active' || $qty != 'total' || $filter == true || $loc || $tag || $without)
                <div class="m-3">
                    <x-text-button wire:click="resetSearch" type="button" class="text-sm"><i
                            class="fa fa-fw mr-2 fa-undo"></i>{{ __('Atur ulang') }}</x-text-button>

                </div>
            @endif
            </div>
            <div class="m-3">
                <x-text-button type="button" class="text-sm"><i
                        class="fa fa-fw mr-2 fa-download"></i>{{ __('Unduh CSV barang') }}</x-text-button>
            </div>
        </div>
        <div class="sticky top-0 px-3 py-5">
            <x-link-secondary-button class="w-full text-center" href="#content"><i
                    class="fa fa-arrows-up-to-line mr-2"></i>{{ __('Ke atas') }}</x-link-secondary-button>
        </div>
    </div>
    <div class="w-full">
        <div class="flex justify-between w-full px-3 sm:px-0">
            <div class="my-auto"><span>{{ $inv_items->total() }}</span><span
                    class="hidden md:inline">{{ ' ' . __('barang') }}</span></div>
            <div class="flex">
                <x-select wire:model.live="sort" class="mr-3">
                    <option value="updated">{{ __('Diperbarui') }}</option>
                    <option value="created">{{ __('Dibuat') }}</option>
                    <option value="price_low">{{ __('Termurah') }}</option>
                    <option value="price_high">{{ __('Termahal') }}</option>
                    <option value="qty_low">{{ __('Paling sedikit') }}</option>
                    <option value="qty_high">{{ __('Paling banyak') }}</option>
                    <option value="alpha">{{ __('Abjad') }}</option>
                </x-select>
                <div class="btn-group">
                    <x-radio-button wire:model.live="view" value="list" name="view" id="view-list"><i
                            class="fa fa-fw fa-grip-lines text-center m-auto"></i></x-radio-button>
                    <x-radio-button wire:model.live="view" value="content" name="view" id="view-content"><i
                            class="fa fa-fw fa-list text-center m-auto"></i></x-radio-button>
                    <x-radio-button wire:model.live="view" value="grid" name="view" id="view-grid"><i
                            class="fa fa-fw fa-border-all text-center m-auto"></i></x-radio-button>
                </div>
            </div>
        </div>
        @if (!$inv_items->count())
            @if (count($area_ids))
                <div wire:key="no-match" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-ghost"></i>
                    </div>
                    <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Tidak ada yang cocok') }}
                    </div>
                </div>
            @else
                <div wire:key="no-area" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-building relative"><i
                                class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-400 dark:text-neutral-800"></i></i>
                    </div>
                    <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Pilih area inventaris') }}
                    </div>
                </div>
            @endif
        @else
            @switch($view)
                @case('grid')
                    <div wire:key="grid"
                        class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 mt-4 px-3 sm:px-0">
                        @foreach ($inv_items as $inv_item)
                            <x-inv-card-grid :href="route('inventory.items.show', ['id' => $inv_item->id])" :name="$inv_item->name" :desc="$inv_item->desc" :uom="$inv_item->inv_uom->name"
                                :loc="$inv_item->inv_loc->name ?? null" :qty="$qty" :qty_main="$inv_item->qty_main" :qty_used="$inv_item->qty_used" :qty_rep="$inv_item->qty_rep"
                                :url="$inv_item->photo ? '/storage/inv-items/' . $inv_item->photo : null">
                            </x-inv-card-grid>
                        @endforeach
                    </div>
                @break

                @case('list')
                    <div wire:key="list" class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-auto mt-4">
                        <table class="table table-sm table-truncate text-neutral-600 dark:text-neutral-400">
                            <tr class="uppercase text-xs">
                                <th>{{ __('Qty') }}</th>
                                <th>{{ __('Nama') }}</th>
                                <th>{{ __('Kode') }}</th>
                                <th>{{ __('Harga') }}</th>
                                <th>{{ __('Lokasi') }} </th>
                                <th>{{ __('Tag') }} </th>
                                <th></th>
                            </tr>
                            @foreach ($inv_items as $inv_item)
                                <x-inv-tr :href="route('inventory.items.show', ['id' => $inv_item->id])" :name="$inv_item->name" :desc="$inv_item->desc" :code="$inv_item->code"
                                    :curr="$inv_curr->name" :price="$inv_item->price" :uom="$inv_item->inv_uom->name" :loc="$inv_item->inv_loc->name ?? null"
                                    :tags="$inv_item->tags() ?? null" :qty="$qty" :qty_main="$inv_item->qty_main" :qty_used="$inv_item->qty_used"
                                    :qty_rep="$inv_item->qty_rep">
                                </x-inv-tr>
                            @endforeach
                        </table>
                    </div>
                @break

                @default
                    <div wire:key="content" class="grid grid-cols-1 lg:grid-cols-2 gap-3 mt-4">
                        @foreach ($inv_items as $inv_item)
                            <x-inv-card-content :href="route('inventory.items.show', ['id' => $inv_item->id])" :name="$inv_item->name" :desc="$inv_item->desc" :code="$inv_item->code"
                                :curr="$inv_curr->name" :price="$inv_item->price" :uom="$inv_item->inv_uom->name" :loc="$inv_item->inv_loc->name ?? null" :tags="$inv_item->tags() ?? null"
                                :qty="$qty" :qty_main="$inv_item->qty_main" :qty_used="$inv_item->qty_used" :qty_rep="$inv_item->qty_rep" :url="$inv_item->photo ? '/storage/inv-items/' . $inv_item->photo : null">
                            </x-inv-card-content>
                        @endforeach
                    </div>
            @endswitch
        @endif
    </div>
</div>
