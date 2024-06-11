<div>
    @include('toast.toast')
    @push('scripts')
        <script>
            flatpickr("#orginal_dueDate", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#dueDate", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#dueDate", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#completion_date", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#personal_reminder", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
        </script>
    @endpush
    <!-- The button to open modal -->
    <label for="my_modal_7" class="btn btn-xs btn-outline btn-accent {{$IncidentClose?'btn-disabled':''}}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd"
                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z"
                clip-rule="evenodd" />
        </svg>

        New Action
    </label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my_modal_7" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="w-11/12 max-w-4xl modal-box">
            <div
                class="-mt-3 text-sm font-extrabold text-transparent divider divider-accent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                New Action</div>
            <form >
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
                                                    <textarea placeholder="Bio" wire:model='description_incident' disabled
                                                        class="@error('description_incident') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-xs w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                                    <x-input-error :messages="$errors->get('description_incident')" class="mt-0" />
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
                                        <tr>
                                            <td>
                                                <div class="w-full max-w-md form-control">
                                                    <x-input-label :value="__('Original Due Date')" />
                                                    <input type="text" id="orginal_dueDate" placeholder="Type here"
                                                        wire:model='orginal_dueDate' readonly
                                                        class=" @error('orginal_dueDate') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                                    <x-input-error :messages="$errors->get('orginal_dueDate')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <td>
                                                <div class="w-full max-w-md form-control">
                                                    <x-input-label-req :value="__('Responsibility')" />
                                                    <label wire:click='openResponsibility' class="join">
                                                        <input type="text" placeholder="Type here"
                                                            wire:model='report_to'
                                                            class=" @error('report_to') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-xs focus:outline-none  focus:ring-success focus:ring-1" />
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
                                                    <x-input-error :messages="$errors->get('report_to')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <td>
                                                <div class="w-full max-w-md form-control">
                                                    <x-input-label :value="__('Due Date')" />
                                                    <input type="text" id="dueDate" placeholder="Type here"
                                                        wire:model='dueDate' readonly
                                                        class=" @error('dueDate') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                                    <x-input-error :messages="$errors->get('dueDate')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <td>
                                                <div class="w-full max-w-md form-control">
                                                    <x-input-label :value="__('Completion Date')" />
                                                    <input type="text" id="completion_date" placeholder="Type here"
                                                        wire:model='completion_date' readonly
                                                        class=" @error('completion_date') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                                    <x-input-error :messages="$errors->get('completion_date')" class="mt-0" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <td>
                                                <div class="w-full max-w-md form-control">
                                                    <x-input-label :value="__('Personal Reminder')" />
                                                    <input type="text" id="personal_reminder" placeholder="Type here"
                                                        wire:model='personal_reminder' readonly
                                                        class=" @error('personal_reminder') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                                    <x-input-error :messages="$errors->get('personal_reminder')" class="mt-0" />
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
                    <label wire:click='storeAction' class="btn btn-success btn-xs">{{ __('Save') }}</label>
                    <label for="my_modal_7" wire:click='closeResponsibility' class="btn btn-error btn-xs">Close!</label>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.event-report-list.insident.action.modal')
</div>
