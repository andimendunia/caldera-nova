<div>
    <form wire:submit="save" class="p-6">
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Beri wewenang') }}
        </h2>
        <div class="grid grid-cols-1 gap-y-3 mt-6">
            <x-text-input-icon wire:model.live="user" icon="fa fa-fw fa-user" id="inv-user" type="search" placeholder="{{ __('Pengguna') }}" />
            <x-select wire:model="inv_area_id">
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </x-select>
        </div>
        <div wire:key="error-inv_area_id">
            @error('inv_area_id')
                <x-input-error messages="{{ $message }}" class="mt-2" />
            @enderror
        </div>
        <div class="grid grid-cols-1 gap-y-3 mt-6">
            <div>{{ __('Barang') }}</div>
            <x-checkbox id="item-create" value="item-create">{{ __('Buat barang') }}</x-checkbox>
            <x-checkbox id="item-loc" value="item-create">{{ __('Perbarui lokasi barang') }}</x-checkbox>
            <x-checkbox id="item-tag" value="item-create">{{ __('Perbarui tag barang') }}</x-checkbox>
        </div>
        <div class="grid grid-cols-1 gap-y-3 mt-6">
            <div>{{ __('Sirkulasi') }}</div>
            <x-checkbox id="circ-create" value="item-create">{{ __('Buat sirkulasi') }}</x-checkbox>
            <x-checkbox id="circ-eval" value="item-create">{{ __('Evaluasi sirkulasi (setujui/tolak)') }}</x-checkbox>
        </div>
        <div class="grid grid-cols-1 gap-y-3 mt-6">
            <div>{{ __('Lain-lain') }}</div>
            <x-checkbox id="manage-tag" value="item-create">{{ __('Kelola (edit/hapus) tag') }}</x-checkbox>
            <x-checkbox id="manage-loc" value="item-create">{{ __('Kelola (edit/hapus) lokasi') }}</x-checkbox>
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

    <x-spinner-bg wire:loading.class.remove="hidden"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden" class="hidden"></x-spinner>
</div>
