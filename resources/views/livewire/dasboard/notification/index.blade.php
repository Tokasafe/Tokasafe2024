<div>

    <div class="dropdown dropdown-bottom dropdown-end ml-4 sm:m-0" wire:poll='pemberitahuan'>
        <label tabindex="0" role="button" class="btn btn-ghost btn-sm btn-circle m-1 relative">
            @if ($notifications->count() < 1)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                </svg>
            @endif
            @if ($notifications->count() >= 1)
                <span class="absolute h-4 w-4 -right-1 -top-1 bg-rose-400 animate-ping rounded-full opacity-75"></span>
                <span class="absolute h-4 w-4 -right-1 -top-1 bg-rose-400  rounded-full "><small
                        class="text-gray-200 font-semibold">{{ $notifications->count() }}</small></span>
            @endif
        </label>
        <ul tabindex="0" class="dropdown-content z-[1]  menu  shadow bg-base-100 rounded-box   ">
            <div class="relative w-56 sm:w-96">
                <div class="h-96 sm:w-96 overflow-y-auto p-0">

                    <li
                        class=" {{ empty($unreadNotifications->first()->id) ? 'hidden' : 'sticky top-0 z-10 bg-gray-200' }}">
                        <h2 class="menu-title">{{ __('unread') }}</h2>

                    </li>
                    @foreach ($unreadNotifications as $notification)
                        @if (auth()->user()->id == $notification->notifiable_id)
                            <li>

                                <a wire:click="markasread('{{ $notification->id }}')"
                                    href="{{ auth()->user()->role_users_id == 2 ? route('hazardDetailsGuest', $notification->data['offer_id']) : route('hazardDetails', $notification->data['offer_id']) }}"
                                    class="flex items-center  py-3 border-b hover:bg-gray-100 ">
                                    <small class="text-gray-600 text-xs mx-2">
                                        <span class="font-bold"
                                            href="#">{{ $notification->data['lookup_name'] }}</span>
                                        {{ $notification->data['info'] }} <span
                                            class="font-semibold text-teal-500">{{ $notification->data['bahaya'] }}</span>
                                        <span class="font-bold text-blue-500"
                                            href="#">{{ $notification->data['reference'] }}</span><br><small
                                            class="font-bold">{{ date(' d-M-y h:i:sa', strtotime($notification->updated_at)) }}</small>
                                    </small>

                                </a>
                            </li>
                        @endif
                    @endforeach
                    <li
                        class="{{ empty($readNotifications->first()->id) ? 'hidden' : 'sticky top-0 z-10 bg-gray-200' }}">
                        <h2 class="menu-title flex gap-4">{{ __('read') }}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5 text-emerald-500">
                                <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                <path fill-rule="evenodd"
                                    d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </h2>
                    </li>
                    @foreach ($readNotifications as $notification)
                        @if (auth()->user()->id == $notification->notifiable_id)
                            <li>
                                <div class="flex items-center">

                                    <p class="text-gray-600 text-xs px-2">
                                        <a href="{{ auth()->user()->role_users_id == 2 ? route('hazardDetailsGuest', $notification->data['offer_id']) : route('hazardDetails', $notification->data['offer_id']) }}"
                                            class="  py-3 border-b  ">
                                            <span class="font-bold"
                                                href="#">{{ $notification->data['lookup_name'] }}</span>
                                            {{ $notification->data['info'] }} <span
                                                class="font-semibold text-teal-500">{{ $notification->data['bahaya'] }}</span>
                                            <span class="font-bold text-blue-500"
                                                href="#">{{ $notification->data['reference'] }}</span> <br><small
                                                class="font-bold">{{ date('d-M-y h:i:sa', strtotime($notification->updated_at)) }}</small>
                                        </a>
                                    </p>
                                    <button class="btn btn-xs btn-ghost btn-square "
                                        wire:click="deleteNotif('{{ $notification->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-4 h-4 text-rose-500">
                                            <path fill-rule="evenodd"
                                                d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                clip-rule="evenodd" />
                                        </svg>

                                    </button>
                                </div>

                            </li>
                        @endif
                    @endforeach
                </div>


                <button wire:click='markNotification' for=""
                    class="{{ empty($unreadNotifications->first()->id) ? 'hidden' : 'btn absolute bottom-0 z-10 w-full btn-info btn-xs' }}   ">Mark
                    as Read</button>


            </div>
        </ul>
    </div>

</div>
