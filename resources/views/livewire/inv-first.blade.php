<div>
    <form wire:submit="first" class="p-6">
        <div class="flex justify-between items-center text-lg mb-6 font-medium text-neutral-900 dark:text-neutral-100">
            <h2>
                {{ __('Buat barang') }}
            </h2>
            <x-text-button type="button" x-on:click="$dispatch('close')"><i class="fa fa-times"></i></x-text-button>
        </div>
        <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
            {{ __('Caldera akan mencari barang dengan area dan kode item yang kamu tentukan di bawah. Bila tidak ditemukan, kamu akan diarahkan ke halaman buat barang.') }}
        </p>
        <div class="mt-6">
            <x-text-input wire:model="code" class="mt-4" type="text" placeholder="{{ __('Kode item') }}" />
            <x-select wire:model="inv_area_id" class="mt-4">
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </x-select>
            <div wire:key="error-inv_area_id">
                @error('inv_area_id')
                    <x-input-error messages="{{ $message }}" class="mt-2" />
                @enderror
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <x-secondary-button type="submit" class="ml-3">
                {{ __('Lanjut') }}
            </x-secondary-button>
        </div>
    </form>
    <x-spinner-bg wire:loading.class.remove="hidden"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden" class="hidden"></x-spinner>
</div>
