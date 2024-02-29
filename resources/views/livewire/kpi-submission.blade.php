<div class="flex flex-col gap-4 md:gap-8 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-64 px-3 sm:px-0 mb-5">
            <div class="mb-4">
                <label for="area_id" class="block px-3 mb-2 uppercase text-sm">{{ __('Area') }}</label>
                <x-select id="area_id" wire:model.live="area_id">
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
                    <option value="1">{{ $months[1] }}</option>
                    <option value="2">{{ $months[2] }}</option>
                    <option value="3">{{ $months[3] }}</option>
                    <option value="4">{{ $months[4] }}</option>
                    <option value="5">{{ $months[5] }}</option>
                    <option value="6">{{ $months[6] }}</option>
                    <option value="7">{{ $months[7] }}</option>
                    <option value="8">{{ $months[8] }}</option>
                    <option value="9">{{ $months[9] }}</option>
                    <option value="10">{{ $months[10] }}</option>
                    <option value="11">{{ $months[11] }}</option>
                    <option value="12">{{ $months[12] }}</option>
                </x-select>
            </div>
            <div class="mb-4">
                <label class="block px-3 mb-2 uppercase text-sm">{{ __('Status') }}</label>
                <div class="bg-white dark:bg-neutral-800 shadow rounded-lg py-3 px-4 uppercase text-sm">
                    <x-radio id="f-none" wire:model="status" name="status"
                        value="all">{{ __('Semua') }}</x-radio>
                    <x-radio id="f-no-submission" wire:model="status" name="status"
                        value="empty">{{ __('Kosong') }}</x-radio>
                    <x-radio id="f-draft" wire:model="status" name="status"
                        value="draft">{{ __('Draf') }}</x-radio>
                    <x-radio id="f-submitted" wire:model="status" name="status"
                        value="submitted">{{ __('Diserahkan') }}</x-radio>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full">        
        @if (!$items->count())
            @if (!$area_id)
                <div wire:key="no-area" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-building relative"><i
                                class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
                    </div>
                    <div class="text-center text-neutral-400 dark:text-neutral-600">
                        {{ __('Pilih area') }}
                    </div>
                </div>
            @elseif (!$year)
                <div wire:key="no-year" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-calendar relative"><i
                                class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
                    </div>
                    <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Pilih tahun') }}
                    </div>
                </div>
            @elseif (!$month)
                <div wire:key="no-month" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-calendar relative"><i
                                class="fa fa-question-circle absolute bottom-0 -right-1 text-lg text-neutral-500 dark:text-neutral-400"></i></i>
                    </div>
                    <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Pilih bulan') }}
                    </div>
                </div>
            @else
                <div wire:key="no-items">
                    <div class="text-center py-12">
                        {{ __('Tak ada KPI dalam masa ini') }}
                    </div>
                </div>
            @endif
        @else
            <h1 class="text-2xl mb-6 text-neutral-900 dark:text-neutral-100 px-5 text-right">
                {{ $months[$month] . ' ' . $year }}</h1>
            <div class="grid grid-cols-1 gap-3">
                @foreach ($items as $item)
                    <x-card-link href="{{ route('kpi.scores.show', ['id' => $item->kpi_score($month)->id ]) }}"
                        class="px-6 py-4">
                        <div>{{ $item->name }}</div>
                        <div class="truncate mt-2 text-xs text-neutral-600 dark:text-neutral-400 uppercase">
                            <span>{{ __('Kosong') }}</span><span class="mx-2">•</span><span class="mr-3"><i
                                    class="fa fa-paperclip mr-2"></i>0</span><span class="mr-3"><i
                                    class="far fa-comment mr-2"></i>0</span>
                        </div>
                    </x-card-link>
                @endforeach
            </div>
        @endif
    </div>
</div>
