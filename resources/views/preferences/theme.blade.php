<x-app-layout>
    <x-slot name="title">
        <title>{{__('Tema')}}</title>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-800 dark:text-neutral-200 leading-tight">
            <x-link href="{{ route('preferences') }}" class="inline-block py-6"><i class="fa fa-arrow-left"></i></x-link><span class="ml-4">{{ __('Tema') }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 space-y-6 text-neutral-900 dark:text-neutral-100">
            <ul>
                <li>Patuhi tema sistem</li>
                <li>Cerah</li>
                <li>Gelap</li>
            </ul>
            <ul>
                <li>Ungu nostalgia</li>
                <li>Pink mempesona</li>
                <li>Merah harga mati</li>
                <li>Biru bobotoh</li>
            </ul>         
        </div>
    </div>
</x-app-layout>