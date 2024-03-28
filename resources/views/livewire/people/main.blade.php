<!doctype html>
<html data-theme="winter" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
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
                    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="flex justify-center tabs">
                            <a
                                href="{{ route('people') }}"class="{{ Request::is('InControl/people') ? 'tab-active font-semibold text-green-500 ' : '' }}tab tab-lifted tab-sm">Personal
                                Details</a>
                            <a class="tab tab-lifted tab-sm">Roles</a>
                            <a class="tab tab-lifted tab-sm">Tab 3</a>
                        </div>
                        @yield('people')
                    </div>

                </main>

            </div>
            @include('navigation.sidebar')
        </div>
        @stack('scripts')
    </div>
</body>

</html>
