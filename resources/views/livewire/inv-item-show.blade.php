<div class="block sm:flex gap-x-6">
    <div wire:key="photo">
        <div class="sticky top-5 left-0">
            <livewire:inv-item-photo :id="$inv_item->id" :url="$inv_item->photo ? '/storage/inv-items/' . $inv_item->photo : ''" />
            <div class="flex px-4 py-5 text-sm text-neutral-600 dark:text-neutral-400">
                <div class="grow">{{ __('Updated:') . ' ' . $inv_item->updated_at->diffForHumans() }}</div>
                <x-link class="uppercase" href="{{ route('inventory.items.edit', ['id' => $inv_item]) }}"><i
                        class="fa fa-pen"></i></x-link>
            </div>
        </div>
    </div>
    <div class="w-full overflow-hidden">
        <div class="px-4">
            <h1 class="text-2xl mb-3 text-neutral-900 dark:text-neutral-100">{{ $inv_item->name }}</h1>
            <p class="mb-4">{{ $inv_item->desc }}</p>
        </div>
        <div class="text-neutral-600 dark:text-neutral-400">
            <hr class="border-neutral-200 dark:border-neutral-800" />
            <div class="px-4 py-5">
                <div class="flex mb-3">
                    <div>{{ $inv_item->code ? $inv_item->code : __('Tak ada kode') }}</div>
                    <div class="mx-3">•</div>
                    <div>
                        {{ $inv_item->price ? $inv_curr->name . ' ' . number_format($inv_item->price, 2) . ' / ' . $inv_item->inv_uom->name : __('Tak ada harga') }}
                    </div>
                </div>
                <div>
                    <x-text-button type="button" x-on:click="$dispatch('open-modal', 'edit-loc')" class="mr-4"><i
                            class="fa fa-map-marker-alt mr-2"></i>{{ $loc ? $loc : __('Tak ada lokasi') }}</x-text-button>
                    <x-modal :name="'edit-loc'" focusable>
                        <livewire:inv-item-loc :loc="$inv_item->loc()" :inv_area_id="$inv_item->inv_area_id" :id="$inv_item->id" lazy />
                    </x-modal>
                    <x-text-button type="button" x-on:click="$dispatch('open-modal', 'edit-tags')"><i
                            class="fa fa-tag mr-2"></i>{{ $tags ? $tags : __('Tak ada tag') }}</x-text-button>
                    <x-modal :name="'edit-tags'">
                        <livewire:inv-item-tags :tags="$inv_item->tags_array()" :inv_area_id="$inv_item->inv_area_id" :id="$inv_item->id" lazy />
                    </x-modal>

                </div>
            </div>
            <hr class="border-neutral-200 dark:border-neutral-800" />
            <div class="flex px-4 py-5 text-sm">
                @if ($inv_item->is_active)
                    <div>{{ __('Aktif') }}</div>
                @else
                    <div class="text-red-500">{{ __('Nonaktif') }}</div>
                @endif
                <div class="mx-2">•</div>
                <div>{{ $inv_item->inv_area->name }}</div>
            </div>
        </div>
        <livewire:inv-item-circ :id="$inv_item->id" :qty_main="$inv_item->qty_main" :qty_used="$inv_item->qty_used" :qty_rep="$inv_item->qty_rep" :qty_main_min="$inv_item->qty_main_min" :qty_main_max="$inv_item->qty_main_max" :curr="$inv_curr->name" :price="$inv_item->price" :uom="$inv_item->inv_uom->name" />
    </div>
</div>
