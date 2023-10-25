<x-layout-inventory title="{{ $title }}" prev="{{ $prev }}" header="{{ $header }}" nav="" navs="">
    <div class="sm:py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
        <livewire:inv-items-form :$inv_item />   
    </div>
</x-layout-inventory>