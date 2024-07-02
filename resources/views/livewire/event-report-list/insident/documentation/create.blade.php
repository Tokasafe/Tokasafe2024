<div>
    @include('toast.toast')
    <!-- The button to open modal -->
    <!-- You can open the modal using ID.showModal() method -->
    <!-- The button to open modal -->


    <label  for="inputDoc" class="btn btn-xs btn-outline btn-accent {{$IncidentClose?'btn-disabled':''}}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd"
                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z"
                clip-rule="evenodd" />
        </svg>

        New Documentation
    </label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="inputDoc" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">


            <div
                class="font-extrabold text-transparent divider divider-info text-1xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                {{ __('Input Document!') }}</div>
            <form wire:submit.prevent='store_document'wire:target="fileName" wire:loading.class="skeleton">
                @csrf



                <div class="w-full max-w-lg form-control">

                    <x-input-label-req :value="__('description')" />
                    <textarea type="text" placeholder="Type here" wire:model='fileTitle'
                        class=" @error('fileTitle') border-rose-500 border-2 @enderror w-full  textarea textarea-bordered textarea-success textarea-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1"></textarea>
                    <x-input-error :messages="$errors->get('fileTitle')" class="mt-0" />
                </div>
                <div class="w-full max-w-lg form-control">

                    <x-input-label-req :value="__('File Name')" />
                    <x-input-file :error="$errors->get('fileName')" class="relative" wire:model='fileName' />
                    <x-input-error :messages="$errors->get('fileName')" class="mt-0" />
                </div>




                <div class="modal-action">
                    <button wire:target="fileName" wire:loading.class="btn-disabled" type="submit"
                        class="text-white btn btn-success btn-xs">{{ __('Save') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label for="inputDoc" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
    
</div>
