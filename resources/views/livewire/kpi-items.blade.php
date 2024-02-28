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
                <x-select id="year" wire:model.live="item_year">
                    <option value=""></option>
                    @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
    </div>
    <div class="w-full">
        <div>
            <div class="flex justify-between px-6 sm:px-0">
                <div>
                    {{-- {{ $areas->count() . ' ' . __('area terdaftar') }} --}}
                    0 item KPI ditemukan
                </div>
                <x-secondary-button type="button" class="my-auto" x-data="" x-on:click="$dispatch('open-modal', 'create-kpi-item')">{{ __('Buat') }}</x-secondary-button>
            </div>
            <x-modal name="create-kpi-item">
                <livewire:kpi-items-create wire:key="kpi-items-create" :$area_id :$area_name :$item_year lazy />
            </x-modal>
            <div class="w-full mt-5">
                <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">            
                    <table wire:key="kpi-items-table" class="table">
                        <tr class="uppercase text-xs">
                            <th>
                                {{ __('Nama') }}
                            </th>
                            <th>
                                {{ __('Satuan') }}
                            </th>
                        </tr>
                        @foreach($items as $item)
                        <tr wire:key="item-tr-{{ $item->id . $loop->index }}" tabindex="0" x-on:click="$dispatch('open-modal', 'edit-kpi-item-{{ $item->id }}')">
                            <td>
                                {{ $item->name }}
                            </td> 
                            <td>
                                {{ $item->unit }}
                            </td> 
                        </tr>
                        <x-modal :name="'edit-kpi-item-'.$item->id">
                            <livewire:kpi-items-edit wire:key="item-lw-{{ $item->id . $loop->index }}" :item="$item" lazy />                    
                        </x-modal> 
                        @endforeach
                    </table>
                    <div wire:key="items-none">
                        {{-- @if(!$items->count())
                            <div class="text-center py-12">
                                {{ __('Tak ada item KPI terdaftar') }}
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
