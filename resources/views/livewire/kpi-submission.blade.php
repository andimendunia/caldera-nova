<div class="flex flex-col gap-4 md:gap-8 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-64 px-3 sm:px-0 mb-5">
            <div class="mb-4">
                <label for="area_id"
                    class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Area') }}</label>
                <x-select id="area_id" wire:model.live="area_id">
                    <option value=""></option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <label for="year"
                    class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Tahun') }}</label>
                <x-select id="year" wire:model.live="f_year">
                    <option value=""></option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @if ($f_year == $year) selected @endif>
                            {{ $year }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <label for="month"
                    class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Bulan') }}</label>
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
                <label class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Status') }}</label>
                <div class="bg-white dark:bg-neutral-800 shadow rounded-lg py-3 px-4 uppercase text-sm">
                    <x-radio id="f-none" wire:model.live="status" name="status"
                        :checked="!$status">{{ __('Semua') }}</x-radio>
                    <x-radio id="f-draft" wire:model.live="status" name="status" :checked="$status == 'draft'"
                        value="draft">{{ __('Draf') }}</x-radio>
                    <x-radio id="f-submitted" wire:model.live="status" name="status" :checked="$status == 'submitted'"
                        value="submitted">{{ __('Diserahkan') }}</x-radio>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full">
        @if (!count($item_ids))
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
            @elseif (!$f_year)
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
                <div wire:key="no-match" class="py-20">
                    <div class="text-center text-neutral-300 dark:text-neutral-700 text-5xl mb-3">
                        <i class="fa fa-ghost"></i>
                    </div>
                    <div class="text-center text-neutral-400 dark:text-neutral-600">{{ __('Tidak ada yang cocok') }}
                    </div>
                </div>
            @endif
        @else
            <div class="grid grid-cols-1 gap-4">
                <h1 class="text-2xl text-neutral-900 dark:text-neutral-100 px-5">
                    {{ $months[$month] . ' ' . $f_year }}</h1>
                @foreach ($grouped_items as $group => $items)
                    <div class="grid grid-cols-1 gap-1">
                        <div class="uppercase text-xs text-neutral-500 px-5 mb-1">
                            {{ $group ? $group : __('Tanpa grup') }}</div>
                        @foreach ($items as $item)
                            <x-card-link
                                href="{{ route('kpi.scores.show', ['id' => $item['kpi_score_id'], 'from' => 'submission']) }}"
                                class="px-6 py-4">
                                <div>{{ $item['kpi_item_name'] }}</div>
                                <div
                                    class="flex truncate mt-2 text-xs text-neutral-600 dark:text-neutral-400 uppercase">
                                    @if ($item['kpi_score_is_submitted'])
                                        <div class="text-green-500">{{ __('Diserahkan') }}</div>
                                    @else
                                        <div>{{ __('Draf') }}</div>
                                    @endif
                                    @if ($item['comments_count'])
                                        <div class="mx-2">•</div>
                                        <div class="mr-3"><i
                                                class="far fa-comment mr-2"></i>{{ $item['comments_count'] }}
                                        </div>
                                        @if ($item['files_count'])
                                            <div class="mr-3"><i
                                                    class="fa fa-paperclip mr-2"></i>{{ $item['files_count'] }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </x-card-link>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
