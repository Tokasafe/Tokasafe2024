<div>
    @include('toast.toast')

    @push('scripts')
        {{-- @livewireScripts() --}}
        {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="../../flatpickr/dist/plugins/monthSelect/index.js"></script> --}}
        <script>
            const modalact = document.getElementById("closeModalAction");
            $(document).on('click', '#closed', function() {
                modalact.click()
            });
        </script>

        <script>
            flatpickr("#due_date", {
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
            flatpickr("#completion", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
        </script>
    @endpush
    <div class="flex justify-between mx-4 mt-4">
        <div class="{{$guest_respons?'block':'hidden'}}">
            @livewire('event-report-list.hazard-id.action.create', ['id' => $ID_Details])
        </div>
        <div class="hidden">


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

        <div class="overflow-x-auto">
            <table class="table table-xs">

                <tbody>
                    @forelse($EventAction as $index =>$value )
                      
                    <tr class="border-b-2 border-gray-400">
                        <td>
                            <table class="table table-xs">
                                <tr valign="top">
                                    <td>
                                        <p class="font-bold leading-loose text-[10px]">Action No.   {{ $EventAction->firstItem() + $index }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="table table-xs">
                                <tr >
                                    <td>
                                       <p class="text-justify text-[11px] font-bold">Observation, Hazard or Non-Conformance</p>
                                    </td>
                                    <td>
                                        <p class="text-[10px]">{{$value->HazardId->task}}</p>
                                    </td>
                                </tr>
                              
                                <tr >
                                    <td>
                                       <p class="text-justify text-[11px] font-bold">Followup Action</p>
                                    </td>
                                    <td>
                                        <p class="text-justify text-[10px] text-wrap w-96 "> {{$value->followup_action}}</p>
                                    </td>
                                </tr>

                                <tr >
                                    <td>
                                       <p class="text-justify text-[11px] font-bold">Actionee Comments</p>
                                    </td>
                                    <td>
                                        <p class="text-justify text-[10px] text-wrap w-96 " >{{$value->actionee_comments}}</p>
                                    </td>
                                </tr>
                        
                                <tr >
                                    <td>
                                       <p class="text-justify text-[11px] font-bold">Action Conditions</p>
                                    </td>
                                    <td>
                                        <p class="text-justify text-[10px] text-wrap w-96 " >{{$value->action_condition}}</p>
                                    </td>
                                </tr>
                               
                                
                            </table>
                        </td>
                        <td>
                            <table class="table table-xs">
                               
                              
                                <tr valign="top">
                                    <td>
                                       <p class="text-justify text-[11px] font-bold ">Responsibility</p> 
                                    </td>
                                    <td>
                                        <span id="ctl00_cphMain_gdvActionList_ctl03_eaRow_lblResponsibility">{{$value->responsibility?$value->People->lookup_name:'-'}}</span>
                                    </td>
                                </tr>
                               
                                <tr valign="top">
                                    <td>
                                       <p class="text-justify text-[11px] font-bold">Due Date</p> 
                                    </td>
                                    <td>
                                        <span id="ctl00_cphMain_gdvActionList_ctl03_eaRow_lblDueDate">{{$value->due_date?date('d-m-Y',strtotime($value->due_date)):'-'}}</span>
                                    </td>
                                </tr>
                               
                                <tr valign="top">
                                    <td>
                                       <p class=" text-[11px] font-bold">Completion Date</p> 
                                    </td>
                                    <td>
                                        <span id="text-[11px]">{{$value->competed?date('d-m-Y',strtotime($value->competed)):'-'}}</span>
                                    </td>
                                </tr>
                               
                                
                            </table>
                        </td>
                        <td>
                            <table class="table table-xs">
                                <tr valign="top">
                                    <td class="{{$guest_respons?'block':'hidden'}}">
                                        <div class="flex flex-row justify-center gap-1">
        
                                            <label  wire:click="update({{ $value->id }})"
                                                class="btn btn-xs {{$hazardClose?'btn-disabled':''}} btn-warning ">Edit</label>
                                            <label wire:click="delete({{ $value->id }})"
                                                class="btn btn-xs {{$hazardClose?'btn-disabled':''}} btn-error ">{{ __('Delete') }}</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                   
                    @empty
                        <tr>
                            <th class="font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-rose-500 animate-pulse">{{__('Tindakan_Perbaikan_empty')}}</th>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

        
    </div>
    <div>{{ $EventAction->links() }}</div>
    @livewire('event-report-list.hazard-id.action.update')
    <input type="checkbox" id="delete_data_act" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete?</h4>
            <form wire:submit.prevent='deleteFileAction'>

                <div class="modal-action">
                    <button type="submit" id="closed" class="text-white btn btn-success btn-xs">Yes
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </button>
                    <label id="closeModalAction" for="delete_data_act" class="btn btn-xs btn-error">No!</label>
                </div>
            </form>
        </div>
    </div>
</div>
