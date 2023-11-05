<x-app-layout>
    <x-slot name="title">
        <title>{{ __('Tema') }}</title>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-800 dark:text-neutral-200 leading-tight">
            <x-link href="{{ route('preferences') }}" class="inline-block py-6"><i
                    class="fa fa-arrow-left"></i></x-link><span class="ml-4">{{ __('Tema') }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6 text-sm text-neutral-900 dark:text-neutral-100">
            <div class="bg-white dark:bg-neutral-800 shadow p-6 sm:rounded-lg mb-6">
                <h2 class="text-lg font-medium mb-3">
                    {{ __('Latar') }}
                </h2>
                <fieldset class="grid grid-cols-2 gap-2 sm:grid-cols-3 sm:gap-4">
                    <div>
                        <input type="radio" name="theme-bg" id="theme-bg-auto"
                            class="peer hidden [&:checked_+_label_svg]:block" checked />
                        <label for="theme-bg-auto"
                            class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <p><i class="text-neutral-500 fa fa-circle-half-stroke"></i></p>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Patuhi sistem') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-bg" id="theme-bg-light"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-bg-light"
                            class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <p><i class="text-neutral-500 fa fa-sun"></i></p>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Cerah') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-bg" id="theme-bg-dark"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-bg-dark"
                            class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <p><i class="text-neutral-500 fa fa-moon"></i></p>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Gelap') }}</p>
                        </label>
                    </div>
                </fieldset>
            </div>
            <div class="bg-white dark:bg-neutral-800 shadow p-6 sm:rounded-lg mb-6">
                <h2 class="text-lg font-medium mb-3">
                    {{ __('Aksen') }}
                </h2>
                <fieldset class="grid grid-cols-2 gap-2 sm:grid-cols-3 sm:gap-4">
                    <div>
                        <input type="radio" name="theme-color" id="theme-color-caldy"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-color-caldy"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <div style="color: rgb(127, 99, 204);" class="flex gap-1"><i  class="fa fa-square"></i></div>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Ungu Caldera') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-color" id="theme-color-01"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-color-01"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <div style="color: rgb(90, 160, 85);" class="flex gap-1"><i  class="fa fa-square"></i></div>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Hijau alam') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-color" id="theme-color-02"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-color-02"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <div style="color: rgb(255, 105, 134);" class="flex gap-1"><i  class="fa fa-square"></i></div>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Pink lembut') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-color" id="theme-color-03"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-color-03"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <div style="color: rgb(59, 138, 208);" class="flex gap-1"><i  class="fa fa-square"></i></div>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Biru damai') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-color" id="theme-color-05"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-color-05"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <div style="color: rgb(22, 146, 146);" class="flex gap-1"><i  class="fa fa-square"></i></div>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Hijau tenang') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-color" id="theme-color-06"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-color-06"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <div style="color: rgb(255, 121, 16);" class="flex gap-1"><i  class="fa fa-square"></i></div>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Jingga sore') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-color" id="theme-color-07"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-color-07"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <div style="color: rgb(122, 122, 122);" class="flex gap-1"><i  class="fa fa-square"></i></div>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Abu suram') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-color" id="theme-color-08"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-color-08"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <div style="color: rgb(181, 99, 0);" class="flex gap-1"><i  class="fa fa-square"></i></div>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Cokelat pekat') }}</p>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="theme-color" id="theme-color-09"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="theme-color-09"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                            <div class="flex items-center justify-between text-2xl">
                                <div style="color: rgb(255, 193, 36);" class="flex gap-1"><i  class="fa fa-square"></i></div>
                                <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-1">{{ __('Kuning ceria') }}</p>
                        </label>
                    </div>
                </fieldset>
            </div> 
            <div class="flex justify-between mx-3 sm:mx-0">
                <div><i class="fa fa-info-circle mr-2"></i>{{__('Terapkan untuk melihat perubahan')}}</div>
                <x-primary-button>{{ __('Terapkan') }}</x-primary-button>
            </div>
        </div>
    </div>
</x-app-layout>
