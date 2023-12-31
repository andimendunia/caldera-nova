<div>
    <form wire:submit="save" class="p-6">
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Buat mata uang') }}
        </h2>
        <div class="mt-6">
            <x-text-input id="inv-curr-name" wire:model="name" type="text"
                placeholder="{{ __('Mata uang') }}" />
            @error('name')
                <x-input-error messages="{{ $message }}" class="mt-2" />
            @enderror
            <x-text-input id="inv-curr-rate" Wire:model="rate" type="number" class="mt-4" 
                placeholder="{{ __('Nilai tukar') }}" />
            <div class="text-sm mt-2">{{ __('Nilai tukar terhadap mata uang utama.') }}</div>
            @error('rate')
                <x-input-error messages="{{ $message }}" class="mt-2" />
            @enderror        </div>
        <div class="mt-6 flex justify-end">
            <x-secondary-button type="button" x-on:click="$dispatch('close')">
                {{ __('Tutup') }}
            </x-secondary-button>
    
            <x-primary-button type="submit" class="ml-3">
                {{ __('Simpan') }}
            </x-primary-button>
        </div>
    </form>  
    <x-spinner-bg wire:loading.class.remove="hidden"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden" class="hidden"></x-spinner>
</div>