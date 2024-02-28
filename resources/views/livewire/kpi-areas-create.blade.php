<div>
    <form wire:submit="save" class="p-6">
        <div class="flex justify-between items-start">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Buat area') }}
            </h2>
            <x-text-button type="button" x-on:click="$dispatch('close')"><i class="fa fa-times"></i></x-text-button>
        </div>
        <div class="mt-6">
            <x-text-input id="inv-area-name" wire:model="name" type="text"
                placeholder="{{ __('Nama area') }}" />
            @error('name')
                <x-input-error messages="{{ $message }}" class="mt-2" />
            @enderror
        </div>
        <div class="mt-6 flex">
            <x-secondary-button type="submit"><i class="fa fa-save me-2"></i>
                {{ __('Simpan') }}
            </x-secondary-button>
        </div>
    </form>  
    <x-spinner-bg wire:loading.class.remove="hidden"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden" class="hidden"></x-spinner>
</div>