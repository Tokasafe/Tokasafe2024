<div>
    @include('toast.toast')
    <div id="manhoursRegister" role="dialog" class=" {{$openModal?'modal modal-open':'modal'}} ">
        <div class="modal-box sm:w-[51%] lg:w-auto max-w-5xl">
            <div class="divider divider-primary font-bold">Update Manhours</div>
            <form wire:submit.prevent='store'>
                @csrf
                <div class="flex flex-wrap gap-1">
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
                    <label wire:click='closeModal' class="btn btn-error btn-sm">Close</label>
                </div>
            </form>
        </div>
    </div>
</div>
