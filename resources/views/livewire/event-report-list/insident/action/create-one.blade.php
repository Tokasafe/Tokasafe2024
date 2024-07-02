<div>
    <form class="">
        @csrf
        <div class="overflow-x-auto ">
            <table class="table table-xs">
                <tbody>
                    <tr>
                        <td>
                            <table class="table table-xs">
                              
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
                                                <input type="text" placeholder="Type here" wire:model='report_to'
                                                    class=" @error('report_to') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                                <label for=""
                                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
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
            <div class="mx-4">
                <div wire:ignore class="w-full ">
                    <x-input-label-req :value="__('KeyLearning')" />
                    <textarea id="key_learningOne" placeholder="Type here" wire:model='key_learning'
                        class="@error('key_learning') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                </div>
                <x-input-error :messages="$errors->get('key_learning')" class="mt-0" />
            </div>
        </div>
        <div class="modal-action">
            <label wire:click='storeAction' class="btn btn-success btn-xs">{{ __('Save') }}</label>
            <label wire:click='backTabIncident' class="btn btn-error btn-xs">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd"
                        d="M3.22 7.595a.75.75 0 0 0 0 1.06l3.25 3.25a.75.75 0 0 0 1.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 0 0-1.06-1.06l-3.25 3.25Zm8.25-3.25-3.25 3.25a.75.75 0 0 0 0 1.06l3.25 3.25a.75.75 0 1 0 1.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 0 0-1.06-1.06Z"
                        clip-rule="evenodd" />
                </svg>

                {{ __('Previous_step') }}</label>
        </div>
    </form>
    @include('livewire.event-report-list.insident.action.modal')
    <script>
          // key_learning
          ClassicEditor
            .create(document.querySelector('#key_learningOne'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {

                newEditor.model.document.on('change:data', () => {

                    @this.set('key_learning', newEditor.getData())
                    window.addEventListener('articleStore', event => {
                        newEditor.setData('');
                    })
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</div>
