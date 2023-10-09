<div class="flex gap-10">
    <div>
        <div class="w-64">
            <x-text-input-icon id="inv-q" icon="fa fa-search" type="search" placeholder="{{ __('Cari') }}"></x-text-input-icon>
        </div>
    </div>
    <div class="w-full">
        <div class="flex justify-between px-6 sm:px-0">
            <div>
                {{ $locs->count() . ' ' . __('lokasi terdaftar') }}
            </div>
            <x-secondary-button type="button" class="my-auto" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'create-loc')">{{ __('Tambah') }}</x-secondary-button>
        
        </div>
        <div class="w-full mt-5">
            <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">            
                <table class="table">
                    <tr class="uppercase text-xs">
                        <th>
                            {{ __('Nama') }}
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
                            {{ __('Tak ada lokasi terdaftar') }}
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>    
    </div>
</div>