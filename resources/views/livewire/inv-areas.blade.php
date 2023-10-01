<div>
    <div class="flex justify-between px-6 sm:px-0">
        <div>
            {{ $areas->count() . ' ' . __('area terdaftar') }}
        </div>
        <x-secondary-button type="button" class="my-auto" x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'create-area')">{{ __('Tambah') }}</x-secondary-button>
    
    </div>
    <div class="w-full mt-5">
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">            
            <table class="table">
                <tr class="uppercase text-xs">
                    <th>
                        {{ __('Nama') }}
                    </th>
                </tr>
                @foreach($areas as $area)
                <tr tabindex="0" x-on:click="$dispatch('open-modal', 'edit-area-{{ $area->id }}')">
                    <td>
                        {{ $area->name }}
                    </td> 
                </tr>
                <x-modal :name="'edit-area-'.$area->id">
                    <livewire:inv-areas-edit wire:key="area-lw-{{ $area->id }}" :area="$area" lazy />                    
                </x-modal> 
                @endforeach
                @if(!$areas->count())
                <tr>
                    <td class="text-center">
                        {{ __('Tak ada area terdaftar') }}
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>    
</div>