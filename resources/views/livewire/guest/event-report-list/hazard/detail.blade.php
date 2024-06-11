<div>
    @include('toast.toast')
    @push('styles')
        @livewireStyles()
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
        {{-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script> --}}
        <script src="https://kit.fontawesome.com/3de311882c.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css"
            crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
    @push('scripts')
        @livewireScripts()
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            const modal = document.getElementById("closeModal");
            $(document).on('click', '#close', function() {
                modal.click()
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>

        <script>
            flatpickr("#tanggal", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });

            flatpickr("#tglLapor1", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#jamKejadian", {
                disableMobile: "true",
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
            flatpickr("#tgldilapor", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#month", {
                disableMobile: "true",
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true, //defaults to false
                        dateFormat: "M-Y", //defaults to "F Y"
                        altFormat: "F Y", //defaults to "F Y"
                        theme: "dark" // defaults to "light"
                    })
                ]
            });

            const tglll = $("#rangeDate").flatpickr({
                mode: 'range',
                dateFormat: "d-m-Y", //defaults to "F Y"
                onChange: function(dates) {
                    if (dates.length === 2) {
                        var start = dates[0].getDate() + "-" + dates[0].getMonth() + "-" + dates[0].getFullYear();
                        var end = dates[1].getDate() + "-" + dates[1].getMonth() + "-" + dates[1].getFullYear();;
                        livewire.emit('TglMulai', start);
                        livewire.emit('TglAkhir', end);
                    }
                }
            })
        </script>
    @endpush
    @section('bradcrumbs')
        {{ Breadcrumbs::render('hazardDetailsGuest', $data_id) }}
    @endsection
    <div class="p-2 m-1 rounded-md sm:w-full ">

        <div class="flex flex-row pl-2 sm:pl-0">
            <div class="w-20 text-xs font-semibold text-gray-500 ">{{ __('reference') }}</div>
            <div class="w-40 text-xs font-semibold text-gray-500">: {{ $reference }}</div>
        </div>
        <div class="flex flex-row pl-2 sm:pl-0">
            <div class="w-20 text-xs font-semibold text-gray-500 ">{{ __('date') }}</div>
            <div class="w-40 text-xs font-semibold text-gray-500">: {{ date('d-M-Y', strtotime($tanggal_kejadian)) }}
            </div>
        </div>
        <div class="flex flex-row pl-2 sm:pl-0">
            <div class="w-20 text-xs font-semibold text-gray-500 ">{{ __('Workgroup') }}</div>
            <div class="text-xs font-semibold text-gray-500 ">: {{ $workgroup }}</div>
        </div>
    </div>
    @livewire('event-report-list.hazard-id.panel.index', ['id' => $data_id])
    <div class="shadow-md ">
        <form id="commentForm" wire:submit.prevent='store' wire:loading.class="skeleton" wire:target="store">
            @csrf
            @method('PATCH')
            @if($userController)
                
            <div class="top-0 z-10 p-2 bg-white shadow-sm sm:sticky">
                <button {{ $hazardClose ? 'disabled' : '' }} wire:loading.class="btn-disabled"
                    wire:target="documentation1" type="submit"
                    class="text-white btn btn-outline btn-success btn-xs">{{ __('Save') }}
                    <svg wire:loading.remove wire:target="store" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                        fill="currentColor" class="size-4">
                        <path d="M2 3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3Z" />
                        <path fill-rule="evenodd"
                            d="M13 6H3v6a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V6ZM8.75 7.75a.75.75 0 0 0-1.5 0v2.69L6.03 9.22a.75.75 0 0 0-1.06 1.06l2.5 2.5a.75.75 0 0 0 1.06 0l2.5-2.5a.75.75 0 1 0-1.06-1.06l-1.22 1.22V7.75Z"
                            clip-rule="evenodd" />
                    </svg>


                    <span wire:loading wire:target="store" wire:loading wire:loading.class="bg-rose-500"
                        class="hidden loading loading-spinner loading-sm"></span>
                </button>
                <label {{ $hazardClose ? 'disabled' : '' }} for="delete"
                    class="btn btn-xs btn-error btn-outline">{{ __('Delete') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd"
                            d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                            clip-rule="evenodd" />
                    </svg>

                </label>
            </div>
            @endif
            <div class=" {{ $hazardClose ? 'stack' : '' }}">
                <div
                    class=" {{ $hazardClose ? 'overflow-y-auto h-[520px] sm:h-[18rem] xxl:h-[22rem] 2xl:h-[38rem] p-2' : 'overflow-y-auto sm:h-[18rem] lg:h-[20rem] 2xl:h-[39rem] p-2 ' }}">
                    <div class="flex flex-wrap gap-1 sm:grid sm:grid-cols-3">
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('est')" />
                            <select wire:model='event_subtype' {{ $hazardClose ? 'disabled' : '' }}
                                class=" @error('event_subtype') border-rose-500 border-2 @enderror  w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                @foreach ($EventSubType as $ets)
                                    @if (old('event_subtype') == $ets->id)
                                        <option value="{{ $ets->id }}">
                                            {{ $ets->EventType->name }}-{{ $ets->name }}</option>
                                    @else
                                        <option value="{{ $ets->id }}">
                                            {{ $ets->EventType->name }}-{{ $ets->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('event_subtype')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('nama_pelapor')" />
                            <label class="join"wire:click='reportByClick'>
                                <input type="text" placeholder="Type here" wire:model='nama_pelapor' readonly
                                    {{ $hazardClose ? 'disabled' : '' }}
                                    class=" @error('nama_pelapor') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label for="" {{ $hazardClose ? 'disabled' : '' }}
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('nama_pelapor')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('tanggal_kejadian')" />
                            <input type="text" id="tglLapor1" placeholder="Type here" wire:model='tanggal_kejadian'
                                {{ $hazardClose ? 'disabled' : '' }} readonly
                                class=" @error('tanggal_kejadian') border-rose-500 border-2 @enderror cursor-pointer w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('tanggal_kejadian')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('time_event')" />
                            <input type="text" id="jamKejadian" placeholder="Type here" wire:model='waktu' readonly
                                {{ $hazardClose ? 'disabled' : '' }}
                                class=" @error('waktu') border-rose-500 border-2 @enderror w-full cursor-pointer input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('waktu')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('rw')" />
                            <label class="join" wire:click='wgClick'>
                                <input type="text" placeholder="Type here" wire:model='workgroup' readonly
                                    {{ $hazardClose ? 'disabled' : '' }}
                                    class=" @error('workgroup') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label for="" {{ $hazardClose ? 'disabled' : '' }}
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                                    </svg>
                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('workgroup')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('pengawas_area')" />
                            <label class="join"wire:click='reportToClick'>
                                <input type="text" placeholder="Type here" wire:model='pengawas_area' readonly
                                    {{ $hazardClose ? 'disabled' : '' }}
                                    class=" @error('pengawas_area') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label for="" {{ $hazardClose ? 'disabled' : '' }}
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('pengawas_area')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('el')" />
                            <select wire:model='lokasi' {{ $hazardClose ? 'disabled' : '' }}
                                class=" @error('lokasi') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                @foreach ($LocationEvent as $location)
                                    @if (old('lokasi') == $location->name)
                                        <option value="{{ $location->name }}">{{ $location->name }}</option>
                                    @else
                                        <option value="{{ $location->name }}">{{ $location->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lokasi')" class="mt-0" />
                        </div>
                        <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                            <x-input-label-req :value="__('tugas')" />
                            <input type="text" placeholder="Type here" wire:model='task' {{ $hazardClose ? 'disabled' : '' }}
                                class=" @error('task') border-rose-500 border-2 @enderror  w-full sm:max-w-xl input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('task')" class="mt-0" />
                        </div>
                        <div class="flex flex-row w-full max-w-xl form-control">
                            <div class="flex-initial w-[650px]">

                                <x-input-label :value="__('documentation')" />

                                <input type="file" @if ($hazardClose) disabled @endif
                                    wire:model='documentation'
                                    class=" @error('documentation') border-rose-500 border-2 @enderror file-input  file-input-bordered file-input-primary w-full m file-input-xs  focus:outline-none  focus:ring-success focus:ring-1" />
                                <x-input-error :messages="$errors->get('documentation')" class="mt-0" />
                            </div>
                            @if ($filename)
                                <div wire:click='download'
                                    class="flex-none w-6 mt-[25px] cursor-pointer tooltip-left tooltip"data-tip="{{ $filename }}">

                                    @include('livewire.event-report-list.insident.svg')

                                </div>
                            @endif
                            @if ($documentation)
                                <div class="flex-none w-6 mt-[25px] ">

                                    @include('livewire.event-report-list.insident.svgCreate')

                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="flex flex-col justify-center gap-2 mx-2 sm:justify-normal">
                        <div>
                            <div wire:ignore class="w-full form-control">
                                <x-input-label-bahaya :value="__('deskripsi')" />
                                <textarea id="rincian_bahaya" placeholder="Bio" wire:model='rincian_bahaya'
                                    class="@error('rincian_bahaya') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1">{{ $rincian_bahaya }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('rincian_bahaya')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full form-control">
                                <x-input-label-req :value="__('tindakan_perbaikan_dilakuan')" />
                                <textarea id="tindakan_perbaikan" placeholder="Bio" wire:model='tindakan_perbaikan'
                                    class="@error('tindakan_perbaikan') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1">{{ $tindakan_perbaikan }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('tindakan_perbaikan')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full form-control">
                                <x-input-label-req :value="__('tindakan_perbaikan_disarankan')" />
                                <textarea id="tindakan_perbaikan_disarankan" placeholder="Bio" wire:model='tindakan_perbaikan_disarankan'
                                    class="@error('tindakan_perbaikan_disarankan') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1">{{ $tindakan_perbaikan_disarankan }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('tindakan_perbaikan_disarankan')" class="mt-0" />
                        </div>
                    </div>
                   
                        @include('livewire.guest.event-report-list.hazard.tablePenilaian')
                   
                    <div class="flex flex-wrap justify-center gap-2 mx-2 my-4 sm:justify-normal">
                        <div class="w-full p-4 ">
                            <div
                                class="font-extrabold text-transparent divider divider-info text-1xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                                {{ __('Tindakan_Perbaikan') }}</div>
                            @livewire('event-report-list.hazard-id.action.index', ['id' => $data_id])
                        </div>
                    </div>
                    {{-- <div class="flex flex-wrap justify-center gap-2 mx-2 my-4 sm:justify-normal">
                        <div class="w-full p-4 border border-accent">
                            <div class="font-semibold divider divider-accent">{{ __('documentation') }}</div>

                            @livewire('event-report-list.hazard-id.document.index', ['id' => $data_id])
                        </div>
                    </div> --}}

                    <div class="mx-2">
                        <div wire:ignore class="w-full form-control">
                            <x-input-label :value="__('komentar')" />
                            <textarea id="komentar" placeholder="Bio" wire:model='komentar'
                                class="@error('komentar') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"> {{ $komentar }} </textarea>
                        </div>
                        <x-input-error :messages="$errors->get('komentar')" class="mt-0" />
                    </div>


                </div>
                <div
                    class=" {{ $hazardClose ? 'overflow-y-auto h-full sm:h-[14rem] xxl:h-[16rem] 2xl:h-[34rem] flex justify-center ' : '' }} ">
                    <p
                        class=" {{ $hazardClose ? 'self-center text-6xl sm:text-9xl font-black font-mono text-gray-300 italic z-50' : 'hidden' }}">
                        CLOSED</p>
                </div>
            </div>
        </form>
    </div>
    @include('livewire.guest.event-report-list.hazard.modalDetail')
    <input type="checkbox" id="delete" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <p class="py-4 text-2xl font-bold text-center">{{ __('ars') }} : {{ $reference }} ?</p>
            <div class="modal-action">
                <label wire:click='deleted' class="btn btn-xs btn-success">{{ __('Yes') }}</label>
                <label for="delete" class="btn btn-xs btn-error">{{ __('No') }}</label>
            </div>
        </div>
    </div>

    <style>
        .ck-editor__editable[role="textbox"] {
            /* Editing area */
            /* min-height: 200px; */
            padding: 25px !IMPORTANT;
        }
    </style>
    <script>
        var hazardClose = "<?php echo "$hazardClose"; ?>";
        // rincian_bahaya
        ClassicEditor
            .create(document.querySelector('#rincian_bahaya'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (hazardClose === 'Closed' || hazardClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#rincian_bahaya');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#rincian_bahaya');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('rincian_bahaya', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // tindakan_perbaikan
        ClassicEditor
            .create(document.querySelector('#tindakan_perbaikan'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']


            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (hazardClose === 'Closed' || hazardClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#tindakan_perbaikan');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#tindakan_perbaikan');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('tindakan_perbaikan', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // tindakan_perbaikan_disarankan
        ClassicEditor
            .create(document.querySelector('#tindakan_perbaikan_disarankan'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (hazardClose === 'Closed' || hazardClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#tindakan_perbaikan_disarankan');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#tindakan_perbaikan_disarankan');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('tindakan_perbaikan_disarankan', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // komentar
        ClassicEditor
            .create(document.querySelector('#komentar'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (hazardClose === 'Closed' || hazardClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#komentar');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#komentar');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('komentar', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>


</div>
