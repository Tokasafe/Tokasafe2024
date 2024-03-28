<div>
    @include('toast.toast')
    <!-- You can open the modal using ID.showModal() method -->
    <label for="my_modal_4" class="btn btn-sm btn-square btn-info ">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg>
    </label>
    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my_modal_4" class="modal-toggle" />
    <div id="my_modal_4" class="modal ">
        <div class="w-11/12 max-w-5xl modal-box">
            <h3 class="text-lg font-bold text-center">Hello!</h3>
            <form wire:submit.prevent='store'>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Name')" />
                            <input type="text" placeholder="Type here" wire:model='name'
                                class=" @error('name') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('name')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('description')" />
                            <input type="text" placeholder="Type here" wire:model='description'
                                class=" @error('description') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('description')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('status_code')" />
                            <select wire:model='status_code'
                                class=" @error('status_code') border-rose-500 border-2 @enderror select select-success w-full select-xs max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>{{ __('select') }} {{ __('status_code') }}</option>
                                @foreach ($StatusCode as $item)
                                    @if (old('status_code') == $item->id)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status_code')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('responsible_role')" />
                            <select wire:model='responsible_role'
                                class=" @error('responsible_role') border-rose-500 border-2 @enderror select select-success w-full select-xs max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>{{ __('select') }} {{ __('responsible_role') }}</option>
                                @foreach ($Responsible_role as $item)
                                    @if (old('responsible_role') == $item->id)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('responsible_role')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control ">
                            <x-input-label-req :value="__('Is Cancel Step:')" />
                            <label class="cursor-pointer label">
                                <span class="label-text">Yes:</span>
                                <input type="checkbox" wire:model="checkCancel" value="Cancelled"
                                    class=" checkbox checkbox-xs checkbox-info" />
                            </label>
                        </div>
                    </div>
                    <!-- ... -->
                    <div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('destination_1')" />
                            <select wire:model='destination_1'
                                class=" @error('destination_1') border-rose-500 border-2 @enderror select select-success w-full select-xs max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>{{ __('select') }} {{ __('destination_1') }}</option>
                                @foreach ($WorkflowAdministration as $item)
                                    @if (old('destination_1') == $item->id)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('destination_1')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('destination_1_label')" />
                            <input type="text" placeholder="Type here" wire:model='destination_1_label'
                                class=" @error('destination_1_label') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('destination_1_label')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('destination_2')" />
                            <select wire:model='destination_2'
                                class=" @error('destination_2') border-rose-500 border-2 @enderror select select-success w-full select-xs max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>{{ __('select') }} {{ __('destination_2') }}</option>
                                <option selected>Select Workflow Step</option>
                            </select>
                            <x-input-error :messages="$errors->get('destination_2')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('destination_2_label')" />
                            <input type="text" placeholder="Type here" wire:model='destination_2_label'
                                class=" @error('destination_2_label') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('destination_2_label')" class="mt-0" />
                        </div>
                    </div>
                </div>
                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label for="my_modal_4" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
</div>
