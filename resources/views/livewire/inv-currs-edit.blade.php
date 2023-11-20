<div>
    <form wire:submit="update()" class="p-6">
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Edit mata uang') }}
        </h2>
        <div class="mt-6">
            <x-text-input id="inv-curr-name" wire:model="name" type="text" placeholder="{{ __('Nama mata uang') }}" />
            @error('name')
                <x-input-error messages="{{ $message }}" class="mt-2" />
            @enderror
            @if ($curr->id != 1)
                <x-text-input id="inv-curr-rate" Wire:model="rate" type="number" class="mt-4"
                    placeholder="{{ __('Nilai tukar') }}" />
                <div class="text-sm mt-2">{{ __('Nilai tukar terhadap mata uang utama.') }}</div>
                @error('rate')
                    <x-input-error messages="{{ $message }}" class="mt-2" />
                @enderror
            @else
                <input type="hidden" wire:model="rate" />
            @endif
        </div>
        <div x-data="{ open: false }" class="mt-6">
            <div x-show="!open" class="flex justify-between">
                @if ($curr->id != 1)
                    <x-text-button type="button" class="text-red-500 mt-auto"
                        x-on:click="open = true">{{ __('Hapus') }}</x-text-button>
                @else
                    <div></div>
                @endif
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
    <x-spinner-bg wire:loading.class.remove="hidden"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden" class="hidden"></x-spinner>
</div>
