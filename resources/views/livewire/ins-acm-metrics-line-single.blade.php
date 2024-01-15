<div class="w-full">
    {{-- <div wire:key="no-match" class="py-20">
        <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
            <i class="fa fa-ghost"></i>
        </div>
        <div class="text-center text-neutral-500 dark:text-neutral-600">{{ __('Tidak ada yang cocok') }}
        </div>
    </div> --}}

    <div wire:key="line-all-rows" class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-auto">
        <div>{{ $sline }}</div>
        <canvas id="myChart"></canvas>
    </div>
</div>

@script
<script>
        const chart = new Chart(
            document.getElementById('myChart'), {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: @json($dataset)
                },
            }
        );
        Livewire.on('updateChart', data => {
            chart.data = data;
            chart.update();
        });
</script>
@endscript