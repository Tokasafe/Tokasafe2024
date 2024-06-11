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
    @if (isset($title))
        <title>{{ $title }}</title>
    @endif

    </script>

    <script>
        $(document).ready(function() {
            $("#preloader").fadeOut();
        })
    </script>
</head>
</head>

<body class="static antialiased">
        
    <div id="loader" >

        <div class="absolute inset-0  content-center flex  justify-center  z-50 w-full ">
            <img
                class=" w-40 p-8 bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500" src="{{ asset('loaders/bounce.svg') }}" alt="">
            </div>
    </div>

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
    <script> 
        document.onreadystatechange = function() { 
            if (document.readyState !== "complete") { 
                document.querySelector( 
                "body").style.visibility = "hidden"; 
                document.querySelector( 
                "#loader").style.visibility = "visible"; 
            } else { 
                document.querySelector( 
                "#loader").style.display = "none"; 
                document.querySelector( 
                "body").style.visibility = "visible"; 
            } 
        }; 
    </script>
</body>

</html>
