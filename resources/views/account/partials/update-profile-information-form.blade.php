<section>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('account.update') }}">
        <div class="flex justify-center" x-data="{ photo: '{{ $user->photo }}'}" x-on:photo-updated="photo = $event.detail[0]">
        <livewire:user-photo :url="$user->photo ? '/storage/users/'.$user->photo : ''" />
            <input type="hidden" name="photo" x-model="photo" />
        </div>
        <div class="p-4 sm:p-6 bg-white dark:bg-neutral-800 shadow sm:rounded-lg">
            <div class="mb-6">
                <x-input-label for="name" :value="__('Nama')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
    
            @csrf
            @method('patch')
            <div>
                <x-input-label for="emp_id" :value="__('Nomor Karyawan')" />
                <div class="mt-2 text-neutral-700 dark:text-neutral-300">{{ $user->emp_id }}</div>
            </div>
            <div class="flex justify-end">
                <x-primary-button>{{ __('Perbarui') }}</x-primary-button>
            </div>
        </div>
    </form>
</section>
