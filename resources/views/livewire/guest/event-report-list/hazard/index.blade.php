<div class="">
  
    @push('styles')
        @livewireStyles()
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <link rel="stylesheet" href="../../flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="../../flatpickr/dist/plugins/monthSelect/style.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../flatpickr/dist/themes/dark.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
    @push('scripts')
        @livewireScripts()
        <script src="../../ckeditor5/js/index.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            const modal = document.getElementById("closeModal");
            $(document).on('click', '#close', function() {
                modal.click()
            });
        </script>
        {{-- <script src="../../flatpickr/dist/plugins/rangePlugin.js"></script> --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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

                      tglMulai=  year + '-' + month + '-' + dt;
                      tglAkhir=  year2 + '-' + month2 + '-' + dt2;

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
        <div class="flex flex-col gap-1 join sm:flex-row sm:gap-0">  
           
            <div class="relative flex items-center w-full max-w-xs join-item ">
                <input id="rangeDate" type="text" readonly wire:model='dateRange'
                    class="relative w-full   peer input input-bordered pl-6 input-xs text-[9px] font-semibold focus:ring-1 focus:outline-none focus:drop-shadow-lg"
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
                    <option class="text-center" value="" selected>Initial Incident Class</option>
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
                    class="relative w-full sm:w-auto max-w-xs pl-6 peer select select-bordered select-xs text-[10px] font-semibold focus:ring-1 focus:outline-none focus:drop-shadow-lg"
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
    <div class="grid ">
        <div class="overflow-x-auto">
            <table class="table table-xs table-zebra">
                <thead class="bg-gray-400">
                    <tr class="text-center ">
                        <th>#</th>
                        <th>{{__('date')}}</th>
                        <th>{{ __('reference') }}</th>
                        <th>{{ __('est') }}</th>
                        <th>{{ __('rw') }}</th>
                        <th>{{ __('rincian_bahaya') }}</th>
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
                                <p class="w-32 truncate">{{ $item->Hazard->tindakan_perbaikan }}</p>
                            </td>
                            <td>

                                @if (!empty($event_action->where('event_hzd_id', $item->Hazard->id)->first()->event_hzd_id))
                                    {{ $event_action->where('event_hzd_id', $item->Hazard->id)->count('due_date') }}/{{ $event_action->where('event_hzd_id', $item->Hazard->id)->whereNull('competed')->count() }}
                                @else
                                    0/0
                                @endif
                            </td>
                            <td
                                class="
                            {{ $item->WorkflowStep->StatusCode->name === 'Submitted' ? 'bg-cyan-500 text-white font-semibold' : '' }}
                            {{ $item->WorkflowStep->StatusCode->name === 'In Progress' ? 'bg-emerald-500 text-white font-semibold' : '' }}
                            {{ $item->WorkflowStep->StatusCode->name === 'Pending' ? 'bg-amber-500 text-white font-semibold' : '' }}
                            {{ $item->WorkflowStep->StatusCode->name === 'Closed' ? 'bg-sky-500 text-white font-semibold' : '' }}
                            {{ $item->WorkflowStep->StatusCode->name === 'Cancelled' ? 'bg-rose-500 text-white font-semibold' : '' }}">
                                {{ $item->WorkflowStep->StatusCode->name }}
                            </td>

                            <td>
                                <div class="flex flex-row justify-center gap-1">
                                    <a href="{{ route('hazardDetailsGuest', $item->Hazard->id) }}"
                                        class="btn btn-xs btn-warning">Details</a>
                                   
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="9" class="font-semibold text-rose-500">

                                <p class="flex justify-center"> Data not found <span
                                        class="loading loading-bars loading-xs"> </span></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-400">
                    <tr class="text-center">
                        <th>#</th>
                        <th>{{__('date')}}</th>
                        <th>{{ __('reference') }}</th>
                        <th>{{ __('est') }}</th>
                        <th>{{ __('rw') }}</th>
                        <th>{{ __('rincian_bahaya') }}</th>
                        <th>{{ __('Actions_Total_Open') }}</th>
                        <th>Status</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div>{{ $PanelHazardId->links() }}</div>

   
</div>
