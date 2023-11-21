<div>
    <form wire:submit="save" class="p-6">
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Beri wewenang') }}
        </h2>
        <div class="grid grid-cols-1 gap-y-3 mt-3">
            <div x-data="{ open: false, userq: @entangle('userq').live }" x-on:user-selected="userq = $event.detail; open = false">
                <div x-on:click.away="open = false">
                    <x-text-input-icon x-model="userq" icon="fa fa-fw fa-user" x-on:change="open = true"
                        x-ref="userq" x-on:focus="open = true" id="inv-user" class="mt-3" type="text" autocomplete="off"
                        placeholder="{{ __('Pengguna') }}" />
                    <div class="relative" x-show="open" x-cloak>
                        <div class="absolute top-1 left-0 w-full">
                            <livewire:user-select wire:key="user-select" />
                        </div>
                    </div>
                </div>
                <div wire:key="error-user_id">
                    @error('user_id')
                        <x-input-error messages="{{ $message }}" class="mt-2" />
                    @enderror
                </div>
            </div>
            <div>
                <x-select wire:model="area_id">
                    <option value=""></option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </x-select>
                <div wire:key="error-area_id">
                    @error('area_id')
                        <x-input-error messages="{{ $message }}" class="mt-2" />
                    @enderror
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-y-3 mt-6">
            <div>{{ __('Barang') }}</div>
            <x-checkbox id="item-create" wire:model="actions" value="item-create">{{ __('Buat barang') }}</x-checkbox>
            <x-checkbox id="item-loc" wire:model="actions" value="item-loc">{{ __('Perbarui lokasi barang') }}</x-checkbox>
            <x-checkbox id="item-tag" wire:model="actions" value="item-tag">{{ __('Perbarui tag barang') }}</x-checkbox>
        </div>
        <div class="grid grid-cols-1 gap-y-3 mt-6">
            <div>{{ __('Sirkulasi') }}</div>
            <x-checkbox id="circ-create" wire:model="actions" value="circ-create">{{ __('Buat sirkulasi') }}</x-checkbox>
            <x-checkbox id="circ-eval" wire:model="actions" value="circ-eval">{{ __('Evaluasi sirkulasi (setujui/tolak)') }}</x-checkbox>
        </div>
        <div class="grid grid-cols-1 gap-y-3 mt-6">
            <div>{{ __('Lain-lain') }}</div>
            <x-checkbox id="manage-tag" wire:model="actions" value="manage-tag">{{ __('Kelola (edit/hapus) tag') }}</x-checkbox>
            <x-checkbox id="manage-loc" wire:model="actions" value="manage-loc">{{ __('Kelola (edit/hapus) lokasi') }}</x-checkbox>
        </div>
        <div class="mt-6 flex justify-end">
            <x-secondary-button type="button" x-on:click="$dispatch('close')">
                {{ __('Tutup') }}
            </x-secondary-button>
            <x-primary-button type="submit" class="ml-3">
                {{ __('Simpan') }}
            </x-primary-button>
        </div>
    </form>

    <x-spinner-bg wire:loading.class.remove="hidden" wire:target="save"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden" wire:target="save" class="hidden"></x-spinner>
</div>
