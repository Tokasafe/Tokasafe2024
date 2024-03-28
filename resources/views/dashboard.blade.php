

<!doctype html>
<html class="scroll-smooth" data-theme="nord" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


    @stack('styles')
    <meta name="theme-color" content="#10b981" />
    <link rel="apple-touch-icon" href="{{ asset('icons.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.11.0/css/flag-icons.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="static antialiased">
    <div class="min-h-screen">
        <div class="drawer">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
            <div class="flex flex-col drawer-content">
                <!-- Navbar -->
                
                @include('navigation.guest.guestfile')
                <main>
                    <div class="pt-1 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        @yield('content')
                        @yield('contentUser')
                    </div>
                </main>
            </div>
            @include('navigation.sidebar')
        </div>
    </div>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
    @stack('scripts')
</body>

</html>
