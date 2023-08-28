<section class="space-y-6">
    <div class="text-center">
        <x-link
        href="#"
        class="text-red-500"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Hapus akun') }}</x-link>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('account.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Yakin ingin menghapus akunmu?') }}
            </h2>

            <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                {{ __('Setelah akunmu dihapus, informasi yang bertautan dengan akunmu akan tetap ada, namun nama yang terkandung akan ditampilkan sebagai "Akun yang dihapus" dan foto profil bawaan akan digunakan.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Kata sandi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Hapus akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
