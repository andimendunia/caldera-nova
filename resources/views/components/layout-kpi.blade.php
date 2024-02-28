@props(['title', 'header', 'prev', 'nav', 'navs'])

<x-app-layout>
    <x-slot name="title">
        <title>{{ $title == __('Laporan KPI') ? $title : ($title.' — '.__('Laporan KPI')) }}</title>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-800 dark:text-neutral-200 leading-tight">
            @if($prev)
            <x-link href="{{ $prev }}" class="inline-block py-6"><i class="fa fa-arrow-left"></i></x-link><span class="ml-4">{{ $header }}</span>
            @else
            <div class="inline-block py-6">{{ $header }}</div>
            @endif
        </h2>
    </x-slot>
    @if($navs)
    <x-slot name="navs">
        <x-nav-link href="{{ route('kpi', [ 'nav' => 'overview' ])}}" :active="$nav == 'overview'">
            <i class="fa mx-2 fa-fw fa-table text-sm"></i>
        </x-nav-link>
        <x-nav-link href="{{ route('kpi', [ 'nav' => 'submission' ])}}" :active="$nav == 'submission'">
            <i class="fa mx-2 fa-fw fa-pen-to-square text-sm"></i>
        </x-nav-link>
        <x-nav-link href="{{ route('kpi', [ 'nav' => 'admin' ])}}" :active="$nav == 'admin'">
            <i class="fa mx-2 fa-fw fa-ellipsis-h text-sm"></i>
        </x-nav-link>
    </x-slot>
    @endif
    {{ $slot }}    
</x-app-layout>
