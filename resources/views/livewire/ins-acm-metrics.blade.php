<div class="flex flex-col gap-x-2 md:gap-x-4 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-64 px-3 sm:px-0">
            <x-select wire:model.live="view">
                <option value="">{{ __('Tampilan') }}</option>
                <option value="raw">{{ __('Data mentah') }}</option>
                <option value="line-all">{{ __('Line (semua)') }}</option>
                <option value="line-single">{{ __('Line (tunggal)') }}</option>
            </x-select>
            <div class="mt-4 bg-white dark:bg-neutral-800 shadow rounded-lg py-5 px-4">
                <div class="flex items-start justify-between">
                    <div><i class="fa fa-calendar mr-3"></i>{{ __('Rentang') }}</div>
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-text-button><i class="fa fa-fw fa-ellipsis-v"></i></x-text-button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="#" wire:click.prevent="setToday">
                                    {{ __('Hari ini') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#" wire:click.prevent="setYesterday">
                                    {{ __('Kemarin') }}
                                </x-dropdown-link>
                                <hr class="border-neutral-300 dark:border-neutral-600" />
                                <x-dropdown-link href="#" wire:click.prevent="setThisMonth">
                                    {{ __('Bulan ini') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#" wire:click.prevent="setLastMonth">
                                    {{ __('Bulan kemarin') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <div class="mt-5">
                    <x-text-input wire:model.live="start_at" id="inv-date-start" type="date"></x-text-input>
                    <x-text-input wire:model.live="end_at" id="inv-date-end" type="date"
                        class="mt-3 mb-1"></x-text-input>
                </div>
            </div>
        </div>
    </div>
    @switch($view)
        @case('raw')
            <livewire:ins-acm-metrics-raw :$start_at :$end_at />
        @break
        @default
        <div wire:key="no-view" class="w-full py-20">
            <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                <i class="fa fa-tv relative"><i
                        class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
            </div>
            <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Pilih tampilan') }}
            </div>
        </div>
    @endswitch
</div>
