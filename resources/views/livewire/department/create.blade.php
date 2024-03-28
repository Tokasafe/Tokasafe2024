<div>
    @include('toast.toast')
    <!-- The button to open modal -->
    <!-- You can open the modal using ID.showModal() method -->
    <!-- The button to open modal -->
    <label for="addDept" class="btn btn-sm btn-square btn-info tooltip-info tooltip-top tooltip"
    data-tip="Create Department"><svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 pt-0.5"
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg></label>

        <label for="uploadDept" class="btn btn-sm btn-square btn-warning tooltip-warning tooltip-top tooltip"
        data-tip="Import">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 pt-0.5">
            <path
                d="M9.97.97a.75.75 0 011.06 0l3 3a.75.75 0 01-1.06 1.06l-1.72-1.72v3.44h-1.5V3.31L8.03 5.03a.75.75 0 01-1.06-1.06l3-3zM9.75 6.75v6a.75.75 0 001.5 0v-6h3a3 3 0 013 3v7.5a3 3 0 01-3 3h-7.5a3 3 0 01-3-3v-7.5a3 3 0 013-3h3z" />
            <path
                d="M7.151 21.75a2.999 2.999 0 002.599 1.5h7.5a3 3 0 003-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 01-4.5 4.5H7.151z" />
        </svg>
    </label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="addDept" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-center">Add Department!</h3>
            <form wire:submit.prevent='store'>
                <div class="w-full max-w-xs form-control">
                    <label class="p-0 label">
                        <span class="label-text-alt">Name</span>
                    </label>
                    <input type="text" placeholder="Type here" wire:model='name'
                        class=" @error('name') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-sm focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                    @error('name')
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
                    <label for="addDept" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>

    <input type="checkbox" id="uploadDept" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box">
        <div class="divider divider-primary">Import new Company</div>
        <form wire:submit.prevent='uploadDept'>
            @csrf 
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('File Name')" />
                    <input type="file" placeholder="Type here" wire:model='fileImport' required`
                        class=" @error('fileImport') border-rose-500 border-2 @enderror w-full max-w-xs file-input file-input-bordered file-input-success file-input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                    <x-input-error :messages="$errors->get('fileImport')" class="mt-0" />
                </div>
            <div class="modal-action">
                <button type="submit" class="text-white btn btn-success btn-xs">Save
                    <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                    </svg>
                    <svg wire:loading wire:target="fileImport" class="animate-spin h-5 w-5 mr-3 ..." viewBox="0 0 24 24">
                        <!-- ... -->
                      </svg>
                </button>
                <label for="uploadDept" class="btn btn-xs btn-error">Close!</label>
            </div>
        </form>
      
      </div>
    </div>
</div>
