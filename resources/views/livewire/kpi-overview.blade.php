<div>
    <div class="flex justify-between mb-6">
        <div class="flex gap-3">
            <div class="w-48">
                <label for="area_id" class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Area') }}</label>
                <x-select id="area_id" wire:model.live="area_id">
                    <option value=""></option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="w-48">
                <label for="year" class="block px-3 mb-2 uppercase text-xs text-neutral-500">{{ __('Tahun') }}</label>
                <x-select id="year" wire:model.live="f_year">
                    <option value=""></option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @if ($f_year == $year) selected @endif>
                            {{ $year }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
        <div class="text-xs">
            <div class="text-green-500">> 95%</div>
            <div class="text-orange-500">85-95%</div>
            <div class="text-red-500">< 85%</div>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-x-auto">
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
                <tr class="tr-separator" >
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
                                            <div><span class="text-{{ $item[$m]['grade'] }}-500">{{ $item[$m]['actual'] }}</span>
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
</div>
