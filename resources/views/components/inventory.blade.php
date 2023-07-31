@props(['title', 'header', 'prev', 'nav'])

<x-app-layout>
    <x-slot name="title">
        <title>{{$title.' — '.__('Inventaris')}}</title>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if($prev)
            <x-link href="{{ $prev }}" class="inline-block py-6"><i class="fa fa-arrow-left"></i>{{ $header }}</x-link>
            @else
            <div class="inline-block py-6">{{ $header }}</div>
            @endif
        </h2>
    </x-slot>

    <x-slot name="navs">
        <x-nav-link href="{{ route('inventory', [ 'nav' => 'search'])}}" :active="$nav == 'search'">
            <i class="fa mx-2 fa-fw fa-search"></i>
        </x-nav-link>
        <x-nav-link href="{{ route('inventory', [ 'nav' => 'circs'])}}" :active="$nav == 'circs'">
            <i class="fa mx-2 fa-fw fa-arrow-right-arrow-left"></i>
        </x-nav-link>
        <x-nav-link href="{{ route('inventory', [ 'nav' => 'admin' ])}}" :active="$nav == 'admin'">
            <i class="fa mx-2 fa-fw fa-ellipsis"></i>
        </x-nav-link>
    </x-slot>

    {{ $slot }}
    
</x-app-layout>
