<x-inventory title="{{ $title }}" header="{{ $header }}" prev="" nav="{{ $nav }}">
    @switch($nav)
    @case('search')
        @include('inventory.search')  
        @break
    @case('circs')
        @include('inventory.circs')  
        @break
    @case('admin')
        @include('inventory.admin')
        @break
    @default
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-200">
            <div class="text-center"></div>
        </div>
    @endswitch
</x-inventory>