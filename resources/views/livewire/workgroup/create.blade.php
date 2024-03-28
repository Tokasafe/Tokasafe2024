<div>
    @include('toast.toast')
    <label for="my_workgroup" class="btn btn-sm btn-square btn-info "><svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg></label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my_workgroup" class="modal-toggle" />
    <div class="modal ">
        <div class="modal-box">
            <h4 class="font-semibold text-center ">Add Workgroup!</h4>
            <form wire:submit.prevent='store'>
                @csrf
                <div class="flex">
                    <div class="flex items-center">
                        <label class="gap-2 cursor-pointer label">
                            <input type="radio" name="radio-10" wire:model='level' value="department"
                                class="radio radio-xs checked:bg-teal-600" checked />
                            <span class="label-text">Department</span>
                        </label>
                    </div>
                    <div class="flex items-center">
                        <label class="gap-2 cursor-pointer label">
                            <input type="radio" name="radio-10" wire:model='level' value="contractor"
                                class="radio radio-xs checked:bg-sky-600" />
                            <span class="label-text">Contractor</span>
                        </label>
                    </div>
                </div>
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('Company Level')" />
                    <select wire:model='companyLevel_id'
                        class=" @error('companyLevel_id') border-rose-500 border-2 @enderror select-xs select select-success w-full select-sm max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option selected>Select Company Level</option>
                        @foreach ($CompanyLevel as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->BussinessUnit->name }}-{{ $level }}-{{ $item->deptORcont }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('companyLevel_id')" class="mt-0" />
                </div>
                @foreach ($inputs as $key => $value)
                    <div class="my-1">

                        <div class="flex flex-row gap-1">
                            <div class="flex items-stretch w-full gap-1">
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label-req :value="__('Role Class')" />
                                    <select
                                        class="w-full max-w-xs select select-bordered select-xs  @error('role.' . $value) select-error  @enderror"
                                        wire:model="role.{{ $value }}">
                                        <option selected>select Job Class</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Operational">Operational</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="MSD">MSD</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('role.' . $value)" class="mt-0" />
                                </div>
                                <label wire:click.prevent='remove({{ $key }})'
                                    class="self-end btn btn-xs btn-square btn-error btn-outline tooltip tooltip-error"
                                    data-tip="remove"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z"
                                            clip-rule="evenodd" />
                                    </svg></label>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="flex flex-row gap-1">
                    <div class="flex items-stretch w-full gap-1">
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Role Class')" />
                            <select
                                class="w-full max-w-xs select select-bordered select-xs  @error('role.0') select-error  @enderror"
                                wire:model="role.0">
                                <option selected>select Job Class</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Operational">Operational</option>
                                <option value="Administrator">Administrator</option>
                                <option value="MSD">MSD</option>
                            </select>
                            <x-input-error :messages="$errors->get('role.0')" class="mt-0" />
                        </div>
                        <label wire:click.prevent='add({{ $i }})'
                            class="self-end btn btn-xs btn-info btn-square btn-outline tooltip tooltip-info"
                            data-tip="add"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z"
                                    clip-rule="evenodd" />
                            </svg></label>
                    </div>
                </div>

                <div class="modal-action">

                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label for="my_workgroup" class="text-white btn btn-error btn-xs">Close!</label>
                </div>
            </form>
        </div>
    </div>
</div>
