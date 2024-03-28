{{-- Modal Workgroup --}}
<div class="modal @if (!empty($openModalWG)) modal-open @endif ">
    {{--   --}}
    <div class="h-auto md:max-w-5xl md:w-5/12 modal-box">
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
                                    wire:click="workGroup('{{ $wg->companyLevel->BussinessUnit->name }}','{{ $wg->CompanyLevel->deptORcont }}','{{ $wg->job_class }}')">

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
<div class="modal @if (!empty($openEmployee)) modal-open @endif ">
    {{--   --}}
    <div class="w-auto modal-box">
        <h3 class="text-lg font-bold text-center text-emerald-600">Employer!</h3>
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
                        <input wire:model='search_employee'
                            class="block w-full py-2 pr-3 bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 pl-9 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
                            placeholder="Search For..." type="text" name="search" />
                    </label>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" basis-auto">

                <div class="h-32 overflow-y-auto border lg:h-72 border-emerald-500">
                    <ol class="ml-4 list-decimal cursor-pointer">
                        @foreach ($Company as $index => $comp)
                            <li wire:click="cari_employee('{{ $comp->id }}')" class="text-xs hover:bg-cyan-200">
                                {{ $comp->name }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="modal-action">
            <label wire:click='EmployeClickClose' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>
<div class="modal @if (!empty($openSupervisor)) modal-open @endif ">
    {{--   --}}
    <div class="w-auto modal-box">
        <h3 class="text-lg font-bold text-center text-emerald-600">Supervisor!</h3>
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
                        <input wire:model='search_employee'
                            class="block w-full py-2 pr-3 bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 pl-9 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
                            placeholder="Search For..." type="text" name="search" />
                    </label>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" basis-auto">

                <div class=" h-32 overflow-y-auto border lg:h-72 border-emerald-500">
                 

                       <table class="table-zebra table-xs w-full">
                           @foreach ($Orang as $index => $name)
                              <tr>
                               <td class="cursor-pointer w-full" wire:click="cari_supervisor('{{ $name->id }}')">
                                   <label >
                                       {{ $name->lookup_name }}</label>
                               </td>
                              </tr>
                           @endforeach
                       </table>
                </div>
                
            </div>
        </div>
        <div class="modal-action">
            <label wire:click='spvClickClose' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>

<input type="checkbox" id="uploadPeople" class="modal-toggle" />
<div class="modal">
    <div class="modal-box" wire:loading.class="skeleton" wire:target="uploadPeople">
        <div class="divider divider-primary">Import new People</div>
        <form wire:submit.prevent='uploadPeople'>
            @csrf

            <div class="w-full max-w-xs form-control">
                <x-input-label-req :value="__('File Name')" />
                <input type="file" placeholder="Type here" wire:model='fileImport' required`
                    class=" @error('fileImport') border-rose-500 border-2 @enderror w-full max-w-xs file-input file-input-bordered file-input-success file-input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                <x-input-error :messages="$errors->get('fileImport')" class="mt-0" />
            </div>
            <div class="modal-action">
                <button type="submit" class="text-white btn btn-success btn-xs">Save
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                    </svg>
                </button>
                <label for="uploadPeople" class="btn btn-xs btn-error">Close!</label>
            </div>
        </form>

    </div>
</div>
