<div class="">
    @include('toast.toast')
    @push('styles')
        {{-- @livewireStyles() --}}
    @endpush
    @push('scripts')
        {{-- @livewireScripts() --}}

        <script>
            const modaldoc = document.getElementById("closeModalDoc");
            $(document).on('click', '#closeDoc', function() {
                modaldoc.click()
            });
        </script>
        {{-- <script src="../../flatpickr/dist/plugins/rangePlugin.js"></script> --}}
    @endpush
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-rose-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex justify-between mx-4 mt-4">
        <div class="mt-2  ">
            @livewire('event-report-list.hazard-id.document.create', ['id' => $ID_Details])

        </div>

        <div class="hidden join">


            <input wire:model='search'
                class="w-full max-w-xs py-2 bg-white shadow-sm join-item input-xs input input-success placeholder:italic placeholder:text-slate-400 focus:outline-none focus:border-success focus:ring-success focus:ring-1 sm:text-sm"
                placeholder="Search Responsiblity..." type="text" />
            <span class="hidden bg-emerald-300 join-item btn-xs border-emerald-600 md:block">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M8.25 10.875a2.625 2.625 0 115.25 0 2.625 2.625 0 01-5.25 0z" />
                    <path fill-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.125 4.5a4.125 4.125 0 102.338 7.524l2.007 2.006a.75.75 0 101.06-1.06l-2.006-2.007a4.125 4.125 0 00-3.399-6.463z"
                        clip-rule="evenodd" />
                </svg>

            </span>

        </div>
    </div>
    <div class="grid px-2 ">

        <div class="w-auto mx-4 mt-4 overflow-x-auto rounded-md shadow-md md:w-auto">
            <table class="table table-xs">
                <thead class="bg-emerald-300">
                    <tr class="text-center ">
                        <th>#</th>
                        <th>{{ __('description') }}</th>
                        <th>{{ __('documentation') }}</th>
                        <th>{{ __('type') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Document as $index => $item)
                        <tr class="text-center">
                            <th>{{ $Document->firstItem() + $index }}</th>
                            <td class="font-semibold">{{ $item->fileTitle }}</td>
                            <td>{{ $item->fileName }}</td>
                            <td class="flex justify-center">

                                <label class="btn btn-ghost" wire:click="download('{{ $item->id }}')">

                                    @if (pathinfo(public_path($item->fileName))['extension'] === 'png' ||
                                            pathinfo(public_path($item->fileName))['extension'] === 'jpeg' ||
                                            pathinfo(public_path($item->fileName))['extension'] === 'JPG' ||
                                            pathinfo(public_path($item->fileName))['extension'] === 'PNG' ||
                                            pathinfo(public_path($item->fileName))['extension'] === 'jpg')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10" version="1.0"
                                            viewBox="0 0 110 110" id="images">
                                            <g>
                                                <circle cx="55" cy="55" r="55" fill="#E04F5F"></circle>
                                                <path fill="#F0F1F1"
                                                    d="M87 85a2 2 0 0 1-2 2H41a2 2 0 0 1-2-2V41a2 2 0 0 1 2-2h44a2 2 0 0 1 2 2v44z">
                                                </path>
                                                <path fill="#40C9E7" d="M43 43h40v32H43z"></path>
                                                <path fill="#FFF"
                                                    d="M71 69a2 2 0 0 1-2 2H25a2 2 0 0 1-2-2V25a2 2 0 0 1 2-2h44a2 2 0 0 1 2 2v44z">
                                                </path>
                                                <path fill="#40C9E7" d="M27 27h40v32H27z"></path>
                                                <path fill="#6FDAF1"
                                                    d="M43.979 45.021L62 27H26.962v26.4l8.664-10.397-.003-.003 3.334-4 .002.003.003-.003z">
                                                </path>
                                                <path fill="#84462D" d="M59 31L38 59h29V42.2z"></path>
                                                <path fill="#F0F1F1"
                                                    d="M58.98 38.979l2.927 4.098 2.926-3.903-5.853-8.195-5.854 7.805 2.927 4.293z">
                                                </path>
                                                <path fill="#D4A263" d="M39 39L27 53.4V59h28.667z"></path>
                                                <path fill="#FFF"
                                                    d="M49.005 33.037a2.001 2.001 0 0 1-2.001 2.001H34.996a2.001 2.001 0 0 1-2.001-2.001c0-1.241 1.166-2.543 3.336-1.769a6.002 6.002 0 0 1 9.34 0c2.179-.778 3.334.539 3.334 1.769z">
                                                </path>
                                                <path fill="#EDBC7C"
                                                    d="M44.017 45.021L30.038 59H27v-5.6l8.664-10.397L38.995 47l3.333-4z">
                                                </path>
                                                <path fill="#FFF" d="M38.995 47.038l3.333-4-3.333-4-3.334 4z"></path>
                                            </g>
                                        </svg>
                                    @elseif(pathinfo(public_path($item->fileName))['extension'] === 'docx' ||
                                            pathinfo(public_path($item->fileName))['extension'] === 'doc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10" fill-rule="evenodd"
                                            clip-rule="evenodd" image-rendering="optimizeQuality"
                                            shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                            viewBox="0 0 17639 17639" id="word">
                                            <g>
                                                <path fill="#2b5797"
                                                    d="m3526 12823 5-8040 6100-1044v10125l-6105-1041zm9610-2714H9872v-632h3264v-421H9872v-631h3264v-421H9872v-632h3264v-421H9872v-632h3264v-421H9872l6-994h3951c212-8 255 34 247 247v7337c3 127-36 236-247 212H9878l-6-1117h3264v-421H9872v-632h3264v-421zM2081 15593h13512l-18-13494H2081v13494z">
                                                </path>
                                                <path fill="#2b5797"
                                                    d="m7766 6933-483 2594-500-2512-677 39-480 2382-406-2308-598 7 622 3342 628 34 516-2310 275 1171c80 398 161 779 235 1185l710 73 823-3722-665 25z">
                                                </path>
                                            </g>
                                        </svg>
                                    @elseif(pathinfo(public_path($item->fileName))['extension'] === 'pdf')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10"
                                            viewBox="0 0 192.756 192.756" id="adobe">
                                            <g fill-rule="evenodd" clip-rule="evenodd">
                                                <path fill="#fff" d="M0 0h192.756v192.756H0V0z"></path>
                                                <path fill="#d0d1d3"
                                                    d="M38.329 6.164h107.55l31.6 32.783v147.979H38.329V6.164z"></path>
                                                <path fill="#fff" d="M18.022 24.473h110.189v32.956H18.022V24.473z">
                                                </path>
                                                <path fill="#db812e"
                                                    d="M84.928 72.231c2.727 0 4.951 2.224 4.951 4.951s-2.225 4.951-4.951 4.951-4.951-2.224-4.951-4.951 2.225-4.951 4.951-4.951zM68.353 84.146a4.96 4.96 0 0 1 4.951 4.951 4.96 4.96 0 0 1-4.951 4.951 4.96 4.96 0 0 1-4.951-4.951 4.96 4.96 0 0 1 4.951-4.951zM59.032 101.596c2.727 0 4.951 2.225 4.951 4.951s-2.225 4.951-4.951 4.951-4.951-2.225-4.951-4.951 2.224-4.951 4.951-4.951zM57.839 121.68a4.961 4.961 0 0 1 4.951 4.951c0 2.729-2.224 4.951-4.951 4.951s-4.951-2.223-4.951-4.951a4.96 4.96 0 0 1 4.951-4.951zM65.288 140.406a4.96 4.96 0 0 1 4.951 4.949 4.96 4.96 0 0 1-4.951 4.951 4.96 4.96 0 0 1-4.951-4.951 4.959 4.959 0 0 1 4.951-4.949zM80.073 154.055a4.96 4.96 0 0 1 4.951 4.949c0 2.729-2.224 4.953-4.951 4.953s-4.951-2.225-4.951-4.953a4.96 4.96 0 0 1 4.951-4.949zM98.979 159.838c1.418 0 2.699.602 3.602 1.561v-1.561c2.729 0 4.951 2.225 4.951 4.951s-2.223 4.951-4.951 4.951v-1.561a4.936 4.936 0 0 1-3.602 1.561c-2.726 0-4.951-2.225-4.951-4.951s2.224-4.951 4.951-4.951zM104.707 68.652c2.727 0 4.951 2.225 4.951 4.951s-2.225 4.951-4.951 4.951-4.951-2.225-4.951-4.951 2.224-4.951 4.951-4.951zM123.807 73.896c2.729 0 4.953 2.224 4.953 4.951s-2.225 4.951-4.953 4.951c-2.727 0-4.949-2.224-4.949-4.951s2.222-4.951 4.949-4.951zM139.121 87.073a4.96 4.96 0 0 1 4.951 4.951c0 2.727-2.225 4.951-4.951 4.951s-4.951-2.224-4.951-4.951a4.961 4.961 0 0 1 4.951-4.951zM147.443 105.383a4.96 4.96 0 0 1 4.951 4.951c0 2.727-2.225 4.949-4.951 4.949s-4.951-2.223-4.951-4.949a4.96 4.96 0 0 1 4.951-4.951zM146.777 125.689a4.96 4.96 0 0 1 4.951 4.951c0 2.727-2.225 4.949-4.951 4.949s-4.951-2.223-4.951-4.949a4.96 4.96 0 0 1 4.951-4.951zM137.928 143.275a4.961 4.961 0 0 1 4.951 4.951c0 2.729-2.225 4.951-4.951 4.951s-4.951-2.223-4.951-4.951a4.961 4.961 0 0 1 4.951-4.951zM122.143 155.648c2.727 0 4.951 2.225 4.951 4.951s-2.225 4.951-4.951 4.951-4.951-2.225-4.951-4.951 2.224-4.951 4.951-4.951z">
                                                </path>
                                                <path fill="#cc2229"
                                                    d="M164.031 140.096c-1.225-2.018-11.596-3.199-15.01-2.705 2.344 1.588 14.106 4.089 15.01 2.705zM55.103 172.107c-1.538-1.262 11.326-15.016 14.529-17.098-2.176 5.278-13.406 17.8-14.529 17.098zm32.448-30.748c5.977-10.426 10.927-21.398 14.851-32.508 4.859 10.129 11.086 17.725 17.793 23.199-10.836 2.009-22.15 5.112-32.644 9.309zm14.81-78.766c-1.559.264-1.361 9.687-.768 15.157.545-2.691 1.535-6.446 1.82-9.631h4.219c.627 6.57-.328 19.165-1.434 27.189 4.232 16.02 17.758 31.745 27.408 35.071 18.02-2.039 25.854-.689 32.266 2.414 6.412 3.102 2.275 9.869 2.275 9.869s.691 2.656-5.701 4.225c-7.459 1.389-28.062-5.549-31.529-8.451-1.744-1.832-47.067 7.951-47.452 9.812-.503 1.979-14.717 25.184-23.59 29.469-7.806 3.93-9.754.035-10.425-.188-1.448 0-3.479-1.547-2.299-6.531 4.346-13.029 22.544-21.303 22.544-21.303l1.871 2.48s23.533-40.598 26.051-56.877c-6.755-19.456-2.375-35.879-2.591-35.879l12.988-.009c.566 1.958.549 4.568-.027 7.197h-4.496c.013-1.741-.284-3.19-1.13-4.014z">
                                                </path>
                                                <path
                                                    d="M12.614 21.284h23.051V2.834h110.256l34.219 34.934v152.153H35.666V60.89H12.614V21.284zm28.711 0h92.884V60.89H41.325v123.54h133.158V43.961h-33.969V8.328H41.325v12.956zm58.128 34.042h7.949V44.269h13.252V38.6h-13.252v-6.318h16.643V26.34H99.453v28.986zM68.407 31.6h4.53c4.387 0 7.976 3.532 7.976 9.112s-3.589 9.217-7.976 9.217h-4.53V31.6zm5.46-5.26H60.779v28.985h13.087c6.546 0 15.42-4.592 15.42-14.493.001-9.892-8.457-14.492-15.419-14.492zM32.273 39.589V31.6h4.556c4.295 0 6.142.723 6.142 4.055 0 3.172-2.128 3.935-6.624 3.935h-4.074v-.001zm-8.357 15.737h8.357V44.577h8.826c4.195 0 9.765-2.9 9.765-9.042 0-6.143-5.298-9.194-9.765-9.194H23.916v28.985zm122.037-44.764l27.053 27.792h-27.053V10.562z">
                                                </path>
                                            </g>
                                        </svg>
                                    @elseif(pathinfo(public_path($item->fileName))['extension'] === 'xlsx' ||
                                            pathinfo(public_path($item->fileName))['extension'] === 'csv')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10" fill-rule="evenodd"
                                            clip-rule="evenodd" image-rendering="optimizeQuality"
                                            shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                            viewBox="0 0 17639 17639" id="excel">
                                            <path fill="#1e7145"
                                                d="M9596 3634v10265l-6103-1058V4692l6103-1058zm290 1185h4053c224 0 267 44 267 267v7360c0 223-43 267-267 267H9886v-694h1547v-1066H9886v-320h1547V9566H9886v-320h1547V8179H9886v-320h1547V6793H9886v-320h1547V5406H9886v-587zM2083 15593h13474l2-13476H2081l2 13476z">
                                            </path>
                                            <path fill="#1e7145"
                                                d="m7129 6861-556 1272-432-1195-695 31 690 1741-777 1703 683 51 548-1225 510 1296 786 43-852-1875 815-1894zM11753 12019h1760v-1066h-1760zM11753 10633h1760V9566h-1760zM11753 9246h1760V8179h-1760zM11753 6473h1760V5406h-1760zM11753 7859h1760V6793h-1760z">
                                            </path>
                                        </svg>
                                    @endif
                                </label>
                            </td>

                            <td>
                                <div class="flex flex-row justify-center gap-1">
                                    <label for="delete_data" wire:click="delete({{ $item->id }})"
                                        {{ $hazardClose ? 'disabled' : '' }}
                                        class="btn btn-xs btn-error ">{{ __('Delete') }}</label>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="10" class="font-semibold text-rose-500">

                                <p class="flex justify-center"> Data not found <span
                                        class="loading loading-bars loading-xs"> </span></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-emerald-300">
                    <tr class="text-center">
                        <th>#</th>
                        <th>{{ __('description') }}</th>
                        <th>{{ __('documentation') }}</th>
                        <th>{{ __('type') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div>{{ $Document->links() }}</div>
    </div>

    <input type="checkbox" id="delete_data" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete file name : {{ $filename }}?</h4>
            <form wire:submit.prevent='deleteFile'>
                <div class="modal-action">
                    <button id="closeDoc" type="submit" class="text-white btn btn-success btn-xs">Yes
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </button>
                    <label for="delete_data" id="closeModalDoc" class="btn btn-xs btn-error">No!</label>
                </div>
            </form>
        </div>
    </div>

</div>
