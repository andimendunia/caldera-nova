<div class="flex flex-col gap-x-2 md:gap-x-4 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-64 px-3 sm:px-0 mb-5">
            <div class="btn-group h-10 grid grid-cols-3 w-full">
                <x-radio-button wire:model.live="view" grow value="line-all" name="view" id="view-line-all">
                    <div class="text-center my-auto">
                        <i class="fa fa-fw fa-display text-center m-auto"></i>
                    </div>
                </x-radio-button>
                <x-radio-button wire:model.live="view" grow value="raw" name="view" id="view-raw">
                    <div class="text-center my-auto">
                        <i class="fa fa-fw fa-table text-center m-auto"></i>
                    </div>
                </x-radio-button>
                <x-radio-button wire:model.live="view" grow value="misc" name="view" id="view-misc">
                    <div class="text-center my-auto">
                        <i class="fa fa-fw fa-ellipsis-h text-center m-auto"></i>
                    </div>
                </x-radio-button>
            </div>
            <div class="mt-4 bg-white dark:bg-neutral-800 shadow rounded-lg py-5 px-4 {{ $is_line ? '' : 'hidden' }}">
                <div class="flex items-start justify-between">
                    <div><i class="fa fa-ruler-horizontal mr-3"></i>{{ __('Line') }}</div>
                </div>
                <div class="mt-5">
                    <x-select wire:model.live="sline">
                        <option value=""></option>
                        @foreach ($olines as $oline)
                            <option value="{{ $oline }}">{{ $oline }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="mt-4 bg-white dark:bg-neutral-800 shadow rounded-lg py-5 px-4 {{ $is_date ? '' : 'hidden' }}">
                <div class="flex items-start justify-between">
                    <div><i class="fa fa-calendar mr-3"></i>{{ $is_range ? __('Rentang') : __('Tanggal') }}</div>
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
                                <hr
                                    class="border-neutral-300 dark:border-neutral-600 {{ $is_range ? '' : 'hidden' }}" />
                                <x-dropdown-link href="#" wire:click.prevent="setThisMonth"
                                    class="{{ $is_range ? '' : 'hidden' }}">
                                    {{ __('Bulan ini') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="#" wire:click.prevent="setLastMonth"
                                    class="{{ $is_range ? '' : 'hidden' }}">
                                    {{ __('Bulan kemarin') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <div class="mt-5">
                    <x-text-input wire:model.live="start_at" id="inv-date-start" type="date"></x-text-input>
                    <x-text-input wire:model.live="end_at" id="inv-date-end" type="date"
                        class="mt-3 mb-1 {{ $is_range ? '' : 'hidden' }}"></x-text-input>
                </div>
            </div>
            <div
                class="mt-4 bg-white dark:bg-neutral-800 shadow rounded-lg py-5 px-4 {{ $is_filter ? '' : 'hidden' }}">
                <div class="flex items-start justify-between">
                    <div><i class="fa fa-filter mr-3"></i>{{ __('Filter') }}</div>
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-text-button><i class="fa fa-fw fa-ellipsis-v"></i></x-text-button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="#" wire:click.prevent="resetFilter">
                                    {{ __('Kosongkan filter') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <div>
                    <x-text-input wire:model.live="fline" class="mt-4" type="search"
                        placeholder="{{ __('Line') }}" name="fline" />
                </div>
            </div>
            @if ($view == 'raw')
                <div wire:key="raw-panel">
                    <div class="m-3">
                        <div class="py-4">
                            <x-text-button type="button" wire:click="download" class="text-sm"><i
                                    class="fa fa-fw mr-2 fa-download"></i>{{ __('Unduh CSV') }}</x-text-button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @switch($view)
        @case('line-all')
            <livewire:ins-rtm-line-all :$fline />
        @break

        @case('raw')
            <livewire:ins-rtm-raw :$start_at :$end_at :$fline />
        @break

        @case('misc')
            <livewire:ins-rtm-misc />
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
