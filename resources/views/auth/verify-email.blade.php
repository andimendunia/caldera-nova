<x-guest-layout>
    <div class="mb-4 text-sm text-neutral-600 dark:text-neutral-400">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah kamu memverifikasi alamat emailmu dengan mengeklik tautan yang baru saja Caldera kirim melalui email? Jika kamu tidak menerima email, kami dengan senang hati akan mengirimkan lagi.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang kamu berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Kirim ulang email verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-caldy-500 dark:focus:ring-offset-neutral-800">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>
