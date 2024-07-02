<div>
    @include('toast.toast')
    <!-- The button to open modal -->
    <!-- You can open the modal using ID.showModal() method -->
    <!-- The button to open modal -->
    <label for="addDeptGroup" class="btn btn-sm btn-square btn-info "><svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg></label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="addDeptGroup" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-center">Add Department Group!</h3>
            <form wire:submit.prevent='storeDeptGroup'>
                @csrf
                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                    <x-input-label-req :value="__('Group')" />
                    <x-input-select wire:model='group_id' :error="$errors->get('group_id')">
                        <option value="" selected>Select an option</option>
                        @foreach ($Group as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </x-input-select>
                    <x-input-error :messages="$errors->get('group_id')" class="mt-0" />
                </div>

                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                    <x-input-label-req :value="__('Department')" />
                    <x-input-select wire:model='department_id' :error="$errors->get('department_id')">
                        <option value="" selected>Select an option</option>
                        @foreach ($Department as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                    </x-input-select>
                    <x-input-error :messages="$errors->get('department_id')" class="mt-0" />
                </div>
              

                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label for="addDeptGroup" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
</div>
