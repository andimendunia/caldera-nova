<div>
    <div class="flex justify-between px-6 sm:px-0">
        <div>
            {{ $uoms->count() . ' ' . __('UOM terdaftar') }}
        </div>
        <x-text-button type="button" class="my-auto" x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'create-uom')"><i class="far fa-question-circle"></i></x-text-button>    
    </div>
    <div class="w-full mt-5">
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">            
            <table wire:key="uoms-table" class="table">
                <tr class="uppercase text-xs">
                    <th>
                        {{ __('Nama') }}
                    </th>
                </tr>
                @foreach($uoms as $uom)
                <tr wire:key="uom-tr-{{ $uom->id.$loop->index }}" tabindex="0" x-on:click="$dispatch('open-modal', 'edit-uom-{{ $uom->id }}')">
                    <td>
                        {{ $uom->name }}
                    </td> 
                </tr>
                <x-modal :name="'edit-uom-'.$uom->id">
                    <livewire:inv-uoms-edit wire:key="uom-lw-{{ $uom->id.$loop->index }}" :uom="$uom" lazy />                    
                </x-modal> 
                @endforeach
            </table>
            <div wire:key="uoms-none">
                @if(!$uoms->count())
                    <div class="text-center py-12">
                        {{ __('Tak ada UOM terdaftar') }}
                    </div>
                @endif
            </div>
        </div>
    </div>    
</div>