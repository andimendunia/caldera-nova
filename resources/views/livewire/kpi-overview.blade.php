<div>
    <div class="flex gap-3 mb-6">
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
                    <th>
                        {{ __('Satuan') }}
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
                    <td colspan="15">{{ $group ? $group : __('Tanpa grup') }}</td>
                </tr>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-base">
                                {{ $item['name'] }}
                            </td>
                            <td class="text-sm">
                                {{ $item['unit'] }}
                            </td>
                            @foreach (range(1, 12) as $m)
                                <td>
                                    @if ($item[$m]['kpi_score_id'])
                                        <x-link class="block p-1" :href="route('kpi.scores.show', [
                                            'id' => $item[$m]['kpi_score_id'],
                                            'from' => 'overview',
                                        ])">
                                            <div><span
                                                    class="{{ $item[$m]['target'] !== '' ? '' : 'opacity-0' }}">{{ $item[$m]['target'] }}</span>
                                            </div>
                                            <div><span
                                                    class="{{ $item[$m]['actual'] !== '' ? '' : 'opacity-0' }}">{{ $item[$m]['actual'] }}</span>
                                            </div>
                                        </x-link>
                                    @else
                                        <div class="p-1">
                                            <div><span
                                                    class="{{ $item[$m]['target'] !== '' ? '' : 'opacity-0' }}">{{ $item[$m]['target'] }}</span>
                                            </div>
                                            <div><span
                                                    class="{{ $item[$m]['actual'] !== '' ? '' : 'opacity-0' }}">{{ $item[$m]['actual'] }}</span>
                                            </div>
                                        </div>
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
