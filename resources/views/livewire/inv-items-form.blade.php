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
            <x-text-input id="inv-name" class="mb-4" name="inv-name" type="text"
                placeholder="{{ __('Nama') }}" />
            <x-text-input id="inv-desc" class="mb-4" name="inv-desc" type="text"
                placeholder="{{ __('Deskripsi') }}" />
            <div class="py-3 text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Info consumables') }}</div>
            <x-text-input wire:model="code" class="mb-4" type="text"
                placeholder="{{ __('Kode item') }}" />
                @if($currs->count())
                <x-select wire:model.live="inv_curr_id" class="mb-3">
                    <option value="">{{__('Tanpa harga sekunder')}}</option>
                        @foreach($currs as $curr)
                            <option wire:key="{{ 'curr'.$loop->index }}" value="{{ $curr->id }}">{{ __('Dengan').' '. $curr->name }}</option>
                        @endforeach
                </x-select>
                @endif
            <x-text-input-curr wire:model.live="price" id="inv-price" min="0" class="mb-4" curr="{{ $curr_main->name }}"
                type="number" placeholder="0" />
            @if($curr_sec->name ?? false)
            <x-text-input-curr wire:model.live="price_sec" id="inv-price-sec" min="0" class="mb-4" curr="{{ $curr_sec->name }}"
            type="number" placeholder="0" />
            @endif
            <div class="py-3 text-medium text-sm uppercase  text-neutral-400 dark:text-neutral-600">
                {{ __('Klasifikasi') }} — TT MM</div>
            <x-text-input-icon wire:model.live="loc" icon="fa fa-fw fa-map-marker-alt" id="inv-loc" list="qlocs" class="mb-3"
                type="text" placeholder="{{ __('Lokasi') }}" />
                <div>{{ var_dump($qlocs) }}</div>
            <datalist id="qlocs">
                @if(count($qlocs))
                    @foreach($qlocs as $qloc)
                        <option wire:key="{{ 'qloc'.$loop->index }}" value="{{ $qloc }}">
                    @endforeach
                @endif
            </datalist>
            <x-text-input-icon icon="fa fa-fw fa-tag" class="mb-3" id="inv-tag" name="tag"
                type="text" placeholder="{{ __('Tag') }}" />
            <div class="py-3 text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Info qty') }}</div>
            <x-text-input type="text" class="mb-4" placeholder="UOM"></x-text-input>
            <div class="grid grid-cols-3 mb-4 gap-3">
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="inv-qtymain">
                        {{ __('Utama') }}
                    </label>
                    <x-text-input id="inv-qtymain" class="mb-4" name="inv-qtymain" type="number"
                        placeholder="0" />
                </div>
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="inv-qtyused">
                        {{ __('Bekas') }}
                    </label>
                    <x-text-input id="inv-qtyused" class="mb-4" name="inv-qtyused" type="number"
                        placeholder="0" />
                </div>
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="inv-qtyrepaired">
                        {{ __('Diperbaiki') }}
                    </label>
                    <x-text-input id="inv-qtyrepaired" class="mb-4" name="inv-qtyrepaired" type="number"
                        placeholder="0" />
                </div>
            </div>
            <div class="py-3 text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Batas qty utama') }}</div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="inv-qtymainmin">
                        {{ __('Minimum') }}
                    </label>
                    <x-text-input id="inv-qtymainmin" class="mb-4" name="inv-qtymainmin" type="number"
                        placeholder="0" />
                </div>
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="inv-qtymainmax">
                        {{ __('Maksimum') }}
                    </label>
                    <x-text-input id="inv-qtymainmax" class="mb-4" name="inv-qtymainmax" type="number"
                        placeholder="0" />
                </div>
            </div>
            <div class="py-3">
                <x-primary-button type="submit">{{ __('Simpan') }}</x-primary-button>
            </div>
        </div>
    </div>
</div>