{{-- MODAL WORKGROUP --}}
<div class="{{ $openWG }}" role="dialog">
    <div class="modal-box sm:w-11/12 sm:max-w-3xl">
        <div
            class="divider divider-accent text-sm font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500 -mt-3">
            Workgroup</div>
        <div class="join flex flex-col sm:flex-row gap-1 sm:gap-0 -mt-3 justify-end">
            <div class="relative flex items-center max-w-xs join-item shadow-sm">
                <input id="5" type="text" wire:model='search_workgroup'
                    class="peer relative  input input-bordered input-xs w-full max-w-xs  focus:ring-1 focus:outline-none  focus:drop-shadow-lg"
                    placeholder="search" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="w-4 h-4 opacity-70 absolute right-2">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="relative flex items-center max-w-xs join-item shadow-sm ">

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
        <div class="flex md:flex-row flex-col">
            <div class="text-xs shadow-md max-w-xs w-full">

                <ul class="list-inside list-disc h-60 overflow-y-auto">
                    <li
                        class="text-xs text-center font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500  ">
                        Company Level</li>
                    @foreach ($CompanyLevel as $index => $dept)
                        <li wire:click="cariCL('{{ $dept->id }}')" class="hover:bg-sky-400 cursor-pointer px-2">
                            {{ $dept->BussinessUnit->name }}-{{ $dept->deptORcont }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="text-xs shadow-md w-full">
                <ul class="list-inside list-disc h-60 overflow-y-auto">
                    <li
                        class="text-xs text-center font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500">
                        Workgroup</li>
                    @if ($showWG)
                        @forelse ($ModalWorkgroup as $index => $item)
                            <li class="hover:bg-sky-400 cursor-pointer text-[10px] px-2"
                                wire:click="clickWorkgroup('{{ $item->id }}','{{ $item->companyLevel->BussinessUnit->name }}','{{ $item->CompanyLevel->deptORcont }}','{{ $item->job_class }}')">
                                {{ $item->CompanyLevel->BussinessUnit->name }}-{{ $item->CompanyLevel->level }}-{{ $item->CompanyLevel->deptORcont }}
                                {{ $item->job_class }}</li>
                        @empty

                            <li class="font-semibold text-rose-500">data not found!!</li>
                        @endforelse
                    @endif
                </ul>
            </div>
        </div>
        <div class="modal-action">
            <label for="my_modal_6" wire:click='closeWokrgroup' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>
{{-- MODAL REPORT BY --}}
<div class="{{ $open_ReportBy }}" role="dialog">
    <div class="modal-box w-64">
        <div
            class="divider divider-accent text-sm font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500 -mt-3">
            Report By</div>
        <div class="relative flex items-center max-w-xs join-item shadow-sm">
            <input id="5" type="text" wire:model='search_reportBy'
                class="peer relative  input input-bordered input-xs w-full max-w-xs  focus:ring-1 focus:outline-none  focus:drop-shadow-lg "
                placeholder="search people..." />

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                class="w-4 h-4 opacity-70 absolute right-2">
                <path fill-rule="evenodd"
                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                    clip-rule="evenodd" />
            </svg>

        </div>
        <div class="text-xs shadow-md max-w-xs w-full">


            <ul class="list-inside list-disc h-60 overflow-y-auto">

                @foreach ($ReportBy as $index => $pelapor)
                    <li wire:click="cariPelapor('{{ $pelapor->id }}')" class="hover:bg-sky-400 cursor-pointer px-2">
                        {{ $pelapor->lookup_name }}</li>
                @endforeach
            </ul>
        </div>
        <div>{{ $ReportBy->links('livewire.miniPagination') }}</div>
        <div class="modal-action">
            <label for="my_modal_6" wire:click='closeReportBy' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>
{{-- MODAL REPORT TO --}}
<div class="{{$open_ReportTo}}" role="dialog">
    <div class="modal-box w-64">
        <div
        class="divider divider-accent text-sm font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500 -mt-3">
        Report To</div>
        <div class="relative flex items-center max-w-xs join-item shadow-sm">
            <input id="5" type="text" wire:model='search_reportBy'
                class="peer relative  input input-bordered input-xs w-full max-w-xs  focus:ring-1 focus:outline-none  focus:drop-shadow-lg "
                placeholder="search people..." />
                
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                class="w-4 h-4 opacity-70 absolute right-2">
                <path fill-rule="evenodd"
                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                    clip-rule="evenodd" />
            </svg>
            
        </div>
        <div class="text-xs shadow-md max-w-xs w-full">
            

            <ul class="list-inside list-disc h-60 overflow-y-auto">
              
                @foreach ($ReportTo as $index => $pelapor)
                    <li wire:click="cariReportTo('{{ $pelapor->id }}')" class="hover:bg-sky-400 cursor-pointer px-2">
                       {{ $pelapor->lookup_name }}</li>
                @endforeach
            </ul>
        </div>
        <div>{{ $ReportTo->links('livewire.miniPagination') }}</div>
      <div class="modal-action">
        <label for="my_modal_6" wire:click='closeReportTo' class="btn btn-xs btn-error">Close!</label>
      </div>
    </div>
  </div>
