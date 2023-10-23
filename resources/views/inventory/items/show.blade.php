<x-layout-inventory title="{{ $title }}" prev="{{ $prev }}" header="" nav="" navs="true">
    <div class="sm:py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
        <livewire:inv-item-show :$inv_item />
        <hr class="border-neutral-200 dark:border-neutral-800" />
    </div>
</x-inventory>