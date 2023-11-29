<div>
    @if (!$isValid)
        <div class="bg-white dark:bg-neutral-800 shadow p-6 sm:rounded-lg mb-6">
            <fieldset class="grid grid-cols-3 gap-2 md:grid-cols-6 sm:gap-4">
                <div>
                    <input type="radio" name="prop" id="prop-name" class="peer hidden [&:checked_+_label_svg]:block"
                        value="name" />
                    <label for="prop-name"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 px-4 py-2 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                        <div class="flex items-center justify-between text-2xl">
                            <p><i class="text-neutral-500 fa fa-cube"></i></p>
                            <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="mt-1">{{ __('Nama') }}</p>
                    </label>
                </div>
                <div>
                    <input type="radio" name="prop" id="prop-status"
                        class="peer hidden [&:checked_+_label_svg]:block" value="status" />
                    <label for="prop-status"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 px-4 py-2 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                        <div class="flex items-center justify-between text-2xl">
                            <p><i class="text-neutral-500 fa fa-toggle-on"></i></p>
                            <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="mt-1">{{ __('Status') }}</p>
                    </label>
                </div>
                <div>
                    <input type="radio" name="prop" id="prop-price" value="price" class="peer hidden [&:checked_+_label_svg]:block" />
                    <label for="prop-price"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 px-4 py-2 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                        <div class="flex items-center justify-between text-2xl">
                            <p><i class="text-neutral-500 fa fa-coins"></i></p>
                            <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="mt-1">{{ __('Harga') }}</p>
                    </label>
                </div>
                <div>
                    <input type="radio" name="prop" id="prop-loc" value="loc" class="peer hidden [&:checked_+_label_svg]:block" />
                    <label for="prop-loc"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 px-4 py-2 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                        <div class="flex items-center justify-between text-2xl">
                            <p><i class="text-neutral-500 fa fa-map-marker-alt"></i></p>
                            <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="mt-1">{{ __('Lokasi') }}</p>
                    </label>
                </div>
                <div>
                    <input type="radio" name="prop" id="prop-tag" value="tag" class="peer hidden [&:checked_+_label_svg]:block" />
                    <label for="prop-tag"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 px-4 py-2 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                        <div class="flex items-center justify-between text-2xl">
                            <p><i class="text-neutral-500 fa fa-tag"></i></p>
                            <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="mt-1">{{ __('Tag') }}</p>
                    </label>
                </div>
                <div>
                    <input type="radio" name="prop" id="prop-qty-limit" value="qty-limit" class="peer hidden [&:checked_+_label_svg]:block" />
                    <label for="prop-qty-limit"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 px-4 py-2 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                        <div class="flex items-center justify-between text-2xl">
                            <p><i class="text-neutral-500 fa fa-compress-alt"></i></p>
                            <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="mt-1">{{ __('Batas qty') }}</p>
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="flex">
            <div class="max-w-sm px-3 sm:px-0 mb-10 mx-auto">
                <div class="flex flex-col gap-6 text-sm mx-auto text-center text-neutral-600 dark:text-neutral-400">
                    <div class="text-center text-neutral-500 py-8 text-4xl"><i class="fa fa-upload"></i></div>
                    <x-secondary-button x-on:click="$refs.file.click()"
                        class="w-full mb-3">{{ __('Pilih file') }}</x-secondary-button>
                    <input x-ref="file" wire:model="file" type="file" accept=".csv" class="hidden" />
                    <div>
                        <div>{{ __('Format CSV, ukuran maksimum 1 MB') }}</div>
                        <div class="mt-2"><x-text-button wire:click="download"><i
                                    class="fa fa-download mr-2"></i>{{ __('Unduh templat') }}</x-text-button></div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif
</div>
