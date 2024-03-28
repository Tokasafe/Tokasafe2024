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
                            @if (auth()->user()->role_users_id == 1)
                                <li>
                                    <a
                                        href="{{ route('dashboard') }}"class="{{ Request::is('dashboard*') ? 'text-emerald-500 font-semibold' : '' }}">Dashboard</a>
                                </li>

                                <li>
                                    <details {{ Request::is('eventReport*') ? 'open' : '' }}>
                                        <summary
                                            class="{{ Request::is('eventReport*') ? 'text-emerald-500 font-semibold' : '' }}">
                                            Event Report
                                        </summary>
                                        <ul class=" text-xs text-center menu menu-xs max-w-xs">
                                            <li>
                                                <a
                                                    href="{{ route('hazard') }}"class="{{ Request::is('eventReport/hazard_id*') ? ' active font-semibold ' : '' }}">{{ __('Hazard_Report') }}</a>
                                            </li>
                                        </ul>
                                    </details>
                                </li>
                                <li>
                                    <details {{ Request::is('manhours*') ? 'open' : '' }}>
                                        <summary
                                            class="{{ Request::is('manhours*') ? 'text-emerald-500 font-semibold' : '' }}">
                                            Manhours
                                        </summary>
                                        <ul class=" text-xs text-center menu menu-xs max-w-xs">
                                            <li>
                                                <a
                                                    href="{{ route('manhoursRegister') }}"class="{{ Request::is('manhours/manhoursRegister*') ? ' active font-semibold ' : '' }}">{{ __('Register') }}</a>
                                            </li>
                                        </ul>
                                    </details>
                                </li>

                                <li>
                                    <details {{ Request::is('InControl*') ? 'open' : '' }}>
                                        <summary
                                            class="{{ Request::is('InControl*') ? 'text-emerald-500 font-semibold' : '' }}">
                                            Administrator
                                        </summary>
                                        <ul class=" text-xs text-center opacity-100 bg-gray-300 menu  menu-xs p-2">
                                            <li><a
                                                    href="{{ route('people') }}"class="{{ Request::is('InControl/people') ? 'active font-semibold' : '' }}">{{ __('People') }}</a>
                                            </li>
                                            <li><a
                                                    href="{{ route('securityUser') }}"class="{{ Request::is('InControl/securityUser') ? 'active font-semibold' : '' }}">{{ __('security_user') }}</a>
                                            </li>
                                            <li><a
                                                    href="{{ route('categoryCompany') }}"class="{{ Request::is('InControl/categorycompany') ? 'active font-semibold' : '' }}">{{ __('Category_Company') }}</a>
                                            </li>

                                            <li>
                                                <a
                                                    href="{{ route('company') }}"class="{{ Request::is('InControl/company') ? 'active font-semibold' : '' }}">{{ __('Company') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('department') }}"class="{{ Request::is('InControl/department') ? 'active font-semibold' : '' }}">{{ __('department') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('deptGroup') }}"class="{{ Request::is('InControl/deptGroup') ? 'active font-semibold' : '' }}">{{ __('group') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('companyLevel') }}"class="{{ Request::is('InControl/companyLevel') ? 'active font-semibold' : '' }}">{{ __('level') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('roster') }}"class="{{ Request::is('InControl/roster') ? 'active font-semibold' : '' }}">{{ __('Roster') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('responsibleRole') }}"class="{{ Request::is('InControl/responsibleRole') ? 'active font-semibold' : '' }}">{{ __('responsible_role') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('statusCode') }}"class="{{ Request::is('InControl/statusCode') ? 'active font-semibold' : '' }}">{{ __('status_code') }}</a>
                                            </li>

                                            <li>
                                                <details {{ Request::is('InControl/rolePosition*') ? 'open' : '' }}>
                                                    <summary
                                                        class="{{ Request::is('InControl/rolePosition*') ? 'text-amber-500 font-semibold' : '' }}">
                                                        {{ __('Role Position') }}</summary>
                                                    <ul class="">
                                                        <li>
                                                            <a
                                                                href="{{ route('roleClass') }}"class="{{ Request::is('InControl/rolePositionClass') ? 'active font-semibold' : '' }}">{{ __('role_class') }}</a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                href="{{ route('rolePosition') }}"class="{{ Request::is('InControl/rolePosition') ? 'active font-semibold' : '' }}">{{ __('Roles') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </details>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('workgroup') }}"class="{{ Request::is('InControl/workgroup') ? 'active font-semibold' : '' }}">{{ __('Workgroup') }}</a>
                                            </li>
                                            <li>
                                                <details {{ Request::is('InControl/event*') ? 'open' : '' }}>
                                                    <summary
                                                        class="{{ Request::is('InControl/event*') ? 'text-emerald-500 font-semibold' : '' }}">
                                                        {{ __('event') }}</summary>
                                                    <ul class="z-10 bg-gray-300">
                                                        <li>
                                                            <a
                                                                href="{{ route('eventLocation') }}"class="{{ Request::is('InControl/eventLocation') ? 'active font-semibold' : '' }}">{{ __('el') }}</a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                href="{{ route('eventSite') }}"class="{{ Request::is('InControl/eventSite') ? 'active font-semibold' : '' }}">{{ __('es') }}</a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                href="{{ route('eventCategory') }}"class="{{ Request::is('InControl/eventCategory') ? 'active font-semibold' : '' }}">{{ __('ec') }}</a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                href="{{ route('eventType') }}"class="{{ Request::is('InControl/eventType') ? 'active font-semibold' : '' }}">{{ __('et') }}</a>

                                                        </li>
                                                        <li>
                                                            <a
                                                                href="{{ route('eventSubType') }}"class="{{ Request::is('InControl/eventSubType') ? 'active font-semibold' : '' }}">{{ __('est') }}</a>

                                                        </li>
                                                    </ul>
                                                </details>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('port') }}"class="{{ Request::is('InControl/port') ? 'active font-semibold' : '' }}">Port</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('riskConsequence') }}"class="{{ Request::is('InControl/riskConsequence') ? 'active font-semibold' : '' }}">{{ __('rc') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('riskLikelihood') }}"class="{{ Request::is('InControl/riskLikelihood') ? 'active font-semibold' : '' }}">{{ __('rl') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('riskAssessment') }}"class="{{ Request::is('InControl/riskAssessment') ? 'active font-semibold' : '' }}">{{ __('ra') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('workflowstep') }}"class="{{ Request::is('InControl/workflowstep') ? 'active font-semibold' : '' }}">{{ __('ws') }}</a>
                                            </li>

                                            <li>
                                                <a
                                                    href="{{ route('accessRiskAssessment') }}"class="{{ Request::is('InControl/accessRiskAssessment') ? 'active font-semibold' : '' }}">{{ __('ara') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('AdminControlCompanyManhours') }}"class="{{ Request::is('InControl/AdminControlCompanyManhours') ? 'active font-semibold' : '' }}">{{ __('Control Company Manhours') }}</a>
                                            </li>
                                        </ul>
                                    </details>
                                </li>
                            @else
                                <li> <a
                                        href="{{ route('dashboard') }}"class="{{ Request::is('dashboard*') ? 'text-emerald-500 font-semibold' : '' }}">Dashboard</a>
                                </li>
                                <li>
                                    <details {{ Request::is('eventReport*') ? 'open' : '' }}>
                                        <summary
                                            class="{{ Request::is('eventReport*') ? 'text-emerald-500 font-semibold' : '' }}">
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

                                <li>
                                    <details {{ Request::is('user/manhours*') ? 'open' : '' }}>
                                        <summary
                                            class="{{ Request::is('user/manhours*') ? 'text-emerald-500 font-semibold' : '' }}">
                                            Manhours
                                        </summary>
                                        <ul class=" text-xs text-center menu menu-xs max-w-xs">
                                            <li>
                                                <a
                                                    href="{{ route('ManhoursGuest') }}"class="{{ Request::is('user/manhours/manhoursRegister*') ? ' active font-semibold ' : '' }}">{{ __(' Manhours') }}</a>
                                            </li>
                                        </ul>
                                    </details>
                                </li>
                            @endif

                        @endauth

                    </ul>
                </div>

            </div>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal menu-xs">
                <!-- Navbar menu content here -->
                @auth
                    @if (auth()->user()->role_users_id == 1)
                        <li><a
                                href="{{ route('dashboard') }}"class="{{ Request::is('dashboard*') ? 'text-amber-200     font-semibold' : '' }}">Dashboard</a>
                        </li>

                        <li>
                            <details>
                                <summary class="{{ Request::is('eventReport*') ? 'text-amber-200 font-semibold' : '' }}">
                                    Event Report
                                </summary>
                                <ul class=" text-xs text-center w-28 menu-xs max-w-xs">
                                    <li>
                                        <a
                                            href="{{ route('hazard') }}"class="{{ Request::is('eventReport/hazard_id*') ? ' active font-semibold ' : '' }}">{{ __('Hazard_Report') }}</a>
                                    </li>
                                </ul>
                            </details>
                        </li>
                        <li>
                            <details>
                                <summary class="{{ Request::is('manhours*') ? 'text-amber-200 font-semibold' : '' }}">
                                    Manhours
                                </summary>
                                <ul class=" text-xs text-center w-28 menu menu-xs max-w-xs">
                                    <li>
                                        <a
                                            href="{{ route('manhoursRegister') }}"class="{{ Request::is('manhours/manhoursRegister*') ? ' active font-semibold ' : '' }}">{{ __('Register') }}</a>
                                    </li>
                                </ul>
                            </details>
                        </li>
                        <li>
                            <details>
                                <summary class="{{ Request::is('InControl*') ? 'text-amber-200 font-semibold' : '' }}">
                                    Administrator
                                </summary>
                                <ul class="grid grid-cols-2 gap-1 text-xs text-center opacity-100 w-96 menu  menu-xs p-2">
                                    <li><a
                                            href="{{ route('people') }}"class="{{ Request::is('InControl/people') ? 'active font-semibold' : '' }}">{{ __('People') }}</a>
                                    </li>
                                    <li><a
                                            href="{{ route('securityUser') }}"class="{{ Request::is('InControl/securityUser') ? 'active font-semibold' : '' }}">{{ __('security_user') }}</a>
                                    </li>
                                    <li><a
                                            href="{{ route('categoryCompany') }}"class="{{ Request::is('InControl/categorycompany') ? 'active font-semibold' : '' }}">{{ __('Category_Company') }}</a>
                                    </li>

                                    <li>
                                        <a
                                            href="{{ route('company') }}"class="{{ Request::is('InControl/company') ? 'active font-semibold' : '' }}">{{ __('Company') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('department') }}"class="{{ Request::is('InControl/department') ? 'active font-semibold' : '' }}">{{ __('department') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('deptGroup') }}"class="{{ Request::is('InControl/deptGroup') ? 'active font-semibold' : '' }}">{{ __('group') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('companyLevel') }}"class="{{ Request::is('InControl/companyLevel') ? 'active font-semibold' : '' }}">{{ __('level') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('roster') }}"class="{{ Request::is('InControl/roster') ? 'active font-semibold' : '' }}">{{ __('Roster') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('responsibleRole') }}"class="{{ Request::is('InControl/responsibleRole') ? 'active font-semibold' : '' }}">{{ __('responsible_role') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('statusCode') }}"class="{{ Request::is('InControl/statusCode') ? 'active font-semibold' : '' }}">{{ __('status_code') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('users') }}"class="{{ Request::is('InControl/users') ? 'active font-semibold' : '' }}">{{ __('User') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('roleUser') }}"class="{{ Request::is('InControl/roleUser') ? 'active font-semibold' : '' }}">{{ __('Role User') }}</a>
                                    </li>

                                    <li>
                                        <details {{ Request::is('InControl/rolePosition*') ? 'open' : '' }}>
                                            <summary
                                                class="{{ Request::is('InControl/rolePosition*') ? 'text-amber-500 font-semibold' : '' }}">
                                                {{ __('Role Position') }}</summary>
                                            <ul class="">
                                                <li>
                                                    <a
                                                        href="{{ route('roleClass') }}"class="{{ Request::is('InControl/rolePositionClass') ? 'active font-semibold' : '' }}">{{ __('role_class') }}</a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('rolePosition') }}"class="{{ Request::is('InControl/rolePosition') ? 'active font-semibold' : '' }}">{{ __('Roles') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </details>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('workgroup') }}"class="{{ Request::is('InControl/workgroup') ? 'active font-semibold' : '' }}">{{ __('Workgroup') }}</a>
                                    </li>
                                    <li>
                                        <details {{ Request::is('InControl/event*') ? 'open' : '' }}>
                                            <summary
                                                class="{{ Request::is('InControl/event*') ? 'text-amber-500 font-semibold' : '' }}">
                                                {{ __('event') }}</summary>
                                            <ul class="">
                                                <li>
                                                    <a
                                                        href="{{ route('eventLocation') }}"class="{{ Request::is('InControl/eventLocation') ? 'active font-semibold' : '' }}">{{ __('el') }}</a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('eventSite') }}"class="{{ Request::is('InControl/eventSite') ? 'active font-semibold' : '' }}">{{ __('es') }}</a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('eventCategory') }}"class="{{ Request::is('InControl/eventCategory') ? 'active font-semibold' : '' }}">{{ __('ec') }}</a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('eventType') }}"class="{{ Request::is('InControl/eventType') ? 'active font-semibold' : '' }}">{{ __('et') }}</a>

                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('eventSubType') }}"class="{{ Request::is('InControl/eventSubType') ? 'active font-semibold' : '' }}">{{ __('est') }}</a>

                                                </li>
                                            </ul>
                                        </details>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('port') }}"class="{{ Request::is('InControl/port') ? 'active font-semibold' : '' }}">Port</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('riskConsequence') }}"class="{{ Request::is('InControl/riskConsequence') ? 'active font-semibold' : '' }}">{{ __('rc') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('riskLikelihood') }}"class="{{ Request::is('InControl/riskLikelihood') ? 'active font-semibold' : '' }}">{{ __('rl') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('riskAssessment') }}"class="{{ Request::is('InControl/riskAssessment') ? 'active font-semibold' : '' }}">{{ __('ra') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('workflowstep') }}"class="{{ Request::is('InControl/workflowstep') ? 'active font-semibold' : '' }}">{{ __('ws') }}</a>
                                    </li>

                                    <li>
                                        <a
                                            href="{{ route('accessRiskAssessment') }}"class="{{ Request::is('InControl/accessRiskAssessment') ? 'active font-semibold' : '' }}">{{ __('ara') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('AdminControlCompanyManhours') }}"class="{{ Request::is('InControl/AdminControlCompanyManhours') ? 'active font-semibold' : '' }}">{{ __('Control Company Manhours') }}</a>
                                    </li>
                                </ul>
                            </details>
                        </li>
                    @else
                        <li>
                            <a
                                href="{{ route('dashboard') }}"class="{{ Request::is('dashboard*') ? 'text-amber-200     font-semibold' : '' }}">Dashboard</a>
                        </li>

                        <li>
                            <details>
                                <summary
                                    class="{{ Request::is('user/eventReport*') ? 'text-amber-200 font-semibold' : '' }}">
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
                        <li>
                            <details>
                                <summary
                                    class="{{ Request::is('user/manhours*') ? 'text-amber-200 font-semibold' : '' }}">
                                    Manhours
                                </summary>
                                <ul class=" text-xs text-center w-28 menu-xs max-w-xs">
                                    <li>
                                        <a
                                            href="{{ route('ManhoursGuest') }}"class="{{ Request::is('user/manhours/manhoursRegister*') ? ' active font-semibold ' : '' }}">{{ __('Hazard_Report') }}</a>
                                    </li>
                                </ul>
                            </details>
                        </li>
                    @endif
                @endauth
        </div>
        <div class="navbar-end ">
            @if (Route::has('login'))
                @auth
                    @livewire('dasboard.notification.index')
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="font-semibold text-emerald-600 btn btn-ghost btn-xs">
                            {{ Auth::user()->name }}</label>
                        <form method="POST" action="{{ route('logout') }}">
                            <ul tabindex="0"
                                class="menu menu-sm dropdown-content mt-3 z-20 p-2 shadow bg-base-100 rounded-box w-52">
                                <li>
                                    <!-- Authentication -->
                                    @csrf
                                    <a href="route('logout')" class=" font-semibold"
                                        onclick="event.preventDefault();this.closest('form').submit();">Log Out</a>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="dropdown dropdown-end ">
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
