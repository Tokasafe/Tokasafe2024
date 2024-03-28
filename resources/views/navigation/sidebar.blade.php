<div class="z-20 drawer-side">
    <label for="my-drawer-3" class="drawer-overlay"></label>
    <ul class="min-h-full p-4 menu w-80 bg-base-200">
        <!-- Sidebar content here -->
       
        <li>
            <details {{ Request::is('eventReport*') ? 'open' : '' }}>
                <summary class="{{ Request::is('eventReport*') ? 'text-success font-bold' : '' }}">
                    Event Report
                </summary>
                <ul class=" text-xs text-center opacity-100 menu menu-xs">
                    <li>
                        <a
                            href="{{ route('hazard') }}"class="{{ Request::is('eventReport/hazard_id*') ? 'active font-semibold' : '' }}">{{ __('Hazard_Report') }}</a>
                    </li>
                </ul>
            </details>
        </li>
        
        <li>
            <details {{ Request::is('InControl*') ? 'open' : '' }}>
                <summary class="{{ Request::is('InControl*') ? 'text-success font-bold' : '' }}">Administrator
                </summary>
                <ul class="text-xs text-center menu menu-xs">
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
                            href="{{ route('workgroup') }}"class="{{ Request::is('InControl/workgroup') ? 'active font-bold' : '' }}">Workgroup</a>
                    </li>
                    <li>
                        <details {{ Request::is('InControl/event*') ? 'open' : '' }}>
                            <summary class="{{ Request::is('InControl/event*') ? 'text-success font-bold' : '' }}">
                                Event</summary>
                            <ul>
                                <li>
                                    <a
                                        href="{{ route('eventLocation') }}"class="{{ Request::is('InControl/eventLocation') ? 'active font-semibold' : '' }}">Event
                                        Location</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('eventSite') }}"class="{{ Request::is('InControl/eventSite') ? 'active font-semibold' : '' }}">Event
                                        Site</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('eventCategory') }}"class="{{ Request::is('InControl/eventCategory') ? 'active font-bold' : '' }}">Event
                                        Category</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('eventType') }}"class="{{ Request::is('InControl/eventType') ? 'active font-bold' : '' }}">Event
                                        Type</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('eventSubType') }}"class="{{ Request::is('InControl/eventSubType') ? 'active font-bold' : '' }}">Event
                                        Sub Type</a>
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
                            href="{{ route('riskConsequence') }}"class="{{ Request::is('InControl/riskConsequence') ? 'active font-bold' : '' }}">Risk
                            Consequence</a>
                    </li>
                    <li>
                        <a
                            href="{{ route('riskLikelihood') }}"class="{{ Request::is('InControl/riskLikelihood') ? 'active font-bold' : '' }}">Risk
                            Likelihood</a>
                    </li>
                    <li>
                        <a
                            href="{{ route('riskAssessment') }}"class="{{ Request::is('InControl/riskAssessment') ? 'active font-semibold' : '' }}">Risk
                            Assessment</a>
                    </li>
                    <li>
                        <a
                            href="{{ route('workflowstep') }}"class="{{ Request::is('InControl/workflowstep') ? 'active font-semibold' : '' }}">Workflow
                            Step</a>
                    </li>

                    <li>
                        <a
                            href="{{ route('accessRiskAssessment') }}"class="{{ Request::is('InControl/accessRiskAssessment') ? 'active font-semibold' : '' }}">Access
                            RiskAssessment</a>
                    </li>
                </ul>
            </details>
        </li>

    </ul>

</div>
