<div class="flex flex-col gap-x-2 md:gap-x-4 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-64 px-3 sm:px-0 mb-5">
            <x-select wire:model="area_id">
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </x-select>
            <x-select wire:model.live="year" class="mt-4">
                <option value="2024">2024</option>
            </x-select>
            <x-select wire:model.live="year" class="mt-4">
                <option value="1">January</option>
            </x-select>
            <div class="mt-4 bg-white dark:bg-neutral-800 shadow rounded-lg py-3 px-4">
                <x-radio id="f-none" wire:model="filter" name="filter"
                value="">{{ __('Semua') }}</x-radio>
                <x-radio id="f-no-submission" wire:model="filter" name="filter"
                value="empty">{{ __('Belum diserahkan') }}</x-radio>
                <x-radio id="f-draft" wire:model="filter" name="filter"
                value="draft">{{ __('Draf') }}</x-radio>
                <x-radio id="f-submitted" wire:model="filter" name="filter"
                value="submitted">{{ __('Diserahkan') }}</x-radio>
            </div>
        </div>
    </div>
    <div class="w-full">
        <div class="grid grid-cols-1 gap-3">
            <x-card-link href="#" class="px-6 py-4">
                <div>Year-over-Year Sales Growth and Market Expansion Rate</div>
                <div class="truncate mt-2 text-xs text-neutral-600 dark:text-neutral-400 uppercase">
                    <span>{{ __('Belum diserahkan') }}</span><span class="mx-2">•</span><span class="mr-3"><i
                            class="fa fa-paperclip mr-2"></i>0</span><span class="mr-3"><i
                            class="far fa-comment mr-2"></i>0</span>
                </div>
            </x-card-link>
            <x-card-link href="#" class="px-6 py-4">
                <div>Monthly New Leads Acquisition and Conversion Effectiveness Ratio</div>
                <div class="truncate mt-2 text-xs text-neutral-600 dark:text-neutral-400 uppercase">
                    <span class="text-green-500">{{ __('Diserahkan') }}</span><span class="mx-2">•</span><span
                        class="mr-3"><i class="fa fa-paperclip mr-2"></i>0</span><span class="mr-3"><i
                            class="far fa-comment mr-2"></i>0</span>
                </div>
            </x-card-link>
            <x-card-link href="#" class="px-6 py-4">
                <div>Quarterly Customer Retention and Loyalty Engagement Index</div>
                <div class="truncate mt-2 text-xs text-neutral-600 dark:text-neutral-400 uppercase">
                    <span>{{ __('Draf') }}</span><span class="mx-2">•</span><span class="mr-3"><i
                            class="fa fa-paperclip mr-2"></i>0</span><span class="mr-3"><i
                            class="far fa-comment mr-2"></i>0</span>
                </div>
            </x-card-link>
            <x-card-link href="#" class="px-6 py-4">
                <div>Monthly New Leads Acquisition and Conversion Effectiveness Ratio</div>
                <div class="truncate mt-2 text-xs text-neutral-600 dark:text-neutral-400 uppercase">
                    <span>{{ __('Belum diserahkan') }}</span><span class="mx-2">•</span><span class="mr-3"><i
                            class="fa fa-paperclip mr-2"></i>0</span><span class="mr-3"><i
                            class="far fa-comment mr-2"></i>0</span>
                </div>
            </x-card-link>
            <x-card-link href="#" class="px-6 py-4">
                <div>Monthly New Leads Acquisition and Conversion Effectiveness Ratio</div>
                <div class="truncate mt-2 text-xs text-neutral-600 dark:text-neutral-400 uppercase">
                    <span>{{ __('Belum diserahkan') }}</span><span class="mx-2">•</span><span class="mr-3"><i
                            class="fa fa-paperclip mr-2"></i>0</span><span class="mr-3"><i
                            class="far fa-comment mr-2"></i>0</span>
                </div>
            </x-card-link>
        </div>
    </div>
</div>
