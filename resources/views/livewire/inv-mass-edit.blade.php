<div>
    @switch($step)
        @case(0)
            <div class=" max-w-lg mx-auto">
                <ol class="flex items-center w-full p-3 mb-4 space-x-2 text-sm font-medium text-center text-neutral-500  sm:text-base sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-caldy-600 dark:text-caldy-500">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-caldy-600 rounded-full shrink-0 dark:border-caldy-500">1</span>{{ __('Mulai') }}<i
                            class="fa fa-chevron-right ms-2 sm:ms-4"></i>
                    </li>
                    <li class="flex items-center cursor-pointer" wire:click="advance(1)">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-neutral-500 rounded-full shrink-0 dark:border-neutral-600">2</span>{{ __('Unggah') }}<i
                            class="fa fa-chevron-right ms-2 sm:ms-4"></i>
                    </li>
                    <li class="flex items-center">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-neutral-500 rounded-full shrink-0 dark:border-neutral-600">3</span>{{ __('Tinjau') }}<i
                            class="fa fa-chevron-right ms-2 sm:ms-4"></i>
                    </li>
                    <li class="flex items-center">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-neutral-500 rounded-full shrink-0 dark:border-neutral-600">4</span>{{ __('Terapkan') }}
                    </li>
                </ol>
                <div class="bg-white dark:bg-neutral-800 shadow p-6 sm:rounded-lg mb-8">
                    <fieldset class="mb-6">
                        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{ __('Properti barang mana yang ingin diperbarui?') }}
                        </h2>
                        @error('prop')
                            <x-input-error messages="{{ $message }}" class="mt-2" />
                        @enderror
                        <div class="mt-4">
                            <x-radio id="prop-name" wire:model="prop" name="prop"
                                value="1">{{ __('Nama dan Deskripsi') }}</x-radio>
                            <x-radio id="prop-status" wire:model="prop" name="prop"
                                value="2">{{ __('Status (Aktif atau Nonaktif)') }}</x-radio>
                            <x-radio id="prop-price" wire:model="prop" name="prop"
                                value="3">{{ __('Harga dan Mata uang') }}</x-radio>
                            <x-radio id="prop-loc" wire:model="prop" name="prop"
                                value="4">{{ __('Lokasi ') }}</x-radio>
                            <x-radio id="prop-tag" wire:model="prop" name="prop"
                                value="5">{{ __('Tag ') }}</x-radio>
                            <x-radio id="prop-limit" wire:model="prop" name="prop"
                                value="6">{{ __('Batas qty utama') }}</x-radio>
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
                            <x-radio id="ref-calid" wire:model="ref" name="ref"
                                value="1">{{ __('ID Caldera') }}</x-radio>
                            <x-radio id="ref-code" wire:model="ref" name="ref"
                                value="2">{{ __('Kode item') }}</x-radio>
                        </div>
                    </fieldset>
                    <x-primary-button type="button" wire:click="advance(1)">{{ __('Lanjut') }}</x-primary-button>
                </div>
            </div>
        @break

        @case(1)
            <div class="max-w-lg mx-auto">
                <ol class="flex items-center w-full p-3 mb-4 space-x-2 text-sm font-medium text-center text-neutral-500  sm:text-base sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center cursor-pointer" wire:click="advance(0)">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-neutral-500 rounded-full shrink-0 dark:border-neutral-600">1</span>{{ __('Mulai') }}<i
                            class="fa fa-chevron-right ms-2 sm:ms-4"></i>
                    </li>
                    <li class="flex items-center text-caldy-600 dark:text-caldy-500">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-caldy-600 rounded-full shrink-0 dark:border-caldy-500">2</span>{{ __('Unggah') }}<i
                            class="fa fa-chevron-right ms-2 sm:ms-4"></i>
                    </li>
                    <li class="flex items-center">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-neutral-500 rounded-full shrink-0 dark:border-neutral-600">3</span>{{ __('Tinjau') }}<i
                            class="fa fa-chevron-right ms-2 sm:ms-4"></i>
                    </li>
                    <li class="flex items-center">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-neutral-500 rounded-full shrink-0 dark:border-neutral-600">4</span>{{ __('Terapkan') }}
                    </li>
                </ol>
                <div class="bg-white dark:bg-neutral-800 shadow p-6 sm:rounded-lg mb-6 ">
                    <div>
                        {{ __('Mengedit massal') . ' ' }}<x-badge>{{ $propName }}</x-badge>{{ ' ' . __('dengan') . ' ' }}<x-badge>{{ $refName }}</x-badge>.
                    </div>
                    <hr class="border-neutral-300 dark:border-neutral-600 my-4" />
                    <div class="flex justify-center items-center">
                        <div class="max-w-sm px-3 sm:px-0">
                            <div class="flex flex-col gap-4 text-sm mx-auto text-center text-neutral-600 dark:text-neutral-400">
                                <div class="text-center text-neutral-400 dark:text-neutral-600 py-4 text-4xl"><i class="fa fa-upload"></i></div>
                                <x-secondary-button x-on:click="$refs.file.click()"
                                    class="w-full">{{ __('Pilih file') }}</x-secondary-button>
                                <input x-ref="file" wire:model="file" type="file" accept=".csv" class="hidden" />
                                <div>
                                    <div>{{ __('Format CSV, maksimum 100 baris') }}</div>
                                    <div class="mt-2"><x-text-button wire:click="download"><i
                                        class="fa fa-download mr-2"></i>{{ __('Unduh templat') }}</x-text-button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @break

        @case(2)
        <div x-data="{
            rows: @entangle('rows'),
            area_id: @entangle('area_id'),
            msgs: [],
            rowDone: 0,
            rowTotal: 0,
            progress: 0,
            isReviewed: false,
            isStarted: false,
            status: '',
            apiRoute: '{{ route('inventory.items.update') }}',
            csrfToken: document.head.querySelector('meta[name=\'csrf-token\']').content,
            updateTotal: function() {
                this.rowTotal = this.rows.length;
            },
            review: async function (row) {

            },
            massReview: {

            },
            update: async function(row) {
                try {
                    const response = await fetch(this.apiRoute, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken,
                        },
                        body: JSON.stringify(row),
                    });
        
                    if (response.ok) {
                        const responseData = await response.json();
        
        
                        if (responseData.status && typeof responseData.status.success !== 'undefined') {
        
                            row.status = responseData.status;
        
                        } else {
                            row.status = {
                                success: false,
                                code: 'ERR-P',
                                msg: ['{{ __('Muatan data tidak sah') }}']
                            };
                        }
        
                    } else {
                        row.status = {
                            success: false,
                            code: 'ERR-S',
                            msg: ['{{ __('Tidak dapat meraih data') }}']
                        };
                    }
                } catch (error) {
                    row.status = {
                        success: false,
                        code: 'ERR-C',
                        msg: error.message || error.toString()
                    };
                }
            },
            massUpdate: async function() {
                if (this.area_id) {
                    this.isStarted = true;
                    this.rowTotal = this.rows.length;
                    this.status = '{{ __('Membuat...') }}';
                    for (let i = 0; i < this.rowTotal; i++) {
                        this.rows[i].area_id = this.area_id;
                        const row = this.rows[i];
                        await this.update(row);
                        this.rowDone++;
                    }
                    this.status = '{{ __('Selesai') }}';
                } else {
                    notyf.error('{{ __('Tentukan area dulu') }}');
                    $refs.area.focus();
                }
            },
            }" x-init="updateTotal()">
            <div class="flex flex-col md:flex-row gap-3 justify-between p-3">
                <ol class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-neutral-500  sm:text-base sm:p-0 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center cursor-pointer" wire:click="advance(0)">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-neutral-500 rounded-full shrink-0 dark:border-neutral-600">1</span>{{ __('Mulai') }}<i
                            class="fa fa-chevron-right ms-2 sm:ms-4"></i>
                    </li>
                    <li class="flex items-center cursor-pointer" wire:click="advance(1)">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-neutral-500 rounded-full shrink-0 dark:border-neutral-600">2</span>{{ __('Unggah') }}<i
                            class="fa fa-chevron-right ms-2 sm:ms-4"></i>
                    </li>
                    <li class="flex items-center text-caldy-600 dark:text-caldy-500">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-caldy-600 rounded-full shrink-0 dark:border-caldy-500">3</span>{{ __('Tinjau') }}<i
                            class="fa fa-chevron-right ms-2 sm:ms-4"></i>
                    </li>
                    <li class="flex items-center cursor-pointer" wire:click="advance(0)">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-neutral-500 rounded-full shrink-0 dark:border-neutral-600">4</span>{{ __('Terapkan') }}
                    </li>
                </ol>
                <div x-show="isStarted">
                    <div class="flex justify-between text-xs uppercase">
                        <div x-text="status"></div>
                        <div class="flex items-center truncate gap-x-1">
                            <span x-text="rowDone"></span>
                            <span class="mx-1">/</span>
                            <span x-text="rowTotal"></span>
                        </div>
                    </div>
                    <div class="h-1 mt-2 relative w-40 rounded-full overflow-hidden">
                        <div class="w-full h-full bg-gray-200 absolute"></div>
                        <div id="bar" class="h-full bg-caldy-500 relative transition-all"
                            :style="'width: ' + Math.ceil(rowDone / rowTotal * 100) + '%'"></div>
                    </div>
                </div>
                <div class="flex gap-2" x-show="!isStarted">
                    <div class="w-52">
                        <x-select x-model="area_id" x-ref="area">
                            <option value=""></option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <x-primary-button x-on:click="massCreate" class="whitespace-nowrap" type="button"><i
                            class="fa fa-eye mr-2"></i>{{ __('Tinjau') }}<span class="ms-2" x-text="'('+rowTotal+')'"></span></x-primary-button>
                </div>
            </div>
            <div class="overflow-x-auto bg-white dark:bg-neutral-800 shadow sm:rounded-lg mt-6">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Nama') }}</th>
                            <th>{{ $a }}</th>
                            <th>{{ $a . ' ' . __('baru') }}</th>
                            <th>{{ $b }}</th>
                            <th>{{ $b . ' ' . __('baru')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="row in rows">
                            <tr>
                                <td class="text-xs cursor-pointer opacity-70 hover:opacity-40 active:opacity-100"
                                    :class="row.status.success ? 'text-green-500' : 'text-red-500'"
                                    x-on:click="$dispatch('open-modal', 'row-msg'); msgs = row.status.msg;">
                                    <i x-show="row.status" class="fa mr-1"
                                        :class="row.status.success ? 'fa-check-rowle' : 'fa-exclamation-rowle'"></i><span
                                        x-text="row.status.code"></span>
                                </td>
                                <td x-text="row.a"></td>
                                <td x-text="row.anew"></td>
                                <td x-text="row.b"></td>
                                <td x-text="row.bnew"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <x-modal name="row-msg">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{ __('Rincian') }}
                        </h2>
                        <ul class="list-disc">
                            <template x-for="msg in msgs">
                                <li x-text="msg" class="ml-6 mt-2"></li>
                            </template>
                        </ul>
                    </div>
                </x-modal>
            </div>
        </div>
        @break

    @endswitch
</div>
