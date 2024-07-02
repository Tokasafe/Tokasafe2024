<div class="z-30 drawer-side">
    <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
    <div
        class=" w-80 pl-2 bg-base-300 text-base-content sticky top-0 z-30 flex h-16   items-center bg-opacity-90 backdrop-blur transition-shadow duration-100 [transform:translate3d(0,0,0)]">
        <div class="text-2xl font-extrabold ...">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-emerald-500">
                Tokasefe
            </span>
        </div>
        <div class="avatar">
            <div class="w-14 rounded">
                <img src="{{ asset('images/icons/icon-192x192.png') }}" alt="Tailwind-CSS-Avatar-component" />
            </div>
        </div>
    </div>
    
        <ul class="mt-16 min-h-full m-0 bg-base-300 menu w-80 text-base-content ">
            <!-- Sidebar content here -->
            @auth
                @if (auth()->user()->role_users_id == 1)
                    <li>
                        <a
                            href="{{ route('dashboard') }}"class="{{ Request::is('dashboard*') ? 'text-info font-semibold' : '' }}">Dashboard</a>
                    </li>

                    <li>
                        <details {{ Request::is('eventReport*') ? 'open' : '' }}>
                            <summary class="{{ Request::is('eventReport*') ? 'text-info font-semibold' : '' }}">
                                Event Report
                            </summary>
                            <ul class="max-w-xs text-xs text-center menu menu-xs">
                                <li>
                                    <a
                                        href="{{ route('hazard') }}"class="{{ Request::is('eventReport/hazard_id*') ? ' active font-semibold ' : '' }}">{{ __('Hazard_Report') }}</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('incident') }}"class="{{ Request::is('eventReport/incident*') ? ' active font-semibold ' : '' }}">{{ __('incident_Report') }}</a>
                                </li>
                            </ul>

                        </details>
                    </li>
                    <li>
                        <details {{ Request::is('manhours*') ? 'open' : '' }}>
                            <summary class="{{ Request::is('manhours*') ? 'text-info font-semibold' : '' }}">
                                Manhours
                            </summary>
                            <ul class="max-w-xs text-xs text-center menu menu-xs">
                                <li>
                                    <a
                                        href="{{ route('manhoursRegister') }}"class="{{ Request::is('manhours/manhoursRegister*') ? ' active font-semibold ' : '' }}">{{ __('Register') }}</a>
                                </li>
                            </ul>
                        </details>
                    </li>

                    <li>
                        <details {{ Request::is('InControl*') ? 'open' : '' }}>
                            <summary class="{{ Request::is('InControl*') ? 'text-info font-semibold' : '' }}">
                                Administrator
                            </summary>
                            <ul class="p-2 text-xs text-center  opacity-100 menu menu-xs">
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
                                            class="{{ Request::is('InControl/event*') ? 'text-info font-semibold' : '' }}">
                                            {{ __('event') }}</summary>
                                        <ul class="z-10 ">
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
                            href="{{ route('dashboard') }}"class="{{ Request::is('dashboard*') ? 'text-info font-semibold' : '' }}">Dashboard</a>
                    </li>
                    <li>
                        <details {{ Request::is('eventReport*') ? 'open' : '' }}>
                            <summary class="{{ Request::is('eventReport*') ? 'text-info font-semibold' : '' }}">
                                Event Report
                            </summary>
                            <ul class="max-w-xs text-xs text-center menu menu-xs">
                                <li>
                                    <a
                                        href="{{ route('hazardGuest') }}"class="{{ Request::is('user/eventReport/hazard_id*') ? ' active font-semibold ' : '' }}">{{ __('Hazard_Report') }}</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('incidentGuest') }}"class="{{ Request::is('user/eventReport/insident*') ? ' active font-semibold ' : '' }}">{{ __('incident_Report') }}</a>
                                </li>
                            </ul>
                        </details>
                    </li>

                    <li>
                        <details {{ Request::is('user/manhours*') ? 'open' : '' }}>
                            <summary class="{{ Request::is('user/manhours*') ? 'text-info font-semibold' : '' }}">
                                Manhours
                            </summary>
                            <ul class="max-w-xs text-xs text-center menu menu-xs">
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
