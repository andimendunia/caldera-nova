<div>
    <div wire:key="inv-circ-edit-content-{{ $circ->id }}" x-data="{ edit: false }"
        class="text-neutral-600 dark:text-neutral-400 p-6">
        <div x-show="!edit" class="mb-6">
            <div
                class="flex justify-between items-center text-lg mb-4 font-medium text-neutral-900 dark:text-neutral-100">
                <h2>
                    {{ __('Sirkulasi') }}
                </h2>
                <x-text-button type="button" x-on:click="$dispatch('close')"><i class="fa fa-times"></i></x-text-button>
            </div>
            <div class="flex justify-center items-center gap-x-2 mb-6">
                <div>
                    <i class="fa {{ $circ->getDirIcon() }}"></i>
                </div>
                <div>
                    {{ abs($qty) }}
                </div>
                <div>
                    {{ $uom }}
                </div>
                <div>
                    •
                </div>
                <div>
                    {{ number_format(abs($amount), 2) . ' ' . $curr }}
                </div>
                @if ($circ->status == 1)
                    <div>
                        •
                    </div>
                    <div>
                        {{ $circ->qty_before . ' → ' . $circ->qty_after }}
                    </div>
                @endif
            </div>
            <div class="flex items-start gap-x-3">
                <div>
                    <div class="w-8 h-8 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                        @if ($circ->user->photo)
                            <img class="w-full h-full object-cover dark:brightness-75"
                                src="{{ '/storage/users/' . $circ->user->photo }}" />
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25"
                                viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano">
                                <path
                                    d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z" />
                            </svg>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="whitespace-normal">
                        <div class="text-xs text-neutral-400 dark:text-neutral-600 mb-1">{{ $circ->user->name }} @if ($circ->assigner_id)
                                <span
                                    title="{{ __('Didelegasikan oleh:') . ' ' . $circ->assigner->name . ' (' . $circ->assigner->emp_id . ')' }}">•
                                    <i class="fa fa-handshake-angle"></i></span>
                            @endif <span class="mx-1">•</span>{{ $circ->created_at }}</div>
                        <div class="text-base">
                            @if ($circ->qtype !== 1)
                                <x-badge>{{ $circ->getQtype() }}</x-badge>
                            @endif {{ $circ->remarks }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="edit" x-cloak>
            <div
            class="flex justify-between items-center text-lg mb-4 font-medium text-neutral-900 dark:text-neutral-100">
            <h2>
                {{ __('Edit sirkulasi') }}
            </h2>

            <x-text-button type="button" x-on:click="$dispatch('close')"><i class="fa fa-times"></i></x-text-button>
        </div>

        </div>
        <hr class="border-neutral-300 dark:border-neutral-700">
        <div class="flex text-sm gap-x-2 my-4">
            <div class="grow truncate">
                <div class="flex truncate gap-x-2">
                    <div class="truncate font-medium text-neutral-900 dark:text-neutral-100">
                        {{ $circ->inv_item->name }}
                    </div>
                    <div>•</div>
                    <div class="truncate">
                        {{ $circ->inv_item->desc }}
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <x-link href="{{ route('inventory.items.show', ['id' => $circ->inv_item_id]) }}" target="_blank"><i
                        class="fa fa-external-link-alt"></i></x-link>
            </div>
        </div>
        <hr class="border-neutral-300 dark:border-neutral-700">
        <div x-show="edit" x-cloak class="mt-6">
            <x-secondary-button type="button" x-on:click="edit = false">{{ __('Kembali') }}</x-secondary-button>
        </div>
        <div x-show="!edit" class="mt-6">
            @if ($circ->status == 0)
            <div x-data="{ eval: false }">
                <div x-show="!eval" class="flex justify-end gap-x-2">
                    <x-secondary-button x-on:click="edit = true"
                    type="button">{{ __('Edit') }}</x-secondary-button>
                    <x-primary-button type="button" x-on:click="eval = true;">{{ __('Evaluasi') }}</x-primary-button>
                </div>
                <div x-show="eval">
                    <x-text-input wire:model="comment" id="inv-comment" type="text"
                    placeholder="{{ __('Komentar') }}" autocomplete="inv-comment" />
                    <div class="flex justify-between mt-3">
                        <x-secondary-button type="button" x-on:click="eval = false;"
                        type="button">{{ __('Kembali') }}</x-secondary-button>
                        <div class="flex gap-x-2">
                            <x-primary-button type="button" x-on:click="eval = false"
                            type="button">{{ __('Setujui') }}</x-primary-button>
                            <x-primary-button type="button" x-on:click="eval = false"
                            type="button">{{ __('Tolak') }}</x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if ($circ->evaluator_id)
                <div class="flex items-center gap-x-2">
                    <div>
                        <div class="w-8 h-8 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                            @if ($circ->evaluator->photo)
                                <img class="w-full h-full object-cover dark:brightness-75"
                                    src="{{ '/storage/users/' . $circ->evaluator->photo }}" />
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25"
                                    viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano">
                                    <path
                                        d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z" />
                                </svg>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="whitespace-normal">
                            <div class="text-xs text-neutral-400 dark:text-neutral-600">{{ $circ->evaluator->name }}
                                <span class="mx-1">•</span>{{ $circ->updated_at }}</div>
                            <div class="text-base"><x-badge><i class="fa {{ $circ->getStatusIcon() }} mr-2"></i>{{ $circ->getStatus() }}</x-badge> {{ $circ->comment }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
