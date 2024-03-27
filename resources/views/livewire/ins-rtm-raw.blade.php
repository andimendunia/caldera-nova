<div wire:poll class="w-full">
    <h1 class="text-2xl mb-6 text-neutral-900 dark:text-neutral-100 px-5">
        {{ __('Data mentah') }}</h1>
    @if (!$metrics->count())
        @if (!$start_at || !$end_at)
            <div wire:key="no-range" class="py-20">
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
        <div wire:key="raw-stats" class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-auto mb-4">
            <div class="flex justify-between p-4 align-middle">
                <div class="flex gap-6">
                    <div>
                        <div class="uppercase text-xs mb-1">
                        {{ __('Hari ') }}
                        </div>
                        <div>
                        {{ $days }}
                        </div>  
                    </div>                 
                    <div>
                        <div class="uppercase text-xs mb-1">
                        {{ __('Integritas') }}
                        </div>
                        <div>
                        {{ $integrity . '% ' }}
                        </div>  
                    </div>    
                    <div>
                        <div class="uppercase text-xs mb-1">
                        {{ __('Akurasi') }}
                        </div>
                        <div>
                        {{ $accuracy . '% '}}
                        </div>  
                    </div> 
                </div>   
                <x-text-button type="button" class="my-auto" x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'raw-stats-info')"><i class="far fa-question-circle"></i></x-text-button>                   
            </div>
            <x-modal name="raw-stats-info">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                        {{ __('Statistik data mentah') }}
                    </h2>
                    <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400"><span class="font-bold">{{ __('Hari:') . ' '}}</span>
                        {{__('Jumlah hari yang mengandung data. Digunakan sebagai referensi berapa hari kerja pada rentang tanggal yang ditentukan.')}}
                    </p>
                    <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400"><span class="font-bold">{{ __('Integritas:') . ' '}}</span>
                        {{__('Mengindikasikan persentase data yang hadir di tiap jamnya. Contoh: Jika ada data setiap jam selama 8 jam dalam 1 hari, maka integritas bernilai 100%. Jika hanya ada data selama 4 jam selama 8 jam dalam 1 hari, maka integritas bernilai 50%')}}
                    </p>
                    <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400"><span class="font-bold">{{ __('Akurasi:') . ' '}}</span>
                        {{__('Mengindikasikan persentase data Laju yang logis. Rentang Laju yang dianggap logis ialah 0-10 pasang/detik.')}}
                    </p>
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button type="button" x-on:click="$dispatch('close')">
                            {{ __('Paham') }}
                        </x-secondary-button>
                    </div>
                </div>
            </x-modal>
        </div>
        <div wire:key="raw-metrics" class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-auto">
            <table class="table table-sm table-truncate text-neutral-600 dark:text-neutral-400">
                <tr class="uppercase text-xs">
                    <th>{{ __('Waktu alat') }}</th>
                    <th>{{ __('Line') }}</th>
                    <th>{{ __('Kiri') }}</th>
                    <th>{{ __('Kanan') }}</th>
                </tr>
                @foreach ($metrics as $metric)
                    <tr>
                        <td>{{ $metric->dt_client }}</td>
                        <td>{{ $metric->line }}</td>
                        <td>{{ $metric->thick_act_left }}</td>
                        <td>{{ $metric->thick_act_right }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="flex items-center relative h-16">
            @if (!$metrics->isEmpty())
                @if ($metrics->hasMorePages())
                    <div wire:key="more" x-data="{
                        observe() {
                            const observer = new IntersectionObserver((metrics) => {
                                metrics.forEach(metric => {
                                    if (metric.isIntersecting) {
                                        @this.loadMore()
                                    }
                                })
                            })
                            observer.observe(this.$el)
                        }
                    }" x-init="observe"></div>
                    <x-spinner class="sm" />
                @else
                    <div class="mx-auto">{{ __('Tidak ada lagi') }}</div>
                @endif
            @endif
        </div>
    @endif
</div>
