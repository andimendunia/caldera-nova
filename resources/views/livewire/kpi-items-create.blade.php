<div>
    <form wire:submit="save" class="p-6">
        <div class="flex justify-between items-start">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Buat item KPI') }}
            </h2>
            <x-text-button type="button" x-on:click="$dispatch('close')"><i class="fa fa-times"></i></x-text-button>
        </div>
        <div class="mt-6">
            <label class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Area') }}</label>
            <div class="px-3">{{ $area_name ?? __('Tak ada area yang dipilih') }}</div>
            @error('area_id')
                <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
            @enderror
        </div>
        <div class="mt-6">
            <label for="kpi-item-year" class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Tahun') }}</label>
            <x-text-input id="kpi-item-year" wire:model="item_year" type="number" />
            @error('item_year')
                <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
            @enderror
        </div>
        <div class="mt-6">
            <label for="kpi-item-name" class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Nama') }}</label>
            <x-text-input id="kpi-item-name" wire:model="item_name" type="text" />
            @error('item_name')
                <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
            @enderror
        </div>
        <div class="mt-6">
            <label for="kpi-item-unit" class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Satuan') }}</label>
            <x-text-input id="kpi-item-unit" wire:model="item_unit" type="text" />
            @error('item_unit')
                <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
            @enderror
        </div>
        <div class="mt-6 flex">
            <x-secondary-button type="submit">
                <i class="fa fa-save mr-2"></i>
                {{ __('Simpan') }}
            </x-secondary-button>
        </div>
    </form>  
    <x-spinner-bg wire:loading.class.remove="hidden"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden" class="hidden"></x-spinner>
</div>