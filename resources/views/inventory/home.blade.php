<x-inventory title="{{ $title }}" header="{{ $header }}" prev="{!! $prev !!}" nav="{{ $nav }}">
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
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-200">
            <div class="text-center"></div>
        </div>
    @endswitch
</x-inventory>