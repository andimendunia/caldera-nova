<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('account.update') }}" class="space-y-6">
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        @csrf
        @method('patch')
        <div>
            <x-input-label for="emp_id" :value="__('Nomor Karyawan')" />
            <x-text-input id="emp_id" name="emp_id" type="text" class="mt-1 block w-full" :value="old('emp_id', $user->emp_id)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('emp_id')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Perbarui') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    notyf.success('Profil diperbarui');
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
    </form>
</section>
