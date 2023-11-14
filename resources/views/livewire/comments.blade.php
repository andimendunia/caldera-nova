<div class="pb-32">
    <div>
        <h1>{{ __('Komentar') . ' ' . '(' . $count . ')' }}</h1>
    </div>
    {{-- <hr class="border-neutral-300 dark:border-neutral-600" /> --}}
    <livewire:com-item-write :$mod />
    @if ($comments->count())
        @foreach ($comments as $comment)
            <hr class=" border-neutral-200 dark:border-neutral-800" />
            <div class="flex gap-x-4 my-4">
                <div>
                    <div class="w-8 h-8 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                        @if ($comment->user->photo)
                            <img class="w-full h-full object-cover dark:brightness-75"
                                src="/storage/users/{{ $comment->user->photo }}" />
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
                <div class="w-full">
                    <div class="flex text-xs text-neutral-400 dark:text-neutral-600 mb-1 justify-between">
                        <div>{{ $comment->user->name . ' • ' . $comment->updated_at->diffForHumans() }}</div>
                        {{-- <div><i class="fa fa-ellipsis"></i></div> --}}
                    </div>
                    <div>{!! nl2br($comment->parseContent()) !!}</div>
                    @if ($comment->files->count())
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4 text-sm text-neutral-600 dark:text-neutral-400">
                            @foreach ($comment->files->all() as $file)
                                <x-card-button type="button" class="p-3"
                                    wire:click="download('{{ $file->id }}')">
                                    <div class="flex justify-center items-center h-24">
                                        <div class="flex flex-col items-center gap-1">
                                            <div><i class="{{ $file->getIcon() }} text-xl "></i></div>
                                            <div class="text-xs">{{ $file->ext . ' • ' . $file->getFormattedSize() }}</div>
                                        </div>
                                    </div>
                                    <div class="truncate">{{ $file->client_name }}</div>
                                </x-card-button>
                            @endforeach
                        </div>
                    @endif
                    <div x-data="{ open: false, setFocus: function() { $nextTick(() => $refs.container.querySelector('textarea').focus()); } }" x-on:click.away="open = false" x-ref="container">
                        <div class="text-neutral-400 dark:text-neutral-600 text-sm mt-2">
                            <x-text-button type="button" x-on:mousedown="open = true"
                                x-on:mouseup="setFocus()">{{ __('Balas') }}</x-text-button>
                        </div>
                        <div x-show="open" x-cloak>
                            <livewire:com-item-write wire:key="write-first-{{ $comment->id }}" :$mod :parent_id="$comment->id" />
                        </div>
                    </div>
                    <div x-data="{ open: false, emp_id: '', setFocus: function() { $nextTick(() => { const ta = $refs.container.querySelector('textarea');
                                ta.focus();
                                ta.value = '@' + this.emp_id + ' ' }); } }" x-on:click.away="open = false" x-ref="container">
                        @foreach ($comment->children as $child)
                            <hr class=" border-neutral-200 dark:border-neutral-800 mt-4" />
                            <div class="flex gap-x-4 my-4">
                                <div>
                                    <div
                                        class="w-8 h-8 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                        @if ($child->user->photo)
                                            <img class="w-full h-full object-cover dark:brightness-75"
                                                src="/storage/users/{{ $child->user->photo }}" />
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
                                <div class="w-full">
                                    <div
                                        class="flex text-xs text-neutral-400 dark:text-neutral-600 mb-1 justify-between">
                                        <div>{{ $child->user->name . ' • ' . $child->updated_at->diffForHumans() }}
                                        </div>
                                        {{-- <div><i class="fa fa-ellipsis"></i></div> --}}
                                    </div>
                                    <div>{!! nl2br($child->parseContent()) !!}</div>
                                    @if ($child->files->count())
                                        <div
                                            class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4 text-sm text-neutral-600 dark:text-neutral-400">
                                            @foreach ($child->files->all() as $file)
                                                <x-card-button type="button" class="p-3"
                                                    wire:click="download('{{ $file->id }}')">
                                                    <div class="flex justify-center items-center h-24">
                                                        <div class="flex flex-col items-center gap-1">
                                                            <div><i class="{{ $file->getIcon() }} text-xl "></i></div>
                                                            <div class="text-xs">
                                                                {{ $file->ext . ' • ' . $file->getFormattedSize() }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="truncate">{{ $file->client_name }}</div>
                                                </x-card-button>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="text-neutral-400 dark:text-neutral-600 text-sm mt-2">
                                        <x-text-button type="button"
                                            x-on:mousedown="open = true; emp_id = '{{ $child->user->emp_id }}'"
                                            x-on:mouseup="setFocus()">{{ __('Balas') }}</x-text-button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div x-show="open" x-cloak>
                            <livewire:com-item-write wire:key="write-second-{{ $comment->id }}" :$mod :parent_id="$comment->id" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
