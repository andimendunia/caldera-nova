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
            <livewire:inv-auths-form wire:key="auths-create" lazy />
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
                        <div class="flex">
                            <div class="w-8 h-8 my-auto mr-3 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                @if($auth->user->photo)
                                <img class="w-full h-full object-cover dark:brightness-75" src="{{ '/storage/users/'.$auth->user->photo }}" />
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                @endif
                            </div>
                            <div>
                                <div>{{ $auth->user->name }}</div>
                                <div class="text-xs text-neutral-400 dark:text-neutral-600" >{{ $auth->user->emp_id }}</div>
                            </div>            
                        </div>
                    </td> 
                    <td>
                        {{ $auth->inv_area->name }}
                    </td>
                    <td>
                        {{ $auth->countActions() .' '.__('tindakan') }}
                    </td>
                </tr>
                <x-modal :name="'edit-auth-'.$auth->id">
                    <livewire:inv-auths-form wire:key="auth-lw-{{ $auth->id.$loop->index }}" :auth="$auth" lazy />                    
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