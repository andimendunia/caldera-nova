<div class="flex flex-col gap-x-4 md:gap-x-8 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-56 px-3 sm:px-0">
            <x-text-input-icon icon="fa fa-fw fa-search" id="inv-q" name="q" type="text" placeholder="{{ __('Cari...') }}" autofocus autocomplete="q" />
            <x-select name="status" id="inv-status" class="mt-3">
                <option value="">{{ __('Aktif')}}</option>
                <option value="">{{ __('Nonaktif') }}</option>
                <option value="">{{ __('Aktif dan Nonaktif') }}</option>
            </x-select>
            <x-select name="qtype" id="inv-qty-type" class="mt-3">
                <option value="">{{ __('Qty total')}}</option>
                <option value="">{{ __('Qty utama saja')}}</option>
                <option value="">{{ __('Qty bekas saja') }}</option>
                <option value="">{{ __('Qty diperbaiki saja') }}</option>
            </x-select>
            <div x-data="{ open: false }" class="my-5">
                <div class="mx-2 flex justify-between">
                    <div>
                        <x-toggle x-model="open">{{ __('Filter') }}</x-toggle>
                    </div>
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="focus:outline-none transition ease-in-out duration-150">
                                    <svg class="fill-transparent h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path stroke="#6b7280" stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 6l4 4 4-4'/>
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                {{-- <div class="text-sm text-neutral-400 dark:text-neutral-500 p-6 text-center">{{__('Tidak ada filter tersimpan')}}</div> --}}
                                <x-dropdown-link href="#">
                                    <span class="bg-neutral-600 rounded-full px-2 py-1 mr-2"><i class="fa fa-tag mr-2"></i>okc</span>
                                </x-dropdown-link>
                                <x-dropdown-link href="#" class="flex flex-wrap gap-2">
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap"><i class="fa fa-search mr-2"></i>e10-19</div>
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap">Tak ada foto</div>
                                </x-dropdown-link>  
                                <x-dropdown-link href="#" class="flex flex-wrap gap-2">
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap"><i class="fa fa-tag mr-2"></i>okc</div>
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap">Nonaktif</div>
                                </x-dropdown-link>      
                                <x-dropdown-link href="#" class="flex flex-wrap gap-2">
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap"><i class="fa fa-map-marker-alt mr-2"></i>G1.2.3</div>
                                    <div class="bg-neutral-600 rounded-full px-2 py-1 whitespace-nowrap"><i class="fa fa-tag mr-2"></i>ym laser</div>
                                </x-dropdown-link>
                                <hr class="border-neutral-300 dark:border-neutral-600" />
                                <x-dropdown-link :href="route('account.edit')">
                                    {{ __('Kelola') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <div x-show="open" x-cloak>
                    <x-text-input-icon icon="fa fa-fw fa-map-marker-alt" id="inv-loc" class="mt-3" name="loc" type="text" placeholder="{{ __('Lokasi') }}" />
                    <x-text-input-icon icon="fa fa-fw fa-tag" class="mt-3" id="inv-tag" name="tag" type="text" placeholder="{{ __('Tag') }}" />
                    <x-select name="filter" id="inv-filter" class="mt-3">
                        <option value=""></option>
                        <option value="">{{ __('Tak ada lokasi') }}</option>
                        <option value="">{{ __('Tak ada tag') }}</option>
                        <option value="">{{ __('Tak ada foto') }}</option>
                        <option value="">{{ __('Tak ada kode item') }}</option>
                        <option value="">{{ __('Tak ada batas qty') }}</option>
                    </x-select>
                    <div class="m-3">
                        <x-text-button type="button" class="text-sm"><i class="fa fa-fw mr-2 fa-save"></i>{{__('Simpan filter')}}</x-text-button>
                    </div>
                </div>
            </div>
            <hr class="my-5 border-neutral-300 dark:border-neutral-700" />
            <div class="m-3">
                <x-checkbox id="inv-area-1">TT MM</x-checkbox>
                <x-checkbox id="inv-area-2">TT MM Cons</x-checkbox>
                <x-checkbox id="inv-area-3">TT Maintenance</x-checkbox>
            </div>
            <hr class="my-5 border-neutral-300 dark:border-neutral-700" />
            <div class="m-3">
                <x-text-button type="button" class="text-sm"><i class="fa fa-fw mr-2 fa-xmark"></i>{{__('Atur ulang')}}</x-text-button>
            </div>
            <div class="m-3">
                <x-text-button type="button" class="text-sm"><i class="fa fa-fw mr-2 fa-download"></i>{{__('Unduh CSV barang')}}</x-text-button>
            </div>
        </div>
        <div class="sticky top-0 px-3 py-5">
            <x-link-secondary-button class="w-full text-center" href="#content"><i class="fa fa-arrows-up-to-line mr-2"></i>{{ __('Ke atas') }}</x-link-secondary-button>
        </div>
    </div>
    <div class="w-full">
        <div class="flex justify-between w-full px-3 sm:px-0">
            <div class="my-auto"><span>0</span><span class="hidden md:inline">{{' ' . __('barang')}}</span></div>
            <div class="flex">
                <x-select name="sort" class="mr-3">
                    <option value="">{{ __('Diperbarui') }}</option>
                    <option value="">{{ __('Dibuat') }}</option>
                    <option value="">{{ __('Termurah') }}</option>
                    <option value="">{{ __('Termahal') }}</option>
                    <option value="">{{ __('Paling sedikit') }}</option>
                    <option value="">{{ __('Paling banyak') }}</option>
                    <option value="">{{ __('Abjad') }}</option>
                </x-select>
                <div class="btn-group">
                    <x-secondary-button><i class="fa fa-fw fa-list"></i></x-secondary-button>
                    <x-secondary-button><i class="fa fa-fw fa-border-all"></i></x-secondary-button>    
                </div>                
            </div>
        </div>
        <div class="py-20 hidden">
            <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                <i class="fa fa-ghost"></i>
            </div>
            <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Tidak ada yang cocok') }}</div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mt-4">
            <x-inv-card-content 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-content>
            <x-inv-card-content 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-content>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 mt-4 px-3 sm:px-0">
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="MONITOR 19INCH SAMSUNG WITHOUT STAND"
            desc="A long description of item which describe extensively"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="90">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="HZ2N.L1"
            desc="KNIFE COMPATIBLE WITH TMC2 OR TB OR TH HEAD"
            code="TBE10-19001"
            curr="USD"
            price="99.00"
            uom="EA"
            loc="A1.1.5"
            tags="okc, sparepart"
            qty="1">
            </x-inv-card-grid>
            <x-inv-card-grid 
            href="/inventory/items/1"
            name="PRESSURE FOOT PEBBLE"
            desc="LECTRA IX6 FOOTWEAR"
            code="TBE10-19001"
            curr="USD"
            price="123.00"
            uom="PCK"
            loc="A2.1.1"
            tags="okc, sparepart"
            qty="6">
            </x-inv-card-grid>
        </div>
    </div>
</div>