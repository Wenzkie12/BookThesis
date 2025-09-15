<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Library') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/logo.jpg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    x-data="{ open: false }"
    :class="{ 'overflow-hidden': open }"
    class="bg-background text-text overflow-y-auto"
>
    <div class="min-h-screen p-4 relative flex flex-col gap-4">
        @isset($header)
            <header 
                class="bg-background shadow rounded-xl px-4 py-2 flex items-center justify-between text-sm sticky top-0 z-50"
            >
          
                <div class="flex items-center gap-2">
                    <a href="/dashboard">
                        <x-application-logo class="w-8 h-8 fill-current text-gray-500" />
                    </a>
                    <span class="text-base font-semibold">Library System</span>
                </div>

                
                <div class="hidden md:flex items-center space-x-6">
                    @include('layouts.links')
                </div>

               
                <div class="md:hidden">
                    <button @click="open = !open" class="focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path :class="{ 'hidden': open, 'block': !open }" class="block" d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{ 'hidden': !open, 'block': open }" class="hidden" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

           
                <div 
                    x-show="open" 
                    x-cloak 
                    class="fixed inset-0 top-[4.5rem] bg-background z-40 p-6 overflow-y-auto md:hidden"
                >
                    <div class="flex flex-col space-y-4">
                        @include('layouts.links')
                    </div>
                </div>
            </header>
        @endisset

      
        <main class="flex-1 bg-background rounded-xl p-6 shadow z-0">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
