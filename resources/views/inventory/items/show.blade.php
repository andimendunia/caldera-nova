<x-inventory title="{{ $title }}" prev="{{ $prev }}" header="" nav="" >
    <div class="sm:py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-200">
        <div class="block sm:flex gap-x-6">
            <div>
                <div class="flex w-full rounded-none sm:w-48 h-48 md:w-72 md:h-72 lg:w-80 lg:h-80 bg-gray-200 dark:bg-gray-700 sm:rounded">
                    <div class="m-auto">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="block h-32 w-auto fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z" /></svg>
                    </div>
                </div>
                <div class="p-4 text-sm text-gray-600 dark:text-gray-400">
                    TT MM
                </div>
            </div>
            <div class="w-full overflow-hidden">
                <div class="px-4">
                    <h1 class="text-2xl mb-2 text-gray-900 dark:text-gray-100">
                        A long link given as the item name
                    </h1>   
                    <p class="mb-4">
                        A long link given as the item name
                    </p>
                </div>
                <hr class="border-gray-200 dark:border-gray-800" />
                <div class="p-4 text-gray-600 dark:text-gray-400">
                    <div class="mb-2">
                        TBE10-191001 • USD 123.00 / EA 
                    </div>
                    <div>
                        <span class="mr-4"><i class="fa fa-map-marker-alt mr-2"></i>A2.1.1</span>
                        <span><i class="fa fa-tag mr-2"></i>okc, sparepart</span> 
                    </div>
                </div>
                <div x-data="{qty: '', price: 123.00, circs: false, qty_main: 0, qty_used: 1, qty_repaired: 0}">
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="flex justify-between p-4">
                            <div>
                                <div class="mb-2"><span class="text-4xl mr-2">90</span><span class="font-bold">EA</span><x-text-button type="button" class="ml-4"><i class="fa fa-info-circle"></i></x-text-button></div>
                                <div class="text-sm mt-2">
                                    <div x-show="qty_used > 0" x-cloak>Qty bekas: 1 EA</div>
                                    <div x-show="qty_repaired > 0" x-cloak>Qty diperbaiki: 3 EA</div>
                                </div>
                            </div>
                            <div class="spinner-group my-auto">
                                <x-secondary-button @click="qty == null ? qty = -1 : --qty"><i class="fa fa-fw fa-minus"></i></x-secondary-button>
                                <x-text-input-spinner x-model="qty" id="inv-circ-qty" class="w-24 pl-5 text-center" name="qty" type="number" value="" placeholder="Qty"></x-text-input-spinner>
                                <x-secondary-button @click="qty == null ? qty = 1 : ++qty"><i class="fa fa-fw fa-plus"></i></x-secondary-button>    
                            </div>  
                        </div>
                        <div x-show="parseInt(qty) === 0 || qty > 0 || qty < 0" x-cloak class="px-4 pb-4">
                            <div x-show="qty < 0 || qty > 0" x-cloak class="mb-2">
                                <span x-show="qty < 0" x-cloak>{{__('Ambil')}}</span><span x-show="qty > 0" x-cloak>{{__('Tambah')}}</span> • USD <span x-text="Math.abs(price * qty).toLocaleString(undefined, {minimumIntegerDigits: 1, minimumFractionDigits: 2, maximumFractionDigits: 2,})"></span>
                            </div>
                            <x-text-input id="inv-remarks" class="mb-3" name="remarks" type="text" placeholder="{{ __('Keterangan') }}" autocomplete="inv-remarks" />
                            <div x-show="parseInt(qty) !== 0">
                                <x-select x-show="qty_used > 0 || qty_repaired > 0" x-cloak name="qtype" id="inv-qty-type" class="mb-3">
                                    <option value="">{{ __('Qty utama') }}</option>
                                    <option x-show="qty_used > 0 || qty > 0" value="">{{ __('Qty bekas') }}</option>
                                    <option x-show="qty_repaired > 0 || qty > 0"value="">{{ __('Qty diperbaiki') }}</option>
                                </x-select>
                            </div>
                            <x-checkbox x-show="qty < 0" x-cloak id="inv-transfer" class="mb-3">Transfer</x-checkbox>
                            <x-primary-button class="w-full text-center"><span x-show="qty < 0 || qty > 0"><i x-show="qty < 0" x-cloak class="fa fa-minus mr-2"></i><i x-show="qty > 0" x-cloak class="fa fa-plus mr-2"></i><span x-text="Math.abs(qty)"></span> EA</span><span x-show="parseInt(qty) === 0">{{__('Rekam Qty')}}</span></x-primary-button>
                        </div>
                    </div>
                    <div class="flex justify-between p-4 mb-4 text-gray-600 dark:text-gray-400">
                        <div>Diambil 4 hari sekali</div>
                        <div><x-text-button @click="circs = !circs" type="button">Sirkulasi<i x-show="!circs" x-cloak class="fa fa-chevron-down ml-2"></i><i x-show="circs" x-cloak class="fa fa-chevron-up ml-2"></i></x-text-button></div>
                    </div>
                    <div x-show="circs" x-cloak class="text-gray-600 dark:text-gray-400 mb-4">
                        <hr class="border-gray-200 dark:border-gray-800" />
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
                                        <div class="w-8 h-8 mr-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                        </div>
                                    </div>
                                    <div class="truncate">
                                        <div class="truncate">
                                            <div class="text-xs truncate">Andi Permana</div>
                                            <div class="text-base truncate">Pemasangan di mesin okc 5 long ass</div>
                                        </div>
                                        <div class="text-xs truncate text-gray-400 dark:text-gray-600">
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
                                        <div class="w-8 h-8 mr-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                        </div>
                                    </div>
                                    <div class="truncate">
                                        <div class="truncate">
                                            <div class="text-xs truncate">Andi Permana</div>
                                            <div class="text-base truncate">Pemasangan di mesin okc 5 long ass</div>
                                        </div>
                                        <div class="text-xs truncate text-gray-400 dark:text-gray-600">
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
                                        <div class="w-8 h-8 mr-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                        </div>
                                    </div>
                                    <div class="truncate">
                                        <div class="truncate">
                                            <div class="text-xs truncate">Andi Permana</div>
                                            <div class="text-base truncate">Pemasangan di mesin okc 5 long ass</div>
                                        </div>
                                        <div class="text-xs truncate text-gray-400 dark:text-gray-600">
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
        <hr class="border-gray-200 dark:border-gray-800" />
    </div>
</x-inventory>