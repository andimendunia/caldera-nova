<div>
    <form wire:submit="update()" class="p-6">
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Edit area') }}
        </h2>
        <div class="mt-6">
            <x-text-input id="inv-area-name" wire:model="name" type="text" placeholder="{{ __('Nama area') }}" />
            @error('name')
                <x-input-error messages="{{ $message }}" class="mt-2" />
            @enderror
        </div>
        <div x-data="{ open: false }" class="mt-6">
            <div x-show="!open" class="flex justify-between">
                <x-text-button type="button" class="text-red-500 mt-auto"
                    x-on:click="open = true">{{ __('Hapus') }}</x-text-button>
                <div>
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Tutup') }}
                    </x-secondary-button>
                    <x-primary-button type="submit" class="ml-3">
                        {{ __('Simpan') }}
                    </x-primary-button>
                </div>
            </div>
            <div x-cloak x-show="open" class="flex justify-end">
                <x-secondary-button type="button" x-on:click="open = false">
                    {{ __('Kembali') }}
                </x-secondary-button>
                <x-danger-button wire:click="delete()" type="button" class="ml-3">
                    {{ __('Hapus') }}
                </x-danger-button>
            </div>
        </div>
    </form>
    <div wire:loading.class.remove="hidden"
        class="w-full h-full absolute top-0 left-0 bg-white/70 dark:bg-neutral-800/70 hidden"></div>
    <x-spinner wire:loading.class.remove="hidden" class="hidden"></x-spinner>
</div>
