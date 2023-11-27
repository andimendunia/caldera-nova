<div>
    @if (!$is_valid)
        <div class="flex">
            <div class="max-w-sm px-3 sm:px-0 mb-10 mx-auto">
                <x-secondary-button x-on:click="$refs.file.click()" class="w-full mb-3"><i
                        class="fa fa-upload mr-2"></i>{{ __('Unggah') }}</x-secondary-button>
                <input x-ref="file" wire:model="file" type="file" class="hidden" />
                <div class="text-sm mx-auto text-center text-neutral-600 dark:text-neutral-400">
                    <x-link href="#">{{ __('Unduh berkas contoh') }}</x-link>
                </div>
            </div>
        </div>
    @else
        <div class="flex justify-between">
            <div class="flex items-center truncate p-1 gap-x-2">
                <i class="far fa-file"></i>
                <div class="truncate text-neutral-600 dark:text-neutral-400">{{ $file->getClientOriginalName() }}</div>
                <div>·</div>
                <x-text-button wire:click="reupload" type="button" class="mr-2 uppercase">{{ __('Buang') }}</x-text-button>
            </div>
            <x-primary-button wire:click="parse" type="button">{{ __('Lanjut') }}</x-primary-button>
        </div>

        <div x-data="{ data: @entangle('data'), submitRow: function(index) { /* ... */ } } }" class="overflow-x-scroll bg-white dark:bg-neutral-800 shadow sm:rounded-lg mt-6">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('Kode') }}</th>
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('Deskripsi') }}</th>
                        <th>{{ __('UOM') }}</th>
                        <th>{{ __('Qty') }}</th>
                        <th>{{ __('Jenis') }}</th>
                        <th>{{ __('Keterangan') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="row in data">
                        <tr>
                            <td x-text="row.status"></td>
                            <td x-text="row.code"></td>
                            <td x-text="row.name"></td>
                            <td x-text="row.desc"></td>
                            <td x-text="row.uom"></td>
                            <td x-text="row.qty"></td>
                            <td x-text="row.qtype"></td>
                            <td x-text="row.remarks"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    @endif
</div>
