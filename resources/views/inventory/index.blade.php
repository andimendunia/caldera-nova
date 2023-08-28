<x-inventory title="{{ $title }}" header="{{ $header }}" prev="{!! $prev !!}" nav="{{ $nav }}" navs="{{ $navs }}">
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
    @case('mass-update')
        @include('inventory.admin.mass-update')
        @break
    @case('manage-locs')
        @include('inventory.admin.manage-locs')
        @break
    @case('manage-tags')
        @include('inventory.admin.manage-tags')
        @break
    @case('manage-currs')
        @include('inventory.admin.manage-currs')
        @break
    @case('manage-uoms')
        @include('inventory.admin.manage-uoms')
        @break
    @default
        <div class="py-16 max-w-xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
            <x-text-input-icon icon="fa fa-fw fa-search" id="inv-q" name="q" type="text" placeholder="{{ __('Aku ingin mencari barang...') }}" autofocus autocomplete="q" />
        </div>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-neutral-500 dark:text-neutral-200">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mt-4 ">
                <div class="sm:rounded-lg border-dashed border-2 border-neutral-200 dark:border-neutral-800 text-neutral-500 p-6 text-center">   
                    <h2 class="text-xl">
                        {{ __('Panel pengamatan') }}
                    </h2>
                    <p class="mt-3 text-sm">
                        {{ __('Dapatkan informasi penting dengan sekali pandang seperti barang yang baru saja habis atau informasi penting lainnya.') }}
                    </p>
                    <p class="mt-3 text-sm">
                        {{ __('Klik tombol "+" untuk memulai.') }}
                    </p>
                </div>
                <x-card-button type="button" class="h-72">
                    <i class="fa fa-plus text-2xl"></i>
                </x-card-button>
            </div>
        </div>
        {{-- 

            Wizards
            1. Apa yang ingin kamu amati: Barang, sirkulasi, ringkasan
            2. barang: area mana, tag: semua, or specific, kategori: barang yang baru saja habis, barang yang baru ditambahkan // barang nonaktif tidak akan ditampilkan
            3. sirkulasi: area mana, kategori: sirkulasi terkini yang tertunda, sirkulasi terkini yang disetujui
            4. ringkasan: area mana, rentang: bulan ini, bulan kemarin, kategori: pengambilan, penambahan
            
            Ideas for inventory home page
        - Recently emptied. Baru saja habis. qty 0 updated,  
        - New items. Barang baru. newest items, 
        - About to expire. Akan kedaluwarsa, circs pending oldest
        - Recent circulations. Sirkulasi terkini, circs newest (pending, approved, rejected)
        - Large-cost circulations. Sirkulasi biaya tinggi, circs highest usd, direction  
         --}}
    @endswitch
</x-inventory>