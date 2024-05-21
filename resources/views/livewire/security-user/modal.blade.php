<div>
    {{-- Modal Workgroup --}}
    <div class="modal  @if (!empty($openModalWG)) modal-open @endif ">
        {{--   --}}
        <div class="h-auto modal-box">
            <h3 class="text-lg font-bold text-center text-emerald-600">Wokrgroup!</h3>
            <div class="grid m-2 justify-items-stretch">


                <div class="sm:justify-self-end">
                    <div class="flex flex-col items-center lg:flex-row join">
                        <label class="relative block join-item">
                            <span class="sr-only">Search</span>
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                        clip-rule="evenodd" />
                                </svg>


                            </span>
                            <input wire:model='search_workgroup'
                                class="block w-full py-2 pr-3 bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 pl-9 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
                                placeholder="Search For..." type="text" name="search" />
                        </label>
                        <div class="flex join-item">
                            <div class="flex items-center">
                                <label class="gap-2 cursor-pointer label">
                                    <input type="radio" wire:model='radio_select' value="companyLevel"
                                        class="radio radio-xs checked:bg-teal-600" />
                                    <span class="label-text">Company Level</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label class="gap-2 cursor-pointer label">
                                    <input type="radio" wire:model='radio_select' value="workgroup"
                                        class="radio radio-xs checked:bg-sky-600" checked />
                                    <span class="label-text">Workgroup</span>
                                </label>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
            <table class="table w-full table-zebra">
                <thead class="bg-emerald-500">
                    <tr class="text-center">
                        <td class="border-2 border-success">Company Level</td>
                        <td class="border-2 border-success"> Workgroup</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-2 border-success ">
                            <ol class="h-32 ml-4 overflow-y-auto list-decimal cursor-pointer lg:h-60">
                                @foreach ($CompanyLevel as $index => $dept)
                                    <li wire:click="cari('{{ $dept->id }}')" class="text-xs hover:text-orange-500">
                                        {{ $dept->BussinessUnit->name }}-{{ $dept->deptORcont }}</li>
                                @endforeach
                            </ol>

                        </td>
                        <td class="border-2 border-success">

                            <ol class="h-32 ml-4 overflow-y-auto list-decimal cursor-pointer lg:h-60">
                                @foreach ($ModalWorkgroup as $index => $workgroup)
                                    <li class="text-xs hover:text-orange-400">
                                        <label class="gap-1 p-0 cursor-pointer label">
                                            <input type="checkbox"
                                                class="checkbox checkbox-xs  border-orange-400 checked:border-indigo-800 [--chkbg:theme(colors.indigo.600)] [--chkfg:orange]"
                                                wire:model='selectedWorkgroup'value="{{ $workgroup->id }}" />
                                            <span class=""
                                                wire:click="workGroup('{{ $workgroup->companyLevel->BussinessUnit->name }}','{{ $workgroup->CompanyLevel->deptORcont }}')">
                                                {{ $workgroup->CompanyLevel->BussinessUnit->name }}-{{ $workgroup->CompanyLevel->deptORcont }}-{{ $workgroup->job_class }}
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            </ol>

                        </td>

                    </tr>
                </tbody>
            </table>
            <div class="modal-action">
                <label wire:click='btnsave' class="btn btn-xs btn-success">{{ __('Save') }}!</label>
                <label wire:click='wgClickClose' class="btn btn-xs btn-error">Close!</label>
            </div>
        </div>
    </div>


    <div class="modal @if (!empty($openModalEST)) modal-open @endif ">
        <div class="modal-box">
            <button wire:click='EventSubtypeClose'
                class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
            <div class="divider divider-accent">Event Subtype</div>
            <div class="overflow-x-auto">
                <table class="table table-xs ">
                    <thead class="bg-secondary">
                        <tr>
                            <th>#</th>
                            <th>Event Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($EventTypes as $key => $value)
                            <tr wire:click="subtypeClick('{{ $value->id }}','{{ $value->name }}')"
                                class="cursor-pointer hover:bg-cyan-300">
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $value->name }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot class="bg-secondary">
                        <tr>
                            <th>#</th>
                            <th>Event Type</th>
                            <th>Event Subtype</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

        {{-- Modal Workgroup --}}
        <div class="modal  @if (!empty($openModalWGupdate)) modal-open @endif ">
            {{--   --}}
            <div class="h-auto modal-box">
                <h3 class="text-lg font-bold text-center text-emerald-600">Wokrgroup!</h3>
                <div class="grid m-2 justify-items-stretch">
    
    
                    <div class="sm:justify-self-end">
                        <div class="flex flex-col items-center lg:flex-row join">
                            <label class="relative block join-item">
                                <span class="sr-only">Search</span>
                                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                            clip-rule="evenodd" />
                                    </svg>
    
    
                                </span>
                                <input wire:model='search_workgroup'
                                    class="block w-full py-2 pr-3 bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 pl-9 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
                                    placeholder="Search For..." type="text" name="search" />
                            </label>
                            <div class="flex join-item">
                                <div class="flex items-center">
                                    <label class="gap-2 cursor-pointer label">
                                        <input type="radio" wire:model='radio_select' value="companyLevel"
                                            class="radio radio-xs checked:bg-teal-600" />
                                        <span class="label-text">Company Level</span>
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <label class="gap-2 cursor-pointer label">
                                        <input type="radio" wire:model='radio_select' value="workgroup"
                                            class="radio radio-xs checked:bg-sky-600" checked />
                                        <span class="label-text">Workgroup</span>
                                    </label>
                                </div>
                            </div>
    
    
    
                        </div>
    
                    </div>
                </div>
                <table class="table w-full table-zebra">
                    <thead class="bg-emerald-500">
                        <tr class="text-center">
                            <td class="border-2 border-success">Company Level</td>
                            <td class="border-2 border-success"> Workgroup</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-2 border-success ">
                                <ol class="h-32 ml-4 overflow-y-auto list-decimal cursor-pointer lg:h-60">
                                    @foreach ($CompanyLevel as $index => $dept)
                                        <li wire:click="cariUpdate('{{ $dept->id }}')" class="text-xs hover:text-orange-500">
                                            {{ $dept->BussinessUnit->name }}-{{ $dept->deptORcont }}</li>
                                    @endforeach
                                </ol>
    
                            </td>
                            <td class="border-2 border-success">
    
                                <ol class="h-32 ml-4 overflow-y-auto list-decimal cursor-pointer lg:h-60">
                                    @foreach ($ModalWorkgroup as $index => $workgroup)
                                        <li class="text-xs hover:text-orange-400">
                                            <label class="gap-1 p-0 cursor-pointer label" wire:click="workGroupUpdate('{{ $workgroup->companyLevel->BussinessUnit->name }}','{{ $workgroup->CompanyLevel->deptORcont }}','{{$workgroup->job_class}}')">
                                                <input type="radio"
                                                    class="radio radio-xs  border-orange-400 checked:border-indigo-800 [--chkbg:theme(colors.indigo.600)] [--chkfg:orange]"
                                                    wire:model='selectedWorkgroup'value="{{ $workgroup->id }}" />
                                                <span class=""
                                                    >
                                                    {{ $workgroup->CompanyLevel->BussinessUnit->name }}-{{ $workgroup->CompanyLevel->deptORcont }}-{{ $workgroup->job_class }}
                                                </span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ol>
    
                            </td>
    
                        </tr>
                    </tbody>
                </table>
                <div class="modal-action">
                    <label wire:click='btnsave' class="btn btn-xs btn-success">{{ __('Save') }}!</label>
                    <label wire:click='wgClickClose' class="btn btn-xs btn-error">Close!</label>
                </div>
            </div>
        </div>

</div>
