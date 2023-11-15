<div>
    @if ($circs->count())
        <div class="text-sm p-4">
            <x-text-button type="button"><i class="fa fa-download mr-2"></i>{{ __('Unduh sirkulasi') }}</x-text-button>
        </div>
        <div wire:key="circs" class="grid grid-col-1">
            @foreach ($circs as $circ)
            <div wire:key="circ-for-{{ $circ->id }}" class="p-1 truncate">
                <x-circ-button wire:key="circ-button-{{ $circ->id }}" class="p-2 text-sm truncate w-full" x-on:click.prevent="$dispatch('open-modal', 'circ-edit-{{ $circ->id }}')">
                    <div class="flex items-center">
                        <div>
                            <div class="w-24 truncate text-base">
                                @if ($circ->qty < 0)
                                    <i class="fa fa-fw fa-minus mr-1"></i>{{ abs($circ->qty) . ' ' . $circ->inv_item->inv_uom->name }}
                                @elseif ($circ->qty > 0)
                                    <i class="fa fa-fw fa-plus mr-1"></i>{{ $circ->qty . ' ' . $circ->inv_item->inv_uom->name }}
                                @else
                                    <i class="fa fa-fw fa-flag mr-1"></i>
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="w-8 h-8 mr-2 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                @if($circ->user->photo)
                                <img class="w-full h-full object-cover dark:brightness-75" src="{{ '/storage/users/'.$circ->user->photo }}" />
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                                @endif
                            </div>
                        </div>
                        <div class="truncate">
                            <div class="truncate">
                                <div class="text-xs truncate text-neutral-400 dark:text-neutral-600">{{ $circ->user->name }} @if($circ->assigner_id) <span title="{{ __('Didelegasikan oleh:') . ' ' . $circ->assigner->name . ' ('. $circ->assigner->emp_id .')' }}">• <i class="fa fa-handshake-angle"></i></span> @endif <span class="mx-1">•</span>{{ $circ->created_at->diffForHumans() }}</div>
                                <div class="text-base truncate">@switch($circ->qtype) @case(2) <x-badge>{{ __('Bekas') }}</x-badge> @break @case(3) <x-badge>{{ __('Diperbaiki') }}</x-badge> @break @endswitch {{ $circ->remarks }}</div>
                            </div>
                        </div>
                        <div class="ml-auto pl-4 text-sm">
                            <i class="fa {{ $circ->getStatusIcon() }}"></i>
                        </div>
                    </div>
                </x-circ-button>
                <x-modal name="circ-edit-{{ $circ->id }}">
                    <livewire:inv-circ-edit wire:key="inv-circ-edit-{{ $circ->id }}" :$circ lazy />
                </x-modal>
            </div>
            @endforeach
            <div class="mt-4">
                {{ $circs->links(data: ['scrollTo' => false]) }}
            </div>
    @else
    <div class="my-10 text-center">
        {{ __('Tak ada sirkulasi')}}
    </div>
    @endif
</div>
</div>
