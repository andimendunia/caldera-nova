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
    <form wire:submit="save()" class="w-full overflow-hidden">
        <div class="px-4 pb-4">
            <div class="text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Info umum') }}</div>
            <x-text-input wire:model="name" class="mt-4" name="name" type="text"
                placeholder="{{ __('Nama') }}" />
            <div wire:key="err-name">
                @error('name')
                    <x-input-error messages="{{ $message }}" class="m-2" />
                @enderror
            </div>
            <x-text-input wire:model="desc" class="mt-4" name="desc" type="text"
                placeholder="{{ __('Deskripsi') }}" />
            <div wire:key="err-desc">
                @error('desc')
                    <x-input-error messages="{{ $message }}" class="m-2" />
                @enderror
            </div>
            <x-text-input wire:model="code" class="mt-4" type="text"
                placeholder="{{ __('Kode') }}" />
            <div wire:key="err-code">
                @error('code')
                    <x-input-error messages="{{ $message }}" class="m-2" />
                @enderror
            </div>
            <div class="mt-8 text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Info harga') }}</div>
            @if($currs->count())
                <x-select wire:model.live="curr_id" class="mt-4">
                    <option value="">{{__('Gunakan hanya').' '.$curr_main->name}}</option>
                        @foreach($currs as $curr)
                            <option wire:key="{{ 'curr'.$loop->index }}" value="{{ $curr->id }}">{{ __('Dengan').' '. $curr->name }}</option>
                        @endforeach
                </x-select>
            @endif
            <div wire:key="prices">
                <x-text-input-curr wire:model.live="price" id="price" min="0" step=".01" class="mt-4" curr="{{ $curr_main->name }}"
                    type="number" placeholder="0" />
                <div wire:key="err-price">
                    @error('price')
                        <x-input-error messages="{{ $message }}" class="m-2" />
                    @enderror
                </div>
                @if($curr_sec->name ?? false)
                    <x-text-input-curr wire:model.live="price_sec" id="price-sec" min="0" step=".01" class="mt-4" curr="{{ $curr_sec->name }}"
                    type="number" placeholder="0" />
                    <div wire:key="err-price_sec">
                        @error('price_sec')
                            <x-input-error messages="{{ $message }}" class="m-2" />
                        @enderror
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-2 gap-x-3 mt-4">
                {{-- <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_main">
                        {{ __('Utama') }}
                    </label>
                    <x-text-input wire:model="qty_main" id="qty_main" type="number"
                        placeholder="0" />
                </div>
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_used">
                        {{ __('Bekas') }}
                    </label>
                    <x-text-input wire:model="qty_used" id="qty_used" type="number"
                        placeholder="0" />
                </div>
                <div>
                    <label class="block font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_rep">
                        {{ __('Diperbaiki') }}
                    </label>
                    <x-text-input wire:model="qty_rep" id="qty_rep" type="number"
                        placeholder="0" />
                </div>
                <div class="col-span-3">
                    <div wire:key="err-qty_main">
                        @error('qty_main')
                            <x-input-error messages="{{ $message }}" class="mx-2 mb-2" />
                        @enderror
                    </div>
                    <div wire:key="err-qty_used">
                        @error('qty_used')
                            <x-input-error messages="{{ $message }}" class="mx-2 mb-2" />
                        @enderror
                    </div>
                    <div wire:key="err-qty_rep">
                        @error('qty_rep')
                            <x-input-error messages="{{ $message }}" class="mx-2 mb-2" />
                        @enderror
                    </div>
                </div> --}}
                <div>
                    <label class="block mb-1 font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="uom">
                        {{ __('UOM') }}
                    </label>
                    <x-text-input wire:model.live="uom" id="uom" type="text" list="quoms"></x-text-input>
                    <datalist wire:key="quoms" id="quoms">
                        @if(count($quoms))
                            @foreach($quoms as $quom)
                                <option wire:key="{{ 'uom'.$loop->index }}" value="{{ $quom }}">
                            @endforeach
                        @endif
                    </datalist>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="denom">
                        <span>{{ __('Denominasi') }}</span>
                        <x-text-button type="button" class="ms-1" x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'inv-denom')"><i class="far fa-question-circle"></i></x-text-button> 
                    </label>
                    <x-text-input wire:model.live="denom" type="number" placeholder="1" min="1"></x-text-input>
                    <x-modal name="inv-denom">
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                                {{ __('Denominasi') }}
                            </h2>
                            <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                                {{__('Jika kamu ingin membagi harga utama menjadi satuan yang lebih kecil, isi denominasi sebagai pembagi.')}}
                            </p>
                            <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                                {{__('Contoh: Harga utama USD 100 / PACK. Ada 20 EA setiap PACK, maka isi "20" di denominasi dan "EA" di UOM.')}}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                                    {{ __('Tutup') }}
                                </x-secondary-button>
                            </div>
                        </div>
                    </x-modal>
                </div>
                <div class="col-span-2">
                    <div wire:key="err-uom">
                        @error('uom')
                            <x-input-error messages="{{ $message }}" class="m-2" />
                        @enderror
                    </div>
                    <div wire:key="err-denom">
                        @error('denom')
                            <x-input-error messages="{{ $message }}" class="m-2" />
                        @enderror
                    </div>
                </div>
                <div wire:key="up" class="col-span-2 text-center mt-4">
                    @if($up)
                        <div class="font-medium text-sm text-neutral-700 dark:text-neutral-300">
                            {{ __('Harga per').' '.$uom }}
                        </div>
                        <div class="text-neutral-500">{{ $curr_main->name.' '.$up }}</div>
                    @endif
                </div>
            </div>
            <div class="mt-8 text-medium text-sm uppercase  text-neutral-400 dark:text-neutral-600">
                {{ __('Klasifikasi') }} — TT MM</div>
            <div class="mt-3">
                <livewire:inv-item-loc :$loc :$area_id />
                <div wire:key="err-loc">
                    @error('loc')
                        <x-input-error messages="{{ $message }}" class="m-2" />
                    @enderror
                </div>
            </div>
            <div class="mx-3 mt-3">
                <x-text-button type="button" class="flex items-center"
                x-data="" x-on:click.prevent="$dispatch('open-modal', 'inv-item-tags')">
                    <i class="fa fa-fw fa-tag mr-2 text-neutral-400 dark:text-neutral-600"></i>
                        @if(count($tags))
                            <div>{{ implode(", ", $tags) }}</div>
                        @else
                            <div class="text-neutral-500">{{ __('Tak ada tag')}}</div>
                        @endif
                </x-text-button>
                <x-modal name="inv-item-tags">
                    <livewire:inv-item-tags :$tags :$area_id lazy />
                </x-modal>
            </div>
            <div wire:key="err-tags">
                @foreach($errors->get('tags.*') as $messages)
                    @foreach($messages as $message)
                        <x-input-error messages="{{ $message }}" class="m-2" />
                    @endforeach
                @endforeach
            </div>
            <div class="mt-8 text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600">
                {{ __('Batas qty utama') }}</div>
            <div class="grid grid-cols-2 gap-x-3">
                <div>
                    <label class="block mb-1 mt-4 font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_main_min">
                        {{ __('Qty minimum') }}
                    </label>
                    <x-text-input wire:model="qty_main_min" id="qty_main_min" type="number"
                        placeholder="0" />
                </div>
                <div>
                    <label class="block mb-1 mt-4 font-medium text-sm text-neutral-700 dark:text-neutral-300"
                        for="qty_main_max">
                        {{ __('Qty maksimum') }}
                    </label>
                    <x-text-input wire:model="qty_main_max" id="qty_main_max" type="number"
                        placeholder="0" />
                </div>
                <div class="col-span-2">
                    <div wire:key="err-qty_main_min">
                        @error('qty_main_min')
                            <x-input-error messages="{{ $message }}" class="m-2" />
                        @enderror
                    </div>
                    <div wire:key="err-qty_main_max">
                        @error('qty_main_max')
                            <x-input-error messages="{{ $message }}" class="m-2" />
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <x-primary-button type="submit">{{ __('Simpan') }}</x-primary-button>
            </div>
        </div>
    </form>
</div>