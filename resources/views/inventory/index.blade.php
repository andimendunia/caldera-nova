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
        <div class="py-20 max-w-xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
            <x-text-input-icon icon="fa fa-fw fa-search" id="inv-q" name="q" type="text" placeholder="{{ __('Aku ingin mencari barang...') }}" autofocus autocomplete="q" />
        </div>
        <div class="py-10 max-w-5xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
            <div class="flex">
                <div class="text-center max-w-sm mx-auto py-8">
                    {{ __('Ketahui informasi penting dalam sekali pandang dengan menggunakan panel monitor') }}
                </div>
            </div>
            <div class="flex"><x-secondary-button class="mx-auto">{{ __('Tambah panel monitor') }}</x-secondary-button></div>
        </div>
        {{-- Ideas for inventory home page
        - Recently emptied. Baru saja habis. qty 0 updated,  
        - New items. Barang baru. newest items, 
        - About to expire. Akan kedaluwarsa, circs pending oldest
        - Recent circulations. Sirkulasi terkini, circs newest (pending, approved, rejected)
        - Large-cost circulations. Sirkulasi biaya tinggi, circs highest usd, direction  
         --}}
    @endswitch
</x-inventory>