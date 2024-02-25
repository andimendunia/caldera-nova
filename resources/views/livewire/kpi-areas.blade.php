<div>
    <div class="flex justify-between px-6 sm:px-0">
        <div>
            {{ $areas->count() . ' ' . __('area terdaftar') }}
        </div>
        <x-secondary-button type="button" class="my-auto" x-data="" x-on:click="$dispatch('open-modal', 'create-area')">{{ __('Buat') }}</x-secondary-button>
    
    </div>
    <x-modal name="create-area">
        <livewire:kpi-areas-create wire:key="areas-create" lazy />
    </x-modal>
    <div class="w-full mt-5">
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">            
            <table wire:key="areas-table" class="table">
                <tr class="uppercase text-xs">
                    <th>
                        {{ __('Nama') }}
                    </th>
                </tr>
                @foreach($areas as $area)
                <tr wire:key="area-tr-{{ $area->id . $loop->index }}" tabindex="0" x-on:click="$dispatch('open-modal', 'edit-area-{{ $area->id }}')">
                    <td>
                        {{ $area->name }}
                    </td> 
                </tr>
                <x-modal :name="'edit-area-'.$area->id">
                    <livewire:kpi-areas-edit wire:key="area-lw-{{ $area->id . $loop->index }}" :area="$area" lazy />                    
                </x-modal> 
                @endforeach
            </table>
            <div wire:key="areas-none">
                @if(!$areas->count())
                    <div class="text-center py-12">
                        {{ __('Tak ada area terdaftar') }}
                    </div>
                @endif
            </div>
        </div>
    </div>    
</div>