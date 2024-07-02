<div class="mt-8">
    @push('styles')
        @livewireStyles()
        <link rel="stylesheet" type="text/css" href="{{ asset('toastify/css/toastify.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('flatpickr/dist/flatpickr.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('flatpickr/dist/plugins/monthSelect/style.css') }}" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('flatpickr/dist/themes/dark.css') }}">
    @endpush
    @push('scripts')
        @livewireScripts()
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script type="text/javascript" src="{{ asset('toastify/js/toastify.js') }}"></script>
        <script>
            const modal = document.getElementById("closeModal");
            $(document).on('click', '#close', function() {
                modal.click()
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="../../flatpickr/dist/plugins/monthSelect/index.js"></script>

        <script>
            flatpickr("#dateManhours", {
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
                dateFormat: "d-M-Y", //defaults to "F Y"
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
                        livewire.emit('TglMulai_m', tglMulai);
                        livewire.emit('TglAkhir_m', tglAkhir);
                    }
                }
            })

     
        
        </script>
    @endpush
    @include('toast.toast')
    @section('bradcrumbs')
    {{ Breadcrumbs::render('manhoursRegister') }}
@endsection
    <div class="flex justify-between mx-3 mt-3">
        <div class="flex">
            @livewire('manhours.manhours-register.create')
            <button
                    class="ml-2 btn  btn-square btn-primary btn-xs tooltip-primary  tooltip tooltip-top @if ($bulkDisable) hidden @endif"
                    data-tip="Download" wire:click="export">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="ml-0.5 size-4">
                        <path fill-rule="evenodd" d="M3.5 2A1.5 1.5 0 0 0 2 3.5v9A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 12.5 4H9.621a1.5 1.5 0 0 1-1.06-.44L7.439 2.44A1.5 1.5 0 0 0 6.38 2H3.5Zm5.25 4.75a.75.75 0 0 0-1.5 0v2.69l-.72-.72a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l2-2a.75.75 0 1 0-1.06-1.06l-.72.72V6.75Z" clip-rule="evenodd" />
                      </svg>
                      
                </button>
            <button
                    class="ml-2 btn  btn-square btn-error btn-xs tooltip-error  tooltip tooltip-top @if ($bulkDisable) hidden @endif"
                    data-tip="Delete All" wire:click="deleteAll">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4 ml-0.5">
                        <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                      </svg>
                      
                      
                </button>
        </div>



        <div class="w-auto md:join">
            <div class="relative join-item ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"class="w-4 h-4 absolute left-0 my-1.5 ml-2 font-bold">
                    <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                    <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                  </svg>
                  
                  <input type="text" id="rangeDate" placeholder="{{ __('date_range') }}" wire:model='searchDateRange' readonly
                  autocomplete="off"
                  class="w-full max-w-xs pl-6 input input-bordered placeholder:italic placeholder:text-slate-400 input-success input-xs md:w-52 focus:outline-none focus:ring-success focus:ring-1" />
                
            </div>
            <div class="relative join-item ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 absolute left-0 my-1.5 ml-2 font-bold">
                    <path d="M19.006 3.705a.75.75 0 1 0-.512-1.41L6 6.838V3a.75.75 0 0 0-.75-.75h-1.5A.75.75 0 0 0 3 3v4.93l-1.006.365a.75.75 0 0 0 .512 1.41l16.5-6Z" />
                    <path fill-rule="evenodd" d="M3.019 11.114 18 5.667v3.421l4.006 1.457a.75.75 0 1 1-.512 1.41l-.494-.18v8.475h.75a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1 0-1.5H3v-9.129l.019-.007ZM18 20.25v-9.566l1.5.546v9.02H18Zm-9-6a.75.75 0 0 0-.75.75v4.5c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75H9Z" clip-rule="evenodd" />
                  </svg>
                <select wire:model='searchCompanyCategory' class="w-full max-w-xs pl-6 select select-bordered placeholder:italic placeholder:text-slate-400 select-success select-xs focus:outline-none focus:ring-success focus:ring-1">
                    <option value="" selected class="text-gray-400">Select an company category</option>
                    @foreach($CompanyCategory as $key => $value)
                        <option class="text-xs" value="{{$value->name}}">{{$value->name}}</option>
                    @endforeach
                </select>
                
            </div>
           
            <div class="relative join-item ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 absolute left-0 my-1.5 ml-2 font-bold">
                    <path d="M19.006 3.705a.75.75 0 1 0-.512-1.41L6 6.838V3a.75.75 0 0 0-.75-.75h-1.5A.75.75 0 0 0 3 3v4.93l-1.006.365a.75.75 0 0 0 .512 1.41l16.5-6Z" />
                    <path fill-rule="evenodd" d="M3.019 11.114 18 5.667v3.421l4.006 1.457a.75.75 0 1 1-.512 1.41l-.494-.18v8.475h.75a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1 0-1.5H3v-9.129l.019-.007ZM18 20.25v-9.566l1.5.546v9.02H18Zm-9-6a.75.75 0 0 0-.75.75v4.5c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75H9Z" clip-rule="evenodd" />
                  </svg>
                  
                <select wire:model='searchCompany' class="w-full max-w-xs pl-6 select select-bordered placeholder:italic placeholder:text-slate-400 select-success select-xs focus:outline-none focus:ring-success focus:ring-1">
                    <option value="" selected class="text-gray-400">Select an company</option>
                    @foreach($Company as $key => $value)
                        <option value="{{$value->name}}">{{$value->name}}</option>
                    @endforeach
                </select>
                
            </div>
            <div class="relative join-item ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 absolute left-0 my-1.5 ml-2 font-bold">
                    <path d="M19.006 3.705a.75.75 0 1 0-.512-1.41L6 6.838V3a.75.75 0 0 0-.75-.75h-1.5A.75.75 0 0 0 3 3v4.93l-1.006.365a.75.75 0 0 0 .512 1.41l16.5-6Z" />
                    <path fill-rule="evenodd" d="M3.019 11.114 18 5.667v3.421l4.006 1.457a.75.75 0 1 1-.512 1.41l-.494-.18v8.475h.75a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1 0-1.5H3v-9.129l.019-.007ZM18 20.25v-9.566l1.5.546v9.02H18Zm-9-6a.75.75 0 0 0-.75.75v4.5c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75H9Z" clip-rule="evenodd" />
                  </svg>
                  
                <select wire:model='searchDept' class="w-full max-w-xs pl-6 select select-bordered placeholder:italic placeholder:text-slate-400 select-success select-xs focus:outline-none focus:ring-success focus:ring-1">
                    <option value="" selected class="text-gray-400">Select an Department</option>
                    @foreach($Dept as $key => $value)
                        <option value="{{$value->name}}">{{$value->name}}</option>
                    @endforeach
                </select>
                
            </div>
        </div>
    </div>
    <div class="grid px-2 " wire:loading.class="skeleton"  wire:target="export">

        <div class="w-auto mx-3 mt-2 overflow-x-auto rounded-sm shadow-md md:w-auto">

            <table class="table table-xs table-zebra-zebra">
                <thead class="bg-gray-400">
                    <tr class="text-center">
                        <th>#</th>
                        <th>
                            <label>
                                <input type="checkbox" class="checkbox checkbox-xs border-orange-400 checked:border-indigo-800 [--chkbg:theme(colors.indigo.600)] [--chkfg:orange]" wire:model="selectAll" />
                            </label>
                        </th>
                        <th>{{ __('date') }}</th>
                        <th>{{ __('Company_Category') }}</th>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('department') }}</th>
                        <th>{{ __('Under_Departemen') }}</th>
                        <th>{{ __('Job_Class') }}</th>
                        <th>{{ __('Manhours') }}</th>
                        <th>{{ __('Manpower') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ManhoursRegister as $index =>$item)
                    <tr class="text-center">
                        <th>{{ $ManhoursRegister->firstItem() + $index }}</th>
                        <th>
                            <label>
                                <input wire:model="selectedManhours" value="{{ $item->id }}" type="checkbox"
                                    class="checkbox checkbox-xs border-orange-400 checked:border-indigo-800 [--chkbg:theme(colors.indigo.600)] [--chkfg:orange]" />
                            </label>
                        </th>
                        <td>{{ date('M-Y',strtotime($item->date)) }}</td>
                        <td>{{$item->company_category}}</td>
                        <td>{{$item->company}}</td>
                        <td>{{$item->dept}}</td>
                        <td>{{$item->group}}</td>
                        <td>{{$item->role_class}}</td>
                        <td>{{(int)$item->manhour}}</td>
                        <td>{{$item->manpower}}</td>
                        <td>
                            <div class="flex flex-row justify-center gap-1">

                                <label wire:click='update({{ $item->id }})'
                                    class="btn btn-xs btn-warning ">{{__('Edit')}}</label>
                                <label for="delete_data" wire:click="delete({{ $item->id }})"
                                    class="btn btn-xs btn-error ">{{{__('Delete')}}}</label>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="font-semibold text-rose-500">

                            <p class="flex justify-center"> Data not found <span
                                    class="loading loading-bars loading-xs"> </span></p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot class="bg-gray-400">
                    <tr class="text-center">
                        <th>#</th>
                        <th>
                            <label>
                                <input type="checkbox" class="checkbox checkbox-xs border-orange-400 checked:border-indigo-800 [--chkbg:theme(colors.indigo.600)] [--chkfg:orange]" wire:model="selectAll" />
                            </label>
                        </th>
                        <th>{{ __('date') }}</th>
                        <th>{{ __('Company_Category') }}</th>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('department') }}</th>
                        <th>{{ __('Under_Departemen') }}</th>
                        <th>{{ __('Job_Class') }}</th>
                        <th>{{ __('Manhours') }}</th>
                        <th>{{ __('Manpower') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div>{{ $ManhoursRegister->links() }}</div>
    </div>
   @livewire('manhours.manhours-register.update')


    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="delete_data" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete ?</h4>
            <form wire:submit.prevent='deleteFile'>
                <div class="mx-4 mt-4 overflow-x-auto rounded-t-lg rounded-b-lg shadow-md">
                    <table class="table table-xs">
                        <thead class="bg-emerald-300">
                            <tr class="text-center">
                                <th>{{('Company')}}</th>
                                <th>{{ __('Job Class') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $company }}</td>
                                <td>{{ $job_class }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-action">
                    <button type="submit" id="close" class="text-white btn btn-success btn-xs">Yes
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </button>
                    <label id="closeModal" for="delete_data" class="btn btn-xs btn-error">No!</label>
                </div>
            </form>
        </div>
    </div>
</div>
