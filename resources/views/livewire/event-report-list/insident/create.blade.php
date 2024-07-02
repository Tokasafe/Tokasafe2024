<div>
    @push('scripts')
       
    @endpush
    <!-- You can open the modal using ID.showModal() method -->
    @include('toast.toast')
    <label wire:click='open_modal' class="btn btn-xs btn-info btn-square btn-outline">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd"
                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z"
                clip-rule="evenodd" />
        </svg>

    </label>

    <div  class="{{ $openModal }} ">
        <div class="h-full max-w-7xl xl:w-11/12  xl:h-[800px] modal-box p-0 m-0">

            <div class="bg-base-100 sticky z-20 top-0  grid justify-items-stretch gap-0 shadow-md">
                <label wire:click='close_modal'
                class=" z-20 font-bold text-rose-500 btn btn-xs btn-circle btn-ghost justify-self-end top-3 m-1 ">✕</label>
                <div
                    class=" font-extrabold text-transparent divider divider-accent text-1xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                    {{ __('reportIncident') }}</div>
            </div>

            <div role="tablist" class="tabs tabs-bordered ">
                <input type="radio" name="my_tabs_2" role="tab" class="tab hidden p-0" aria-label="Tab 1" {{$tab}}/>
                <div role="tabpanel" class="tab-content ">
                    <form  wire:submit.prevent='store'>
                        @csrf
                        <div class="p-2 overflow-y-auto sm:h-[25rem] xxl:h-[645px]">
                            <div class="grid-cols-1 gap-1 xl:flex-none grid xl:grid-cols-2">
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                                    <x-input-label-req :value="__('et')" />
                                    <select wire:model='event_type'
                                        class=" @error('event_type') border-rose-500 border-2 @enderror select select-bordered select-xs w-full xl:max-w-xl sm:max-w-sm focus:outline-none  focus:ring-success focus:ring-1">
                                        <option selected>{{ __('select_option') }}</option>
                                        @foreach ($EventType as $key)
                                            <option value="{{ $key->id }}">{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('event_type')" class="mt-0" />
                                </div>
                                <div class="w-full xl:max-w-xl sm:max-w-sm form-control">
                                    <x-input-label-req :value="__('est')" />
                                    <select wire:model='sub_type'
                                        class=" @error('sub_type') border-rose-500 border-2 @enderror select select-bordered select-xs w-full xl:max-w-xl sm:max-w-sm focus:outline-none  focus:ring-success focus:ring-1">
                                        <option selected>{{ __('select_option') }}</option>
                                        @foreach ($EventSubType as $key)
                                            <option value="{{ $key->id }}">{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('sub_type')" class="mt-0" />
                                </div>
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                                    <x-input-label-req :value="__('rw')" />
                                    <label class="join " wire:click='openWokrgroup'>
                                        <input type="text" placeholder="Type here" wire:model='workgroup' readonly
                                            class=" @error('workgroup') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                        <label for=""
                                            class="border btn btn-xs btn-square join-item  btn-info @error('workgroup') btn-error @enderror">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                                            </svg>
        
                                        </label>
                                    </label>
                                    <x-input-error :messages="$errors->get('workgroup')" class="mt-0" />
                                </div>
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control relative">
                                    <x-input-label-req :value="__('nama_pelapor')" />
                                    <label class="join">
                                        <input type="text" placeholder="Type here" wire:model='reporter_name'
                                            class=" @error('reporter_name') border-rose-500 border-2 @enderror w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                        <label for=""
                                            class="border btn btn-xs btn-square join-item  btn-info @error('workgroup') btn-error @enderror">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </label>
                                    </label>
                                    <x-input-error :messages="$errors->get('reporter_name')" class="mt-0" />
                                    <div class=" fixed mt-10 py-1 z-10 w-64 {{ $show_reportBy }}">
                                        <div class="w-full max-w-xs text-xs shadow-inner bg-base-200 mt-2">
                                            <ul class="overflow-y-auto list-disc list-inside h-60">
        
                                                @forelse ($ReportBy as $index => $pelapor)
                                                    <li wire:click="cariPelapor('{{ $pelapor->id }}')"
                                                        class="px-2 cursor-pointer hover:bg-sky-400">
                                                        {{ $pelapor->lookup_name }}</li>
                                                @empty
                                                    <li class="text-rose-500 text-center font-semibold">name not found!!</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="bg-base-200">{{ $ReportBy->links('livewire.miniPagination') }}</div>
                                    </div>
                                </div>
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control relative ">
        
                                    <x-input-label-req :value="__('pengawas_area')" />
                                    <label class="join">
                                        <input type="text" placeholder="Type here" wire:model='report_to'
                                            class=" @error('report_to') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                        <label for=""
                                            class="border btn btn-xs btn-square join-item  btn-info @error('workgroup') btn-error @enderror">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
        
        
                                        </label>
                                    </label>
                                    <x-input-error :messages="$errors->get('report_to')" class="mt-0" />
                                    <div class=" fixed mt-10 py-1 z-10 w-64  {{ $show_reportTo }} ">
                                        <div class="w-full max-w-xs text-xs shadow-inner bg-base-200 mt-2">
                                            <ul class="overflow-y-auto list-disc list-inside h-60">
                                                @forelse ($ReportTo as $index => $pelapor)
                                                    <li wire:click="cariReportTo('{{ $pelapor->id }}')"
                                                        class="px-2 cursor-pointer hover:bg-sky-400">
                                                        {{ $pelapor->lookup_name }}</li>
                                                @empty
                                                    <li class="text-rose-500 text-center font-semibold">name not found!!</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="bg-base-200">{{ $ReportTo->links('livewire.miniPagination') }}</div>
        
                                    </div>
        
                                </div>
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                                    <x-input-label-req :value="__('el')" />
                                    <select wire:model='location'
                                        class=" @error('location') border-rose-500 border-2 @enderror select select-bordered select-xs w-full sm:max-w-xl focus:outline-none  focus:ring-success focus:ring-1">
                                        <option selected>{{ __('select_option') }}</option>
                                        @foreach ($Location as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('location')" class="mt-0" />
                                </div>
        
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                                    <x-input-label-req :value="__('tanggal_kejadian')" />
                                    <input type="text" id="tglLapor" placeholder="Type here" wire:model='date_event'
                                        readonly
                                        class=" @error('date_event') border-rose-500 border-2 @enderror  w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                    <x-input-error :messages="$errors->get('date_event')" class="mt-0" />
                                </div>
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                                    <x-input-label-req :value="__('time_event')" />
                                    <input type="text" id="jamKejadian" placeholder="Type here" wire:model='time_event'
                                        readonly
                                        class=" @error('time_event') border-rose-500 border-2 @enderror w-full input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                    <x-input-error :messages="$errors->get('time_event')" class="mt-0" />
                                </div>
        
        
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                                    <x-input-label-req :value="__('BerpotensiLTI')" />
        
                                    <fieldset
                                        class="flex items-start p-[3px] border @error('potential_lti') border-rose-500 border-2 @enderror gap-0.5">
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
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                                    <x-input-label :value="__('insidenlingkungan')" />
                                    <select wire:model='env_incident'
                                        class=" @error('env_incident') border-rose-500 border-2 @enderror select select-bordered select-xs w-full sm:max-w-xl focus:outline-none  focus:ring-success focus:ring-1">
                                        <option selected>{{ __('select_option') }}</option>
                                        <option value="Level 1">Level 1</option>
                                        <option value="Level 2">Level 2</option>
                                        <option value="Level 3">Level 3</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('env_incident')" class="mt-0 " />
                                </div>
                                <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                                    <x-input-label-req :value="__('tugas')" />
                                    <input type="text" placeholder="Type here" wire:model='task'
                                        class=" @error('task') border-rose-500 border-2 @enderror  w-full sm:max-w-xl input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                                    <x-input-error :messages="$errors->get('task')" class="mt-0" />
                                </div>
                                <div
                                    class="w-full sm:max-w-sm xl:max-w-xl form-control     {{ $documentation ? 'flex flex-row' : '' }}">
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
        
                            <div class="content-center grid-cols-1  gap-1  grid xl:grid-cols-2 ">
                                <div>
                                    <div wire:ignore class="w-full sm:max-w-sm xl:max-w-xl">
                                        <x-input-label-bhy :value="__('deskripsi')" />
                                        <textarea id="description_incident" placeholder="Type here" wire:model='description_incident'
                                            class="@error('description_incident') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                    </div>
                                    <x-input-error :messages="$errors->get('description_incident')" class="mt-0" />
                                </div>
                                <div>
                                    <div wire:ignore class="w-full sm:max-w-sm xl:max-w-xl">
                                        <x-input-label-req :value="__('InvolvedPerson')" />
                                        <textarea id="involved_person" placeholder="Type here" wire:model='involved_person'
                                            class="@error('involved_person') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                    </div>
                                    <x-input-error :messages="$errors->get('involved_person')" class="mt-0" />
                                </div>
                                <div>
                                    <div wire:ignore class="w-full sm:max-w-sm xl:max-w-xl">
                                        <x-input-label-req :value="__('InvolvedEquipment')" />
                                        <textarea id="involved_equipment" placeholder="Type here" wire:model='involved_equipment'
                                            class="@error('involved_equipment') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                    </div>
                                    <x-input-error :messages="$errors->get('involved_equipment')" class="mt-0" />
                                </div>
                                <div>
                                    <div wire:ignore class="w-full sm:max-w-sm xl:max-w-xl">
                                        <x-input-label-req :value="__('PreliminaryCauses')" />
                                        <textarea id="preliminary_causes" placeholder="Type here" wire:model='preliminary_causes'
                                            class="@error('preliminary_causes') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                    </div>
                                    <x-input-error :messages="$errors->get('preliminary_causes')" class="mt-0" />
                                </div>
                               
                            </div>
                            @include('livewire.event-report-list.insident.tablePenilaian')
                        </div>
        
                        <div class=" modal-action sticky bottom-0 h-8 px-2 pt-1 bg-base-100">
                           
                            <button type="submit" class="text-white btn btn-success btn-xs">{{ __('Next_Step') }}
                                       
                                <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z" clip-rule="evenodd" />
                                  </svg>
                                  
                                <span wire:loading wire:target="store" wire:loading.delay.long
                                    wire:loading.class="bg-rose-500"
                                    class="hidden loading loading-spinner loading-sm"></span>
                            </button>
                        </div>
        
                    </form>
                </div>
              
                <input type="radio" name="my_tabs_2" role="tab" class="tab hidden p-0" aria-label="Tab 2" {{$tab2}} />
                <div role="tabpanel" class="tab-content ">
                    @livewire('event-report-list.insident.action.create-one',['id'=>$id_incident])
                </div>
              
               
              </div>
           
        </div>
    </div>
    @include('livewire.event-report-list.insident.modal')
    <style>
        .ck-editor__editable[role="textbox"] {
            /* Editing area */
            /* min-height: 200px; */
            padding: 25px !IMPORTANT;
        }
    </style>
    <script>
        // description_incident
        ClassicEditor
            .create(document.querySelector('#description_incident'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {

                newEditor.model.document.on('change:data', () => {
                    @this.set('description_incident', newEditor.getData())
                });
                window.addEventListener('articleStore', event => {
                    newEditor.setData('');
                })
            })
            .catch(error => {
                console.error(error);
            });
        // involved_person
        ClassicEditor
            .create(document.querySelector('#involved_person'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']


            })
            .then(newEditor => {

                newEditor.model.document.on('change:data', () => {

                    @this.set('involved_person', newEditor.getData())
                    window.addEventListener('articleStore', event => {
                        newEditor.setData('');
                    })
                });
            })
            .catch(error => {
                console.error(error);
            });
        // involved_equipment
        ClassicEditor
            .create(document.querySelector('#involved_equipment'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {

                newEditor.model.document.on('change:data', () => {
                    console.log(newEditor.getData());
                    @this.set('involved_equipment', newEditor.getData())
                    window.addEventListener('articleStore', event => {
                        newEditor.setData('');
                    })
                });
            })
            .catch(error => {
                console.error(error);
            });
        // preliminary_causes
        ClassicEditor
            .create(document.querySelector('#preliminary_causes'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {

                newEditor.model.document.on('change:data', () => {

                    @this.set('preliminary_causes', newEditor.getData())
                    window.addEventListener('articleStore', event => {
                        newEditor.setData('');
                    })
                });
            })
            .catch(error => {
                console.error(error);
            });
        // imediate_action_taken
        ClassicEditor
            .create(document.querySelector('#imediate_action_taken'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {

                newEditor.model.document.on('change:data', () => {

                    @this.set('imediate_action_taken', newEditor.getData())
                    window.addEventListener('articleStore', event => {
                        newEditor.setData('');
                    })
                });
            })
            .catch(error => {
                console.error(error);
            });
        // key_learning
        ClassicEditor
            .create(document.querySelector('#key_learning'), {
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
