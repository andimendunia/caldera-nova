<div wire:poll class="w-full">

    @if (!$rows->count())

            <div wire:key="no-match" class="py-20">
                <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                    <i class="fa fa-ghost"></i>
                </div>
                <div class="text-center text-neutral-500 dark:text-neutral-600">{{ __('Tidak ada yang cocok') }}
                </div>
            </div>

    @else
        <div wire:key="line-all-rows" class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-auto">
            <table class="table table-sm table-truncate text-neutral-600 dark:text-neutral-400">
                <tr class="uppercase text-xs">
                    <th>{{ __('Line') }}</th>
                    <th>{{ __('Laju (det/psg)') }}</th>
                    <th>{{ __('Terakhir mengirim') }}</th>
                    <th>{{ __('Status') }}</th>
                </tr>
                @foreach ($rows as $row)
                    <tr>
                        <td>{{ $row->line }}</td>
                        <td>{{ $row->rate_act }}</td>
                        <td>{{ $row->dt_client->diffForHumans() }}</td>
                        <td><i class="fa fa-2xs fa-circle {{ Carbon\Carbon::now()->diffInMinutes($row->dt_client) > 30 ? 'text-red-500' : 'text-green-500' }}"></i></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="flex items-center relative h-16">
            @if (!$rows->isEmpty())
                @if ($rows->hasMorePages())
                    <div wire:key="more" x-data="{
                        observe() {
                            const observer = new IntersectionObserver((rows) => {
                                rows.forEach(row => {
                                    if (row.isIntersecting) {
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
