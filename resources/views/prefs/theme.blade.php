<x-app-layout>
    <x-slot name="title">
        <title>{{ __('Tema') }}</title>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-800 dark:text-neutral-200 leading-tight">
            <x-link href="{{ route('prefs') }}" class="inline-block py-6"><i
                    class="fa fa-arrow-left"></i></x-link><span class="ml-4">{{ __('Tema') }}</span>
        </h2>
    </x-slot>

    <form method="post" action="{{ route('prefs.update.theme') }}" class="py-12">
        @csrf  
        @method('patch')   
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6 text-sm text-neutral-900 dark:text-neutral-100">
            <div class="bg-white dark:bg-neutral-800 shadow p-6 sm:rounded-lg mb-6">
                <h2 class="text-lg font-medium mb-3">
                    {{ __('Latar') }}
                </h2>
                <fieldset class="grid grid-cols-2 gap-2 sm:grid-cols-3 sm:gap-4">
                    <div>
                        <input type="radio" name="bg" id="bg-auto"
                            class="peer hidden [&:checked_+_label_svg]:block" value="auto" @if($bg == 'auto') checked @endif />
                        <label for="bg-auto"
                            class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="bg" id="bg-light"
                            class="peer hidden [&:checked_+_label_svg]:block" value="light" @if($bg == 'light') checked @endif />
                        <label for="bg-light"
                            class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="bg" id="bg-dark" value="dark" @if($bg == 'dark') checked @endif
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="bg-dark"
                            class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="accent" value="purple" @if($accent == 'purple') checked @endif id="accent-purple"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="accent-purple"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="accent" value="green" @if($accent == 'green') checked @endif id="accent-green"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="accent-green"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="accent" value="pink" @if($accent == 'pink') checked @endif id="accent-pink"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="accent-pink"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="accent" value="blue" @if($accent == 'blue') checked @endif id="accent-blue"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="accent-blue"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="accent" value="teal" @if($accent == 'teal') checked @endif id="accent-teal"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="accent-teal"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="accent" value="orange" @if($accent == 'orange') checked @endif id="accent-orange"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="accent-orange"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="accent" value="grey" @if($accent == 'grey') checked @endif id="accent-grey"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="accent-grey"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="accent" value="brown" @if($accent == 'brown') checked @endif id="accent-brown"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="accent-brown"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
                        <input type="radio" name="accent" value="yellow" @if($accent == 'yellow') checked @endif id="accent-yellow"
                            class="peer hidden [&:checked_+_label_svg]:block" />
                        <label for="accent-yellow"
                        class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
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
    </form>
    @if (session('status') === 'updated')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            notyf.success('{{ __('Tema diperbarui') }}');
        });
    </script>
    @endif
</x-app-layout>
