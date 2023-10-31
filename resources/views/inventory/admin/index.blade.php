<div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-2">
            <x-tab href="{{ route('inventory', [ 'nav' => 'admin' ])}}" :active="!$view" class="text-center">{{__('Area')}}</x-tab>
            <x-tab href="{{ route('inventory', [ 'nav' => 'admin', 'view' => 'global' ])}}" :active="$view == 'global'" class="text-center">{{__('Global')}}</x-tab>
        </div>
        @if(!$view)
        <div class="grid grid-cols-1 gap-3 my-8">
            <x-card-button type="button" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'inv-first')">
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
            <x-modal name="inv-first">
                <livewire:inv-first lazy />
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
        <div class="grid grid-cols-1 gap-3 my-8">
            <x-card-link href="{{ route('inventory', ['nav' => 'manage-auth']) }}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-user-lock"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-2 sm:py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Kelola wewenang')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Kelola wewenang pengguna inventaris')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
            <x-card-link href="{{ route('inventory', ['nav' => 'manage-areas']) }}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-building"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-2 sm:py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Kelola area')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Kelola area inventaris')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
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
    
