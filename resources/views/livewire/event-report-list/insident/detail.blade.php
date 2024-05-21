<div>
    @include('toast.toast')
    @push('styles')
        @livewireStyles()
        <script src="https://kit.fontawesome.com/3de311882c.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="../../flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="../../flatpickr/dist/plugins/monthSelect/style.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../flatpickr/dist/themes/dark.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
    @push('scripts')
        @livewireScripts()
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            const modal = document.getElementById("closeModal");
            $(document).on('click', '#close', function() {
                modal.click()
            });
        </script>
        {{-- <script src="../../flatpickr/dist/plugins/rangePlugin.js"></script> --}}

        <script src="../../flatpickr/dist/plugins/monthSelect/index.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("#tanggal", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });

            flatpickr("#tglLapor", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#jamKejadian", {
                disableMobile: "true",
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                // time_24hr: true
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

            $("#rangeDate").flatpickr({
                mode: 'range',
                dateFormat: "d-m-Y", //defaults to "F Y"
                onChange: function(dates) {
                    if (dates.length === 2) {

                        var start = new Date(dates[0]);
                        var end = new Date(dates[1]);

                        year = start.getFullYear();
                        month = start.getMonth() + 1;
                        dt = start.getDate();

                        if (dt < 10) {
                            dt = '0' + dt;
                        }
                        if (month < 10) {
                            month = '0' + month;
                        }
                        year2 = end.getFullYear();
                        month2 = end.getMonth() + 1;
                        dt2 = end.getDate();

                        if (dt2 < 10) {
                            dt2 = '0' + dt2;
                        }
                        if (month2 < 10) {
                            month2 = '0' + month2;
                        }

                        tglMulai = year + '-' + month + '-' + dt;
                        tglAkhir = year2 + '-' + month2 + '-' + dt2;
                        livewire.emit('TglMulai', tglMulai);
                        livewire.emit('TglAkhir', tglAkhir);
                    }
                }
            })
        </script>
    @endpush
    @section('bradcrumbs')
        {{ Breadcrumbs::render('incident_details', $data_id) }}
    @endsection
    <div class="p-2 m-1 rounded-md sm:w-full ">

        <div class="flex flex-row pl-2 sm:pl-0">
            <div class="w-20 text-xs font-semibold text-gray-500 ">{{ __('reference') }}</div>
            <div class="w-40 text-xs font-semibold text-gray-500">: {{ $reference }}</div>
        </div>
        <div class="flex flex-row pl-2 sm:pl-0">
            <div class="w-20 text-xs font-semibold text-gray-500 ">{{ __('date') }}</div>
            <div class="w-40 text-xs font-semibold text-gray-500">: {{ date('d-M-Y', strtotime($date_event)) }}
            </div>
        </div>
        <div class="flex flex-row pl-2 sm:pl-0">
            <div class="w-20 text-xs font-semibold text-gray-500 ">{{ __('Workgroup') }}</div>
            <div class="text-xs font-semibold text-gray-500 ">: {{ $workgroup }}</div>
        </div>
    </div>
    @livewire('event-report-list.insident.panel.index', ['id' => $data_id])
    <div class="shadow-md ">
        <form wire:submit.prevent='updateStore' wire:loading.class="skeleton" wire:target="updateStore">
            @csrf
            @method('PATCH')
            <div class="top-0 z-10 p-1 bg-white shadow-md sm:sticky">
                <button type="submit" id="my-submit" class="text-white btn btn-success btn-xs">{{ __('Save') }}
                    <svg wire:loading.remove wire:target="updateStore" xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                    </svg>
                    <span wire:loading wire:target="updateStore" wire:loading.delay.long
                        wire:loading.class="bg-rose-500" class="hidden loading loading-spinner loading-sm"></span>
                </button>
                <label for="my_modal_3" class="text-white btn btn-xs btn-error">{{ __('Delete') }}!</label>
            </div>
            <div class=" {{ $IncidentClose ? 'stack' : '' }}">
                <div
                    class=" {{ $IncidentClose ? 'overflow-y-auto sm:h-[18rem] xxl:h-[22rem] 2xl:h-[40rem] p-2' : 'overflow-y-auto sm:h-[18rem] xl:h-[20rem] 2xl:h-[40rem] p-2 ' }}">
                    <div class="flex flex-wrap gap-1 sm:grid sm:grid-cols-4">
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('et')" />
                            <select wire:model='event_type'
                                class=" @error('event_type') border-rose-500 border-2 @enderror select select-bordered select-xs w-full max-w-xl focus:outline-none  focus:ring-success focus:ring-1"
                                @if ($IncidentClose) disabled @endif>
                                <option selected>{{ __('select_option') }}</option>
                                @foreach ($EventType as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('event_type')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('est')" />
                            <select wire:model='sub_type'
                                class=" @error('sub_type') border-rose-500 border-2 @enderror select select-bordered select-xs w-full max-w-xl focus:outline-none  focus:ring-success focus:ring-1"
                                @if ($IncidentClose) disabled @endif>
                                <option selected>{{ __('select_option') }}</option>
                                @foreach ($EventSubType as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('sub_type')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('rw')" />
                            <label class="join " wire:click='openWokrgroup'>
                                <input type="text" placeholder="Type here" wire:model='workgroup' readonly
                                    class=" @error('workgroup') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1"
                                    @if ($IncidentClose) disabled @endif />
                                <label for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info {{ $IncidentClose ? 'btn-disabled' : '' }}">
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
                            <x-input-label-req :value="__('nama_pelapor')" />
                            <label class="join" wire:click='openReportBy'>
                                <input type="text" placeholder="Type here" wire:model='reporter_name' readonly
                                    class=" @error('reporter_name') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1"
                                    @if ($IncidentClose) disabled @endif />
                                <label for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info {{ $IncidentClose ? 'btn-disabled' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('reporter_name')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('pengawas_area')" />
                            <label wire:click='openReportTo' class="join">
                                <input type="text" placeholder="Type here" wire:model='report_to'
                                    class=" @error('report_to') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-xs focus:outline-none  focus:ring-success focus:ring-1"
                                    @if ($IncidentClose) disabled @endif />
                                <label for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info {{ $IncidentClose ? 'btn-disabled' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('report_to')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('el')" />
                            <select wire:model='location'
                                class=" @error('location') border-rose-500 border-2 @enderror select select-bordered select-xs w-full max-w-xl focus:outline-none  focus:ring-success focus:ring-1"
                                @if ($IncidentClose) disabled @endif>
                                <option selected>{{ __('select_option') }}</option>
                                @foreach ($Location as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('location')" class="mt-0" />
                        </div>

                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('tanggal_kejadian')" />
                            <input type="text" id="tglLapor" placeholder="Type here" wire:model='date_event'
                                readonly
                                class=" @error('date_event') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1"
                                @if ($IncidentClose) disabled @endif />
                            <x-input-error :messages="$errors->get('date_event')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('time_event')" />
                            <input type="text" id="jamKejadian" placeholder="Type here" wire:model='time_event'
                                readonly
                                class=" @error('time_event') border-rose-500 border-2 @enderror w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1"
                                @if ($IncidentClose) disabled @endif />
                            <x-input-error :messages="$errors->get('time_event')" class="mt-0" />
                        </div>


                        <div class="w-full max-w-xl form-control ">
                            <x-input-label-req :value="__('BerpotensiLTI')" />

                            <fieldset class="px-1 py-0 border">
                                <input wire:model.live="potential_lti" name="radio-10" id="yes" @if ($IncidentClose) disabled @endif
                                    class="radio-xs peer/yes checked:bg-rose-500 radio" type="radio" name="status"
                                    value="Yes" />
                                <label for="yes"
                                    class="text-xs font-semibold peer-checked/yes:text-rose-500">{{ __('Yes') }}</label>

                                <input wire:model.live="potential_lti" name="radio-10" id="no" @if ($IncidentClose) disabled @endif
                                    class="radio-xs peer/no checked:bg-sky-500 radio" type="radio" name="status"
                                    value="No" />
                                <label for="no"
                                    class="text-xs font-semibold peer-checked/no:text-sky-500">{{ __('No') }}</label>

                            </fieldset>
                            <x-input-error :messages="$errors->get('potential_lti')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control ">
                            <x-input-label :value="__('insidenlingkungan')" />
                            <select wire:model='env_incident'
                                class=" @error('env_incident') border-rose-500 border-2 @enderror select select-bordered select-xs w-full max-w-xl focus:outline-none  focus:ring-success focus:ring-1"
                                @if ($IncidentClose) disabled @endif>
                                <option selected>{{ __('select_option') }}</option>
                                <option value="Level 1">Level 1</option>
                                <option value="Level 2">Level 2</option>
                                <option value="Level 3">Level 3</option>
                            </select>
                            <x-input-error :messages="$errors->get('env_incident')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xl form-control">
                            <x-input-label-req :value="__('tugas')" />
                            <input type="text" placeholder="Type here" wire:model='task'
                                class=" @error('task') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1"
                                @if ($IncidentClose) disabled @endif />
                            <x-input-error :messages="$errors->get('task')" class="mt-0" />
                        </div>
                        <div class="flex flex-row w-full max-w-xl form-control">
                            <div class="flex-initial w-[650px]">

                                <x-input-label :value="__('documentation')" />

                                <input type="file" @if ($IncidentClose) disabled @endif
                                    class=" @error('documentation') border-rose-500 border-2 @enderror file-input  file-input-bordered file-input-primary w-full m file-input-xs  focus:outline-none  focus:ring-success focus:ring-1" />
                                <x-input-error :messages="$errors->get('documentation')" class="mt-0" />
                            </div>
                            @if ($filename)
                                <div wire:click='download' class="flex-none w-10 cursor-pointer ">
                                    <div class="p-2 mt-4">
                                        @include('livewire.event-report-list.insident.svg')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2 ">
                        <div>
                            <div wire:ignore class="w-full max-w-md sm:max-w-[625px] form-control">
                                <x-input-label-bahaya :value="__('deskripsi')" />
                                <textarea id="editor1" placeholder="Bio" wire:model='description_incident'
                                    class="@error('description_incident') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"
                                    @if ($IncidentClose) disabled @endif>{{ $description_incident }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('description_incident')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full max-w-md sm:max-w-[625px] form-control">
                                <x-input-label-req :value="__('InvolvedPerson')" />
                                <textarea id="editor2" placeholder="Bio" wire:model='involved_person'
                                    class="@error('involved_person') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"
                                    @if ($IncidentClose) disabled @endif></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('involved_person')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full max-w-md sm:max-w-[625px] form-control">
                                <x-input-label-req :value="__('InvolvedEquipment')" />
                                <textarea id="editor3" placeholder="Bio" wire:model='involved_person'
                                    class="@error('involved_equipment') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"
                                    @if ($IncidentClose) disabled @endif></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('involved_equipment')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full max-w-md sm:max-w-[625px] form-control">
                                <x-input-label-req :value="__('PreliminaryCauses')" />
                                <textarea id="editor4" placeholder="Bio" wire:model='preliminary_causes'
                                    class="@error('preliminary_causes') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"
                                    @if ($IncidentClose) disabled @endif></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('preliminary_causes')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full max-w-md sm:max-w-[625px] form-control">
                                <x-input-label-req :value="__('ImmediateActionTaken')" />
                                <textarea id="editor5" placeholder="Bio" wire:model='imediate_action_taken'
                                    class="@error('imediate_action_taken') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"
                                    @if ($IncidentClose) disabled @endif></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('imediate_action_taken')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full max-w-md sm:max-w-[625px] form-control">
                                <x-input-label-req :value="__('KeyLearning')" />
                                <textarea id="editor6" placeholder="Bio" wire:model='key_learning'
                                    class="@error('key_learning') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"
                                    @if ($IncidentClose) disabled @endif></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('key_learning')" class="mt-0" />
                        </div>
                    </div>
                    @include('livewire.event-report-list.insident.tablePenilaian')
        </form>
        <div class="flex flex-wrap justify-center gap-2 my-4 sm:justify-normal">
            <div class="w-full p-4 border border-accent" >
                <div class="font-semibold divider divider-accent">{{__("Tindakan_Perbaikan")}}</div>
                @livewire('event-report-list.insident.action.index', ['id' => $data_id])
            </div>
        </div>
    </div>
    <div
        class=" {{ $IncidentClose ? 'overflow-y-auto sm:h-[14rem] xxl:h-[16rem] 2xl:h-[34rem] flex justify-center ' : '' }} ">
        <p
            class=" {{ $IncidentClose ? 'self-center text-6xl sm:text-9xl font-black font-mono text-gray-300 italic z-50' : 'hidden' }}">
            CLOSED</p>
    </div>
</div>
</div>
@include('livewire.event-report-list.insident.modal')
<script>
    var IncidentClose = "<?php echo "$IncidentClose"; ?>";
    const editor = CKEDITOR.replace('editor1');
    editor.config.uiColor = '#bae6fd';
    editor.config.height = 150;

    editor.config.toolbar = [{
            name: 'clipboard',
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {
            name: 'editing',
            items: ['Scayt']
        },

        {
            name: 'tools',
            items: ['Maximize']
        },
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'styles',
            items: ['Styles', 'Format']
        },

    ];
    editor.on('change', function(event) {
        // console.log(event.editor.getData())
        @this.set('description_incident', event.editor.getData())
    })
    const editor2 = CKEDITOR.replace('editor2');
    editor2.config.uiColor = '#bae6fd';
    editor2.config.height = 150;

    editor2.config.toolbar = [{
            name: 'clipboard',
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {
            name: 'editing',
            items: ['Scayt']
        },

        {
            name: 'tools',
            items: ['Maximize']
        },
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'styles',
            items: ['Styles', 'Format']
        },

    ];

    editor2.on('change', function(event) {
        console.log(event.editor.getData())
        @this.set('involved_person', event.editor.getData())
    })
    const editor3 = CKEDITOR.replace('editor3');
    editor3.config.uiColor = '#bae6fd';
    editor3.config.height = 150;

    editor3.config.toolbar = [{
            name: 'clipboard',
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {
            name: 'editing',
            items: ['Scayt']
        },

        {
            name: 'tools',
            items: ['Maximize']
        },
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'styles',
            items: ['Styles', 'Format']
        },

    ];

    editor3.on('change', function(event) {
        // console.log(event.editor3.getData())
        @this.set('involved_equipment', event.editor.getData())
    })
    const editor4 = CKEDITOR.replace('editor4');
    editor4.config.uiColor = '#bae6fd';
    editor4.config.height = 150;

    editor4.config.toolbar = [{
            name: 'clipboard',
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {
            name: 'editing',
            items: ['Scayt']
        },

        {
            name: 'tools',
            items: ['Maximize']
        },
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'styles',
            items: ['Styles', 'Format']
        },

    ];

    editor4.on('change', function(event) {
        // console.log(event.editor4.getData())
        @this.set('preliminary_causes', event.editor.getData())
    })
    const editor5 = CKEDITOR.replace('editor5');
    editor5.config.uiColor = '#bae6fd';
    editor5.config.height = 150;

    editor5.config.toolbar = [{
            name: 'clipboard',
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {
            name: 'editing',
            items: ['Scayt']
        },

        {
            name: 'tools',
            items: ['Maximize']
        },
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'styles',
            items: ['Styles', 'Format']
        },

    ];

    editor5.on('change', function(event) {
        // console.log(event.editor5.getData())
        @this.set('imediate_action_taken', event.editor.getData())
    })
    const editor6 = CKEDITOR.replace('editor6');
    editor6.config.uiColor = '#bae6fd';
    editor6.config.height = 150;

    editor6.config.toolbar = [{
            name: 'clipboard',
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {
            name: 'editing',
            items: ['Scayt']
        },

        {
            name: 'tools',
            items: ['Maximize']
        },
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'styles',
            items: ['Styles', 'Format']
        },

    ];

    editor6.on('change', function(event) {
        // console.log(event.editor6.getData())
        @this.set('key_learning', event.editor.getData())
    })
    if (IncidentClose === 'Closed' || IncidentClose === 'Cancelled') {
        editor.config.readOnly = true;
        editor2.config.readOnly = true;
        editor3.config.readOnly = true;
        editor4.config.readOnly = true;
        editor5.config.readOnly = true;
        editor6.config.readOnly = true;
        // color
        editor.config.uiColor = '#e2e8f0';
        editor2.config.uiColor = '#e2e8f0';
        editor3.config.uiColor = '#e2e8f0';
        editor4.config.uiColor = '#e2e8f0';
        editor5.config.uiColor = '#e2e8f0';
        editor6.config.uiColor = '#e2e8f0';
    }
    window.addEventListener('articleStore', event => {

        CKEDITOR.instances['editor1'].setData('');
        CKEDITOR.instances['editor2'].setData('');
        CKEDITOR.instances['editor3'].setData('');
        CKEDITOR.instances['editor4'].setData('');
        CKEDITOR.instances['editor5'].setData('');
        CKEDITOR.instances['editor6'].setData('');
    })
</script>
</div>
