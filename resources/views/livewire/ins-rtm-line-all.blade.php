<div wire:poll class="w-full">
    <h1 class="text-2xl mb-6 text-neutral-900 dark:text-neutral-100 px-5">
        {{ __('Ringkasan') }}</h1>

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
                    <th>{{ __('Kiri') }}</th>
                    <th>{{ __('Kanan') }}</th>
                    <th>{{ __('Terakhir mengirim') }}</th>
                    <th>{{ __('Status') }}</th>
                </tr>
                @foreach ($rows as $row)
                    <tr>
                        <td>{{ $row->line }}</td>
                        <td>{{ $row->thick_act_left }}</td>
                        <td>{{ $row->thick_act_right }}</td>
                        <td>{{ $row->dt_client }}</td>
                        <td>
                            @if (Carbon\Carbon::now()->diffInMinutes($row->dt_client) > 30)
                                <div class="flex text-xs gap-x-2 items-center text-red-500">
                                    <i class="fa fa-2xs fa-circle"></i>
                                    <span>{{ __('OFFLINE') }}</span>
                                </div>
                            @else
                                <div class="flex text-xs gap-x-2 items-center text-green-500">
                                    <i class="fa fa-2xs fa-circle"></i>
                                    <span>{{ __('ONLINE') }}</span>
                                </div>
                            @endif
                        </td>


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
