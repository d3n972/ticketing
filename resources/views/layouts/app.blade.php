<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        @if(env('APP_DEBUG'))
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        @else
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @endif
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        @stack('scripts')
    </head>
    <body class="font-sans antialiased min-h-screen bg-gray-900 text-white">
        <x-jet-banner />

        <div class="">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <div class="border-gray-400 border-t-2 p-5 m-3">
            <div class="grid grid-cols-3 grid-flow-row justify-items-center">
                <div class="grid grid-rows-2 grid-flow-col">
                    <div>{{env('APP_NAME')}}</div>
                    <p>{{env('APP_URL')}}</p>
                </div>
                <div>asd</div>
                <div>asd</div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('endscripts')
        @livewire('livewire-ui-modal')
    </body>
</html>
