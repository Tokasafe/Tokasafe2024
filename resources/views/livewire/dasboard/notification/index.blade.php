<div class="">
    <div class="ml-[20px] dropdown dropdown-end relative sm:m-0" wire:poll='pemberitahuan'>
        <label tabindex="0" role="button" class="relative m-1 btn btn-ghost btn-sm btn-circle">
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
                <span class="absolute w-4 h-4 rounded-full opacity-75 -right-1 -top-1 bg-rose-400 animate-ping"></span>
                <span class="absolute w-4 h-4 rounded-full -right-1 -top-1 bg-rose-400 "><small
                        class="font-semibold text-gray-200">{{ $notifications->count() }}</small></span>
            @endif
        </label>
        <ul tabindex="0"
            class="  gap-0.5 -start-[10rem] m-4 top-4  p-0 dropdown-content mx-auto z-[1] menu m-2  w-80  text-base-content ">
            <div class="max-h-full overflow-y-auto h-96 sm:h-400px lg:h-[500px] xl:h-[550px] relative">
                <li class="sticky top-0 left-0 right-0 z-50 shadow-sm bg-slate-200">
                    <small class="flex menu-title">{{ __('Notification') }}

                        <fieldset class="flex items-center p-[3px] border absolute inset-y-0 right-0 gap-1">
                            <input name="radio-10" id="all"wire:model='markAsRead'
                                class="radio-xs peer/all checked:bg-emerald-500 radio" type="radio" name="status"
                                 value="All" />
                            <label for="all"
                                class="text-xs font-semibold peer-checked/all:text-emerald-500">{{ __('All') }}</label>
                            <input name="radio-10" id="Unread"wire:model='markAsRead'
                                class="radio-xs peer/Unread checked:bg-rose-500 radio" type="radio" name="status"
                                value="Unread" />
                            <label for="Unread"
                                class="text-xs font-semibold peer-checked/Unread:text-rose-500">{{ __('Unread') }}</label>
                            <input name="radio-10" id="Read"wire:model='markAsRead'
                                class="radio-xs peer/Read checked:bg-sky-500 radio" type="radio" name="status"
                                value="Read" />
                            <label for="Read"
                                class="text-xs font-semibold peer-checked/Read:text-sky-500">{{ __('Read') }}</label>

                        </fieldset>
                    </small>
                </li>
                @forelse ($Pemberitahuan as $notification)
                    @if (auth()->user()->id == $notification->notifiable_id)
                        <li class="my-0.5 rounded-lg shadow-xl bg-slate-200 ">
                            <a class="relative  flex max-w-xs rounded-lg shadow-xl {{ $notification->read_at ? 'bg-base-200' : 'bg-sky-200' }}"
                                href={{ $notification->data['offerUrl'] }}
                                wire:click="markasread('{{ $notification->id }}')">

                                <span
                                    class="absolute bottom-0 right-0 py-0 -m-1 mr-3 text-[8px] font-semibold text-gray-500 uppercase">{{ date(' d-M-y h:i:sa', strtotime($notification->data['dateTime'])) }}</span>
                                <div class="">
                                    <h4 class="text-sm font-semibold leading-tight text-gray-900">
                                        {{ $notification->data['lookup_name'] }}</h4>
                                    <p class="text-[11px] text-gray-600">{{ $notification->data['info'] }}</p>
                                </div>
                            </a>
                            <label wire:click="deleteNotif('{{ $notification->id }}')"
                                class="absolute top-0 right-0 order-1 px-2 mt-2 mr-2 text-xs font-bold text-green-900 uppercase btn-ghost btn btn-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-4 h-4 -mt-1 text-rose-500">
                                    <path fill-rule="evenodd"
                                        d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>
                        </li>
                    @endif
                    @empty
                    <li class="inset-x-0 top-0 z-50 text-center shadow-sm bg-slate-200 ">
                        <p class="font-semibold text-center text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">{{ __('no notifications') }}</p>
                    </li>
                @endforelse
            </div>
        </ul>
    </div>
</div>
