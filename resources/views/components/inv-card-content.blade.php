@props(['href', 'name', 'desc', 'code', 'curr', 'price', 'uom', 'loc', 'tags', 'qty'])

<x-card-link href="{{ $href }}">
    <div class="flex">
        <div>
            <div class="flex w-32 h-full bg-neutral-200 dark:bg-neutral-700">
                <div class="m-auto">
                    <svg xmlns="http://www.w3.org/2000/svg"  class="block h-16 w-auto fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 38.777 39.793"><path d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z" /></svg>
                </div>
            </div>
        </div>
        <div class="flex grow truncate p-2 sm:p-4">
            <div class="grow truncate">
                <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                    {{ $name }}
                </div>                        
                <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                    {{ $desc }}
                </div>
                <div class="truncate mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ $code . ' • ' . $curr  . ' ' . $price . ' / ' . $uom}}
                </div>
                <div class="truncate mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    <span class="mr-3"><i class="fa fa-map-marker-alt mr-2"></i>{{ $loc }}</span>
                    <span><i class="fa fa-tag mr-2"></i>{{ $tags }}</span>                            
                </div>
            </div>
            <div class="ml-2 text-right">
                <div class="text-2xl">{{ $qty }}</div>
                <div>{{ $uom }}</div>
            </div>
        </div>
    </div>
</x-card-link>