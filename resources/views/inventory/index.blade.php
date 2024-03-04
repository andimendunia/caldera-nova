<x-layout-inventory title="{{ $title }}" header="{{ $header }}" prev="{!! $prev !!}" nav="{{ $nav }}" navs="{{ $navs }}">
    @switch($nav)
    @case('search')
        @include('inventory.search')  
        @break
    @case('circs')
        @include('inventory.circs')  
        @break
    @case('admin')
        @include('inventory.admin.index')
        @break
    @case('mass-circ')
        @include('inventory.admin.mass-circ')
        @break
    @case('mass-edit')
        @include('inventory.admin.mass-edit')
        @break
    @case('manage-locs')
        @include('inventory.admin.manage-locs')
        @break
    @case('manage-tags')
        @include('inventory.admin.manage-tags')
        @break
    @case('manage-areas')
        @include('inventory.admin.manage-areas')
        @break  
    @case('manage-currs')
        @include('inventory.admin.manage-currs')
        @break
    @case('manage-uoms')
        @include('inventory.admin.manage-uoms')
        @break
    @case('manage-auth')
        @include('inventory.admin.manage-auth')
        @break
    @default
    <div class="max-w-xl lg:max-w-2xl mx-auto px-4 py-16">        
        <h2 class="text-4xl font-extrabold dark:text-white">{{ __('Selamat datang di Inventaris') }}</h2>
        <p class="mt-4 mb-12 text-lg text-neutral-500">{{ __('Cari dan buat sirkulasi barang.') }}</p>
        <p class="mb-4 text-lg font-normal text-neutral-500 dark:text-neutral-400">{{ __('Mulai dengan mengklik menu navigasi di pojok kanan atas.') }}</p>

        <ul class="space-y-4 text-left text-neutral-500 dark:text-neutral-400">
            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <i class="fa fa-search fa-fw me-2"></i>
                <span><span class="font-semibold text-neutral-900 dark:text-white">{{ __('Cari') }}</span>{{ ' ' . __('untuk menjelajah barang dan melakukan sirkulasi barang.') }}</span>
            </li>
            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <i class="fa fa-arrow-right-arrow-left fa-fw me-2"></i>
                <span><span class="font-semibold text-neutral-900 dark:text-white">{{ __('Sirkulasi') }}</span>{{ ' ' . __('untuk melihat sirkulasi barang yang telah dibuat beserta statusnya.') }}</span>
            </li>
            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <i class="fa fa-ellipsis-h fa-fw me-2"></i>
                <span><span class="font-semibold text-neutral-900 dark:text-white">{{ __('Administrasi') }}</span> {{ ' ' . __('untuk mengelola barang beserta propertinya dan lainnya.') }}</span>
            </li>
        </ul>
    </div>
    {{-- <div class="max-w-xl lg:max-w-6xl mx-auto px-4">
        <livewire:inv-home-search />
        <div class="text-neutral-500 dark:text-neutral-200 pb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mt-4">
                <x-modal name="inv-obpanel">
                    <div class="p-6">      
                        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{ __('Panel pengamatan') }}
                        </h2>        
                        <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                            {{ __('Dapatkan informasi penting dengan sekali pandang seperti barang yang baru saja habis, sirkulasi termahal dalam sebulan terakhir, atau informasi penting lainnya.') }}                                </p>             
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Paham') }}
                            </x-secondary-button>
                        </div>
                    </div>
                </x-modal>
                <div class="sm:rounded-lg border-dashed border-2 border-neutral-200 dark:border-neutral-800 text-neutral-500">   
                    <div class="h-64 flex items-center">
                        <div class="text-center mx-auto">
                            <div class="text-4xl mb-2 text-neutral-300 dark:text-neutral-700 ">
                                <i class="far fa-rectangle-list"></i>
                            </div>
                            <h2 class="text-xl">
                                {{ __('Panel pengamatan') }}
                                <x-link href="#" class="text-sm" x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'inv-obpanel')"><i class="far fa-question-circle"></i></x-link>
                            </h2>
                        </div>
                    </div>
                </div>                
                <div class="sm:rounded-lg border-dashed border-2 border-neutral-200 dark:border-neutral-800 text-neutral-500">  
                    <div class="h-64 flex items-center">
                        <div class="text-center mx-auto">
                            <x-secondary-button><i class="fa fa-plus mr-2"></i>{{ __('Buat panel') }}</x-secondary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        {{-- 

            Wizards
            1. Apa yang ingin kamu amati: Barang, sirkulasi, ringkasan
            2a. barang: area mana, tag: semua, or specific, kategori: barang yang baru saja habis, barang yang baru ditambahkan // barang nonaktif tidak akan ditampilkan
            2b. sirkulasi: area mana, kategori: sirkulasi terkini yang tertunda, sirkulasi terkini yang disetujui
            2c. ringkasan: area mana, rentang: bulan ini, bulan kemarin, kategori: pengambilan, penambahan
            
            Ideas for inventory home page
        - Recently emptied. Baru saja habis. qty 0 updated,  
        - New items. Barang baru. newest items, 
        - About to expire. Akan kedaluwarsa, circs pending oldest
        - Recent circulations. Sirkulasi terkini, circs newest (pending, approved, rejected)
        - Large-cost circulations. Sirkulasi biaya tinggi, circs highest usd, direction  
         --}}
    @endswitch
</x-layout-inventory>