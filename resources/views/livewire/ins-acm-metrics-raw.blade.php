<div class="w-full">

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
        <div wire:key="raw-metrics" class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-auto">
            <table class="table table-sm table-truncate text-neutral-600 dark:text-neutral-400">
                <tr class="uppercase text-xs">
                    <th>{{ __('Waktu alat') }}</th>
                    <th>{{ __('Waktu server') }}</th>
                    <th>{{ __('Line') }}</th>
                    <th>{{ __('Laju (det/psg)') }}</th>
                    <th>{{ __('Min') }}</th>
                    <th>{{ __('Maks') }}</th>
                </tr>
                @foreach ($metrics as $metric)
                    <tr>
                        <td>{{ $metric->dt_client }}</td>
                        <td>{{ $metric->created_at }}</td>
                        <td>{{ $metric->line }}</td>
                        <td>{{ $metric->rate_act }}</td>
                        <td>{{ $metric->rate_min }}</td>
                        <td>{{ $metric->rate_max }}</td>
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
