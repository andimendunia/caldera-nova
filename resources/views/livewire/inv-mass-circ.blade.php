<div>
    @if (!$isValid)
        <div class="flex">
            <div class="max-w-sm px-3 sm:px-0 mb-10 mx-auto">
                <div class="flex flex-col gap-4 text-sm mx-auto text-center text-neutral-600 dark:text-neutral-400">
                    <div class="text-center text-neutral-500 pb-8 text-4xl"><i class="fa fa-upload"></i></div>
                    <x-secondary-button x-on:click="$refs.file.click()"
                        class="w-full mb-3">{{ __('Pilih file') }}</x-secondary-button>
                    <input x-ref="file" wire:model="file" type="file" accept=".csv" class="hidden" />
                    <div>
                        <div>{{ __('Format CSV, maksimum 100 baris') }}</div>
                        <div class="mt-2"><x-text-button wire:click="download"><i
                                    class="fa fa-download mr-2"></i>{{ __('Unduh templat') }}</x-text-button></div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div x-data="{
            circs: @entangle('circs'),
            area_id: @entangle('area_id'),
            msgs: [],
            circDone: 0,
            circTotal: 0,
            progress: 0,
            isStarted: false,
            status: '',
            apiRoute: '{{ route('inventory.circs.create') }}',
            csrfToken: document.head.querySelector('meta[name=\'csrf-token\']').content,
            updateTotal: function () {
                this.circTotal = this.circs.length;
            },
            create: async function(circ) {
                try {
                    const response = await fetch(this.apiRoute, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken,
                        },
                        body: JSON.stringify(circ),
                    });
        
                    if (response.ok) {
                        const responseData = await response.json();
                          

                            if (responseData.status && typeof responseData.status.success !== 'undefined') {
 
                                circ.status = responseData.status; 

                            } else {
                                circ.status = {
                                    success: false,
                                    code: 'ERR-P',
                                    msg: '{{ __('Muatan data tidak sah') }}'
                                };
                            }
        
                    } else {
                        circ.status = {
                            success: false,
                            code: 'ERR-S',
                            msg: '{{ __('Tidak dapat meraih data') }}'
                        };
                    }
                } catch (error) {
                    circ.status = {
                        success: false,
                        code: 'ERR-C',
                        msg: error.message || error.toString()
                    };
                }
            },
            massCreate: async function() {
                if (this.area_id) {
                    this.isStarted = true;
                    this.circTotal = this.circs.length;
                    this.status = '{{ __('Membuat...') }}';
                    for (let i = 0; i < this.circTotal; i++) {
                        this.circs[i].area_id = this.area_id;
                        const circ = this.circs[i];
                        await this.create(circ);
                        this.circDone++;
                    }
                    this.status = '{{ __('Selesai') }}';
                } else {
                    notyf.error('{{ __('Tentukan area dulu') }}');
                    $refs.area.focus();
                }
            },
        }" x-init="updateTotal()">
            <div class="flex flex-col md:flex-row gap-3 justify-between p-3">
                <div class="w-64">
                    <x-select x-model="area_id" x-ref="area">
                        <option value=""></option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </x-select>  
                </div>
                <div class="flex items-center truncate p-1 gap-x-2">
                    <span x-text="circDone"></span>
                    <span class="mx-1">/</span>
                    <span x-text="circTotal"></span>
                </div>
                <div x-show="isStarted">
                    <span x-text="status" class="text-xs uppercase"></span>
                    <div class="h-1 mt-1 relative w-40 rounded-full overflow-hidden">
                        <div class="w-full h-full bg-gray-200 absolute" ></div>
                        <div id="bar" class="h-full bg-caldy-500 relative transition-all" :style="'width: ' + Math.ceil(circDone / circTotal * 100) + '%'"></div>
                    </div>
                </div>
                <div class="flex gap-2" x-show="!isStarted">
                    <x-secondary-button  wire:click="reupload"
                        type="button"><i
                        class="fa fa-undo mr-2"></i>{{ __('Ulangi dari awal') }}</x-secondary-button>
                    <x-primary-button x-on:click="massCreate" type="button"><i
                            class="fa fa-play mr-2"></i>{{ __('Mulai') }}</x-primary-button>
                </div>
            </div>
            <x-modal name="circ-msg" >
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
            <div class="overflow-x-auto bg-white dark:bg-neutral-800 shadow sm:rounded-lg mt-6">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>{{ __('Status') }}</th>
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
                        <template x-for="circ in circs">
                            <tr>
                                <td class="text-xs cursor-pointer opacity-70 hover:opacity-40 active:opacity-100" :class="circ.status.success ? 'text-green-500' : 'text-red-500'" x-on:click="$dispatch('open-modal', 'circ-msg'); msgs = circ.status.msg;">
                                    <i x-show="circ.status" class="fa mr-1" :class="circ.status.success ? 'fa-check-circle' : 'fa-exclamation-circle'"></i><span x-text="circ.status.code"></span>
                                </td>
                                <td x-text="circ.code"></td>
                                <td x-text="circ.name"></td>
                                <td x-text="circ.desc"></td>
                                <td x-text="circ.uom"></td>
                                <td x-text="circ.qty"></td>
                                <td x-text="circ.qtype"></td>
                                <td x-text="circ.remarks"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
