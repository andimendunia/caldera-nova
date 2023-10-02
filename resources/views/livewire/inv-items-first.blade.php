<div>
    <form wire:submit="first" class="p-6">    
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Tambah barang') }}
        </h2>        
        <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
            {{ __('Caldera akan mencari barang dengan area dan kode item yang kamu tentukan di bawah. Bila tidak ditemukan, kamu akan diarahkan ke halaman buat barang.') }}
        </p>        
        <div class="mt-6">
            <x-text-input wire:model="code" class="mt-4" type="text" placeholder="{{ __('Kode item') }}" />
            <x-select wire:model="area_id" class="mt-4">
                <option value=""></option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </x-select>  
            @error('area_id')
                <x-input-error messages="{{ $message }}" class="mt-2" />
            @enderror
        </div>        
        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Tutup') }}
            </x-secondary-button>
            <x-primary-button class="ml-3">
                {{ __('Lanjut') }}
            </x-primary-button>
        </div>
    </form>
    <div wire:loading.class.remove="hidden"
    class="w-full h-full absolute top-0 left-0 bg-white dark:bg-neutral-800 opacity-80 hidden"></div>
    <x-spinner wire:loading.class.remove="hidden" class="hidden"></x-spinner>
</div>
