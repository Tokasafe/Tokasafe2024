{{-- Modal Workgroup --}}
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
                    @foreach ($CompanyLevels as $index => $item)
                        <li wire:click="cari('{{ $item->id }}')" class="px-2 cursor-pointer hover:bg-sky-400">
                            {{ $item->BussinessUnit->name }}-{{ $item->deptORcont }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="w-full text-xs shadow-md">
                <ul class="overflow-y-auto list-disc list-inside h-60">
                    <li
                        class="text-xs font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                        Workgroup</li>
                   
                        @forelse ($ModalWorkgroup as $index => $item)
                            <li class="hover:bg-sky-400 cursor-pointer text-[10px] px-2"
                                wire:click="workGroup('{{ $item->id }}','{{ $item->CompanyLevel->BussinessUnit->name }}','{{ $item->CompanyLevel->deptORcont }}','{{ $item->job_class }}')">
                                {{ $item->CompanyLevel->BussinessUnit->name }}-{{ $item->CompanyLevel->level }}-{{ $item->CompanyLevel->deptORcont }}
                                {{ $item->job_class }}</li>
                        @empty

                            <li class="font-semibold text-rose-500">data not found!!</li>
                        @endforelse
                  
                </ul>
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
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="absolute inset-0 left-0 w-4 h-4 mx-2 mt-1 self">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                          </svg>

                        <input wire:model='search_reportBy'
                            class="block w-full py-2 pl-6 bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
                            placeholder="Search People" type="text" name="search" />
                    </label>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" basis-auto">
                <div class="h-32 overflow-y-auto border lg:h-60 border-emerald-500">
                    <table class="w-full table-zebra table-xs">
                        @foreach ($People as $index => $person)
                           <tr class="">
                            <td class="w-full cursor-pointer" wire:click="cari_reportBy('{{ $person->id }}')">
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
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="absolute inset-0 left-0 w-4 h-4 mx-2 mt-1 self">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                          </svg>
                        <input wire:model='search_reportTo'
                            class="block w-full py-2 pl-6 bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
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
                    <table class="w-full table-zebra table-xs">
                        @foreach ($Supervisor as $index => $person)
                           <tr class="">
                            <td class="w-full cursor-pointer" wire:click="cari_reportTo('{{ $person->id }}')">
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