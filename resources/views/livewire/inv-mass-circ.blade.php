<div>
    @if (!$isValid)
        <div class="flex">
            <div class="max-w-sm px-3 sm:px-0 mb-10 mx-auto">
                <div class="flex flex-col gap-6 text-sm mx-auto text-center text-neutral-600 dark:text-neutral-400">
                    <div class="text-center text-neutral-500 pb-8 text-4xl"><i class="fa fa-upload"></i></div>
                    <x-secondary-button x-on:click="$refs.file.click()"
                        class="w-full mb-3">{{ __('Pilih file') }}</x-secondary-button>
                    <input x-ref="file" wire:model="file" type="file" accept=".csv" class="hidden" />
                    <div>
                        <div>{{ __('Format CSV, ukuran maksimum 1 MB') }}</div>
                        <div class="mt-2"><x-link href="#"><i
                                    class="fa fa-download mr-2"></i>{{ __('Unduh templat') }}</x-link></div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div x-data="{
            data: @entangle('data'),
            dadone: '0',
            datotal: '0',
            isStarted: false,
            apiRoute: '{{ route('invCirc.create') }}',
            csrfToken: document.head.querySelector('meta[name=\'csrf-token\']').content,
            createCirc: async function(dataObject) {
                try {
                    const response = await fetch(this.apiRoute, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken,
                        },
                        body: JSON.stringify(dataObject),
                    });
        
                    if (response.ok) {
                        const responseData = await response.json();
                        dataObject.status = responseData.status;
                        this.dDone++
        
                    } else {
                        dataObject.status.success = false;
                        dataObject.status.code = 'S';
                        dataObject.status.msg = '{{ __('Tidak dapat meraih data') }}';
                    }
                } catch (error) {
                    dataObject.status.success = false;
                    dataObject.status.code = 'C';
                    dataObject.status.msg = error;
                }
            },
            massCreate: function() {
                this.isStarted = true;
                this.rowTotal = Object.keys(this.data).length;
                for (let i = 0; i < this.rowTotal; i++) {
                    const dataObject = this.data[i];
                    this.createCirc(dataObject);
                }
            }
        }">
            <div class="flex justify-between">
                <div class="flex items-center truncate p-1 gap-x-2">
                    <div x-text="dadone"></div>
                    <div class="mx-1">/</div>
                    <div x-text="datotal"></div>
                </div>
            </div>
                <div class="flex gap-2">
                    <x-secondary-button x-show="!isStarted" wire:click="reupload"
                        type="button">{{ __('Unggah ulang') }}</x-secondary-button>
                    <x-primary-button x-show="!isStarted" x-on:click="massCreate" type="button"><i
                            class="fa fa-play mr-2"></i>{{ __('Mulai') }}</x-primary-button>
                </div>
            </div>

            <div class="overflow-x-auto bg-white dark:bg-neutral-800 shadow sm:rounded-lg mt-6">
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
                                <td :class="row.status.success ? 'text-green-500' : 'text-red-500'">
                                    <i x-show="row.status" class="fa mr1"
                                        :class="row.status.success ? 'fa-check-circle' : 'fa-exclamation-circle'"></i>
                                    <span x-text="row.status.code"></span>
                                </td>
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
        </div>
    @endif
</div>
