<div>

    <div class="{{ $openModalWG }}">
        <div class="modal-box sm:w-11/12 sm:max-w-3xl">
            <div
                class="-mt-3 text-sm font-extrabold text-transparent divider divider-accent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                Workgroup</div>
            <div class="flex flex-col justify-end gap-1 -mt-3 join sm:flex-row sm:gap-0">
                <div class="relative flex items-center max-w-xs shadow-sm join-item">
                    <input id="5" type="text" wire:model='search'
                        class="relative w-full max-w-xs peer input input-bordered input-xs focus:ring-1 focus:outline-none focus:drop-shadow-lg"
                        placeholder="search" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="absolute w-4 h-4 opacity-70 right-2">
                        <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="relative flex items-center max-w-xs shadow-sm join-item ">
    
                    <fieldset class="flex items-start p-[3px] border  gap-0.5">
                        <input wire:model.live="radio_select" id="yes"
                            class="radio-xs peer/yes checked:bg-rose-500 radio" type="radio" value="companyLevel" />
                        <label for="yes"
                            class="text-xs font-semibold peer-checked/yes:text-rose-500">{{ __('Company Level') }}</label>
    
                        <input wire:model.live="radio_select" id="no"
                            class="radio-xs peer/no checked:bg-sky-500 radio" type="radio" value="workgroup" />
                        <label for="no"
                            class="text-xs font-semibold peer-checked/no:text-sky-500">{{ __('Workgroup') }}</label>
    
                    </fieldset>
                </div>
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="w-full max-w-xs text-xs shadow-md">
    
                    <ul class="overflow-y-auto list-disc list-inside h-60">
                        <li
                            class="text-xs font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500 ">
                            Company Level</li>
                        @foreach ($CompanyLevel as $index => $item)
                            <li wire:click="cari('{{ $item->id }}')" class="px-2 cursor-pointer hover:bg-sky-400">
                                {{ $item->BussinessUnit->name }}-{{ $item->departemen_contractor }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="text-xs shadow-md">
                    <ul class="overflow-y-auto list-disc list-inside h-60">
                        <ol class="h-32 ml-4 overflow-y-auto  cursor-pointer  lg:h-60">
                                <li
                                    >
                                    </li>
                                    <li class="text-xs text-left hover:text-orange-400">
                                        <label wire:click="allWorkgroup('All Workgroup')" class="gap-1 p-0 cursor-pointer  ">
                                            <input type="checkbox" class="checkbox checkbox-xs border-orange-400 checked:border-indigo-800 [--chkbg:theme(colors.indigo.600)] [--chkfg:orange]" wire:model="selectAllWg" />
                                            <span class="text-xs font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500"> Workgroup</span>
                                              
                                        </label>
                                    </li>
                                @foreach ($ModalWorkgroup as $index => $workgroup)
                                    <li class="text-xs text-left hover:text-orange-400">
                                        <label class="gap-1 p-0 cursor-pointer  ">
                                            <input type="checkbox"
                                                class="checkbox checkbox-xs  border-orange-400 checked:border-indigo-800 [--chkbg:theme(colors.indigo.600)] [--chkfg:orange]"
                                                wire:model='selectedWorkgroup'value="{{ $workgroup->id }}" />
                                            <span
                                                wire:click="workGroup('{{ $workgroup->CompanyLevel->BussinessUnit->name }}','{{ $workgroup->CompanyLevel->departemen_contractor }}','{{ $workgroup->job_class }}')">
                                                {{ $workgroup->CompanyLevel->BussinessUnit->name }}-{{ $workgroup->CompanyLevel->departemen_contractor }}-{{ $workgroup->job_class }}
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            </ol>
                       
                            {{-- @forelse ($ModalWorkgroup as $index => $item)
                                <li class="hover:bg-sky-400 cursor-pointer text-[10px] px-2"
                                    wire:click="workGroup('{{ $item->id }}','{{ $item->CompanyLevel->BussinessUnit->name }}','{{ $item->CompanyLevel->departemen_contractor }}','{{ $item->job_class }}')">
                                    {{ $item->CompanyLevel->BussinessUnit->name }}-{{ $item->CompanyLevel->level }}-{{ $item->CompanyLevel->departemen_contractor }}
                                    {{ $item->job_class }}</li>
                            @empty
    
                                <li class="font-semibold text-rose-500">data not found!!</li>
                            @endforelse --}}
                      
                    </ul>
                </div>
            </div>
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
            <div class="divider divider-accent">Event Type</div>

            <ul class="list-inside list-disc  overflow-y-auto h-96">
                <li>5 cups chopped Porcini mushrooms</li>
                @foreach ($EventTypes as $key => $value)
                <li wire:click="subtypeClick('{{ $value->id }}','{{ $value->name }}')" class="cursor-pointer hover:bg-cyan-300">
                    {{-- <th>{{ $key + 1 }}</th> --}}
                    {{ $value->name }}
                </li>
            @endforeach
              </ul>
        </div>
    </div>

        {{-- Modal Workgroup --}}
        <div class="modal  @if (!empty($openModalWGupdate)) modal-open @endif ">
          
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
                                            <label class="gap-1 p-0 cursor-pointer label" wire:click="workGroupUpdate('{{ $workgroup->CompanyLevel->BussinessUnit->name }}','{{ $workgroup->CompanyLevel->deptORcont }}','{{$workgroup->job_class}}')">
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
