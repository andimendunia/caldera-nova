<div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-2">
            <x-tab href="{{ route('inventory', [ 'nav' => 'admin' ])}}" :active="!$view" class="text-center">{{__('Area')}}</x-tab>
            <x-tab href="{{ route('inventory', [ 'nav' => 'admin', 'view' => 'global' ])}}" :active="$view == 'global'" class="text-center">{{__('Global')}}</x-tab>
        </div>
        @if(!$view)
        <div class="grid grid-cols-1 gap-3 my-8">
            <x-card-button type="button" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'create-item')">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-plus"></i></div>
                        </div>
                    </div>
                    <div class="grow text-left truncate py-2 sm:py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Tambah barang baru')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Tambah barang menggunakan kode item')}}
                        </div>
                    </div>
                </div>
            </x-card-button>
            <x-modal name="create-item" focusable>
                <form method="post" action="#" class="p-6">
                    @csrf        
                    <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                        {{ __('Tambah barang') }}
                    </h2>        
                    <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                        {{ __('Caldera akan mencari barang dengan area dan kode item yang kamu tentukan di bawah. Bila tidak ditemukan, kamu akan diarahkan ke halaman buat barang.') }}
                    </p>        
                    <div class="mt-6">
                        <x-select name="inv-area" class="mb-4">
                            <option value="">{{ __('Area') }}</option>
                            <option value="">{{ __('TT MM') }}</option>
                            <option value="">{{ __('TT MM Cons') }}</option>
                        </x-select>  
                        <x-text-input id="inv-itemcode" class="mb-4" name="inv-itemcode" type="text" placeholder="{{ __('Kode item') }}" />
                    </div>        
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-secondary-button>
        
                        <x-primary-button class="ml-3">
                            {{ __('Lanjut') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
            <x-card-link href="{{ route('inventory', ['nav' => 'mass-circ'])}}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-arrow-right-arrow-left"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-2 sm:py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Sirkulasi massal')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Lakukan penambahan atau pengambilan secara massal')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
            <x-card-link href="{{ route('inventory', ['nav' => 'mass-update'])}}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-arrows-rotate"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-2 sm:py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Perbarui massal')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Lakukan pembaruan informasi barang secara massal')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
            <x-card-link href="{{ route('inventory', ['nav' => 'manage-locs'])}}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-map-marker-alt"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-2 sm:py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Kelola lokasi')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Kelola semua lokasi di satu area inventaris')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
            <x-card-link href="{{ route('inventory', ['nav' => 'manage-tags']) }}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-tag"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-2 sm:py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Kelola tag')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Kelola semua tag di satu area inventaris')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
        </div>
        @else
        <div class="text-sm text-center px-6 sm:px-0 text-neutral-600 dark:text-neutral-400 py-8"><i class="fa fa-exclamation-triangle mr-2"></i>Tindakan berikut akan mempengaruhi semua area inventaris</div>
        <div class="grid grid-cols-1 gap-3 mb-8">
            <x-card-link href="{{ route('inventory', ['nav' => 'manage-currs']) }}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-coins"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-2 sm:py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Kelola mata uang')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Kelola mata uang beserta konversinya')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
            <x-card-link href="{{ route('inventory', ['nav' => 'manage-uoms']) }}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-weight-scale"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-2 sm:py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Kelola UOM')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Kelola satuan barang')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
        </div>
        @endif
    </div>
</div>
    
