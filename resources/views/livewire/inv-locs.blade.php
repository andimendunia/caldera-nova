<div>
    <div class="block sm:flex justify-between items-center px-6 sm:px-0">
        <div>
            <div class="w-full sm:w-64">
                <x-select wire:model="area_id">
                    <option value=""></option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </x-select>  
            </div>
        </div>
        <div class="mt-4 sm:mt-0">{{ $locs->count() . ' ' . __('lokasi ditemukan') }}</div>
    </div>
    <div class="w-full mt-5">
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">            
            <table class="table">
                <tr class="uppercase text-xs">
                    <th class="flex justify-between items-center">
                        <div>{{ __('Nama') }}</div>
                        <x-th-search type="search" id="q"></x-th-search>
                    </th>
                </tr>
                @foreach($locs as $loc)
                <tr wire:key="loc-tr-{{ $loc->id.$loop->index }}" tabindex="0" x-on:click="$dispatch('open-modal', 'edit-loc-{{ $loc->id }}')">
                    <td>
                        {{ $loc->name }}
                    </td> 
                </tr>
                <x-modal :name="'edit-loc-'.$loc->id">
                    <livewire:inv-locs-edit wire:key="loc-lw-{{ $loc->id.$loop->index }}" :loc="$loc" lazy />                    
                </x-modal> 
                @endforeach
                @if(!$locs->count())
                <tr>
                    <td class="text-center">
                        {{ __('Tak ada lokasi ditemukan') }}
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>  
</div>