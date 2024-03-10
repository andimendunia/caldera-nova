<div>
    <form wire:submit="update()" class="p-6">
        <div class="flex justify-between items-start">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Edit item KPI') }}
            </h2>
            <x-text-button type="button" x-on:click="$dispatch('close')"><i class="fa fa-times"></i></x-text-button>
        </div>
        <div class="flex">
            <div class="mt-6">
                <label class="block px-3 mb-2 uppercase text-xs">{{ __('Area') }}</label>
                <div class="px-3">{{ $area_name ?? __('Gagal memuat nama area') }}</div>
            </div>
            <div class="mt-6">
                <label class="block px-3 mb-2 uppercase text-xs">{{ __('Tahun') }}</label>
                <div class="px-3">{{ $year ?? __('Gagal memuat tahun') }}</div>
            </div>
        </div>
        <div class="mt-6">
            <label for="kpi-item-name" class="block px-3 mb-2 uppercase text-xs">{{ __('Nama') }}</label>
            <x-text-input id="kpi-item-name" wire:model="name" type="text" />
            @error('name')
                <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
            @enderror
        </div>
        <div class="mt-6">
            <label for="kpi-item-unit" class="block px-3 mb-2 uppercase text-xs">{{ __('Satuan') }}</label>
            <x-text-input id="kpi-item-unit" wire:model="unit" type="text" />
            @error('unit')
                <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
            @enderror
        </div>
        <div class="mt-6">
            <label for="kpi-item-group" class="block px-3 mb-2 uppercase text-xs">{{ __('Grup') }}</label>
            <x-text-input id="kpi-item-group" wire:model="group" type="text" />
            @error('group')
                <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
            @enderror
        </div>
        <div class="mt-6">
            <label for="kpi-item-order" class="block px-3 mb-2 uppercase text-xs">{{ __('Urutan') }}</label>
            <x-text-input id="kpi-item-order" wire:model="order" type="number" />
            @error('order')
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