<div >
    @include('toast.toast')
    @push('styles')
        @livewireStyles()
        <script src="https://kit.fontawesome.com/3de311882c.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
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
        {{-- <script>
            const modal = document.getElementById("closeModalAction");
            $(document).on('click', '#close', function() {
                modal.click()
            });
        </script> --}}
        {{-- <script src="../../flatpickr/dist/plugins/rangePlugin.js"></script> --}}

        <script src="../../flatpickr/dist/plugins/monthSelect/index.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      
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
        <form  wire:submit.prevent='updateStore' wire:loading.class="skeleton" wire:target="updateStore">
            @csrf
            @method('PATCH')
            <div class="top-0 z-10 p-1 bg-white shadow-md sm:sticky">
                <button type="submit" id="my-submit"
                    class="text-white btn btn-success btn-xs btn-outline">{{ __('Save') }}
                    <svg wire:loading.remove wire:target="updateStore" xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                    </svg>
                    <span wire:loading wire:target="updateStore" wire:loading.delay.long
                        wire:loading.class="bg-rose-500" class="hidden loading loading-spinner loading-sm"></span>
                </button>
                <label wire:click='delete' class="text-white btn btn-xs btn-outline btn-error">{{ __('Delete') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd"
                            d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                            clip-rule="evenodd" />
                    </svg>

                </label>
            </div>
            <div  class=" {{ $IncidentClose ? 'stack ' : '' }}">
                <div
                    class=" {{ $IncidentClose ? 'overflow-y-auto h-[520px] sm:h-auto md:h-auto lg:h-auto xl:h-[19.5rem] 2xl:h-[40rem] p-2 ' : 'overflow-y-auto h-[520px] sm:h-auto md:h-auto lg:h-auto xl:h-[19.5rem] 2xl:h-[40rem] p-2 ' }}">
                    <div class="flex flex-wrap gap-1 sm:grid md:grid-cols-3 xl:grid-cols-4">
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
                                    class="border btn btn-xs btn-square join-item @error('workgroup') btn-error @enderror" btn-info {{ $IncidentClose ? 'btn-disabled' : '' }}">
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
                                    class="border btn btn-xs btn-square join-item @error('reporter_name') btn-error @enderror" btn-info {{ $IncidentClose ? 'btn-disabled' : '' }}">
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
                                    class="border btn btn-xs btn-square join-item @error('report_to') btn-error @enderror" btn-info {{ $IncidentClose ? 'btn-disabled' : '' }}">
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

                            <fieldset
                                class="flex items-start p-[3px] border @error('potential_lti') border-rose-500 border-2 @enderror gap-0.5">
                                <input wire:model.live="potential_lti" name="radio-10" id="yes"
                                    @if ($IncidentClose) disabled @endif
                                    class="radio-xs peer/yes checked:bg-rose-500 radio" type="radio" name="status"
                                    value="Yes" />
                                <label for="yes"
                                    class="text-xs font-semibold peer-checked/yes:text-rose-500">{{ __('Yes') }}</label>

                                <input wire:model.live="potential_lti" name="radio-10" id="no"
                                    @if ($IncidentClose) disabled @endif
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
                                    wire:model=documentation
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
                                <div
                                    class="flex-none w-6 mt-[25px] ">

                                    @include('livewire.event-report-list.insident.svgCreate')

                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-1 xl:flex-none xl:grid-cols-2">
                        <div>
                            <div wire:ignore class="w-full ">
                                <x-input-label-bhy :value="__('deskripsi')" />
                                <textarea id="description_incident" placeholder="Bio" wire:model='description_incident'
                                    class="@error('description_incident') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1">{{ $description_incident }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('description_incident')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full ">
                                <x-input-label-req :value="__('InvolvedPerson')" />
                                <textarea id="involved_person" placeholder="Bio" wire:model='involved_person'
                                    class="@error('involved_person') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1">{{ $involved_person }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('involved_person')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full ">
                                <x-input-label-req :value="__('InvolvedEquipment')" />
                                <textarea id="involved_equipment" placeholder="Bio" wire:model='involved_equipment'
                                    class="@error('involved_equipment') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1">{{ $involved_equipment }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('involved_equipment')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full ">
                                <x-input-label-req :value="__('PreliminaryCauses')" />
                                <textarea id="preliminary_causes" placeholder="Bio" wire:model='preliminary_causes'
                                    class="@error('preliminary_causes') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1">{{ $preliminary_causes }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('preliminary_causes')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full ">
                                <x-input-label-req :value="__('ImmediateActionTaken')" />
                                <textarea id="imediate_action_taken" placeholder="Bio" wire:model='imediate_action_taken'
                                    class="@error('imediate_action_taken') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1">{{ $imediate_action_taken }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('imediate_action_taken')" class="mt-0" />
                        </div>
                        <div>
                            <div wire:ignore class="w-full ">
                                <x-input-label-req :value="__('KeyLearning')" />
                                <textarea id="key_learning" placeholder="Bio" wire:model='key_learning'
                                    class="@error('key_learning') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1">{{ $key_learning }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('key_learning')" class="mt-0" />
                        </div>
                    </div>
                    @include('livewire.event-report-list.insident.tablePenilaian')
                    <div class="flex flex-wrap justify-center gap-2 my-4 sm:justify-normal">
                        <div class="w-full p-4 ">
                            <div
                                class="font-extrabold text-transparent divider divider-info text-1xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                                {{ __('Tindakan_Perbaikan') }}</div>
                            @livewire('event-report-list.insident.action.index', ['id' => $data_id])
                        </div>
                    </div>
                </div>
                <div
                    class=" {{ $IncidentClose ? 'overflow-y-auto h-full sm:h-[14rem] xxl:h-[16rem] 2xl:h-[34rem] flex justify-center ' : '' }} ">
                    <p
                        class=" {{ $IncidentClose ? 'self-center text-6xl sm:text-9xl font-black font-mono text-gray-300 italic z-50' : 'hidden' }}">
                        CLOSED</p>
                </div>
        </form>
    </div>

    @include('livewire.event-report-list.insident.modal')
    {{-- MODAL DELETE --}}
    <div class="{{ $modalDelete }}">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete?</h4>
            <form wire:submit.prevent='deleteFileAction'>

                <div class="modal-action">
                    <button type="submit" id="closed" class="text-white btn btn-success btn-xs">Yes
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </button>
                    <label wire:click='deleteClose' class="btn btn-xs btn-error">No!</label>
                </div>
            </form>
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
        var IncidentClose = "<?php echo "$IncidentClose"; ?>";
        // description_incident
        ClassicEditor
            .create(document.querySelector('#description_incident'), {

                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (IncidentClose === 'Closed' || IncidentClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#description_incident');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#description_incident');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('description_incident', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // involved_person
        ClassicEditor
            .create(document.querySelector('#involved_person'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']


            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (IncidentClose === 'Closed' || IncidentClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#involved_person');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#involved_person');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('involved_person', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // involved_equipment
        ClassicEditor
            .create(document.querySelector('#involved_equipment'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (IncidentClose === 'Closed' || IncidentClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#involved_equipment');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#involved_equipment');
                }
                newEditor.model.document.on('change:data', () => {
                    console.log(newEditor.getData());
                    @this.set('involved_equipment', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // preliminary_causes
        ClassicEditor
            .create(document.querySelector('#preliminary_causes'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (IncidentClose === 'Closed' || IncidentClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#preliminary_causes');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#preliminary_causes');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('preliminary_causes', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // imediate_action_taken
        ClassicEditor
            .create(document.querySelector('#imediate_action_taken'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (IncidentClose === 'Closed' || IncidentClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#imediate_action_taken');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#imediate_action_taken');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('imediate_action_taken', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // key_learning
        ClassicEditor
            .create(document.querySelector('#key_learning'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (IncidentClose === 'Closed' || IncidentClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#key_learning');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#key_learning');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('key_learning', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</div>
