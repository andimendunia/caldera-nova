<div class="flex flex-col gap-4 md:gap-8 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-64 px-3 sm:px-0 mb-5">
            <div class="mb-4">
                <label for="area_id" class="block px-3 mb-2 uppercase text-sm">{{ __('Area') }}</label>
                <x-select id="area_id" wire:model="area_id">
                    <option value=""></option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <label for="year" class="block px-3 mb-2 uppercase text-sm">{{ __('Tahun') }}</label>
                <x-select id="year" wire:model.live="year">
                    <option value=""></option>
                    <option value="2024">2024</option>
                </x-select>
            </div>
            <div class="mb-4">
                <label for="month" class="block px-3 mb-2 uppercase text-sm">{{ __('Bulan') }}</label>
                <x-select id="month" wire:model.live="month">
                    <option value=""></option>
                    <option value="1">{{ __('Januari')}}</option>
                    <option value="2">{{ __('Februari')}}</option>
                    <option value="3">{{ __('Maret')}}</option>
                    <option value="4">{{ __('April')}}</option>
                    <option value="5">{{ __('Mei')}}</option>
                    <option value="6">{{ __('Juni')}}</option>
                    <option value="7">{{ __('Juli')}}</option>
                    <option value="8">{{ __('Agustus')}}</option>
                    <option value="9">{{ __('September')}}</option>
                    <option value="10">{{ __('Oktober')}}</option>
                    <option value="11">{{ __('November')}}</option>
                    <option value="12">{{ __('Desember')}}</option>
                </x-select>
            </div>
            <div class="mb-4">
                <label class="block px-3 mb-2 uppercase text-sm">{{ __('Filter') }}</label>
                <div class="bg-white dark:bg-neutral-800 shadow rounded-lg py-3 px-4">
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
    </div>
    <div class="w-full">
        <h1 class="text-2xl mb-6 text-neutral-900 dark:text-neutral-100 px-5">{{ __('Januari') }}</h1>
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
