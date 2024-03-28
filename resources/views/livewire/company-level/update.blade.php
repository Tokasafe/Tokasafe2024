<div>
    @include('toast.toast')


    <div class="modal @if (!empty($openModal)) modal-open @endif">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-center">Update Department Group!</h3>
            <form wire:submit.prevent='store'>
                @csrf
                @method('PATCH')
                <div class="w-full max-w-xs mb-2 form-control">
                    <label class="p-0 label">
                        <span class="font-bold label-text-alt">Bussiness Unit</span>
                    </label>
                    <select wire:model='bussiness_unit'
                        class=" @error('bussiness_unit') border-rose-500 border-2 @enderror select select-success w-full select-sm max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option selected>Select Bussiness Unit</option>
                        @foreach ($BussinessUnit as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('bussiness_unit')
                        <label class="p-0 label">
                            <span class="label-text-alt text-rose-500">{{ $message }}</span>
                        </label>
                    @enderror
                </div>
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
                    <label class="p-0 label">
                        <span class="font-bold label-text-alt">{{ $LabelOption }}</span>
                    </label>
                    <select wire:model='dept_or_group'
                        class=" @error('dept_or_group') border-rose-500 border-2 @enderror select select-success w-full select-sm max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option selected>Select {{ $LabelOption }}</option>
                        @foreach ($Option as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('dept_or_group')
                        <label class="p-0 label">
                            <span class="label-text-alt text-rose-500">{{ $message }}</span>
                        </label>
                    @enderror
                </div>
                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label wire:click="outModal" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
</div>
