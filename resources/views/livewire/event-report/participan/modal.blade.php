{{-- Modal reportBy --}}
<div class="{{ $openModalName ? 'modal modal-open' : 'modal' }}">

    <div class="w-auto modal-box">
        <h3 class="text-lg font-bold text-center">People!</h3>
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
                        <input wire:model='search_reportBy'
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
                        @foreach ($People as $index => $person)
                            <li wire:click="cari_name('{{ $person->id }}')" class="text-xs hover:bg-cyan-200">
                                {{ $person->lookup_name }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="modal-action">
            <label wire:click='nameByClickClose' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>

{{-- Modal responsibleCompany --}}
<div class="{{ $openModalPerusahaan ? 'modal modal-open' : 'modal' }}">
    <div class="w-auto modal-box">
        <h3 class="text-lg font-bold text-center text-emerald-600">Company!</h3>
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
                        <input wire:model='search_company'
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
                            <li wire:click="cari_perusahaan('{{ $comp->id }}')" class="text-xs hover:bg-cyan-200">
                                {{ $comp->name }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="modal-action">
            <label wire:click='perusahaanByClickClose' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>
