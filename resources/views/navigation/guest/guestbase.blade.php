<!doctype html>
<html class="scroll-smooth" data-theme="corporate" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @stack('styles')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.11.0/css/flag-icons.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    @laravelPWA
</head>
<body class="static antialiased">
    <div class="min-h-screen">
        <div class="drawer">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
            <div class="flex flex-col drawer-content">
                <!-- Navbar -->
                @include('navigation.navbar')
                <!-- Page content here -->
                <main>
                    <div class="pt-1 mx-auto max-w-8xl sm:px-6 lg:px-8">

                        @yield('contentUser')
                    </div>
                </main>
            </div>
            @include('navigation.guest.sidebarguest')
        </div>
    </div>
    @stack('scripts')
</body>
</html>
