<div>

    @include('toast.toast')
    <label wire:click='openModal' class="btn btn-xs btn-info btn-square btn-outline">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd"
                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z"
                clip-rule="evenodd" />
        </svg>
    </label>
    <div class="modal {{ $modal }} ">
        <div class="h-full  max-w-7xl xl:w-11/12  xl:h-[800px] modal-box p-0 justify-items-stretch">
            <div class="bg-base-100 sticky z-10 top-0 grid justify-items-stretch gap-0 shadow-md m-0">
                <label wire:click='closeModal'
                    class=" z-20 font-bold text-rose-500 btn btn-xs btn-circle btn-ghost justify-self-end top-3 m-1 ">✕</label>
                <div
                    class=" font-extrabold text-transparent divider divider-accent text-1xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                    {{ __('add_hazard') }}</div>
            </div>
            <div role="tablist" class="tabs tabs-bordered ">
                <input type="radio" name="my_tabs_1" role="tab" class="tab hidden" aria-label="Tab 1"
                    {{ $tab }} />
                <div role="tabpanel" class="tab-content ">
                    <form wire:submit.prevent='store'>
                        @csrf
                        @method('PATCH')
                        <div class="p-2 overflow-y-auto sm:h-[25rem] xxl:h-[645px]">

                            <div class="grid grid-cols-1 content-center xl:grid-cols-2 gap-1">
                                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                                    <x-input-label-req :value="__('est')" />
                                    <x-input-select wire:model='event_subtype' :error="$errors->get('event_subtype')">
                                        <option value="" selected>Select an option</option>
                                        @foreach ($EventSubType as $ets)
                                            <option value="{{ $ets->id }}">
                                                {{ $ets->EventType->name }}-{{ $ets->name }}</option>
                                        @endforeach
                                    </x-input-select>
                                    <x-input-error :messages="$errors->get('event_subtype')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control relative">
                                    <x-input-label-req :value="__('nama_pelapor')" />
                                    <label class="join">
                                        <x-input-new wire:model='nama_pelapor' type="text" class="join-item"
                                            onClick="document.getElementById('namaPelapor').style.display='block'"
                                            :error="$errors->get('nama_pelapor')" />
                                        <label for=""
                                            class="border btn btn-xs btn-square join-item @error('nama_pelapor') btn-error @enderror btn-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </label>
                                    </label>
                                    <x-input-error :messages="$errors->get('nama_pelapor')" class="mt-0" />
                                    <div id="namaPelapor" class="fixed mt-10 py-1 z-10 w-64 {{ $show_reportBy }}">
                                        <div class="w-full max-w-xs text-xs shadow-inner bg-base-200 mt-2">
                                            <ul class="overflow-y-auto list-disc list-inside h-60">
                                                @forelse ($People as $index => $person)
                                                    <li class="w-full cursor-pointer"
                                                        wire:click="cari_reportBy('{{ $person->id }}')">
                                                        {{ $person->lookup_name }}
                                                    </li>

                                                @empty
                                                    <li class="text-rose-500 text-center font-semibold">name not found!!
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="bg-base-200">{{ $People->links('livewire.miniPagination') }}</div>
                                    </div>
                                </div>
                                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                                    <x-input-label-req :value="__('tanggal_kejadian')" />
                                    <x-input-new id="tglLapor" wire:model='tanggal_kejadian' type="text"
                                        :error="$errors->get('tanggal_kejadian')" readonly />
                                    <x-input-error :messages="$errors->get('tanggal_kejadian')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                                    <x-input-label-req :value="__('time_event')" />
                                    <x-input-new id="jamKejadian" wire:model='waktu' type="text" :error="$errors->get('waktu')"
                                        readonly />
                                    <x-input-error :messages="$errors->get('waktu')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                                    <x-input-label-req :value="__('rw')" />
                                    <label class="join " wire:click='wgClick'>

                                        <x-input-new wire:model='workgroup' type="text" class="join-item"
                                            :error="$errors->get('workgroup')" readonly />
                                        <label for=""
                                            class="border btn btn-xs btn-square join-item @error('workgroup') btn-error @enderror btn-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                                            </svg>

                                        </label>
                                    </label>
                                    <x-input-error :messages="$errors->get('workgroup')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control relative">
                                    <x-input-label-req :value="__('pengawas_area')" />
                                    <label class="join">

                                        <x-input-new wire:model='pengawas_area' type="text" class="join-item" onClick="document.getElementById('pengawasArea').style.display='block'"
                                            :error="$errors->get('pengawas_area')" />
                                        <label for=""
                                            class="border btn btn-xs btn-square join-item @error('pengawas_area') btn-error @enderror btn-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </label>
                                    </label>
                                    <x-input-error :messages="$errors->get('pengawas_area')" class="mt-0" />
                                    <div id="pengawasArea" class="fixed mt-10 py-1 z-10 w-64 {{ $show_reportTo }}">
                                        <div class="w-full max-w-xs text-xs shadow-inner bg-base-200 mt-2">
                                            <ul class="overflow-y-auto list-disc list-inside h-60">
                                                @forelse ($Supervisor as $index => $person)
                                                    <li class="w-full cursor-pointer"
                                                        wire:click="cari_reportTo('{{ $person->id }}')">
                                                        {{ $person->lookup_name }}
                                                    </li>

                                                @empty
                                                    <li class="text-rose-500 text-center font-semibold">name not
                                                        found!!</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="bg-base-200">{{ $Supervisor->links('livewire.miniPagination') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                                    <x-input-label-req :value="__('el')" />
                                    <x-input-select wire:model='lokasi' :error="$errors->get('lokasi')">
                                        <option value="" selected>Select an option</option>
                                        @foreach ($LocationEvent as $location)
                                            <option value="{{ $location->name }}">{{ $location->name }}</option>
                                        @endforeach
                                    </x-input-select>
                                    <x-input-error :messages="$errors->get('lokasi')" class="mt-0" />
                                </div>
                                <div class="w-full max-w-xs sm:max-w-sm xl:max-w-xl  form-control">
                                    <x-input-label-req :value="__('tugas')" />

                                    <x-input-new wire:model='task' type="text" class="join-item"
                                        :error="$errors->get('task')" />
                                    <x-input-error :messages="$errors->get('task')" class="mt-0" />
                                </div>
                                <div
                                    class="w-full max-w-xs sm:max-w-sm xl:max-w-xl form-control     {{ $documentation ? 'flex flex-row' : '' }}">
                                    <div class="{{ $documentation ? 'flex-initial w-[650px]' : '' }} relative">
                                        <x-input-label :value="__('documentation')" />

                                        <x-input-file :error="$errors->get('documentation')" class="relative"
                                            wire:model='documentation' />
                                        <span class="absolute bottom-0 right-2 " wire:loading
                                            wire:target="documentation"
                                            wire:loading.class="loading loading-dots loading-xs text-neutral"></span>
                                        <x-input-error :messages="$errors->get('documentation')" class="mt-0" />
                                    </div>
                                    @if ($documentation)
                                        <div class="flex-none w-10 ">
                                            <div class="p-2 mt-4">

                                                @include('livewire.event-report-list.hazard-id.svgCreate')

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div wire:ignore class="w-80  sm:w-full form-control">
                                    <x-input-label-bahaya :value="__('deskripsi')" />
                                    <textarea id="rincian_bahaya" placeholder="Type here" wire:model='rincian_bahaya'
                                        class="@error('rincian_bahaya') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                                </div>
                                <x-input-error :messages="$errors->get('rincian_bahaya')" class="mt-0" />
                            </div>
                            @include('livewire.event-report-list.hazard-id.tablePenilaian')
                        </div>

                        <div class=" modal-action sticky bottom-0 h-8 px-2 pt-1 bg-base-100">
                            <button type="submit" class="text-white btn btn-success btn-xs">{{ __('Next_Step') }}

                                <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                    fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd"
                                        d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span wire:loading wire:target="store" wire:loading.delay.long
                                    wire:loading.class="bg-rose-500"
                                    class="hidden loading loading-spinner loading-sm"></span>
                            </button>
                        </div>
                    </form>
                </div>
                <input type="radio" name="my_tabs_1" role="tab" class="tab hidden" aria-label="Tab 2"
                    {{ $tab2 }} />
                <div role="tabpanel" class="tab-content ">
                    @livewire('event-report-list.hazard-id.action.create-one', ['id' => $id_hazard])
                </div>
            </div>
        </div>
    </div>
    @include('livewire.event-report-list.hazard-id.modal')
    <script>
        window.addEventListener('mouseup', function(event) {
            var namaPelapor = document.getElementById('namaPelapor');
            if (event.target != namaPelapor && event.target.parentNode != namaPelapor) {
                namaPelapor.style.display = 'none';
            }
        });
    </script>
    <script>
        window.addEventListener('mouseup', function(event) {
            var pengawasArea = document.getElementById('pengawasArea');
            if (event.target != pengawasArea && event.target.parentNode != pengawasArea) {
                pengawasArea.style.display = 'none';
            }
        });
    </script>
    <script>
        var hazardClose = "<?php echo "$hazardClose"; ?>";
        // rincian_bahaya
        ClassicEditor
            .create(document.querySelector('#rincian_bahaya'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (hazardClose === 'Closed' || hazardClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#rincian_bahaya');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#rincian_bahaya');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('rincian_bahaya', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // tindakan_perbaikan
        ClassicEditor
            .create(document.querySelector('#tindakan_perbaikan'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']


            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;

                if (hazardClose === 'Closed' || hazardClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#tindakan_perbaikan');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#tindakan_perbaikan');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('tindakan_perbaikan', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // tindakan_perbaikan_disarankan
        ClassicEditor
            .create(document.querySelector('#tindakan_perbaikan_disarankan'), {
                toolbar: ['heading', 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList', 'link']

            })
            .then(newEditor => {
                const toolbarElement = newEditor.ui.view.toolbar.element;
                if (hazardClose === 'Closed' || hazardClose === 'Cancelled') {

                    newEditor.enableReadOnlyMode('#tindakan_perbaikan_disarankan');

                    toolbarElement.style.display = 'none';
                } else {
                    toolbarElement.style.display = 'flex';
                    newEditor.disableReadOnlyMode('#tindakan_perbaikan_disarankan');
                }
                newEditor.model.document.on('change:data', () => {

                    @this.set('tindakan_perbaikan_disarankan', newEditor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
        // komentar
    </script>
</div>
