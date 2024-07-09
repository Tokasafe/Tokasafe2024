<div class="{{ $openModalWG }}">
    <div class="modal-box sm:w-11/12 sm:max-w-3xl">
        <div
            class="-mt-3 text-sm font-extrabold text-transparent divider divider-accent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
            Workgroup</div>
        <div class="flex flex-col justify-end gap-1 -mt-3 join sm:flex-row sm:gap-0">
            <div class="relative flex items-center max-w-xs shadow-sm join-item">
                <input id="5" type="text" wire:model='searchWg'
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
                        <li  class="text-xs font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">Workgroup
                        </li>
                      
                        @forelse ($ModalWorkgroup as $index => $workgroup)
                            <li class="text-xs text-left hover:text-orange-400">
                                <label class="gap-1 p-0 cursor-pointer  ">
                                    <input type="radio"
                                        class="radio radio-xs  border-orange-400 checked:border-indigo-800 [--chkbg:theme(colors.indigo.600)] [--chkfg:orange]"
                                        wire:model='selectedWorkgroup'value="{{ $workgroup->id }}" />
                                    <span
                                        wire:click="workGroup('{{ $workgroup->CompanyLevel->BussinessUnit->name }}','{{ $workgroup->CompanyLevel->departemen_contractor }}','{{ $workgroup->job_class }}')">
                                        {{ $workgroup->CompanyLevel->BussinessUnit->name }}-{{ $workgroup->CompanyLevel->departemen_contractor }}-{{ $workgroup->job_class }}
                                    </span>
                                </label>
                            </li>
                        @empty

                            <li class="font-semibold text-rose-500">data not found!!</li>
                        @endforelse
                    </ol>

                   
                </ul>
            </div>
        </div>
        <div class="modal-action">
            <label wire:click='btnsave' class="btn btn-xs btn-success">{{ __('Save') }}!</label>
            <label wire:click='wgClickClose' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</div>
