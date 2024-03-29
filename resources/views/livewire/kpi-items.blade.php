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
        </div>
    </div>
    <div class="w-full">
        <div>
            <div class="flex justify-between px-6 sm:px-0">
                <div>
                    {{ count($item_ids) . ' ' . __('item KPI ditemukan') }}
                </div>
                <x-secondary-button type="button" class="my-auto" x-data=""
                    x-on:click="$dispatch('open-modal', 'create-kpi-item')">{{ __('Buat') }}</x-secondary-button>
            </div>
            <x-modal name="create-kpi-item">
                <livewire:kpi-items-create wire:key="kpi-items-create" :$area_id :$area_name :$f_year />
            </x-modal>
            <div class="w-full mt-5">
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
                    @else
                        <div wire:key="no-items">
                            <div class="text-center py-12">
                                {{ __('Tak ada item KPI terdaftar') }}
                            </div>
                        </div>
                    @endif
                @else
                    <div wire:key="kpi-items-table-wrapper" class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">
                        <table wire:key="kpi-items-table" class="table">
                            <thead>
                                <tr class="uppercase text-xs">
                                    <th>
                                        {{ __('Nama') }}
                                    </th>
                                    <th>
                                        {{ __('Satuan') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grouped_items as $group => $items)
                                    <tr class="tr-separator" wire:key="item-tr-separator-{{ $group . $loop->index }}">
                                        <td colspan="2">{{ $group ? $group : __('Tanpa grup') }}</td>
                                    </tr>
                                    @foreach ($items as $item)
                                        <tr wire:key="item-tr-{{ $group . $item['id'] . $loop->index }}" tabindex="0"
                                            x-on:click="$dispatch('open-modal', 'edit-kpi-item-{{ $item['id'] }}')">
                                            <td>
                                                {{ $item['name'] }}
                                            </td>
                                            <td class="text-sm">
                                                {{ $item['unit'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div wire:key="kpi-items-modal-wrapper">
                        @foreach($item_ids as $item_id)
                        <x-modal :name="'edit-kpi-item-' . $item_id">
                            <livewire:kpi-items-edit
                                wire:key="item-lw-{{ $item_id . $loop->index }}"
                                item_id="{{ $item_id }}" lazy />
                        </x-modal>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
