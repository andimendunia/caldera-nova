<div>
    <div class="px-6 mb-4">
        <div class="text-neutral-600 dark:text-neutral-400">
            <div class="flex">
                <div>{{ $item->kpi_area->name }}</div>
                <div class="mx-3">•</div>
                <div>
                    {{ $score->month . ' ' . $item->year }}
                </div>
            </div>
        </div>
        <div class="py-4">
            <h1 class="text-2xl text-neutral-900 dark:text-neutral-100">{{ $item->name }}</h1>
        </div>
    </div>
    <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg ">
        <div class="grid grid-cols-1 gap-8 px-4 py-8">
            <div>
                <label class="block px-3 mb-2 uppercase text-xs">{{ __('Target') }}</label>
                <div class="px-3">{{ '1000 points' }}</div>
            </div>
            <div>
                <label for="kpi-score-value" class="block px-3 mb-2 uppercase text-xs">{{ __('Aktual') }}</label>
                <x-text-input id="kpi-score-value" wire:model="score_value" type="number" />
                @error('score_value')
                    <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
                @enderror
            </div>
            {{-- Please restore entangle and :checked attribute --}}
            <div x-data="{ is_submitted: false }" class="px-3">
                <x-toggle x-model="is_submitted"><span
                        x-text="is_submitted ? '{{ __('Diserahkan') }}' : '{{ __('Draf') }}'"></span></x-toggle>
            </div>
        </div>
    </div>
</div>
