<div class=" mx-4 md:mx-0">

    @push('styles')
        @livewireStyles()
        <style>
            .ck-editor__editable[role="textbox"] {
                /* Editing area */
                /* min-height: 200px; */
                padding: 25px !IMPORTANT;
            }
        </style>
      
        <link rel="stylesheet" type="text/css" href="{{ asset('toastify/css/toastify.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('flatpickr/dist/flatpickr.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('flatpickr/dist/plugins/monthSelect/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('flatpickr/dist/themes/dark.css') }}">
        <script type="text/javascript" src="{{ asset('ckeditor/classic/js/ckeditor.js') }}"></script>
    @endpush
    @push('scripts')
        @livewireScripts()
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('flatpickr/dist/plugins/monthSelect/index.js') }}"></script>
        <script type="text/javascript" src="{{ asset('toastify/js/toastify.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      
        <script>
            const modal = document.getElementById("closeModal");
            $(document).on('click', '#close', function() {
                modal.click()
            });
        </script>
        <script>
            flatpickr("#tanggal", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });

            flatpickr("#tglLapor", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#due_date", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#completion", {
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

            $("#rangeDate").flatpickr({
                mode: 'range',
                dateFormat: "d-m-Y", //defaults to "F Y"
                onChange: function(dates) {
                    if (dates.length === 2) {
                        // var d = new Date(dates[0]);
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

                        // console.log(start.toISOString());
                        // console.log(end.toISOString());
                        livewire.emit('TglMulai', tglMulai);
                        livewire.emit('TglAkhir', tglAkhir);
                    }
                }
            })
        </script>
    @endpush
    @include('toast.toast')
    @section('bradcrumbs')
        {{ Breadcrumbs::render('hazard') }}
    @endsection

    <div class="items-center justify-between flex-none my-4 sm:flex sm:p-0">
        <div class="">
            @livewire('event-report-list.hazard-id.create')
        </div>
        <div class="flex flex-col join lg:flex-row sm:gap-0 ">

            <div class="relative flex items-center w-full max-w-xs join-item ">
                <input id="rangeDate" type="text" readonly wire:model='dateRange'
                    class="relative w-full   peer input input-bordered pl-6 input-xs text-[10px] lg:text-[9px] font-semibold focus:ring-1 focus:outline-none focus:drop-shadow-lg"
                    placeholder="date range" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="absolute w-4 h-4 pl-0.5 pl-0.5 opacity-70 left-2">
                    <path fill-rule="evenodd"
                        d="M4 1.75a.75.75 0 0 1 1.5 0V3h5V1.75a.75.75 0 0 1 1.5 0V3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2V1.75ZM4.5 6a1 1 0 0 0-1 1v4.5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-7Z"
                        clip-rule="evenodd" />
                </svg>

            </div>
            <div class="relative flex items-center w-full max-w-xs join-item ">
                <select type="text" wire:model='search_eventsubtype'
                    class="relative w-full sm:w-full max-w-xs pl-6 peer select select-bordered select-xs text-[10px] font-semibold focus:ring-1 focus:outline-none focus:drop-shadow-lg"
                    placeholder="Initial Incident Class">
                    <option value="" selected>Initial Incident Class</option>
                    @foreach ($EventType as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach

                </select>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="absolute w-4 h-4 pl-0.5 opacity-70 left-2">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="relative flex items-center w-full max-w-xs join-item ">
                <select type="text" wire:model='search_eventsubtype'
                    class="relative w-full sm:w-full max-w-xs pl-6 peer select select-bordered select-xs text-[10px] font-semibold focus:ring-1 focus:outline-none focus:drop-shadow-lg"
                    placeholder="Initial Incident Class">
                    <option value="" selected>Sub {{ __('KelasInsidenAwal') }}</option>
                    @foreach ($EventSubType as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach

                </select>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="absolute w-4 h-4 pl-0.5 opacity-70 left-2">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="relative flex items-center w-full max-w-xs join-item ">
                <select type="text" wire:model='search_wg'
                    class="relative w-auto sm:w-auto max-w-xs pl-6 peer select select-bordered select-xs text-[10px] font-semibold focus:ring-1 focus:outline-none focus:drop-shadow-lg"
                    placeholder="Initial Incident Class">
                    <option class="text-center" value="" selected>Workgroup</option>
                    @foreach ($Workgroup as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->CompanyLevel->BussinessUnit->name }}-{{ $item->CompanyLevel->level }}-{{ $item->CompanyLevel->deptORcont }}
                            {{ $item->job_class }}</option>
                    @endforeach

                </select>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="absolute w-4 h-4 pl-0.5 opacity-70 left-2">
                    <path
                        d="M1 4a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4ZM10 5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V5ZM4 10a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H4Z" />
                </svg>

            </div>
        </div>
    </div>
   
        <div class="overflow-x-auto">
            <table class="table table-xs table-zebra">
                <thead class="bg-gray-400">
                    <tr class="text-center ">
                        <th>#</th>
                        <th>{{ __('date') }}</th>
                        <th>{{ __('reference') }}</th>
                        <th>{{ __('est') }}</th>
                        <th>{{ __('rw') }}</th>
                        <th>{{ __('tugas') }}</th>
                        <th>{{ __('Actions_Total_Open') }}</th>
                        <th>Status</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($PanelHazardId as $index => $item)
                        <tr class="text-center">
                            <th>{{ $PanelHazardId->firstItem() + $index }}</th>
                            <th>{{ date('d-m-Y', strtotime($item->Hazard->tanggal_kejadian)) }}</th>
                            <td class="font-semibold">{{ $item->Hazard->reference }}</td>
                            <td>{{ $item->Hazard->EventSubType->name }}</td>
                            <td>{{ $item->Hazard->Workgroup->CompanyLevel->BussinessUnit->name }}-{{ $item->Hazard->Workgroup->CompanyLevel->deptORcont }}-{{ $item->Hazard->Workgroup->job_class }}
                            </td>
                            <td>
                                <p class="w-40 truncate">{{ $item->Hazard->task }}</p>
                            </td>
                            <td>
                                @if (!empty($event_action->where('event_hzd_id', $item->Hazard->id)->first()->event_hzd_id))
                                    {{ $event_action->where('event_hzd_id', $item->Hazard->id)->count('due_date') }}/{{ $event_action->where('event_hzd_id', $item->Hazard->id)->whereNull('competed')->count() }}
                                @else
                                    0/0
                                @endif
                            </td>
                            <td class="
                            {{ $item->WorkflowStep->StatusCode->name === 'Submitted' ? 'bg-cyan-500 text-white font-semibold' : '' }}
                            {{ $item->WorkflowStep->StatusCode->name === 'In Progress' ? 'bg-emerald-500 text-white font-semibold' : '' }}
                            {{ $item->WorkflowStep->StatusCode->name === 'Pending' ? 'bg-amber-500 text-white font-semibold' : '' }}
                            {{ $item->WorkflowStep->StatusCode->name === 'Closed' ? 'bg-blue-500 text-white font-semibold' : '' }}
                            {{ $item->WorkflowStep->StatusCode->name === 'Cancelled' ? 'bg-rose-500 text-white font-semibold' : '' }}">
                                {{ $item->WorkflowStep->StatusCode->name }}
                            </td>
                            <td>
                                <div class="flex flex-row justify-center gap-1">
                                    <a href="{{ route('hazardDetails', $item->Hazard->id) }}"
                                        class="btn btn-xs btn-warning">Details</a>
                                    <label for="delete_data" wire:click="delete({{ $item->hazard_id }})"
                                        class="btn btn-xs btn-error ">Delete</label>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="9" class="font-semibold text-rose-500">

                                <p class="flex justify-center"> Data not found <span class="loading loading-bars loading-xs"> </span></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-400">
                    <tr class="text-center">
                        <th>#</th>
                        <th>{{ __('date') }}</th>
                        <th>{{ __('reference') }}</th>
                        <th>{{ __('est') }}</th>
                        <th>{{ __('rw') }}</th>
                        <th>{{ __('tugas') }}</th>
                        <th>{{ __('Actions_Total_Open') }}</th>
                        <th>Status</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
   
    <div>{{ $PanelHazardId->links() }}</div>


    <div class="{{$modal}}">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete {{ $reference }}?</h4>
            <form wire:submit.prevent='deleteFile'>
                <div class="modal-action">
                    <button  type="submit" class="text-white btn btn-success btn-xs">Yes
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </button>
                    <label  wire:click="closeModal" class="btn btn-xs btn-error">No!</label>
                </div>
            </form>
        </div>
    </div>
</div>
