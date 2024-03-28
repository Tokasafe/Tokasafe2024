<div>
    <!-- Open the modal using ID.showModal() method -->
    <label for="manhoursRegister"
        class="btn btn-sm btn-square btn-info tooltip-info tooltip-top tooltip"data-tip="Create">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7  " viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg>
    </label>
    <label for="uploadManhoursRegister" class="btn btn-sm btn-square btn-warning tooltip-warning tooltip-top tooltip"
        data-tip="Import">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 pt-0.5">
            <path
                d="M9.97.97a.75.75 0 011.06 0l3 3a.75.75 0 01-1.06 1.06l-1.72-1.72v3.44h-1.5V3.31L8.03 5.03a.75.75 0 01-1.06-1.06l3-3zM9.75 6.75v6a.75.75 0 001.5 0v-6h3a3 3 0 013 3v7.5a3 3 0 01-3 3h-7.5a3 3 0 01-3-3v-7.5a3 3 0 013-3h3z" />
            <path
                d="M7.151 21.75a2.999 2.999 0 002.599 1.5h7.5a3 3 0 003-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 01-4.5 4.5H7.151z" />
        </svg>
    </label>
    <input type="checkbox" id="manhoursRegister" class="modal-toggle" />
    <div id="manhoursRegister" role="dialog" class="modal ">
        <div class="modal-box sm:w-[55%] max-w-5xl">
            <div class="divider divider-primary font-bold">{{ __('add') }} Manhours</div>
            <form wire:submit.prevent='store'>
                @csrf
                <div class="flex flex-wrap gap-1 ">
                    <div class="w-full max-w-xs form-control">
                        <x-input-label-req :value="__('date')" />
                        <input type="text" placeholder="Type here" wire:model='date' id="dateManhours"
                            class=" @error('date') border-rose-500 border-2 @enderror z-10 capitalize w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                        <x-input-error :messages="$errors->get('date')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs form-control">
                        <x-input-label-req :value="__('Category_Company')" />
                        <select wire:model='company_category'
                            class=" @error('company_category') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                            <option value="" selected>select category company</option>
                            @foreach ($KategoryCompany as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('company_category')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs form-control">
                        <x-input-label-req :value="__('Company')" />
                        <select wire:model='company'
                            class=" @error('company') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                            <option value="" selected>select company</option>
                            @foreach ($SelectCompany as $key => $value)
                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('company')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs form-control">
                        <x-input-label-req :value="__($label_dept)" />
                        <select wire:model='dept'
                            class=" @error('dept') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                            <option value="" selected>select {{ __('department') }}</option>
                            @foreach ($GroupCompany as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->Department->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('dept')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs form-control">
                        <x-input-label-req :value="__('Role Class')" />
                        <select wire:model='role_class'
                            class=" @error('role_class') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                            <option value="" selected>select Role</option>
                            <option value="Supervisor" selected>Supervisor</option>
                            <option value="Operational" selected>Operational</option>
                            <option value="Administrator" selected>Administrator</option>
                        </select>
                        <x-input-error :messages="$errors->get('role_class')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs form-control">
                        <x-input-label-req :value="__('manhour')" />
                        <input type="number" placeholder="Type here" wire:model='manhour' step="0.01"
                            class=" @error('manhour') border-rose-500 border-2 @enderror capitalize w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                        <x-input-error :messages="$errors->get('manhour')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs form-control">
                        <x-input-label-req :value="__('manpower')" />
                        <input type="number" step="0.01" placeholder="Type here" wire:model='manpower'
                            class=" @error('manpower') border-rose-500 border-2 @enderror capitalize w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                        <x-input-error :messages="$errors->get('manpower')" class="mt-0" />
                    </div>
                </div>
                <div class="modal-action">
                    <!-- if there is a button in form, it will close the modal -->
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                    <label for="manhoursRegister" class="btn btn-error btn-sm">Close</label>
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
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('File Name')" />
                    <input type="file" placeholder="Type here" wire:model='fileImport' required`
                        class=" @error('fileImport') border-rose-500 border-2 @enderror w-full max-w-xs file-input file-input-bordered file-input-success file-input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                    <x-input-error :messages="$errors->get('fileImport')" class="mt-0" />
                </div>
                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs" wire:target="uploadManhours"
                        wire:loading.class="btn-disabled">Upload
                        <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                        </svg>
                        <span wire:loading wire:target="fileImport"
                            class="loading loading-spinner loading-sm hidden"wire:loading.class="block"></span>
                    </button>
                    <label for="uploadManhoursRegister" wire:target="uploadManhours"
                        wire:loading.class="btn-disabled" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
</div>
