<div>
    <div class="px-6 mb-3">
        <div class="text-neutral-600 dark:text-neutral-400">
            <div class="flex">
                <div>{{ $item->kpi_area->name }}</div>
                <div class="mx-3">•</div>
                <div>
                    {{ $month_name . ' ' . $item->year }}
                </div>
            </div>
        </div>
        <div class="py-3">
            <h1 class="text-2xl text-neutral-900 dark:text-neutral-100">{{ $item->name }}</h1>
        </div>
    </div>
    <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg ">
        <form wire:submit="update" class="grid grid-cols-1 gap-8 px-4 py-5">
            <div>
                <label for="kpi-score-target" class="block px-3 mb-2 uppercase text-xs">{{ __('Target') }}</label>
                <x-text-input-suffix wire:model="target" id="kpi-score-target" suffix="{{ $item->unit }}" type="number" />
                @error('target')
                    <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
                @enderror
            </div>
            <div>
                <label for="kpi-score-actual" class="block px-3 mb-2 uppercase text-xs">{{ __('Aktual') }}</label>
                <x-text-input-suffix wire:model="actual" id="kpi-score-actual" suffix="{{ $item->unit }}" type="number" />
                @error('actual')
                    <x-input-error messages="{{ $message }}" class="px-3 mt-2" />
                @enderror
            </div>
            <div class="flex justify-between">
                <div x-data="{ is_submitted: @entangle('is_submitted') }" class="px-3 pt-3 self-end">
                    <x-toggle x-model="is_submitted" :checked="$is_submitted">{{ __('Serahkan') }}</x-toggle>
                </div>
                <div wire:dirty class="hidden">
                    <x-primary-button type="submit">{{ __('Perbarui') }}</x-primary-button>
                </div>
            </div>
        </form>
    </div>
</div>
