<div class="w-full">

    @if (!$sline)
        <div wire:key="no-line" class="py-20">
            <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                <i class="fa fa-ruler-horizontal relative"><i
                        class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
            </div>
            <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Tentukan line') }}
            </div>
        </div>
    @elseif(!$start_at)
        <div wire:key="no-date" class="py-20">
            <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                <i class="fa fa-calendar relative"><i
                        class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
            </div>
            <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Tentukan tanggal') }}
            </div>
        </div>
    @elseif(!$lineChartModel->data->count())
    <div wire:key="no-data" class="py-20">
        <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
            <i class="fa fa-ghost"></i>
        </div>
        <div class="text-center text-neutral-500 dark:text-neutral-600">{{ __('Tidak ada data') }}
        </div>
    </div>
    @else
        <div wire:key="line-single-container" class="bg-white shadow sm:rounded-lg">
            <div class="p-6" style="width:100%;height:480px">
                <livewire:livewire-line-chart wire:key="line-single-chart" key="{{ $lineChartModel->reactiveKey() }}"
                    :line-chart-model="$lineChartModel" />
            </div>
        </div>
    @endif
</div>
