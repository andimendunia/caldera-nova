<section>
    <header>
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Informasi profil') }}
        </h2>

        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
            {{ __("Perbarui informasi profil dan nomor karyawanmu.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="cid" :value="__('Nomor Karyawan')" />
            <x-text-input id="cid" name="cid" type="text" class="mt-1 block w-full" :value="old('cid', $user->cid)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('cid')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Perbarui') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-neutral-600 dark:text-neutral-400"
                ><i class="fa fa-check-circle mr-1"></i>{{ __('Diperbarui') }}</p>
            @endif
        </div>
    </form>
</section>
