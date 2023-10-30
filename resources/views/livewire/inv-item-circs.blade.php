<div>
    <div class="p-4">
        <x-text-button type="button"><i
                class="fa fa-download mr-2"></i>{{ __('Unduh sirkulasi') }}</x-text-button>
    </div>
    <div class="grid grid-col-1">
        @foreach($circs as $circ)
        <x-circ-button class="px-4 py-2 text-sm">
            <div class="flex items-center">
                <div>
                    <div class="w-24 truncate text-base">
                        @if ($circ->qty < 0)
                            <i class="fa fa-min mr-2"></i>{{ abs($circ->qty).' '.$circ->inv_item->inv_uom->name }}
                        @elseif ($circ->qty > 0)
                            <i class="fa fa-plus mr-2"></i>{{ $circ->qty.' '.$circ->inv_item->inv_uom->name }}
                        @else
                            <i class="fa fa-flag mr-2"></i>
                        @endif                                
                    </div>
                </div>
                <div>
                    <div class="w-8 h-8 mr-2 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25"
                            viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano">
                            <path
                                d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z" />
                        </svg>
                    </div>
                </div>
                <div class="truncate">
                    <div class="truncate">
                        <div class="text-xs truncate">{{ $circ->user->name }}</div>
                        <div class="text-base truncate">{{ $circ->remarks}}</div>
                    </div>
                    <div class="text-xs truncate text-neutral-400 dark:text-neutral-600">
                        3 bulan yang lalu
                    </div>
                </div>
                <div class="ml-auto text-sm">
                    @switch($circ->status)
                        @case(0)
                            <i class="fa fa-hourglass-half"></i>
                            @break
                        @case(1)
                            <i class="fa fa-thumbs-up"></i>
                            @break
                        @case(2)
                            <i class="fa fa-thumbs-down"></i>
                            @break
                        @case(3)
                            <i class="fa fa-exclamation-circle"></i>
                            @break                            
                    @endswitch
                </div>
            </div>
        </x-circ-button>
        @endforeach
    </div>
</div>