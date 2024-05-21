<div>
    <!-- You can open the modal using ID.showModal() method -->
    @include('toast.toast')
    <label class="btn btn-xs btn-accent btn-square btn-outline" for="my_modal_3">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd"
                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z"
                clip-rule="evenodd" />
        </svg>

    </label>
    <input type="checkbox" id="my_modal_3" class="modal-toggle" />
    <div id="my_modal_3" class="modal ">
        <div class="modal-box sm:w-11/12 sm:max-w-5xl">

            <div
                class="font-extrabold text-transparent divider divider-accent text-1xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                {{ __('reportIncident') }}</div>
            <div class="overflow-auto h-80">
                <form wire:submit.prevent='store'>
                    @csrf
                    <div class="flex flex-wrap gap-1">
                        <div class="w-full max-w-md form-control">
                            <x-input-label-req :value="__('et')" />
                            <select wire:model='event_type'
                                class=" @error('event_type') border-rose-500 border-2 @enderror select select-bordered select-xs w-full max-w-md focus:outline-none  focus:ring-success focus:ring-1">
                                <option selected>{{ __('select_option') }}</option>
                                @foreach ($EventType as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('event_type')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-md form-control">
                            <x-input-label-req :value="__('est')" />
                            <select wire:model='sub_type'
                                class=" @error('sub_type') border-rose-500 border-2 @enderror select select-bordered select-xs w-full max-w-md focus:outline-none  focus:ring-success focus:ring-1">
                                <option selected>{{ __('select_option') }}</option>
                                @foreach ($EventSubType as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('sub_type')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-md form-control">
                            <x-input-label-req :value="__('rw')" />
                            <label class="join " wire:click='openWokrgroup'>
                                <input type="text" placeholder="Type here" wire:model='workgroup' readonly
                                    class=" @error('workgroup') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                <label for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                                    </svg>

                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('workgroup')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-md form-control">
                            <x-input-label-req :value="__('nama_pelapor')" />
                            <label class="join" wire:click='openReportBy'>
                                <input type="text" placeholder="Type here" wire:model='reporter_name' readonly
                                    class=" @error('reporter_name') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                <label for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('reporter_name')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-md form-control">
                            <x-input-label-req :value="__('pengawas_area')" />
                            <label wire:click='openReportTo' class="join">
                                <input type="text" placeholder="Type here" wire:model='report_to'
                                    class=" @error('report_to') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                <label for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('report_to')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-md form-control">
                            <x-input-label-req :value="__('el')" />
                            <select wire:model='location'
                                class=" @error('location') border-rose-500 border-2 @enderror select select-bordered select-xs w-full max-w-md focus:outline-none  focus:ring-success focus:ring-1">
                                <option selected>{{ __('select_option') }}</option>
                                @foreach ($Location as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('location')" class="mt-0" />
                        </div>

                        <div class="w-full max-w-md form-control">
                            <x-input-label-req :value="__('tanggal_kejadian')" />
                            <input type="text" id="tglLapor" placeholder="Type here" wire:model='date_event'
                                readonly
                                class=" @error('date_event') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('date_event')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-md form-control">
                            <x-input-label-req :value="__('time_event')" />
                            <input type="text" id="jamKejadian" placeholder="Type here" wire:model='time_event'
                                readonly
                                class=" @error('time_event') border-rose-500 border-2 @enderror w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('time_event')" class="mt-0" />
                        </div>


                        <div class="w-full max-w-md form-control ">
                            <x-input-label-req :value="__('BerpotensiLTI')" />

                            <fieldset class="">
                                <input wire:model.live="potential_lti" name="radio-10" id="yes"
                                    class="radio-xs peer/yes checked:bg-rose-500 radio" type="radio" name="status"
                                    value="Yes" />
                                <label for="yes"
                                    class="text-xs font-semibold peer-checked/yes:text-rose-500">{{ __('Yes') }}</label>

                                <input wire:model.live="potential_lti" name="radio-10" id="no"
                                    class="radio-xs peer/no checked:bg-sky-500 radio" type="radio" name="status"
                                    value="No" />
                                <label for="no"
                                    class="text-xs font-semibold peer-checked/no:text-sky-500">{{ __('No') }}</label>

                            </fieldset>
                            <x-input-error :messages="$errors->get('potential_lti')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-md form-control ">
                            <x-input-label :value="__('insidenlingkungan')" />
                            <select wire:model='env_incident'
                                class=" @error('env_incident') border-rose-500 border-2 @enderror select select-bordered select-xs w-full max-w-md focus:outline-none  focus:ring-success focus:ring-1">
                                <option selected>{{ __('select_option') }}</option>
                                <option value="Level 1">Level 1</option>
                                <option value="Level 2">Level 2</option>
                                <option value="Level 3">Level 3</option>
                            </select>
                            <x-input-error :messages="$errors->get('env_incident')" class="mt-0 " />
                        </div>
                        <div class="w-full max-w-md form-control">
                            <x-input-label-req :value="__('tugas')" />
                            <input type="text" placeholder="Type here" wire:model='task'
                                class=" @error('task') border-rose-500 border-2 @enderror  w-full max-w-md input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('task')" class="mt-0" />
                        </div>
                        <div
                            class="w-full max-w-md form-control     {{ $documentation ? 'flex flex-row' : '' }}">
                            <div class="{{ $documentation ? 'flex-initial w-[650px]' : '' }} relative">
                                <x-input-label :value="__('documentation')" />
                                <input type="file" wire:model='documentation'
                                    class=" @error('documentation') border-rose-500 border-2 @enderror peer relative file-input file-input-bordered file-input-primary w-full  file-input-xs  focus:outline-none  focus:ring-success focus:ring-1" />
                                <span class="absolute mt-1 right-2" wire:loading wire:target="documentation"
                                    wire:loading.class="loading loading-dots loading-xs text-neutral"></span>
                                <x-input-error :messages="$errors->get('documentation')" class="mt-0" />
                            </div>
                            @if ($documentation)
                                <div class="flex-none w-10 ">
                                    <div class="p-2 mt-4">
                                       
                                        @include('livewire.event-report-list.insident.svgCreate')

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <div wire:ignore class="w-full max-w-md sm:max-w-screen-2xl form-control">
                            <x-input-label-bahaya :value="__('deskripsi')" />
                            <textarea id="editor1" placeholder="Bio" wire:model='description_incident'
                                class="@error('description_incident') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('description_incident')" class="mt-0" />
                    </div>
                    <div>
                        <div wire:ignore class="w-full max-w-md sm:max-w-screen-2xl form-control">
                            <x-input-label-req :value="__('InvolvedPerson')" />
                            <textarea id="editor2" placeholder="Bio" wire:model='involved_person'
                                class="@error('involved_person') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('involved_person')" class="mt-0" />
                    </div>
                    <div>
                        <div wire:ignore class="w-full max-w-md sm:max-w-screen-2xl form-control">
                            <x-input-label-req :value="__('InvolvedEquipment')" />
                            <textarea id="editor3" placeholder="Bio" wire:model='involved_person'
                                class="@error('involved_equipment') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('involved_equipment')" class="mt-0" />
                    </div>
                    <div>
                        <div wire:ignore class="w-full max-w-md sm:max-w-screen-2xl form-control">
                            <x-input-label-req :value="__('PreliminaryCauses')" />
                            <textarea id="editor4" placeholder="Bio" wire:model='preliminary_causes'
                                class="@error('preliminary_causes') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('preliminary_causes')" class="mt-0" />
                    </div>
                    <div>
                        <div wire:ignore class="w-full max-w-md sm:max-w-screen-2xl form-control">
                            <x-input-label-req :value="__('ImmediateActionTaken')" />
                            <textarea id="editor5" placeholder="Bio" wire:model='imediate_action_taken'
                                class="@error('imediate_action_taken') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('imediate_action_taken')" class="mt-0" />
                    </div>
                    <div>
                        <div wire:ignore class="w-full max-w-md sm:max-w-screen-2xl form-control">
                            <x-input-label-req :value="__('KeyLearning')" />
                            <textarea id="editor6" placeholder="Bio" wire:model='key_learning'
                                class="@error('key_learning') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('key_learning')" class="mt-0" />
                    </div>
                    @include('livewire.event-report-list.insident.tablePenilaian')
            </div>
            <div class="modal-action">
                <button type="submit" id="my-submit" class="text-white btn btn-success btn-xs">Save
                    <svg wire:loading.remove wire:target="store" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                    </svg>
                    <span wire:loading wire:target="store" wire:loading.delay.long wire:loading.class="bg-rose-500"
                        class="hidden loading loading-spinner loading-sm"></span>
                </button>
                <label for="my_modal_3" class="text-white btn btn-xs btn-error">Close!</label>
            </div>
            </form>
        </div>
    </div>
    @include('livewire.event-report-list.insident.modal')

    <script>
        const editor = CKEDITOR.replace('editor1');
        editor.config.uiColor = '#bae6fd';
        editor.config.height = 150;

        editor.config.toolbar = [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                items: ['Scayt']
            },

            {
                name: 'tools',
                items: ['Maximize']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format']
            },

        ];

        editor.on('change', function(event) {
            // console.log(event.editor.getData())
            @this.set('description_incident', event.editor.getData())
        })
        const editor2 = CKEDITOR.replace('editor2');
        editor2.config.uiColor = '#bae6fd';
        editor2.config.height = 150;

        editor2.config.toolbar = [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                items: ['Scayt']
            },

            {
                name: 'tools',
                items: ['Maximize']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format']
            },

        ];

        editor2.on('change', function(event) {
            console.log(event.editor.getData())
            @this.set('involved_person', event.editor.getData())
        })
        const editor3 = CKEDITOR.replace('editor3');
        editor3.config.uiColor = '#bae6fd';
        editor3.config.height = 150;

        editor3.config.toolbar = [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                items: ['Scayt']
            },

            {
                name: 'tools',
                items: ['Maximize']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format']
            },

        ];

        editor3.on('change', function(event) {
            // console.log(event.editor3.getData())
            @this.set('involved_equipment', event.editor.getData())
        })
        const editor4 = CKEDITOR.replace('editor4');
        editor4.config.uiColor = '#bae6fd';
        editor4.config.height = 150;

        editor4.config.toolbar = [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                items: ['Scayt']
            },

            {
                name: 'tools',
                items: ['Maximize']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format']
            },

        ];

        editor4.on('change', function(event) {
            // console.log(event.editor4.getData())
            @this.set('preliminary_causes', event.editor.getData())
        })
        const editor5 = CKEDITOR.replace('editor5');
        editor5.config.uiColor = '#bae6fd';
        editor5.config.height = 150;

        editor5.config.toolbar = [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                items: ['Scayt']
            },

            {
                name: 'tools',
                items: ['Maximize']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format']
            },

        ];

        editor5.on('change', function(event) {
            // console.log(event.editor5.getData())
            @this.set('imediate_action_taken', event.editor.getData())
        })
        const editor6 = CKEDITOR.replace('editor6');
        editor6.config.uiColor = '#bae6fd';
        editor6.config.height = 150;

        editor6.config.toolbar = [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                items: ['Scayt']
            },

            {
                name: 'tools',
                items: ['Maximize']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format']
            },

        ];

        editor6.on('change', function(event) {
            // console.log(event.editor6.getData())
            @this.set('key_learning', event.editor.getData())
        })

        window.addEventListener('articleStore', event => {

            CKEDITOR.instances['editor1'].setData('');
            CKEDITOR.instances['editor2'].setData('');
            CKEDITOR.instances['editor3'].setData('');
            CKEDITOR.instances['editor4'].setData('');
            CKEDITOR.instances['editor5'].setData('');
            CKEDITOR.instances['editor6'].setData('');
        })
    </script>


</div>
