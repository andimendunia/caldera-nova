<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-200">
    <div class="flex flex-col gap-x-4 md:gap-x-8 sm:flex-row">
        <div>
            <div class="w-full sm:w-44 md:w-56 px-3 sm:px-0 mb-10">
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
                            <div class="text-sm text-gray-400 dark:text-gray-500 p-6 text-center">{{__('Tidak ada pencarian tersimpan')}}</div>
                            {{-- <x-dropdown-link :href="route('profile.edit')">
                                {{ __('OKC') }}
                            </x-dropdown-link> --}}
                            <hr class="border-gray-300 dark:border-gray-600" />
                            <x-dropdown-link :href="route('profile.edit')">
                                <i class="fa fa-fw fa-save mr-2"></i>{{ __('Simpan pencarian ini') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
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
                    <label for="inv-filter" class="p-3 inline-block text-gray-400 dark:text-gray-600"><i class="fa fa-filter mr-3"></i>Filter</label>
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
                <hr class="my-5 border-gray-300 dark:border-gray-700" />
                <div class="m-3">
                    <x-link href="#" class="text-sm">{{__('Unduh CSV')}}</x-link>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="flex justify-between w-full px-3 sm:px-0">
                <div class="my-auto">{{'0'.' '.__('barang')}}</div>
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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mt-4">
                <x-card-link href="/inventory/items/1">
                    <div class="flex">
                        <div>
                            <div class="flex w-32 h-full bg-gray-200 dark:bg-gray-700">
                                <div class="m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg"  class="block h-16 w-auto fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z" /></svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex grow truncate p-2 sm:p-4">
                            <div class="grow truncate">
                                <div class="truncate text-lg font-medium text-gray-900 dark:text-gray-100">
                                    A long link given as the item name
                                </div>                        
                                <div class="truncate text-sm text-gray-600 dark:text-gray-400">
                                    Update your account's profile information and email address.
                                </div>
                                <div class="truncate mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    TBE10-191001 • USD 123.00 / EA 
                                </div>
                                <div class="truncate mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    <span class="mr-3"><i class="fa fa-map-marker-alt mr-2"></i>A2.1.1</span>
                                    <span><i class="fa fa-tag mr-2"></i>okc, sparepart</span>                            
                                </div>
                            </div>
                            <div class="ml-2 text-right">
                                <div class="text-2xl">90</div>
                                <div>EA</div>
                            </div>
                        </div>
                    </div>
                </x-card-link>
                <div class="flex bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                    <div>
                        <div class="flex w-32 h-full bg-gray-200 dark:bg-gray-700">
                            <div class="m-auto">
                                <svg xmlns="http://www.w3.org/2000/svg"  class="block h-16 w-auto fill-current text-gray-800 dark:text-gray-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z" /></svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex grow truncate p-2 sm:p-4">
                        <div class="grow truncate">
                            <a href="#" class="truncate text-lg font-medium text-gray-900 dark:text-gray-100">
                                KNIFE HZ2N.L1
                            </a>                        
                            <div class="truncate mt-1 text-sm text-gray-600 dark:text-gray-400">
                                SOME SPECS
                            </div>
                            <div class="truncate mt-1 text-gray-600 dark:text-gray-400">
                                
                            </div>
                            <div class="truncate mt-1 text-sm text-gray-600 dark:text-gray-400">
                                TBE10-191002 • USD 12.00 / EA 
                            </div>
                            <div class="truncate mt-1 text-sm text-gray-600 dark:text-gray-400">
                                <span class="mr-3"><i class="fa fa-map-marker-alt mr-2"></i>A2.1.1</span>
                                <span><i class="fa fa-tag mr-2"></i>okc, sparepart, a long ass tag that way too long</span>                            
                            </div>
                        </div>
                        <div class="ml-2 text-right">
                            <div class="text-2xl">90</div>
                            <div>EA</div>
                        </div>
                    </div>
                </div>
                <div class="p-2 sm:p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Profile Information
                                </h2>
                        
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Update your account's profile information and email address.
                                </p>
                            </header>
                        </section>
                    </div>
                </div>
                <div class="p-2 sm:p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Profile Information
                                </h2>
                        
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Update your account's profile information and email address.
                                </p>
                            </header>
                        </section>
                    </div>
                </div>
                <div class="p-2 sm:p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Profile Information
                                </h2>
                        
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Update your account's profile information and email address.
                                </p>
                            </header>
                        </section>
                    </div>
                </div>
                <div class="p-2 sm:p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Profile Information
                                </h2>
                        
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Update your account's profile information and email address.
                                </p>
                            </header>
                        </section>
                    </div>
                </div>
                <div class="p-2 sm:p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Profile Information
                                </h2>
                        
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Update your account's profile information and email address.
                                </p>
                            </header>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
