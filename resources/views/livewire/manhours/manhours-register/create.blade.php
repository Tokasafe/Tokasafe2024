<div>
    @include('toast.toast')
    <!-- Open the modal using ID.showModal() method -->
    <div class="flex gap-2 flex-col md:flex-row">
        <label for="manhoursRegister"
            class="btn btn-xs btn-square btn-info tooltip-info tooltip-top tooltip"data-tip="Create">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4  mt-0.5 ml-0.5">
                <path fill-rule="evenodd"
                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z"
                    clip-rule="evenodd" />
            </svg>

        </label>
        <label for="uploadManhoursRegister" class="btn btn-xs btn-square btn-warning tooltip-warning tooltip-top tooltip"
            data-tip="Import">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                class="size-4   mt-0.5 ml-0.5">
                <path
                    d="M8.75 6h-1.5V3.56L6.03 4.78a.75.75 0 0 1-1.06-1.06l2.5-2.5a.75.75 0 0 1 1.06 0l2.5 2.5a.75.75 0 1 1-1.06 1.06L8.75 3.56V6H11a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h2.25v5.25a.75.75 0 0 0 1.5 0V6Z" />
            </svg>

        </label>
    </div>
    <input type="checkbox" id="manhoursRegister" class="modal-toggle" />
    <div id="manhoursRegister" role="dialog" class="modal ">
        <div class="modal-box sm:w-[55%] max-w-5xl">
            <div class="font-bold divider divider-primary">{{ __('add') }} Manhours</div>
            <form wire:submit.prevent='store'>
                @csrf
                <div class="grid grid-cols-1 content-center xl:grid-cols-2 gap-1">
                    <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                        <x-input-label-req :value="__('date')" />
                        <x-input-new id="month" wire:model='date' type="text" :error="$errors->get('date')" readonly />
                        <x-input-error :messages="$errors->get('date')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                        <x-input-label-req :value="__('Category_Company')" />

                        <x-input-select wire:model='company_category' :error="$errors->get('company_category')">
                            <option value="" selected>select category company</option>
                            @foreach ($KategoryCompany as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </x-input-select>
                        <x-input-error :messages="$errors->get('company_category')" class="mt-0" />
                    </div>
                    @if (!empty($company_category))
                        <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control relative">

                            <x-input-label-req :value="__('Company')" />

                            <x-input-new wire:model='company' type="text"
                                onClick="document.getElementById('inputNamaPerusahaan').style.display='block'"
                                :error="$errors->get('company')" />
                            <x-input-error :messages="$errors->get('company')" class="mt-0" />
                            <div id="inputNamaPerusahaan" class="fixed mt-10 py-1 z-10 w-64 {{ $showCompany }}">
                                <div class="w-full max-w-xs text-xs shadow-inner bg-base-200  mt-2">
                                    <ul class="overflow-y-auto list-disc list-inside h-32">
                                        @forelse ($SelectCompany as $key => $value)
                                            <li class="w-full cursor-pointer"
                                                wire:click="cari_perusahaan({{ $value->id }})">
                                                {{ $value->name }}
                                            </li>

                                        @empty
                                            <li class="text-rose-500 text-center font-semibold">name not found!!
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                            <x-input-label-req :value="__($label_dept)" />
                            <x-input-select wire:model='dept' :error="$errors->get('dept')">
                                <option value="" selected>select {{ __('department') }}</option>
                                @foreach ($GroupCompany as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->Department->name }}</option>
                                @endforeach
                            </x-input-select>
                            <x-input-error :messages="$errors->get('dept')" class="mt-0" />
                        </div>
                    @endif
                    <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                        <x-input-label-req :value="__('Role Class')" />
                        <x-input-select wire:model='role_class' :error="$errors->get('role_class')">
                            <option value="" selected>select Role</option>
                            <option value="Supervisor" selected>Supervisor</option>
                            <option value="Operational" selected>Operational</option>
                            <option value="Administrator" selected>Administrator</option>
                        </x-input-select>
                        <x-input-error :messages="$errors->get('role_class')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                        <x-input-label-req :value="__('manhour')" />
                        <x-input-new wire:model='manhour' type="text" :error="$errors->get('manhour')" />
                        <x-input-error :messages="$errors->get('manhour')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                        <x-input-label-req :value="__('manpower')" />
                        <x-input-new wire:model='manpower' type="text" :error="$errors->get('manpower')" />
                        <x-input-error :messages="$errors->get('manpower')" class="mt-0" />
                    </div>
                </div>
                <div class="modal-action">
                    <!-- if there is a button in form, it will close the modal -->
                    <button type="submit" class="btn btn-success btn-xs">Save</button>
                    <label for="manhoursRegister" class="btn btn-error btn-xs">Close</label>
                </div>
            </form>
        </div>
    </div>
    <input type="checkbox" id="uploadManhoursRegister" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box" wire:loading.class="skeleton" wire:target="uploadManhours">
            <div class="divider divider-primary">Import new Register Manhours</div>
            <form wire:submit.prevent='uploadManhours'>
                @csrf
                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                    <x-input-label-req :value="__('File Name')" />
                    <x-input-file :error="$errors->get('files')" class="relative" wire:model='files' />
                    <x-input-error :messages="$errors->get('files')" class="mt-0" />
                </div>
                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs" wire:target="uploadManhours"
                        wire:loading.class="btn-disabled">Upload
                        <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                        </svg>
                        <span wire:loading wire:target="files"
                            class="hidden loading loading-spinner loading-sm"wire:loading.class="block"></span>
                    </button>
                    <label for="uploadManhoursRegister" wire:target="uploadManhours"
                        wire:loading.class="btn-disabled" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('mouseup', function(event) {
            var inputNamaPerusahaan = document.getElementById('inputNamaPerusahaan');
            if (event.target != inputNamaPerusahaan && event.target.parentNode != inputNamaPerusahaan) {
                inputNamaPerusahaan.style.display = 'none';
            }
        });
    </script>
</div>
