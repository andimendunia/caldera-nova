<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col items-center text-neutral-600 dark:text-neutral-400">
                <div class="w-24 h-24 mb-4 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                    @if(Auth::user()->photo)
                        <img class="w-full h-full object-cover dark:brightness-80" src="/storage/users/{{ Auth::user()->photo }}" />
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                    @endif
                </div>
                <div class="text-xl">{{ Auth::user()->name }}</div>
                <div class="text-sm">{{ Auth::user()->emp_id }}</div>
            </div>
            <div class="grid grid-cols-1 gap-3 my-8">
                <x-card-link href="{{ route('account.edit')}}">
                    <div class="flex">
                        <div>
                            <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                                <div class="m-auto"><i class="fa fa-circle-user"></i></div>
                            </div>
                        </div>
                        <div class="grow truncate py-2 sm:py-4">
                            <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                                {{__('Akun')}}
                            </div>                        
                            <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                                {{__('Ubah nama atau foto akun')}}
                            </div>
                        </div>
                    </div>
                </x-card-link>
                <x-card-button type="button" x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'change-password')">
                    <div class="flex">
                        <div>
                            <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                                <div class="m-auto"><i class="fa fa-key"></i></div>
                            </div>
                        </div>
                        <div class="grow text-left truncate py-2 sm:py-4">
                            <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                                {{__('Kata sandi')}}
                            </div>                        
                            <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                                {{__('Perbarui kata sandi')}}
                            </div>
                        </div>
                    </div>
                </x-card-button>
                <x-modal name="change-password" focusable :show="$errors->updatePassword->isNotEmpty()">
                    <div class="p-6">
                        @include('account.partials.update-password-form')
                    </div>
                </x-modal>
                <x-card-button type="button" x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'change-language')">
                    <div class="flex">
                        <div>
                            <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                                <div class="m-auto"><i class="fa fa-language"></i></div>
                            </div>
                        </div>
                        <div class="grow text-left truncate py-2 sm:py-4">
                            <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                                {{__('Bahasa')}}
                            </div>                        
                            <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                                {{__('Bahasa Indonesia')}}
                            </div>
                        </div>
                    </div>
                </x-card-button>
                <x-modal name="change-language">
                    <form method="post" action="#" class="text-neutral-900 dark:text-neutral-100 p-6">
                        @csrf        
                        <h2 class="text-lg font-medium ">
                            {{ __('Bahasa') }}
                        </h2>             
                        <div class="mt-6">
                            <x-radio id="lang-id" name="lang">Bahasa Indonesia</x-radio>
                            <x-radio id="lang-en" name="lang">English (US)</x-radio>
                        </div>        
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Batal') }}
                            </x-secondary-button>
            
                            <x-primary-button class="ml-3">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-modal>
                <x-card-link href="{{ route('preferences', ['nav' => 'theme']) }}">
                    <div class="flex">
                        <div>
                            <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                                <div class="m-auto"><i class="fa fa-brush"></i></div>
                            </div>
                        </div>
                        <div class="grow truncate py-2 sm:py-4">
                            <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                                {{__('Tema')}}
                            </div>                        
                            <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                                {{__('Patuhi sistem + Ungu Caldera')}}
                            </div>
                        </div>
                    </div>
                </x-card-link>
            </div>
        </div>
        @if (session('status') === 'account-updated')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                notyf.success('Akun diperbarui');
            });
        </script>
            {{-- <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-neutral-600 dark:text-neutral-400"
            ><i class="fa fa-check-circle mr-1"></i>{{ __('Diperbarui') }}</p> --}}
        @endif
    </div>   
</x-app-layout>