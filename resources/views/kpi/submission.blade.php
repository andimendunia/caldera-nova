<div id="content" class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
    <div class="bg-white dark:bg-neutral-800 shadow rounded-lg p-4 mb-4">
        <div class="text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600 mb-4">
            {{ __('Informasi Dasar') }}</div>
        <x-text-input type="text" placeholder="{{ __('Nama') }}" />
        <div wire:key="err-name">
            @error('name')
                <x-input-error messages="{{ $message }}" class="m-2" />
            @enderror
        </div>
        <x-text-input class="mt-4" type="text" placeholder="{{ __('Deskripsi') }}" />
        <div wire:key="err-desc">
            @error('desc')
                <x-input-error messages="{{ $message }}" class="m-2" />
            @enderror
        </div>
        <x-text-input class="mt-4" type="text" placeholder="{{ __('Kode') }}" />
        <div wire:key="err-code">
            @error('code')
                <x-input-error messages="{{ $message }}" class="m-2" />
            @enderror
        </div>
    </div>
</div>
    
