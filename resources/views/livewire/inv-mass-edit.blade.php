<div>
    @switch($step)
        @case(0)
            <div class="bg-white dark:bg-neutral-800 shadow p-6 sm:rounded-lg mb-6 max-w-lg mx-auto">
                <fieldset class="mb-6">
                    <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                        {{ __('Properti barang mana yang ingin diperbarui?') }}
                    </h2>
                    @error('prop')
                    <x-input-error messages="{{ $message }}" class="mt-2" />
                    @enderror
                    <div class="mt-4">
                        <x-radio id="prop-name" wire:model="prop" name="prop" value="1">{{ __('Nama dan Deskripsi') }}</x-radio>
                        <x-radio id="prop-status" wire:model="prop" name="prop" value="2">{{ __('Status (Aktif atau Nonaktif)') }}</x-radio>
                        <x-radio id="prop-price" wire:model="prop" name="prop" value="3">{{ __('Harga dan Mata uang') }}</x-radio>
                        <x-radio id="prop-loc" wire:model="prop" name="prop" value="4">{{ __('Lokasi ') }}</x-radio>
                        <x-radio id="prop-tag" wire:model="prop" name="prop" value="5">{{ __('Tag ') }}</x-radio>
                        <x-radio id="prop-limit" wire:model="prop" name="prop" value="6">{{ __('Batas qty utama') }}</x-radio>
                    </div>

                </fieldset>
                <fieldset class="mb-6">
                    <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                        {{ __('Identitas barang mana yang ingin digunakan?') }}
                    </h2>
                    @error('ref')
                    <x-input-error messages="{{ $message }}" class="mt-2" />
                    @enderror
                    <div class="mt-4">
                        <x-radio id="ref-calid" wire:model="ref" name="ref" value="1">{{ __('ID Caldera') }}</x-radio>
                        <x-radio id="ref-code" wire:model="ref" name="ref" value="2">{{ __('Kode item') }}</x-radio>    
                    </div>  
                </fieldset>
                <x-primary-button type="button" wire:click="advance(1)">{{ __('Lanjut') }}</x-primary-button>
            </div>            
            @break

        @case(1)
        <div class="bg-white dark:bg-neutral-800 shadow p-6 sm:rounded-lg mb-6 max-w-lg mx-auto">
            <div>{{  __('Mengedit massal') . ' ' }}<x-badge>{{ $propName }}</x-badge>{{ ' ' . __('dengan') . ' ' }}<x-badge>{{ $refName }}</x-badge>.</div>
            <hr class="border-neutral-200 dark:border-neutral-700 my-6">
            <div class="flex gap-x-4 mt-2">
                <x-text-button wire:click="advance(0)"><i
                class="fa fa-undo mr-2"></i>{{ __('Ulangi dari awal') }}</x-text-button>
                <x-text-button wire:click="download"><i
                class="fa fa-download mr-2"></i>{{ __('Unduh templat') }}</x-text-button></div>

        </div>
            <div class="flex justify-center items-center">
                <div class="max-w-sm px-3 sm:px-0">
                    <div class="flex flex-col gap-4 text-sm mx-auto text-center text-neutral-600 dark:text-neutral-400">
                        <div class="text-center text-neutral-500 py-8 text-4xl"><i class="fa fa-upload"></i></div>
                        <x-secondary-button x-on:click="$refs.file.click()"
                            class="w-full">{{ __('Pilih file') }}</x-secondary-button>
                        <input x-ref="file" wire:model="file" type="file" accept=".csv" class="hidden" />
                        <div>
                            <div>{{ __('Format CSV, maksimum 100 baris') }}</div>
                        </div>
                    </div>
                </div>
            </div> 
            @break

        @case(2)
        
            @break
            
    @endswitch
</div>
