<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if (isset($title))
            {{ $title }}
        @else
            <title>{{ config('app.name', 'Laravel') }}</title>
        @endif        

        <!-- Fonts -->
        {{-- <link href="/storage/fonts/figtree.css" rel="stylesheet" /> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div id="pgbar" class="fixed w-full overflow-hidden progress-bar indeterminate hidden">
            <div class="short-bar bg-caldy-400"></div>
            <div class="long-bar bg-caldy-400"></div>
        </div>
        <div class="min-h-screen bg-neutral-100 dark:bg-neutral-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
            <header class="bg-white dark:bg-neutral-800 shadow">
                <div class="flex justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div>
                        {{ $header }}
                    </div>                    
                    @if (isset($navs))
                        <div class="space-x-8 -my-px ml-10 flex">
                            {{ $navs }}
                        </div>
                    @endif
                </div> 
            </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
