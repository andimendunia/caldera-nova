<div class="block sm:flex gap-x-6">
    <livewire:inv-item-photo isForm="true" :url="$inv_item->photo ?? false ? $url : ''" />
    <form wire:submit="save()" class="w-full overflow-hidden">
        <div class="px-4 pb-4">
            <div class="bg-white dark:bg-neutral-800 shadow rounded-lg p-4 mb-4">
                <div class="text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600 mb-4">
                    {{ __('Informasi Dasar') }}</div>
                <x-text-input wire:model="name" type="text" placeholder="{{ __('Nama') }}" />
                <div wire:key="err-name">
                    @error('name')
                        <x-input-error messages="{{ $message }}" class="m-2" />
                    @enderror
                </div>
                <x-text-input wire:model="desc" class="mt-4" type="text" placeholder="{{ __('Deskripsi') }}" />
                <div wire:key="err-desc">
                    @error('desc')
                        <x-input-error messages="{{ $message }}" class="m-2" />
                    @enderror
                </div>
                <x-text-input wire:model="code" class="mt-4" type="text" placeholder="{{ __('Kode') }}" />
                <div wire:key="err-code">
                    @error('code')
                        <x-input-error messages="{{ $message }}" class="m-2" />
                    @enderror
                </div>
                <div x-data="{ is_active: @entangle('is_active') }" class="mt-4">
                    <x-toggle x-model="is_active" :checked="$is_active"><span
                            x-text="is_active ? '{{ __('Aktif') }}' : '{{ __('Nonaktif') }}'"></span></x-toggle>
                </div>
            </div>
            <div class="bg-white dark:bg-neutral-800 shadow rounded-lg p-4 mb-4">
                <div class="text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600 mb-4">
                    {{ __('Harga dan Satuan') }}</div>
                @if ($currs->count())
                    <x-select wire:model.live="inv_curr_id" class="mb-3">
                        <option value="">{{ __('Gunakan hanya') . ' ' . $curr_main->name }}</option>
                        @foreach ($currs as $curr)
                            <option wire:key="{{ 'curr' . $loop->index }}" value="{{ $curr->id }}">
                                {{ __('Dengan') . ' ' . $curr->name }}</option>
                        @endforeach
                    </x-select>
                @endif
                <div wire:key="prices">
                    @if ($curr_sec->name ?? false)
                        <x-text-input-curr wire:model.live="price" readonly id="price" min="0" step=".01"
                            curr="{{ $curr_main->name }}" type="number" placeholder="0" />
                    @else
                        <x-text-input-curr wire:model.live="price" id="price" min="0" step=".01"
                            curr="{{ $curr_main->name }}" type="number" placeholder="0" />
                    @endif
                    <div wire:key="err-price">
                        @error('price')
                            <x-input-error messages="{{ $message }}" class="m-2" />
                        @enderror
                    </div>
                    @if ($curr_sec->name ?? false)
                        <x-text-input-curr wire:model.live="price_sec" id="price-sec" min="0" step=".01"
                            class="mt-4" curr="{{ $curr_sec->name }}" type="number" placeholder="0" />
                        <div wire:key="err-price_sec">
                            @error('price_sec')
                                <x-input-error messages="{{ $message }}" class="m-2" />
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="grid grid-cols-2 gap-x-3 mt-4">
                    <div>
                        <label class="block mb-1 font-medium text-sm text-neutral-700 dark:text-neutral-300"
                            for="uom">
                            {{ __('UOM') }}
                        </label>
                        <x-text-input wire:model.live="uom" id="uom" type="text" list="quoms"></x-text-input>
                        <datalist wire:key="quoms" id="quoms">
                            @if (count($quoms))
                                @foreach ($quoms as $quom)
                                    <option wire:key="{{ 'uom' . $loop->index }}" value="{{ $quom }}">
                                @endforeach
                            @endif
                        </datalist>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-sm text-neutral-700 dark:text-neutral-300"
                            for="denom">
                            <span>{{ __('Denominasi') }}</span>
                            <x-text-button type="button" class="ms-1" x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'inv-denom')"><i
                                    class="far fa-question-circle"></i></x-text-button>
                        </label>
                        <x-text-input wire:model.live="denom" type="number" placeholder="1" id="denom"
                            min="1"></x-text-input>
                        <x-modal name="inv-denom">
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                                    {{ __('Denominasi') }}
                                </h2>
                                <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ __('Jika kamu ingin membagi harga utama menjadi satuan yang lebih kecil, isi denominasi sebagai pembagi.') }}
                                </p>
                                <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ __('Contoh: Harga utama USD 100 / PACK. Ada 20 EA setiap PACK, maka isi 20 di denominasi dan EA di UOM.') }}
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
                        @if ($up)
                            <div class="font-medium text-sm text-neutral-700 dark:text-neutral-300">
                                {{ __('Harga per') . ' ' . $uom }}
                            </div>
                            <div class="text-neutral-500">{{ $curr_main->name . ' ' . $up }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-neutral-800 shadow rounded-lg p-4 mb-4">
                <div class="text-medium text-sm uppercase  text-neutral-400 dark:text-neutral-600 mb-4">
                    {{ __('Lokasi dan Tag') }} — TT MM</div>
                <livewire:inv-item-loc isForm="true" :$loc :$inv_area_id />
                <div wire:key="err-loc">
                    @error('loc')
                        <x-input-error messages="{{ $message }}" class="m-2" />
                    @enderror
                </div>
                <div class="mx-3 mt-3">
                    <x-text-button type="button" class="flex items-center" x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'inv-item-tags')">
                        <i class="fa fa-fw fa-tag mr-2 text-neutral-400 dark:text-neutral-600"></i>
                        @if (count($tags))
                            <div>{{ implode(', ', $tags) }}</div>
                        @else
                            <div class="text-neutral-500">{{ __('Tak ada tag') }}</div>
                        @endif
                    </x-text-button>
                    <x-modal name="inv-item-tags">
                        <livewire:inv-item-tags isForm="true" :$tags :$inv_area_id lazy />
                    </x-modal>
                </div>
                <div wire:key="err-tags">
                    @if (count($errors->get('tags.*')))
                        <x-input-error messages="{{ current($errors->get('tags.*'))[0] }}" class="m-2" />
                    @endif
                </div>
            </div>
            <div class="bg-white dark:bg-neutral-800 shadow rounded-lg p-4 mb-4">
                <div class="text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600 mb-4">
                    {{ __('Batas qty utama') }}</div>
                <div class="grid grid-cols-2 gap-x-3">
                    <div>
                        <label class="block mb-1 font-medium text-sm text-neutral-700 dark:text-neutral-300"
                            for="qty_main_min">
                            {{ __('Qty minimum') }}
                        </label>
                        <x-text-input wire:model="qty_main_min" id="qty_main_min" type="number" placeholder="0" />
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-sm text-neutral-700 dark:text-neutral-300"
                            for="qty_main_max">
                            {{ __('Qty maksimum') }}
                        </label>
                        <x-text-input wire:model="qty_main_max" id="qty_main_max" type="number" placeholder="0" />
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
            </div>
            <input type="hidden" wire:model="photo" />
            <x-primary-button type="submit">{{ __('Simpan') }}</x-primary-button>
        </div>
    </form>
</div>
