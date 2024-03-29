<div>
    <form wire:submit="save" class="p-6">
        <div class="flex justify-between items-start">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Wewenang') }}
            </h2>
            <x-text-button type="button" x-on:click="$dispatch('close')"><i class="fa fa-times"></i></x-text-button>
        </div>
        <div class="grid grid-cols-1 gap-y-3 mt-3">
            @if($auth_id)

            <div class="grid gap-3 grid-cols-1 sm:grid-cols-2">
                <div class="flex p-4 border border-neutral-200 dark:border-neutral-700 rounded-lg">
                    <div>
                        <div class="w-8 h-8 my-auto mr-3 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                            @if($auth->user->photo)
                            <img class="w-full h-full object-cover dark:brightness-75" src="{{ '/storage/users/'.$auth->user->photo }}" />
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                            @endif
                        </div>
                    </div>
                    <div class="truncate">
                        <div class="truncate">{{ $auth->user->name }}</div>
                        <div class="truncate text-xs text-neutral-400 dark:text-neutral-600" >{{ $auth->user->emp_id }}</div>
                    </div>            
                </div>
                <div class="truncate text-center p-4 border border-neutral-200 dark:border-neutral-700 rounded-lg">
                    <div class="truncate">{{ $auth->kpi_area->name }}</div>
                    <div class="truncate text-xs text-neutral-400 dark:text-neutral-600" >{{ __('Area KPI') }}</div>
                </div>
            </div>

            @else

                <div x-data="{ open: false, userq: @entangle('userq').live }" x-on:user-selected="userq = $event.detail; open = false">
                    <div x-on:click.away="open = false">
                        <x-text-input-icon x-model="userq" icon="fa fa-fw fa-user" x-on:change="open = true"
                            x-ref="userq" x-on:focus="open = true" id="kpi-user" class="mt-3" type="text" autocomplete="off"
                            placeholder="{{ __('Pengguna') }}" />
                        <div class="relative" x-show="open" x-cloak>
                            <div class="absolute top-1 left-0 w-full">
                                <livewire:user-select wire:key="user-select" />
                            </div>
                        </div>
                    </div>
                    <div wire:key="error-user_id">
                        @error('user_id')
                            <x-input-error messages="{{ $message }}" class="mt-2" />
                        @enderror
                    </div>
                </div>
                <div>
                    <x-select wire:model="area_id">
                        <option value=""></option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </x-select>
                    <div wire:key="error-area_id">
                        @error('area_id')
                            <x-input-error messages="{{ $message }}" class="mt-2" />
                        @enderror
                    </div>
                </div>
            
            @endif
        </div>
        <div class="grid grid-cols-1 gap-y-3 mt-6">
            <x-checkbox id="{{ $auth->id ?? 'new'}}-item-manage" :disabled="!$is_superuser" wire:model="actions" value="item-manage">{{ __('Kelola KPI') }}</x-checkbox>
        </div>
        @can('superuser')
        <div class="mt-6 flex justify-between items-end">
            <x-secondary-button type="submit">
                <i class="fa fa-save me-2"></i>
                {{ __('Simpan') }}
            </x-secondary-button>
            <div>
                @if($auth_id)
                <x-text-button type="button" class="uppercase text-xs text-red-500" wire:click="delete">
                    {{ __('Cabut') }}
                </x-text-button>
                @endif
            </div>
        </div>
        @endcan
    </form>
    <x-spinner-bg wire:loading.class.remove="hidden" wire:target="delete"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden" wire:target="delete" class="hidden"></x-spinner>
    <x-spinner-bg wire:loading.class.remove="hidden" wire:target="save"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden" wire:target="save" class="hidden"></x-spinner>
</div>
