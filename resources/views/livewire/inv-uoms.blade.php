<div>
    <div class="flex justify-between px-6 sm:px-0">
        <div>
            {{ $uoms->count() . ' ' . __('UOM terdaftar') }}
        </div>
        <x-text-button type="button" class="my-auto" x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'create-uom')"><i class="far fa-question-circle"></i></x-text-button>    
    </div>
    <x-modal name="create-uom">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Penambahan UOM') }}
            </h2>
            <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                {{__('Setiap UOM baru saat barang ditambahkan atau diedit, akan otomatis tersimpan di sini.')}}
            </p>
            <div class="mt-6 flex justify-end">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Tutup') }}
                </x-secondary-button>
            </div>
        </div>
    </x-modal>
    <div class="w-full mt-5">
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">            
            <table wire:key="uoms-table" class="table">
                <tr class="uppercase text-xs">
                    <th>
                        {{ __('Nama') }}
                    </th>
                </tr>
                @foreach($uoms as $uom)
                <tr wire:key="uom-tr-{{ $uom->id . $loop->index }}" tabindex="0" x-on:click="$dispatch('open-modal', 'edit-uom-{{ $uom->id }}')">
                    <td>
                        {{ $uom->name }}
                    </td> 
                </tr>
                <x-modal :name="'edit-uom-'.$uom->id">
                    <livewire:inv-uoms-edit wire:key="uom-lw-{{ $uom->id . $loop->index }}" :uom="$uom" lazy />                    
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