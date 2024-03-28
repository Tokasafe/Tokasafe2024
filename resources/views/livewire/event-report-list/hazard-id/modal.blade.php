{{-- Modal Workgroup --}}
<div class="modal @if (!empty($openModalWG)) modal-open @endif ">
    {{--   --}}
    <div class="h-auto md:max-w-5xl md:w-5/12 modal-box">
        <h3 class="text-lg font-bold text-center text-emerald-600">Wokrgroup!</h3>
        <div class="grid m-2 justify-items-stretch">


            <div class="sm:justify-self-end">
                <div class="flex flex-col items-center lg:flex-row join">
                    <label class="relative block join-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 absolute inset-0 self mx-2 left-0 mt-1">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                          </svg>
                          
                        <input wire:model='search_workgroup'
                            class="block w-full py-2 pr-3 bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 pl-6 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
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
        <div class="flex flex-col border-2 divide-x lg:flex-row divide-emerald-500 border-emerald-500">
            <div class=" basis-1/2">
                <p class="font-semibold text-center border-y-2 border-emerald-500">Company Level</p>
                <div class="h-32 overflow-y-auto lg:h-72">
                    <ol class="ml-4 list-decimal cursor-pointer">
                        @foreach ($CompanyLevel as $index => $dept)
                            <li wire:click="cari('{{ $dept->id }}')" class="text-xs hover:bg-cyan-200">
                                {{ $dept->BussinessUnit->name }}-{{ $dept->deptORcont }}</li>
                        @endforeach
                    </ol>
                </div>

            </div>
            <div class="flex flex-col capitalize cursor-pointer basis-4/5">
                <p class="font-semibold text-center border-y-2 border-emerald-500">Workgroup</p>
                <div class="h-32 overflow-y-auto lg:h-72">
                    @foreach ($ModalWorkgroup as $index => $wg)
                        <ul class="ml-4 text-xs list-disc list-outside ">
                            <li class=" hover:bg-cyan-200">
                                <p
                                    wire:click="workGroup('{{ $wg->id }}','{{ $wg->companyLevel->BussinessUnit->name }}','{{ $wg->CompanyLevel->deptORcont }}','{{ $wg->job_class }}')">

                                    {{ $wg->CompanyLevel->BussinessUnit->name }}-{{ $wg->CompanyLevel->deptORcont }}-{{ $wg->job_class }}
                                </p>
                            </li>

                            <!-- ... -->
                        </ul>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="modal-action">
            <label wire:click='wgClickClose' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>
{{-- Modal reportBy --}}
<div class="modal  @if (!empty($openModalreportBy)) modal-open @endif">
    <div class="w-auto modal-box">
        <h3 class="text-lg font-bold text-center">People!</h3>
        <div class="grid m-2 justify-items-stretch">
            <div class="sm:justify-self-end">
                <div class="flex flex-col items-center lg:flex-row join">
                    <label class="relative block join-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 absolute inset-0 self mx-2 left-0 mt-1">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                          </svg>

                        <input wire:model='search_reportBy'
                            class="block w-full py-2  bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 pl-6 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
                            placeholder="Search People" type="text" name="search" />
                    </label>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" basis-auto">

                <div class="h-32 overflow-y-auto border lg:h-60 border-emerald-500">
                    {{-- <ol class="ml-4 list-disc cursor-pointer">
                        @foreach ($People as $index => $person)
                            <li wire:click="cari_reportBy('{{ $person->id }}')" class="text-xs hover:bg-cyan-200">
                                {{ $person->lookup_name }}</li>
                        @endforeach
                    </ol> --}}
                    <table class="table-zebra table-xs w-full">
                        @foreach ($People as $index => $person)
                           <tr class="">
                            <td class="cursor-pointer w-full" wire:click="cari_reportBy('{{ $person->id }}')">
                               {{ $person->lookup_name }}
                            </td>
                           </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div>{{ $People->links('livewire.miniPagination') }}</div>
        </div>
        <div class="modal-action">
            <label wire:click='reportByClickClose' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>
{{-- Modal reportTo --}}
<div class="modal  @if (!empty($openModalreportTo)) modal-open @endif">
    <div class="w-auto modal-box">
        <h3 class="text-lg font-bold text-center">People!</h3>
        <div class="grid m-2 justify-items-stretch">
            <div class="sm:justify-self-end">
                <div class="flex flex-col items-center lg:flex-row join">

                    <label class="relative block join-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 absolute inset-0 self mx-2 left-0 mt-1">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                          </svg>
                        <input wire:model='search_reportTo'
                            class="block w-full py-2  bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 pl-6 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
                            placeholder="Search People" type="text" name="search" />
                    </label>
                   
                </div>
            </div>
        </div>
        <div class="">
            <div class=" basis-auto">

                <div class="h-32 overflow-y-auto border lg:h-60 border-emerald-500">
                    <ol class="ml-4 list-disc cursor-pointer">
                      
                    </ol>
                    <table class="table-zebra table-xs w-full">
                        @foreach ($Supervisor as $index => $person)
                           <tr class="">
                            <td class="cursor-pointer w-full" wire:click="cari_reportTo('{{ $person->id }}')">
                              {{ $person->lookup_name }}
                            </td>
                           </tr>
                        @endforeach
                    </table>
                </div>
                <div>{{ $Supervisor->links('livewire.miniPagination') }}</div>
            </div>
        </div>
        <div class="modal-action">
            <label wire:click='reportToClickClose' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>
