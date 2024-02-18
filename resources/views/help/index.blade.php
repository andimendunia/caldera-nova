<x-app-layout>
    <x-slot name="title">
        <title>{{ __('Bantuan') }}</title>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-800 dark:text-neutral-200 leading-tight">
            <div class="inline-block py-6">{{ __('Bantuan') }}</div>
        </h2>
    </x-slot>
    <div id="content" class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
        <div class="bg-white dark:bg-neutral-800 shadow rounded-lg p-4 mb-4">
            <div class="text-medium text-sm uppercase text-neutral-400 dark:text-neutral-600 mb-4">
                {{ __('Kontak dukungan') }}</div>
            <h1 class="text-2xl mb-3 text-neutral-900 dark:text-neutral-100">Imam Pratama Setiady</h1>
            <p class="mb-4">MM — Digital Team</p>
            <hr class="border-neutral-300 dark:border-neutral-600 mb-8 sm:mb-4" />
            <div class="grid gap-2">
                <div><i class="fa fa-phone fa-fw me-3"></i>0821-2133-3614</div>
                <div><i class="fa fa-envelope fa-fw me-3"></i>imam.pratama@taekwang.com</div>
            </div>
        </div>

    </div>


</x-app-layout>
