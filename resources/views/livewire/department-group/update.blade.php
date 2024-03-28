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
                        <span class="font-bold label-text-alt">Group</span>
                    </label>
                    <select wire:model='group_id'
                        class=" @error('group_id') border-rose-500 border-2 @enderror select select-success w-full select-sm max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option selected>Select Group</option>
                        @foreach ($Group as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('group_id')
                        <label class="p-0 label">
                            <span class="label-text-alt text-rose-500">{{ $message }}</span>
                        </label>
                    @enderror
                </div>
                <div class="w-full max-w-xs form-control">
                    <label class="p-0 label">
                        <span class="font-bold label-text-alt">Department</span>
                    </label>
                    <select wire:model='department_id'
                        class=" @error('department_id') border-rose-500 border-2 @enderror select select-success w-full select-sm max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option selected>Select Department</option>
                        @foreach ($Department as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
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
