<div>
    @include('toast.toast')
    <label {{$hazardClose?'disabled':''}} for="actionEvent" class="btn btn-sm btn-square btn-info "><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg></label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="actionEvent" class="modal-toggle" />
    <div class="modal ">
        <div class="w-11/12 max-w-5xl modal-box">
           
            <div class="divider divider-primary"> <h3 class="text-lg font-bold text-center">Action Editor!</h3></div>
            <form >
                <table class="table table-xs">
                    @csrf
                    <tbody>
                        <tr>

                            <td>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('Observation, Hazard or Non-Conformance')" />
                                    <textarea type="text" wire:model='report' placeholder="Type here"@readonly(true)
                                        class="w-full @error('report') border-rose-500 @enderror max-w-xs textarea textarea-success input-xs focus:outline-none focus:border-success focus:ring-none focus:ring-0">testing</textarea>
                                    <x-input-error :messages="$errors->get('report')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label-req :value="__('Followup Action')" />
                                    <textarea type="text" wire:model='followup_action' placeholder="Type here"
                                        class="w-full @error('followup_action') border-rose-500 @enderror max-w-xs textarea textarea-success input-xs focus:outline-none focus:border-success focus:ring-none focus:ring-0">testing</textarea>
                                    <x-input-error :messages="$errors->get('followup_action')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('Actionee Comments')" />
                                    <textarea type="text" wire:model='actionee_comments' placeholder="Type here"
                                        class="w-full @error('actionee_comments') border-rose-500 @enderror max-w-xs textarea textarea-success input-xs focus:outline-none focus:border-success focus:ring-none focus:ring-0">testing</textarea>
                                    <x-input-error :messages="$errors->get('actionee_comments')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('Action Conditions')" />
                                    <textarea type="text" wire:model='action_condition' placeholder="Type here"
                                        class="w-full @error('action_condition') border-rose-500 @enderror max-w-xs textarea textarea-success input-xs focus:outline-none focus:border-success focus:ring-none focus:ring-0">testing</textarea>
                                    <x-input-error :messages="$errors->get('action_condition')" class="mt-0" />
                                </div>
                            </td>
                            <td>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label-req :value="__('Responsibility')" />
                                    <div class="join">
                                        <input type="text" wire:model='responsibility' placeholder="Type here"
                                            class="w-full @error('responsibility') border-rose-500 @enderror join-item max-w-xs input input-success input-xs focus:outline-none focus:border-success focus:ring-none focus:ring-0" />
                                        <label wire:click='openModal' class="btn btn-square btn-xs btn-info join-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>

                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->get('responsibility')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('Due Date')" />
                                    <input id="due_date" type="text" wire:model='due_date' placeholder="Type here"
                                        readonly
                                        class="w-full @error('due_date') border-rose-500 @enderror max-w-xs input input-success input-xs focus:outline-none focus:border-success focus:ring-none focus:ring-0" />
                                    <x-input-error :messages="$errors->get('due_date')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('Completion Date:')" />
                                    <input id="completion" type="text" wire:model='competed' placeholder="Type here"
                                        readonly
                                        class="w-full @error('competed') border-rose-500 @enderror max-w-xs input input-success input-xs focus:outline-none focus:border-success focus:ring-none focus:ring-0" />
                                    <x-input-error :messages="$errors->get('competed')" class="mt-0" />
                                </div>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <div class="modal-action">
                    <label wire:click='storeAction'  class="text-white btn btn-success btn-xs">{{ __('Save') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </label>
                    <label for="actionEvent" class="btn btn-error btn-xs">{{ __('Close') }}!</label>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.event-report-list.hazard-id.action.modal')
</div>
