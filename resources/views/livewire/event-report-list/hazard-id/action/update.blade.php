<div>
    @include('toast.toast')
    <div class="{{ $modalOpenEvent === 'modal-open' ? 'modal modal-open' : 'modal' }}">
        <div class="w-11/12 max-w-5xl modal-box">
            <div
                class="-mt-3 text-sm font-extrabold text-transparent divider divider-accent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                Update Action</div>
            <form wire:submit.prevent='store'>
                @csrf
                <div class="overflow-x-auto">
                    <table class="table table-xs">

                        <tbody>
                            <tr>

                                <td>
                                    <table class="table table-xs">
                                        <tr>
                                            <td>
                                                <div class="w-full max-w-md sm:max-w-screen-2xl form-control">
                                                    <x-input-label-req :value="__('Observation, Hazard or Non-Conformance')" />
                                                    <textarea placeholder="Bio" wire:model='report' disabled
                                                        class="@error('report') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-xs w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                                    <x-input-error :messages="$errors->get('report')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="w-full max-w-md sm:max-w-screen-2xl form-control">
                                                    <x-input-label-req :value="__('Followup Action')" />
                                                    <textarea placeholder="Bio" wire:model='followup_action'
                                                        class="@error('followup_action') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-xs w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                                    <x-input-error :messages="$errors->get('followup_action')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="w-full max-w-md sm:max-w-screen-2xl form-control">
                                                    <x-input-label :value="__('Actionee Comments')" />
                                                    <textarea placeholder="Bio" wire:model='actionee_comments'
                                                        class="@error('actionee_comments') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-xs w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                                    <x-input-error :messages="$errors->get('actionee_comments')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="w-full max-w-md sm:max-w-screen-2xl form-control">
                                                    <x-input-label :value="__('Action Conditions')" />
                                                    <textarea placeholder="Bio" wire:model='action_condition'
                                                        class="@error('action_condition') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-xs w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                                    <x-input-error :messages="$errors->get('action_condition')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>


                                    </table>
                                </td>
                                <td>
                                    <table class="table table-xs">
                                       

                                        <tr valign="top">
                                            <td>
                                                <div class="w-full max-w-md form-control">
                                                    <x-input-label :value="__('Responsibility')" />
                                                    <label wire:click='openModal' class="join">
                                                        <input type="text" placeholder="Type here"
                                                            wire:model='responsibility'
                                                            class=" @error('responsibility') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                                        <label for=""
                                                            class="border btn btn-xs btn-square join-item border-info btn-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>


                                                        </label>
                                                    </label>
                                                    <x-input-error :messages="$errors->get('responsibility')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <td>
                                                <div class="w-full max-w-md form-control">
                                                    <x-input-label :value="__('Due Date')" />
                                                    <input type="text" id="due_date" placeholder="Type here"
                                                        wire:model='due_date' readonly
                                                        class=" @error('due_date') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                                    <x-input-error :messages="$errors->get('due_date')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <td>
                                                <div class="w-full max-w-md form-control">
                                                    <x-input-label :value="__('Completion Date')" />
                                                    <input type="text" id="completion" placeholder="Type here"
                                                        wire:model='competed' readonly
                                                        class=" @error('competed') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                                    <x-input-error :messages="$errors->get('competed')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </td>

                            </tr>

                        </tbody>

                    </table>
                </div>
                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">{{ __('Save') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label wire:click='outModal' class="btn btn-error btn-xs">{{ __('Close') }}!</label>
                </div>
            </form>
        </div>
    </div>

    @include('livewire.event-report-list.hazard-id.action.modal')
</div>
