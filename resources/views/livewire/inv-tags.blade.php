<div>
    <div class="px-6 sm:px-0">
        <x-select wire:model.live="area_id" class="w-full sm:w-64">
            <option value=""></option>
            @foreach($areas as $area)
            <option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
        </x-select>  
    </div>
    <div class="w-full mt-5">
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">          
            <div class="flex items-center justify-between px-6 py-3">
                <div class="text-xs font-bold uppercase">{{ $tags->total() . ' ' . __('tag') }}</div>
                <div class="w-40">
                    <x-text-input-search wire:model.live="q" id="inv-q" placeholder="{{ __('CARI') }}"></x-text-input-search>
                </div>
            </div>  
            <hr class="border-neutral-200 dark:border-neutral-700" />
            <table class="table">
                @foreach($tags as $tag)
                <tr wire:key="tag-tr-{{ $tag->id.$loop->index }}" tabindex="0" x-on:click="$dispatch('open-modal', 'edit-tag-{{ $tag->id }}')">
                    <td>
                        {{ $tag->name }}
                    </td> 
                </tr>
                <x-modal :name="'edit-tag-'.$tag->id">
                    <livewire:inv-tags-edit wire:key="tag-lw-{{ $tag->id.$loop->index }}" :tag="$tag" lazy />                    
                </x-modal> 
                @endforeach
            </table>
            @if(!$tags->count())
                <div class="text-center py-12">
                    {{ __('Tak ada tag ditemukan') }}
                </div>
            @endif
        </div>
    </div>  
    <div class="flex items-center relative h-16">
        @if(!$tags->isEmpty())
        @if($tags->hasMorePages())
            <div wire:key="more" x-data="{
                observe(){
                    const observer = new IntersectionObserver((tags) => {
                        tags.forEach(tag => {
                            if(tag.isIntersecting) {
                                @this.loadMore()
                            }
                        })
                    })
                    observer.observe(this.$el)
                }
            }" x-init="observe"></div>
            <x-spinner class="sm" />
        @else
            <div class="mx-auto">{{__('Tidak ada lagi')}}</div>
        @endif
        @endif
    </div>
</div>