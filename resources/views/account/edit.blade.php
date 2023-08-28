<x-app-layout>
    <x-slot name="title">
        <title>{{__('Akun')}}</title>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-800 dark:text-neutral-200 leading-tight">
            <x-link href="{{ route('preferences') }}" class="inline-block py-6"><i class="fa fa-arrow-left"></i></x-link><span class="ml-4">{{ __('Akun') }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-neutral-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('account.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-neutral-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('account.partials.update-password-form')
                </div>
            </div>

            @include('account.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>