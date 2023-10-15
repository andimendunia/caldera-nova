<div class="block sm:flex gap-x-6">
    <div>
        <div
            class="flex w-full rounded-none sm:w-48 h-48 md:w-72 md:h-72 lg:w-80 lg:h-80 bg-neutral-200 dark:bg-neutral-700 sm:rounded">
            <div class="m-auto">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="block h-32 w-auto fill-current text-neutral-800 dark:text-neutral-200 opacity-25"
                    viewBox="0 0 38.777 39.793">
                    <path
                        d="M19.396.011a1.058 1.058 0 0 0-.297.087L6.506 5.885a1.058 1.058 0 0 0 .885 1.924l12.14-5.581 15.25 7.328-15.242 6.895L1.49 8.42A1.058 1.058 0 0 0 0 9.386v20.717a1.058 1.058 0 0 0 .609.957l18.381 8.633a1.058 1.058 0 0 0 .897 0l18.279-8.529a1.058 1.058 0 0 0 .611-.959V9.793a1.058 1.058 0 0 0-.599-.953L20 .105a1.058 1.058 0 0 0-.604-.095zM2.117 11.016l16.994 7.562a1.058 1.058 0 0 0 .867-.002l16.682-7.547v18.502L20.6 37.026V22.893a1.059 1.059 0 1 0-2.117 0v14.224L2.117 29.432z" />
                </svg>
            </div>
        </div>
        <div class="p-4 text-sm text-neutral-600 dark:text-neutral-400">
            <div class="mb-4">
                <x-link href="#"><i
                        class="fa fa-fw fa-upload mr-3"></i>{{ __('Unggah foto') }}</x-link><br />
            </div>
            <div>
                <x-link href="#"><i
                        class="fa fa-fw fa-file-import mr-3"></i>{{ __('Tarik dari ttconsumable') }}</x-link>
            </div>
        </div>
    </div>
    <div class="w-full overflow-hidden">
        <div class="px-4 pb-4">
            <div class="py-3 text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Nama dan deskripsi') }}</div>
            <x-text-input id="name" class="mb-4" name="name" type="text"
                placeholder="{{ __('Nama') }}" />
            <x-text-input id="desc" class="mb-4" name="desc" type="text"
                placeholder="{{ __('Deskripsi') }}" />
            <div class="py-3 text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Info consumables') }}</div>
            <x-text-input wire:model="code" class="mb-4" type="text"
                placeholder="{{ __('Kode item') }}" />
                @if($currs->count())
                <x-select wire:model.live="curr_id" class="mb-3">
                    <option value="">{{__('Tanpa harga sekunder')}}</option>
                        @foreach($currs as $curr)
                            <option wire:key="{{ 'curr'.$loop->index }}" value="{{ $curr->id }}">{{ __('Dengan').' '. $curr->name }}</option>
                        @endforeach
                </x-select>
                @endif
            <div wire:key="prices">
                <x-text-input-curr wire:model.live="price" id="price" min="0" class="mb-4" curr="{{ $curr_main->name }}"
                    type="number" placeholder="0" />
                @if($curr_sec->name ?? false)
                <x-text-input-curr wire:model.live="price_sec" id="price-sec" min="0" class="mb-4" curr="{{ $curr_sec->name }}"
                type="number" placeholder="0" />
                @endif
            </div>
            <div class="py-3 text-medium text-sm uppercase  text-neutral-400 dark:text-neutral-600">
                {{ __('Klasifikasi') }} — TT MM</div>
            <div class="mb-3">
                <livewire:inv-item-loc  :loc="$loc" :area_id="$area_id" />
            </div>
            <div class="mx-3 mb-3">
                <livewire:inv-item-tags :tags="$tags" :area_id="$area_id"/>
            </div>
            {{-- <x-text-input-icon icon="fa fa-fw fa-tag" class="mb-3" id="inv-tag" name="tag"
                type="text" placeholder="{{ __('Tag') }}" /> --}}
            <div class="py-3 text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Info qty') }}</div>
            <x-text-input type="text" class="mb-4" placeholder="UOM"></x-text-input>
            <div class="grid grid-cols-3 mb-4 gap-3">
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_main">
                        {{ __('Utama') }}
                    </label>
                    <x-text-input wire:model="qty_main" id="qty_main" class="mb-4" type="number"
                        placeholder="0" />
                </div>
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_used">
                        {{ __('Bekas') }}
                    </label>
                    <x-text-input wire:model="qty_used" id="qty_used" class="mb-4" type="number"
                        placeholder="0" />
                </div>
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_rep">
                        {{ __('Diperbaiki') }}
                    </label>
                    <x-text-input wire:model="qty_rep" id="qty_rep" class="mb-4" type="number"
                        placeholder="0" />
                </div>
            </div>
            <div class="py-3 text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Batas qty utama') }}</div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_main_min">
                        {{ __('Minimum') }}
                    </label>
                    <x-text-input wire:model="qty_main_min" id="qty_main_min" class="mb-4" type="number"
                        placeholder="0" />
                </div>
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_main_max">
                        {{ __('Maksimum') }}
                    </label>
                    <x-text-input wire:model="qty_main_max" id="qty_main_max" class="mb-4" type="number"
                        placeholder="0" />
                </div>
            </div>
            <div class="py-3">
                <x-primary-button type="submit">{{ __('Simpan') }}</x-primary-button>
            </div>
        </div>
    </div>
</div>