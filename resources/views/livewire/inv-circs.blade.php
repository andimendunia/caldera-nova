<div class="flex flex-col gap-x-2 md:gap-x-4 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-64 px-3 sm:px-0">
            <x-text-input-icon wire:model.live="q" icon="fa fa-fw fa-search" id="inv-q" type="search" placeholder="{{ __('Cari...') }}" autofocus autocomplete="q" />
            <div class="btn-group w-full h-11 mt-5">
                <x-checkbox-button wire:model.live="status" grow value="pending" name="status" id="status-pending">
                    <div class="text-center my-auto"><i class="fa fa-hourglass-half"></i></div>
                </x-checkbox-button>
                <x-checkbox-button wire:model.live="status" grow value="approved" name="status" id="status-approved">
                    <div class="text-center my-auto"><i class="fa fa-thumbs-up"></i></div>
                </x-checkbox-button>
                <x-checkbox-button wire:model.live="status" grow value="rejected" name="status" id="status-rejected">
                    <div class="text-center my-auto"><i class="fa fa-thumbs-down"></i></div>
                </x-checkbox-button>
            </div>
            <div class="my-4 bg-white dark:bg-neutral-800 shadow rounded-lg p-4">
                
                <x-text-input-icon wire:model.live="user" icon="fa fa-fw fa-user" id="inv-user" class="my-2" type="search" placeholder="{{ __('Pengguna') }}" />
                <div class="mt-4">
                    <x-checkbox wire:model.live="qdirs" id="inv-dir-1"
                    value="deposit"><i class="fa fa-fw fa-plus mr-2"></i>{{ __('Penambahan') }}</x-checkbox>
                </div>
                <div class="mt-4">
                    <x-checkbox wire:model.live="qdirs" id="inv-dir-2"
                        value="withdrawal"><i class="fa fa-fw fa-minus mr-2"></i>{{ __('Pengambilan') }}</x-checkbox>
                </div>
                <div class="mt-4">
                    <x-checkbox wire:model.live="qdirs" id="inv-dir-3"
                        value="capture"><i class="far fa-fw fa-flag mr-2"></i>{{ __('Pencatatan') }}</x-checkbox>
                </div>
                
            </div>
            <div class="my-4 bg-white dark:bg-neutral-800 shadow rounded-lg py-5 px-4">
                <div class="flex items-start justify-between">
                    <div><i class="fa fa-calendar mr-3"></i>{{__('Rentang')}}</div>
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-text-button><i class="fa fa-fw fa-ellipsis-v"></i></x-text-button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="#" wire:click.prevent="setToday">
                                    {{ __('Hari ini') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#" wire:click.prevent="setYesterday">
                                    {{ __('Kemarin') }}
                                </x-dropdown-link>
                                <hr class="border-neutral-300 dark:border-neutral-600" />
                                <x-dropdown-link href="#" wire:click.prevent="setThisMonth">
                                    {{ __('Bulan ini') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#" wire:click.prevent="setLastMonth">
                                    {{ __('Bulan kemarin') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <div class="mt-5">
                    <x-text-input wire:model.live="start_at" id="inv-date-start" type="date"></x-text-input>
                    <x-text-input wire:model.live="end_at" id="inv-date-end" type="date" class="mt-3 mb-1" ></x-text-input>    
                </div>
            </div>
            <div class="my-4 bg-white dark:bg-neutral-800 shadow rounded-lg py-3 px-4">
                @foreach ($areas as $area)
                <div class="my-2">
                    <x-checkbox wire:model.live="area_ids" wire:key="inv-area-{{ $area->id }}" id="inv-area-{{ $area->id }}"
                        value="{{ $area->id }}">{{ $area->name }}</x-checkbox>
                </div>
                @endforeach                
            </div>
            <div class="m-3">
                <x-text-button wire:click="resetCircs" type="button" class="text-sm"><i class="fa fa-fw mr-2 fa-undo"></i>{{__('Atur ulang')}}</x-text-button>
            </div>
            <div class="m-3">
                <x-text-button type="button" class="text-sm"><i class="fa fa-fw mr-2 fa-print"></i>{{__('Cetak semua')}}</x-text-button>
            </div>
            <div class="m-3">
                <x-text-button type="button" class="text-sm"><i class="fa fa-fw mr-2 fa-download"></i>{{__('Unduh CSV sirkulasi')}}</x-text-button>
            </div>
        </div>
        <div class="sticky top-0 py-5 opacity-0 sm:opacity-100">
            <x-link-secondary-button href="#content"><i class="fa fa-fw mr-2 fa-arrows-up-to-line"></i>{{ __('Ke atas') }}</x-link-secondary-button>
        </div>
    </div>
    <div x-data="{ ids: [] }" class="w-full" x-on:click.away="ids = []">
        <div x-show="!ids.length" class="flex justify-between w-full p-3">
            <div class="my-auto">{{$circs->total().' '.__('sirkulasi')}}</div>
            <div class="flex">
                <x-select wire:model.live="sort">
                    <option value="updated">{{ __('Diperbarui') }}</option>
                    <option value="created">{{ __('Dibuat') }}</option>
                    <option value="amount_low">{{ __('Termurah') }}</option>
                    <option value="amount_high">{{ __('Termahal') }}</option>
                    <option value="qty_low">{{ __('Paling sedikit') }}</option>
                    <option value="qty_high">{{ __('Paling banyak') }}</option>
                </x-select>
                {{-- <div class="btn-group mr-3">
                    <x-secondary-button><i class="fa fa-fw fa-list"></i></x-secondary-button>
                    <x-secondary-button><i class="fa fa-fw fa-border-all"></i></x-secondary-button>    
                </div>   --}}            
            </div>
        </div>
        <div x-show="ids.length" x-cloak class="sticky z-10 top-0 flex justify-between w-full p-4 bg-neutral-100 dark:bg-neutral-900">
            <div class="my-auto"><span x-text="ids.length"></span><span class="hidden lg:inline">{{' '. __('terpilih')}}</span></div>
            <div class="flex gap-x-2 items-center">
                <x-secondary-button x-show="ids.length === 1"
                class="flex items-center h-full" x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'inv-circedit')"><i class="fa fa-fw fa-pen"></i></x-secondary-button> 
                <x-secondary-button class="flex items-center h-full"><i class="fa fa-fw fa-print"></i><span class="ml-2 hidden lg:inline">{{__('Cetak')}}</span></x-secondary-button> 
                <div class="btn-group">
                    <x-secondary-button class="flex items-center"><i class="fa fa-fw fa-thumbs-up"></i><span class="ml-2">{{__('Setujui')}}</span></x-secondary-button>
                    <x-secondary-button class="flex items-center"><i class="fa fa-fw fa-thumbs-down"></i><span class="ml-2 hidden lg:inline">{{__('Tolak')}}</span></x-secondary-button>                  
                </div>
                <x-text-button type="button" @click="ids = []" class="ml-2"><i class="fa fa-fw fa-times"></i></x-text-button>
            </div>
        </div>
        <x-modal name="inv-circedit">
            <div  class="p-6">        
                <h2 class="text-lg mb-4 font-medium text-neutral-900 dark:text-neutral-100">
                    {{ __('Sirkulasi') }}
                </h2>
                <div class="flex items-center mb-4 gap-x-4">
                    54
                    <div>
                        EA
                    </div>
                </div>   
                <div class="text-sm">
                    <span>Ambil</span><span class="mx-2">•</span><span>3.564,00 USD</span><span class="mx-2">•</span><span>10 → 8</span>
                </div>
                <hr class="border-neutral-300 dark:border-neutral-700 my-4">
                <div class="flex text-sm gap-x-2">
                    <div class="grow truncate">
                        <div class="flex truncate gap-x-2">
                            <div class="truncate font-medium text-neutral-900 dark:text-neutral-100">
                                I COULD HAVE MY GUCCI ON
                            </div>
                            <div>•</div>
                            <div class="truncate">
                                I COULD WEAR MY LOUIS VOUITTON
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <x-link href="/inventory/items/1" target="_blank"><i class="fa fa-external-link-alt"></i></x-link>
                    </div>  
                </div>   
                <hr class="border-neutral-300 dark:border-neutral-700 my-4">
                <div class="mb-6">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                            </div>
                            <div>Andi Permana</div>
                        </div>
                        <div class="text-sm mt-2">Diwakili oleh Bella Puspita</div>
                    </div>
                    <x-text-input id="inv-remarks" class="mb-2" name="remarks" type="text" placeholder="{{ __('Keterangan') }}" autocomplete="inv-remarks" />
                    <x-select id="inv-qty-type">
                        <option value="">{{ __('Qty utama') }}</option>
                        <option value="">{{ __('Qty bekas') }}</option>
                        <option value="">{{ __('Qty diperbaiki') }}</option>
                    </x-select>
                </div>
                <div class="truncate text-sm">
                    <div class="truncate mb-2"><i class="fa fa-fw fa-check-circle mr-2"></i>Disetujui oleh Bella Puspita</div>
                    <div class="text-xs truncate text-neutral-400 dark:text-neutral-600">Diperbarui pada 2023-08-06 13:28</div>
                </div>
                <div class="mt-6 flex justify-end gap-x-2">
                    <x-secondary-button x-on:click="$dispatch('close')">{{__('Batal')}}</x-secondary-button> 
                    <x-primary-button>{{__('Simpan')}}</x-primary-button> 
                </div>
            </div>
        </x-modal>
        @if (!$circs->count())
            @if (!count($area_ids))
                <div wire:key="no-area" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-building relative"><i
                                class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
                    </div>
                    <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Pilih area inventaris') }}
                    </div>
                </div>
            @elseif (!count($status))
                <div wire:key="no-qdirs" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-thumbs-up relative"><i
                                class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
                    </div>
                    <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Pilih status sirkulasi') }}
                    </div>
                </div>
            @elseif (!count($qdirs))
                <div wire:key="no-qdirs" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-plus-minus relative"><i
                                class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
                    </div>
                    <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Pilih arah sirkulasi') }}
                    </div>
                </div>
            @elseif (!$start_at || !$end_at)
            <div wire:key="no-qdirs" class="py-20">
                <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                    <i class="fa fa-calendar relative"><i
                            class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
                </div>
                <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Tentukan rentang tanggal') }}
                </div>
            </div>
            @else
                <div wire:key="no-match" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-ghost"></i>
                    </div>
                    <div class="text-center text-neutral-500 dark:text-neutral-600">{{ __('Tidak ada yang cocok') }}
                    </div>
                </div>
            @endif
        @else
        <div wire:key="circs" class="inv-circs mt-1 grid gap-3 px-0 sm:px-3">
            @foreach($circs as $circ)
            <x-circ-checkbox wire:key="circ-{{ $circ->id }}" id="{{ $circ->id }}" model="ids"
            inv_name="{{ $circ->inv_item->name }}"
            inv_desc="{{ $circ->inv_item->desc }}"
            inv_code="{{ $circ->inv_item->code ?? __('Tak ada kode') }}"
            inv_uom="{{ $circ->inv_item->inv_uom->name }}"
            inv_loc="{{ $circ->inv_item->inv_loc->name ?? __('Tak ada lokasi') }}"
            inv_photo="{{ $circ->inv_item->photo }}"
            qty="{{ $circ->qty }}"
            qtype="{{ $circ->qtype }}"
            curr="{{ $curr->name }}"
            amount="{{ $circ->amount }}"
            user_name="{{ $circ->user->name }}"
            remarks="{{ $circ->remarks}}"
            status="{{ $circ->status }}"
            user_photo="{{ $circ->user->photo }}"
            date_human="{{ $circ->created_at->diffForHumans()}}">
            </x-circ-checkbox>
            @endforeach
            <div class="flex items-center relative h-16">
                @if(!$circs->isEmpty())
                @if($circs->hasMorePages())
                    <div wire:key="more" x-data="{
                        observe(){
                            const observer = new IntersectionObserver((circs) => {
                                circs.forEach(circ => {
                                    if(circ.isIntersecting) {
                                        @this.loadMore()
                                    }
                                })
                            })
                            observer.observe(this.$el)
                        }
                    }" x-init="observe"></div>
                    <x-spinner class="sm" />
                @else
                    <div class="mx-auto">{{__('Tidak ada lagi')}}</div>
                @endif
                @endif
            </div>
        </div>
        @endif  
    </div>
</div>