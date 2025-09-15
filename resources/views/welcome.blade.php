<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Library System</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('image/logo.jpg') }}">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-text min-h-screen flex flex-col">
  <div class="w-full px-6 max-w-7xl mx-auto">

    <header x-data="{ open: false }" class="py-6">
      <div class="flex justify-between items-center">
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
          <img src="{{ asset('image/logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full">
          <span class="font-semibold text-lg">Library System</span>
        </a>
        <button @click="open = !open" class="sm:hidden text-text focus:outline-none">
          <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        @if (Route::has('login'))
          <nav class="hidden sm:flex gap-3">
            @auth
              <a href="{{ url('/dashboard') }}" class="rounded bg-secondary border border-primary text-text px-4 py-2 font-semibold hover:bg-accent/80 transition">
                Dashboard
              </a>
            @else
              <a href="{{ route('login') }}" class="rounded-md bg-secondary border border-primary text-text px-4 py-2 font-semibold hover:bg-accent/80 transition">
                Log in
              </a>
            @endauth
          </nav>
        @endif
      </div>

      @if (Route::has('login'))
        <nav x-show="open" x-transition class="sm:hidden mt-4 flex flex-col gap-3">
          @auth
            <a href="{{ url('/dashboard') }}" class="rounded bg-secondary text-text px-4 py-2 font-semibold hover:bg-accent/80 transition w-full text-center">
              Dashboard
            </a>
          @else
            <a href="{{ route('login') }}" class="rounded-md bg-secondary text-text px-4 py-2 font-semibold hover:bg-accent/80 transition w-full text-center">
              Log in
            </a>
          @endauth
        </nav>
      @endif
    </header>

    <main class="mt-10">
      <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-10">
        <div class="space-y-6 text-center md:text-left">
          <h1 class="text-3xl md:text-4xl font-bold leading-tight">
            “A reader lives a thousand lives before he dies. The man who never reads lives only one.”
          </h1>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-block rounded-md bg-primary text-white px-6 py-3 font-semibold hover:bg-accent/80 transition">
              Get Started
            </a>
          @endif
        </div>
        <div class="flex justify-center">
          <img src="{{ asset('image/model.svg') }}" alt="Library Image" class="max-w-full h-auto">
        </div>
      </div>
    </main>

  </div>
</body>
</html>
