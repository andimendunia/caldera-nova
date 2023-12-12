<div>
    @if (!$isValid)
    <div class="flex justify-center">
        <div class="max-w-lg">
            <div class="bg-white dark:bg-neutral-800 shadow p-6 sm:rounded-lg mb-6">
                <fieldset class="mb-6">
                    <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                        {{ __('Properti barang mana yang ingin diperbarui?') }}
                    </h2>
                    <div class="mt-4">
                        <x-radio id="prop-name" name="prop" value="name">{{ __('Nama dan Deskripsi') }}</x-radio>
                        <x-radio id="prop-status" name="prop" value="status">{{ __('Status (Aktif atau Nonaktif)') }}</x-radio>
                        <x-radio id="prop-price" name="prop" value="price">{{ __('Harga dan Mata uang') }}</x-radio>
                        <x-radio id="prop-loc" name="prop" value="loc">{{ __('Lokasi ') }}</x-radio>
                        <x-radio id="prop-tag" name="prop" value="tag">{{ __('Tag ') }}</x-radio>
                        <x-radio id="prop-limit" name="prop" value="limit">{{ __('Batas qty utama') }}</x-radio>
                    </div>  
                </fieldset>
                <fieldset>
                    <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                        {{ __('Identitas barang mana yang ingin digunakan?') }}
                    </h2>
                    <div class="mt-4">
                        <x-radio id="ref-calid" name="ref" value="calid">{{ __('ID Caldera') }}</x-radio>
                        <x-radio id="ref-code" name="ref" value="code">{{ __('Kode item') }}</x-radio>    
                    </div>  
                </fieldset>
            </div>
        </div>
    </div>
        <div class="flex">
            <div class="max-w-sm px-3 sm:px-0 mb-10 mx-auto">
                <div class="flex flex-col gap-6 text-sm mx-auto text-center text-neutral-600 dark:text-neutral-400">
                    <div class="text-center text-neutral-500 py-8 text-4xl"><i class="fa fa-upload"></i></div>
                    <x-secondary-button x-on:click="$refs.file.click()"
                        class="w-full mb-3">{{ __('Pilih file') }}</x-secondary-button>
                    <input x-ref="file" wire:model="file" type="file" accept=".csv" class="hidden" />
                    <div>
                        <div>{{ __('Format CSV, ukuran maksimum 1 MB') }}</div>
                        <div class="mt-2"><x-text-button wire:click="download"><i
                                    class="fa fa-download mr-2"></i>{{ __('Unduh templat') }}</x-text-button></div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif
</div>
