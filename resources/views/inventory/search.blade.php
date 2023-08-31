<div id="content" class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
    <div class="flex flex-col gap-x-4 md:gap-x-8 sm:flex-row">
        <div>
            <div class="w-full sm:w-44 md:w-56 px-3 sm:px-0">
                <x-text-input id="inv-q" name="q" type="text" placeholder="{{ __('Cari...') }}" autofocus autocomplete="q" />
                <div class="flex items-center">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="text-sm inline-flex items-center p-3 leading-4 focus:outline-none transition ease-in-out duration-150">
                                <div>{{__('Tersimpan')}}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="text-sm text-neutral-400 dark:text-neutral-500 p-6 text-center">{{__('Tidak ada pencarian tersimpan')}}</div>
                            {{-- <x-dropdown-link :href="route('account.edit')">
                                {{ __('OKC') }}
                            </x-dropdown-link> --}}
                            <hr class="border-neutral-300 dark:border-neutral-600" />
                            <x-dropdown-link :href="route('account.edit')">
                                <i class="fa fa-fw fa-save mr-2"></i>{{ __('Simpan pencarian ini') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('account.edit')">
                                <i class="fa fa-fw fa-pen mr-2"></i>{{ __('Edit') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="my-5">
                    <x-text-input-icon icon="fa fa-fw fa-map-marker-alt" id="inv-loc" class="mb-3" name="loc" type="text" placeholder="{{ __('Lokasi') }}" />
                    <x-text-input-icon icon="fa fa-fw fa-tag" class="mb-3" id="inv-tag" name="tag" type="text" placeholder="{{ __('Tag') }}" />
                </div>
                <div class="my-5">
                    <span class="p-3 inline-block text-neutral-400 dark:text-neutral-600"><i class="fa fa-filter mr-3"></i>Filter</span>
                    <x-select name="status" id="inv-status" class="mb-3">
                        <option value="">{{ __('Barang aktif')}}</option>
                        <option value="">{{ __('Barang nonaktif') }}</option>
                    </x-select>
                    <x-select name="qtype" id="inv-qty-type" class="mb-3">
                        <option value="">{{ __('Qty ditotalkan')}}</option>
                        <option value="">{{ __('Qty utama saja')}}</option>
                        <option value="">{{ __('Qty bekas saja') }}</option>
                        <option value="">{{ __('Qty diperbaiki saja') }}</option>
                    </x-select>
                    <x-select name="filter" id="inv-filter" class="mb-3">
                        <option value=""></option>
                        <option value="">{{ __('Tak ada foto') }}</option>
                        <option value="">{{ __('Tak ada kode item') }}</option>
                        <option value="">{{ __('Tak ada batas qty') }}</option>
                    </x-select>
                </div>
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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mt-4 hidden">
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
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 mt-4 ">
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
</div>
    
