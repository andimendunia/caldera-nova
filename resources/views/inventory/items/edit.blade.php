<x-inventory title="{{ $title }}" prev="{{ $prev }}" header="{{ $header }}" nav="" >
    <div class="sm:py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-200">
        <div class="block sm:flex gap-x-6">
            <div>
                <div class="flex w-full rounded-none sm:w-48 h-48 md:w-72 md:h-72 lg:w-80 lg:h-80 bg-gray-200 dark:bg-gray-700 sm:rounded">
                    <div class="m-auto">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="block h-32 w-auto fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z" /></svg>
                    </div>
                </div>
                <div class="p-4 text-sm text-gray-600 dark:text-gray-400">
                    <x-link href="#"><i class="fa fa-upload mr-2"></i>{{ __('Unggah foto') }}</x-link>               
                </div>
            </div>
            <div class="w-full overflow-hidden text-gray-400 dark:text-gray-600">
                <div class="px-4 pb-4">
                    <div class="p-3 text-sm">{{ __('Nama dan deskripsi')}}</div>
                    <x-text-input id="inv-name" class="mb-4" name="inv-name" type="text" placeholder="{{ __('Nama') }}" />
                    <x-text-input id="inv-desc" class="mb-4" name="inv-desc" type="text" placeholder="{{ __('Deskripsi') }}" />
                    <div class="p-3 text-sm">{{ __('Info consumables')}}</div>
                    <x-text-input id="inv-itemcode" class="mb-4" name="inv-itemcode" type="text" placeholder="{{ __('Kode item') }}" />
                    <div x-data="{ currid: '' }">
                        <x-text-input id="inv-priceusd" class="mb-4" name="inv-priceusd" type="text" placeholder="{{ __('USD') }}" />
                        <x-select x-model="currid" name="inv-currsec" class="mb-4">
                            <option value="">{{ __('Mata uang sekunder') }}</option>
                            <option value="1">{{ __('IDR') }}</option>
                            <option value="2">{{ __('KRW') }}</option>
                        </x-select>
                        <x-text-input x-show="currid" x-cloak id="inv-pricesec" class="mb-4" name="inv-pricesec" type="text" placeholder="{{ __('IDR') }}" />
                    </div>
                    <div class="p-3 text-sm">Klasifikasi — TT MM</div>
                    <x-text-input-icon icon="fa fa-fw fa-map-marker-alt" id="inv-loc" class="mb-3" name="loc" type="text" placeholder="{{ __('Lokasi') }}" />
                    <x-text-input-icon icon="fa fa-fw fa-tag" class="mb-3" id="inv-tag" name="tag" type="text" placeholder="{{ __('Tag') }}" /> 
                    <div class="p-3 text-sm">{{ __('Info qty')}}</div>
                    <x-select name="inv-uom" class="mb-4">
                        <option value="">{{ __('UOM') }}</option>
                        <option value="">{{ __('EA') }}</option>
                    </x-select>
                    <x-text-input id="inv-qtymain" class="mb-4" name="inv-qtymain" type="text" placeholder="{{ __('Qty utama') }}" />
                    <x-text-input id="inv-qtyused" class="mb-4" name="inv-qtyused" type="text" placeholder="{{ __('Qty bekas') }}" />
                    <x-text-input id="inv-qtyrepaired" class="mb-4" name="inv-qtyrepaired" type="text" placeholder="{{ __('Qty diperbaiki') }}" />
                    <div class="p-3 text-sm">{{ __('Batas qty utama')}}</div>
                    <x-text-input id="inv-qtymainmin" class="mb-4" name="inv-qtymainmin" type="text" placeholder="{{ __('Minimum') }}" />
                    <x-text-input id="inv-qtymainmax" class="mb-4" name="inv-qtymainmax" type="text" placeholder="{{ __('Maksimum') }}" />
                    <div class="py-3">
                        <x-primary-button type="submit">{{__('Simpan')}}</x-primary-button>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</x-inventory>