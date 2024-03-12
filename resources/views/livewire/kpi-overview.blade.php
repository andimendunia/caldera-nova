<div>
    <div class="flex justify-between mb-6">
        <div class="flex gap-3">
            <div class="w-48">
                <label for="area_id"
                    class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Area') }}</label>
                <x-select id="area_id" wire:model.live="area_id">
                    <option value=""></option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="w-48">
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
        </div>
        <div>
            <label class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Indikator performa') }}</label>
            <div class="btn-group cal-pill">
                <div
                    class="text-red-500 px-4 py-2 bg-white dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-500 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm">
                    < 85%</div>
                        <div
                            class="rounded-none text-orange-500 px-4 py-2 bg-white dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-500 font-semibold text-xs uppercase tracking-widest shadow-sm">
                            85-95%</div>
                        <div
                            class="text-green-500 px-4 py-2 bg-white dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-500 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm">
                            > 95%</div>

                </div>
            </div>
        </div>
        @if (!count($grouped_items))
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
            <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-x-auto p-1">
                <table x-data class="table table-sm text-xs table-kpi-overview">
                    <thead>
                        <tr class="uppercase">
                            <th>
                                {{ __('No') }}
                            </th>
                            <th>
                                {{ __('Nama') }}
                            </th>
                            <th colspan="2">
                                {{ __('Akumulasi') }}
                            </th>
                            @foreach (range(1, 12) as $m)
                                <th>
                                    {{ $months[$m] }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grouped_items as $group => $items)
                            <tr class="tr-separator">
                                <td colspan="16">{{ $group ? $group : __('Tanpa grup') }}</td>
                            </tr>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-base">
                                        {{ $item['name'] }}
                                    </td>
                                    <td>
                                        <div>
                                            <div>
                                                {{ $item['sum_target'] }}
                                            </div>
                                            <div>
                                                {{ $item['sum_actual'] }}
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        {{ $item['unit'] }}
                                    </td>
                                    @foreach (range(1, 12) as $m)
                                        <td>
                                            @if ($item[$m]['kpi_score_id'])
                                                <x-link class="block p-1" :href="route('kpi.scores.show', [
                                                    'id' => $item[$m]['kpi_score_id'],
                                                    'from' => 'overview',
                                                ])">
                                                    <div><span>{{ $item[$m]['target'] }}</span>
                                                    </div>
                                                    <div>
                                                        @if ($item[$m]['is_submitted'])
                                                            <span
                                                                class="text-{{ $item[$m]['grade'] }}-500">{{ $item[$m]['actual'] }}</span>
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </div>
                                                </x-link>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
