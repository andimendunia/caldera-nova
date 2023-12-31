<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form id="cal-form" method="POST" action="{{ route('login') }}" class="relative">
        @csrf
        <input type="hidden" id="bgm" name="bgm" />

        <!-- Email Address -->
        <div>
            <x-input-label for="emp_id" :value="__('Nomor karyawan')" />
            <x-text-input id="emp_id" class="block mt-1 w-full" type="text" name="emp_id" :value="old('emp_id')" required autofocus autocomplete="emp_id" />
            <x-input-error :messages="$errors->get('emp_id')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata sandi')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-neutral-900 border-neutral-300 dark:border-neutral-700 text-caldy-600 shadow-sm focus:ring-caldy-500 dark:focus:ring-caldy-600 dark:focus:ring-offset-neutral-800" name="remember">
                <span class="ml-2 text-sm text-neutral-600 dark:text-neutral-400">{{ __('Ingat aku') }}</span>
            </label>
        </div> --}}

        <div class="flex items-center justify-between mt-4">
            <div>
                <a class="underline text-sm text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caldy-500 dark:focus:ring-offset-neutral-800" href="{{ route('register') }}">
                    {{ __('Daftar') }}</a>
                @if (Route::has('password.request'))
                    <span class="mx-1 text-neutral-600 dark:text-neutral-400">•</span>
                    <a class="underline text-sm text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caldy-500 dark:focus:ring-offset-neutral-800" href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi') }}</a>
                @endif

            </div>

            <x-primary-button class="ml-3">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
        <div id="cal-spinner" class="hidden w-full h-full absolute top-0 left-0 bg-white/70 dark:bg-neutral-800/70">
            <x-spinner />
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                function spin() {
                    const focEl = document.activeElement;
                    const spinner = document.getElementById('cal-spinner');

                    focEl.blur();
                    spinner.classList.remove('hidden');
                }
                const form = document.getElementById('cal-form');
                form.addEventListener('submit', spin);

                const bgm = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                document.getElementById('bgm').value = bgm;
            });
        </script>
    </form>

</x-guest-layout>
