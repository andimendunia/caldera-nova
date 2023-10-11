<div>
    <div class="block sm:flex justify-between px-6 sm:px-0">
        <div>
            <div class="w-full sm:w-64">
                <x-select wire:model.live="area_id">
                    <option value=""></option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </x-select>  
                <x-text-input-icon wire:model.live="q" icon="fa fa-search" type="search" id="inv-q" placeholder="{{ __('Cari...') }}" class="mt-3"></x-text-input-icon>
            </div>
        </div>
        <div class="mt-4 sm:mt-0">{{ $locs->total() . ' ' . __('lokasi ditemukan') }}</div>
    </div>
    <div class="w-full mt-5">
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">            
            <table class="table">
                <tr class="uppercase text-xs">
                    <th>
                        <div>{{ __('Nama') }}</div>
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
    <div class="flex items-center relative h-32">
        @if(!$locs->isEmpty())
        @if($locs->hasMorePages())
            <div wire:key="more" x-data="{
                observe(){
                    const observer = new IntersectionObserver((locs) => {
                        locs.forEach(loc => {
                            if(loc.isIntersecting) {
                                @this.loadMore()
                            }
                        })
                    })
                    observer.observe(this.$el)
                }
            }" x-init="observe"></div>
            <x-spinner />
        @else
            <div class="mx-auto">{{__('Tidak ada lagi')}}</div>
        @endif
        @endif
    </div>
</div>