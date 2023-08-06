<div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-200">
    <div class="flex flex-col gap-x-2 md:gap-x-4 sm:flex-row">
        <div>
            <div class="w-full sm:w-44 md:w-56 px-3 sm:px-0 mb-10">
                <x-text-input id="inv-q" class="mb-5" name="q" type="text" placeholder="{{ __('Cari...') }}" autofocus autocomplete="q" />
                <div class="flex items-center">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center text-gray-400 dark:text-gray-600 p-3 focus:outline-none transition ease-in-out duration-150">
                                <div><i class="fa fa-calendar mr-3"></i>{{__('Rentang')}}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="#">
                                {{ __('Hari ini') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="#">
                                {{ __('Kemarin') }}
                            </x-dropdown-link>
                            <hr class="border-gray-300 dark:border-gray-600" />
                            <x-dropdown-link href="#">
                                {{ __('Bulan ini') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="#">
                                {{ __('Bulan kemarin') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="mb-5">
                    <x-text-input id="inv-date-start" class="mb-3" name="inv-date-start" type="date"></x-text-input>
                    <x-text-input id="inv-date-end" name="inv-date-end" type="date"></x-text-input>
                </div>
                <div class="my-5">
                    <span class="p-3 inline-block text-gray-400 dark:text-gray-600"><i class="fa fa-filter mr-3"></i>Filter</span>
                    <x-select name="inv-eval" id="inv-eval" class="mb-3">
                        <option value="">{{__('Tertunda dan Disetujui')}}</option>
                        <option value="">{{__('Tertunda')}}</option>
                        <option value="">{{__('Disetujui')}}</option>
                        <option value="">{{ __('Ditolak') }}</option>
                    </x-select>
                    <div class="mb-3">
                        <x-text-input-icon icon="fa fa-fw fa-user" id="inv-user" class="mb-3" name="user" type="text" placeholder="{{ __('Pengguna') }}" />
                    </div>
                    <div class="m-3">
                        <x-radio id="inv-direction-all" name="inv-direction" class="mb-4">Kedua arah</x-radio>
                        <x-radio id="inv-direction-deposit" name="inv-direction" class="mb-4"><i class="fa fa-fw fa-plus mr-2"></i>Penambahan </x-radio>
                        <x-radio id="inv-direction-withdrawal" name="inv-direction" class="mb-4"><i class="fa fa-fw fa-minus mr-2"></i>Pengambilan</x-radio>
                    </div>
                </div>
                <div class="m-3">
                    <x-checkbox id="inv-area-1">TT MM</x-checkbox>
                    <x-checkbox id="inv-area-2">TT MM Cons</x-checkbox>
                    <x-checkbox id="inv-area-3">TT Maintenance</x-checkbox>
                </div>
                <hr class="my-5 border-gray-300 dark:border-gray-700" />
                <div class="m-3">
                    <x-text-button type="button" class="text-sm">{{__('Unduh CSV')}}</x-text-button>
                </div>
            </div>
        </div>
        <div x-data="{ ids: [] }" class="w-full">
            <div x-show="!ids.length" class="flex justify-between w-full px-3 mb-3">
                <div class="my-auto">{{'0'.' '.__('sirkulasi')}}</div>
                <div class="flex">
                    <x-select name="sort">
                        <option value="">{{ __('Diperbarui') }}</option>
                        <option value="">{{ __('Dibuat') }}</option>
                        <option value="">{{ __('Termurah') }}</option>
                        <option value="">{{ __('Termahal') }}</option>
                        <option value="">{{ __('Paling sedikit') }}</option>
                        <option value="">{{ __('Paling banyak') }}</option>
                    </x-select>
                    {{-- <div class="btn-group mr-3">
                        <x-secondary-button><i class="fa fa-fw fa-list"></i></x-secondary-button>
                        <x-secondary-button><i class="fa fa-fw fa-border-all"></i></x-secondary-button>    
                    </div>   --}}            
                </div>
            </div>
            <div x-show="ids.length" x-cloak class="sticky z-10 top-0 flex justify-between w-full py-2 px-3 mb-1 bg-gray-100 dark:bg-gray-900">
                <div class="my-auto"><span x-text="ids.length"></span><span class="hidden sm:inline">{{' '. __('terpilih')}}</span></div>
                <div class="flex gap-x-2 items-center">
                    <x-secondary-button x-show="ids.length === 1"
                    class="flex items-center h-full" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'inv-circedit')"><i class="fa fa-fw fa-pen"></i></x-secondary-button> 
                    <x-secondary-button class="flex items-center h-full"><i class="fa fa-fw fa-print"></i><span class="ml-2 hidden sm:inline">{{__('Cetak')}}</span></x-secondary-button> 
                    <div class="btn-group">
                        <x-secondary-button class="flex items-center"><i class="fa fa-fw fa-thumbs-up"></i><span class="ml-2 hidden sm:inline">{{__('Setujui')}}</span></x-secondary-button>
                        <x-secondary-button class="flex items-center"><i class="fa fa-fw fa-thumbs-down"></i></x-secondary-button>                  
                    </div>
                    <x-text-button type="button" @click="ids = []" class="ml-2"><i class="fa fa-fw fa-times"></i></x-text-button>
                </div>
            </div>
            <x-modal name="inv-circedit">
                <div  class="p-6">        
                    <h2 class="text-lg mb-4 font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Sirkulasi') }}
                    </h2>
                    <div class="flex items-center mb-4 gap-x-4">
                        <div class="spinner-group my-auto">
                            <x-secondary-button><i class="fa fa-fw fa-minus"></i></x-secondary-button>
                            <x-text-input-spinner id="inv-circ-qty" class="w-24 pl-5 text-center" name="qty" type="number" value="" placeholder="Qty"></x-text-input-spinner>
                            <x-secondary-button><i class="fa fa-fw fa-plus"></i></x-secondary-button>    
                        </div>  
                        <div>
                            EA
                        </div>
                    </div>   
                    <div class="text-sm mb-4">
                        <span>Ambil</span><span class="mx-2">•</span><span>3.564,00 USD</span>
                    </div>
                    <div class="text-sm">
                        <div class="truncate mb-4">
                            <div class="truncate font-medium text-gray-900 dark:text-gray-100">
                                A BIG ITEM NAME
                            </div> 
                            <div class="truncate">
                                A DESCRIPTION WITH BIG TEXT
                            </div>
                        </div>  
                    </div>   
                    <hr class="border-gray-300 dark:border-gray-700 mb-4">
                    <div class="mb-4">
                        <div class="flex mb-2 items-center">
                            <div class="w-4 h-4 mr-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                            </div>
                            <div>Andi Permana</div>
                        </div>
                        <x-text-input id="inv-remarks" class="mb-2" name="remarks" type="text" placeholder="{{ __('Keterangan') }}" autocomplete="inv-remarks" />
                        <x-select id="inv-qty-type" class="mb-2">
                            <option value="">{{ __('Qty utama') }}</option>
                            <option value="">{{ __('Qty bekas') }}</option>
                            <option value="">{{ __('Qty diperbaiki') }}</option>
                        </x-select>
                        <div>10 EA<span class="fa fa-arrow-right mx-3"></span>2 EA</div>
                    </div>
                    <div class="text-sm">
                        <hr class="border-gray-300 dark:border-gray-700 mb-4">
                        <div>Diperbarui pada 2023-08-06 13:28</div>
                        <div>Diwakili oleh Bella Puspita</div>
                        <div>Disetujui oleh Bella Puspita</div>
                    </div>
                    <div class="mt-6 flex justify-end gap-x-2">
                        <x-secondary-button>{{__('Batal')}}</x-secondary-button> 
                        <x-primary-button>{{__('Simpan')}}</x-primary-button> 
                    </div>
                    <div class="mt-6 flex justify-between hidden">
                        <x-secondary-button>{{__('Batal')}}</x-secondary-button> 
                        <div class="flex gap-x-2 items-center">
                            <x-secondary-button><i class="fa fa-fw fa-pen"></i></x-secondary-button> 
                            <x-secondary-button><i class="fa fa-fw fa-print"></i><span class="ml-2 hidden sm:inline">{{__('Cetak')}}</span></span></x-secondary-button> 
                            <div class="btn-group">
                                <x-secondary-button><i class="fa fa-fw fa-thumbs-up"></i><span class="ml-2 hidden sm:inline">{{__('Setujui')}}</span></x-secondary-button>
                                <x-secondary-button><i class="fa fa-fw fa-thumbs-down"></i></x-secondary-button>                  
                            </div>
                        </div>
                    </div>
                </div>
            </x-modal>
            <div class="inv-circs grid gap-3 px-0 sm:px-3">
                <x-circ-checkbox model="ids" id="circ-1">
                    <div class="h-full">
                        <div class="w-24 h-full relative truncate text-base text-gray-900 dark:text-gray-100">
                            <div class="absolute flex w-full h-full opacity-20 bg-gray-200 dark:bg-gray-700">
                                <div class="m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z"></path></svg>
                                </div>
                            </div>
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <i class="fa fa-plus mr-2"></i>1 EA
                            </div>
                        </div>
                    </div>
                    <div class="grow truncate px-2">
                        <div class="flex items-center truncate">
                            <div class="grow truncate p-3 sm:px-4">
                                <div class="truncate font-medium text-gray-900 dark:text-gray-100">
                                    A BIG ITEM NAME
                                </div> 
                                <div class="truncate mb-1">
                                    A DESCRIPTION WITH BIG TEXT
                                </div>
                                <div class="truncate">
                                    <i class="fa fa-map-marker-alt mr-2"></i>A2.1.1 • TBE10-191001
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-clock text-xs mx-2"></i>
                            </div>
                        </div>
                        <hr class="border-gray-300 dark:border-gray-700">
                        <div class="flex items-center py-2 px-3 sm:px-4">
                            <div>
                                <div class="w-8 h-8 mr-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                </div>
                            </div>
                            <div class="truncate">
                                <div class="truncate">
                                    <div class="text-xs truncate">Andi Permana</div>
                                    <div class="truncate">Pemasangan di mesin okc 5 long ass</div>
                                </div>
                                <div class="text-xs truncate text-gray-400 dark:text-gray-600">
                                    3 bulan yang lalu • USD 3,456.00
                                </div>
                            </div>
                        </div>
                    </div>
                </x-circ-checkbox>
                <x-circ-checkbox model="ids" id="circ-2">
                    <div class="h-full">
                        <div class="w-24 h-full relative truncate text-base text-gray-900 dark:text-gray-100">
                            <div class="absolute flex w-full h-full opacity-20 bg-gray-200 dark:bg-gray-700">
                                <div class="m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z"></path></svg>
                                </div>
                            </div>
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <i class="fa fa-plus mr-2"></i>1 EA
                            </div>
                        </div>
                    </div>
                    <div class="grow truncate px-2">
                        <div class="flex items-center truncate">
                            <div class="grow truncate p-3 sm:px-4">
                                <div class="truncate font-medium text-gray-900 dark:text-gray-100">
                                    A BIG ITEM NAME
                                </div> 
                                <div class="truncate mb-1">
                                    A DESCRIPTION WITH BIG TEXT
                                </div>
                                <div class="truncate">
                                    <i class="fa fa-map-marker-alt mr-2"></i>A2.1.1 • TBE10-191001
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-clock text-xs mx-2"></i>
                            </div>
                        </div>
                        <hr class="border-gray-300 dark:border-gray-700">
                        <div class="flex items-center py-2 px-3 sm:px-4">
                            <div>
                                <div class="w-8 h-8 mr-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                </div>
                            </div>
                            <div class="truncate">
                                <div class="truncate">
                                    <div class="text-xs truncate">Andi Permana</div>
                                    <div class="truncate">Pemasangan di mesin okc 5 long ass</div>
                                </div>
                                <div class="text-xs truncate text-gray-400 dark:text-gray-600">
                                    3 bulan yang lalu • USD 3,456.00
                                </div>
                            </div>
                        </div>
                    </div>
                </x-circ-checkbox>
                <x-circ-checkbox model="ids" id="circ-3">
                    <div class="h-full">
                        <div class="w-24 h-full relative truncate text-base text-gray-900 dark:text-gray-100">
                            <div class="absolute flex w-full h-full opacity-20 bg-gray-200 dark:bg-gray-700">
                                <div class="m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z"></path></svg>
                                </div>
                            </div>
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <i class="fa fa-plus mr-2"></i>1 EA
                            </div>
                        </div>
                    </div>
                    <div class="grow truncate">
                        <div class="flex items-center truncate">
                            <div class="grow truncate p-3 sm:px-4">
                                <div class="truncate font-medium text-gray-900 dark:text-gray-100">
                                    A BIG ITEM NAME
                                </div> 
                                <div class="truncate mb-1">
                                    A DESCRIPTION WITH BIG TEXT
                                </div>
                                <div class="truncate">
                                    <i class="fa fa-map-marker-alt mr-2"></i>A2.1.1 • TBE10-191001
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-clock text-xs mx-2"></i>
                            </div>
                        </div>
                        <hr class="border-gray-300 dark:border-gray-700">
                        <div class="flex items-center p-3 sm:px-4">
                            <div>
                                <div class="w-8 h-8 mr-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                </div>
                            </div>
                            <div class="truncate">
                                <div class="truncate">
                                    <div class="text-xs truncate">Andi Permana</div>
                                    <div class="truncate">Pemasangan di mesin okc 5 long ass</div>
                                </div>
                                <div class="text-xs truncate text-gray-400 dark:text-gray-600">
                                    3 bulan yang lalu • USD 3,456.00
                                </div>
                            </div>
                        </div>
                    </div>
                </x-circ-checkbox>
                <x-circ-checkbox model="ids" id="circ-4">
                    <div class="h-full">
                        <div class="w-24 h-full relative truncate text-base text-gray-900 dark:text-gray-100">
                            <div class="absolute flex w-full h-full opacity-20 bg-gray-200 dark:bg-gray-700">
                                <div class="m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z"></path></svg>
                                </div>
                            </div>
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <i class="fa fa-plus mr-2"></i>1 EA
                            </div>
                        </div>
                    </div>
                    <div class="grow truncate">
                        <div class="flex items-center truncate">
                            <div class="grow truncate p-3 sm:px-4">
                                <div class="truncate font-medium text-gray-900 dark:text-gray-100">
                                    A BIG ITEM NAME
                                </div> 
                                <div class="truncate mb-1">
                                    A DESCRIPTION WITH BIG TEXT
                                </div>
                                <div class="truncate">
                                    <i class="fa fa-map-marker-alt mr-2"></i>A2.1.1 • TBE10-191001
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-clock text-xs mx-2"></i>
                            </div>
                        </div>
                        <hr class="border-gray-300 dark:border-gray-700">
                        <div class="flex items-center p-3 sm:px-4">
                            <div>
                                <div class="w-8 h-8 mr-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                </div>
                            </div>
                            <div class="truncate">
                                <div class="truncate">
                                    <div class="text-xs truncate">Andi Permana</div>
                                    <div class="truncate">Pemasangan di mesin okc 5 long ass</div>
                                </div>
                                <div class="text-xs truncate text-gray-400 dark:text-gray-600">
                                    3 bulan yang lalu • USD 3,456.00
                                </div>
                            </div>
                        </div>
                    </div>
                </x-circ-checkbox>
                <x-circ-checkbox model="ids" id="circ-5">
                    <div class="h-full">
                        <div class="w-24 h-full relative truncate text-base text-gray-900 dark:text-gray-100">
                            <div class="absolute flex w-full h-full opacity-20 bg-gray-200 dark:bg-gray-700">
                                <div class="m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z"></path></svg>
                                </div>
                            </div>
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <i class="fa fa-plus mr-2"></i>1 EA
                            </div>
                        </div>
                    </div>
                    <div class="grow truncate">
                        <div class="flex items-center truncate">
                            <div class="grow truncate p-3 sm:px-4">
                                <div class="truncate font-medium text-gray-900 dark:text-gray-100">
                                    A BIG ITEM NAME
                                </div> 
                                <div class="truncate mb-1">
                                    A DESCRIPTION WITH BIG TEXT
                                </div>
                                <div class="truncate">
                                    <i class="fa fa-map-marker-alt mr-2"></i>A2.1.1 • TBE10-191001
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-clock text-xs mx-2"></i>
                            </div>
                        </div>
                        <hr class="border-gray-300 dark:border-gray-700">
                        <div class="flex items-center p-3 sm:px-4">
                            <div>
                                <div class="w-8 h-8 mr-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                </div>
                            </div>
                            <div class="truncate">
                                <div class="truncate">
                                    <div class="text-xs truncate">Andi Permana</div>
                                    <div class="truncate">Pemasangan di mesin okc 5 long ass</div>
                                </div>
                                <div class="text-xs truncate text-gray-400 dark:text-gray-600">
                                    3 bulan yang lalu • USD 3,456.00
                                </div>
                            </div>
                        </div>
                    </div>
                </x-circ-checkbox>
            </div>
        </div>
    </div>
</div>
    
