<div>
    <div class="w-full mt-5">
        <div class="flex justify-between px-6 sm:px-0">
            <div>
                {{ 0 . ' ' . __('baris') }}
            </div>
            <x-secondary-button type="button" class="my-auto" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'create-auth')">{{ __('Beri wewenang') }}</x-secondary-button>
        
        </div>
        <x-modal name="create-auth">
            <livewire:inv-auths-create wire:key="auths-create" lazy />
        </x-modal>
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg mt-5">          
            <div class="flex items-center justify-between px-6 py-3">
                <div class="text-xs font-bold uppercase">{{ __('Pengguna') }}</div>
                <div class="w-40">
                    <x-text-input-search wire:model.live="q" id="inv-q" placeholder="{{ __('CARI') }}"></x-text-input-search>
                </div>
            </div>  
            <hr class="border-neutral-200 dark:border-neutral-700" />
            <table wire:key="auths-table" class="table">
                @foreach($auths as $auth)
                <tr wire:key="auth-tr-{{ $auth->id.$loop->index }}" tabindex="0" x-on:click="$dispatch('open-modal', 'edit-auth-{{ $auth->id }}')">
                    <td>
                        {{ $auth->name }}
                    </td> 
                </tr>
                <x-modal :name="'edit-auth-'.$auth->id">
                    <livewire:inv-auths-edit wire:key="auth-lw-{{ $auth->id.$loop->index }}" :auth="$auth" lazy />                    
                </x-modal> 
                @endforeach
            </table>
            <div wire:key="auths-none">
                @if(!$auths->count())
                    <div class="text-center py-12">
                        {{ __('Kosong') }}
                    </div>
                @endif
            </div>
        </div>
    </div>  
    <div wire:key="observer" class="flex items-center relative h-16">
        @if(!$auths->isEmpty())
        @if($auths->hasMorePages())
            <div wire:key="more" x-data="{
                observe(){
                    const observer = new IntersectionObserver((auths) => {
                        auths.forEach(auth => {
                            if(auth.isIntersecting) {
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