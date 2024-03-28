<div class="flex flex-col sticky top-0 z-30  drop-shadow-lg">
    <div class="navbar bg-gradient-to-r  from-slate-600 via-slate-400 to-slate-300  w-full">
        <div class="navbar-start">
            <div class="drawer">
                <div class="flex items-center">
                    <label for="my-drawer" class="btn btn-ghost btn-xs btn-primary drawer-button lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </label>
                    <div class="flex items-center">
                        <label tabindex="0" class="btn btn-ghost btn-sm btn-circle avatar">
                            <div class="w-16 rounded-full">
                                <img src="https://i.ibb.co/54S0vfx/logo.png" alt="logo" />
                            </div>
                        </label>
                        <h3 class="hidden text-sm font-extrabold text-amber-500 lg:block">Toka.</h3>
                        <p class="hidden text-sm font-semibold text-emerald-500 lg:block">Safe</p>
                    </div>
                </div>
                <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    <!-- Page content here -->
                </div>
                <div class="drawer-side z-30">
                    <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                    <ul class="menu m-0 w-80 min-h-full bg-gray-300 text-base-content ">
                        <!-- Sidebar content here -->
                        @auth
                            <div class="menu-title sticky top-0 mt-0 bg-gray-300 z-30 shadow-md">
                                <div class="flex flex-row">
                                    <h3 class=" text-sm font-extrabold text-amber-500 ">Toka.</h3>
                                    <p class=" text-sm font-semibold text-emerald-500 ">Safe</p>
                                </div>
                            </div>
                            <li><a
                                    href="{{ route('dashboardguest') }}"class="{{ Request::is('user/dashboard*') ? 'text-emerald-500 font-semibold' : '' }}">Dashboard</a>
                            </li>

                            <li>
                                <details {{ Request::is('user/eventReport*') ? 'open' : '' }}>
                                    <summary
                                        class="{{ Request::is('user/eventReport*') ? 'text-emerald-500 font-semibold' : '' }}">
                                        Event Report
                                    </summary>
                                    <ul class=" text-xs text-center menu menu-xs max-w-xs">
                                        <li>
                                            <a
                                                href="{{ route('hazardGuest') }}"class="{{ Request::is('user/eventReport/hazard_id*') ? ' active font-semibold ' : '' }}">{{ __('Hazard_Report') }}</a>
                                        </li>
                                    </ul>
                                </details>
                            </li>



                        @endauth

                    </ul>
                </div>

            </div>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal menu-xs">
                <!-- Navbar menu content here -->
                @auth

                    <li><a
                            href="{{ route('dashboardguest') }}"class="{{ Request::is('user/dashboard*') ? 'text-amber-200     font-semibold' : '' }}">Dashboard</a>
                    </li>

                    <li>
                        <details>
                            <summary class="{{ Request::is('user/eventReport*') ? 'text-amber-200 font-semibold' : '' }}">
                                Event Report
                            </summary>
                            <ul class=" text-xs text-center w-28 menu-xs max-w-xs">
                                <li>
                                    <a
                                        href="{{ route('hazardGuest') }}"class="{{ Request::is('user/eventReport/hazard_id*') ? ' active font-semibold ' : '' }}">{{ __('Hazard_Report') }}</a>
                                </li>
                            </ul>
                        </details>
                    </li>



                @endauth
        </div>
        <div class="navbar-end ">
            @if (Route::has('login'))
                @auth
                    @livewire('dasboard.notification.index')

                    <div class="dropdown dropdown-end">
                        {{-- <label tabindex="0" class="btn btn-ghost btn-md btn-circle avatar">
                <div class="w-8 rounded-full">
                    <img src="https://i.ibb.co/7YfvLQL/Login-user-name.png" alt="Login-user-name" alt="icon"
                        border="0" />
                </div>
            </label> --}}
                        <label tabindex="0" class="font-semibold text-emerald-600 btn btn-ghost btn-xs">
                            {{ Auth::user()->name }}</label>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-20 p-2 shadow bg-base-100 rounded-box w-52">


                            <li>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="route('logout')" class="  btn btn-sm btn-block"
                                        onclick="event.preventDefault();this.closest('form').submit();">Log Out</a>

                                </form>
                            </li>

                        </ul>
                    </div>
                    <div class="dropdown dropdown-end ">
                        <label tabindex="0" class="btn btn-ghost btn-sm btn-circle avatar">
                            <div class="w-6 rounded-full {{ app()->getLocale() == 'id' ? ' fi fi-id' : 'fi fi-gb' }}">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 m-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 21l5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 016-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 01-3.827-5.802" />
                    </svg> --}}



                            </div>
                        </label>

                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                {{ __('bahasa') }}
                            </li>
                            <li>
                                <a href="{{ url('locale/en') }}" class="justify-between font-semibold capitalize">
                                    <span class="badge fi fi-gb"></span>
                                    {{ __('english') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('locale/id') }}" class="justify-between font-semibold capitalize">
                                    <span class="badge fi fi-id"></span>
                                    {{ __('indonesia') }}
                                </a>
                            </li>


                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm text-gray-100 btn btn-xs btn-success dark:text-gray-500 ">Log in</a>

                    @if (Route::has('register'))
                        {{-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-100 dark:text-gray-500 btn btn-xs btn-info">Register</a> --}}
                    @endif

                @endauth

            @endif
        </div>
    </div>
    @if (isset($header))
        <header class=" text-white shadow bg-gradient-to-r from-amber-500 via-amber-300 to-amber-200 ">
            <div class=" flex justify-between px-4 items-center">
                <div class="font-bold ">
                    {{ $header }}

                </div>
                <div class="text-xs breadcrumbs text-black ">
                    @yield('bradcrumbs')
                </div>
            </div>
        </header>
    @endif
</div>
