<div>
    @push('styles')
    @endpush
    @include('toast.toast')
    <label wire:click='openModal' class="btn btn-xs btn-accent btn-square btn-outline">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd"
                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z"
                clip-rule="evenodd" />
        </svg>
    </label>
    <div class="modal {{ $modal }} ">
        <div class="max-w-7xl xl:w-11/12  xl:h-[800px] modal-box p-0">
            <div class="bg-white sticky z-10 top-0 h-16 grid justify-items-stretch gap-0 shadow-md">
                <label
                    class=" z-20 font-bold text-blue-500 btn btn-xs btn-circle btn-ghost justify-self-end top-3 pt-1 tooltip tooltip-info tooltip-left"
                    data-tip="{{ __('info') }}">?</label>
                <div
                    class=" font-extrabold text-transparent divider divider-accent text-1xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
                    {{ __('add_hazard') }}</div>
            </div>
            <form wire:submit.prevent='store'>

                @csrf
                <div class="p-2 overflow-y-auto shadow-inner sm:60 md:h-80 xl:h-[640px]">

                    <div class="flex flex-wrap gap-1">
                        <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                            <x-input-label-req :value="__('est')" />
                            <select wire:model='event_subtype'
                                class=" @error('event_subtype') border-rose-500 border-2 @enderror select select-bordered select-xs w-full sm:max-w-xl focus:outline-none  focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                @foreach ($EventSubType as $ets)
                                    @if (old('event_subtype') == $ets->id)
                                        <option value="{{ $ets->id }}">
                                            {{ $ets->EventType->name }}-{{ $ets->name }}</option>
                                    @else
                                        <option value="{{ $ets->id }}">
                                            {{ $ets->EventType->name }}-{{ $ets->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('event_subtype')" class="mt-0" />
                        </div>
                        <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                            <x-input-label-req :value="__('nama_pelapor')" />
                            <label class="join" wire:click='reportByClick'>
                                <input type="text" placeholder="Type here" wire:model='nama_pelapor' readonly
                                    class=" @error('nama_pelapor') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
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
                        </div>
                        <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                            <x-input-label-req :value="__('tanggal_kejadian')" />
                            <input type="text" id="tglLapor" placeholder="Type here" wire:model='tanggal_kejadian'
                                readonly
                                class=" @error('tanggal_kejadian') border-rose-500 border-2 @enderror  cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('tanggal_kejadian')" class="mt-0" />
                        </div>
                        <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                            <x-input-label-req :value="__('time_event')" />
                            <input type="text" id="jamKejadian" placeholder="Type here" wire:model='waktu' readonly
                                class=" @error('waktu') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('waktu')" class="mt-0" />
                        </div>
                        <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                            <x-input-label-req :value="__('rw')" />
                            <label class="join " wire:click='wgClick'>
                                <input type="text" placeholder="Type here" wire:model='workgroup' readonly
                                    class=" @error('workgroup') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
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

                        <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                            <x-input-label-req :value="__('pengawas_area')" />
                            <label wire:click='reportToClick' class="join">
                                <input type="text" placeholder="Type here" wire:model='pengawas_area'
                                    class=" @error('pengawas_area') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered  input-xs focus:outline-none  focus:ring-success focus:ring-1" />
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
                        </div>
                        <div class="w-full sm:max-w-sm xl:max-w-xl form-control">
                            <x-input-label-req :value="__('el')" />
                            <select wire:model='lokasi'
                                class=" @error('lokasi') border-rose-500 border-2 @enderror select select-bordered select-xs w-full sm:max-w-xl focus:outline-none  focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                @foreach ($LocationEvent as $location)
                                    @if (old('lokasi') == $location->name)
                                        <option value="{{ $location->name }}">{{ $location->name }}</option>
                                    @else
                                        <option value="{{ $location->name }}">{{ $location->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lokasi')" class="mt-0" />
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

                                        @include('livewire.event-report-list.hazard-id.svgCreate')

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <div wire:ignore class="w-full form-control">
                            <x-input-label-bahaya :value="__('deskripsi')" />
                            <textarea id="rincian_bahaya" placeholder="Type here" wire:model='rincian_bahaya'
                                class="@error('rincian_bahaya') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('rincian_bahaya')" class="mt-0" />
                    </div>
                    <div>
                        <div wire:ignore class="w-full form-control">
                            <x-input-label-req :value="__('tindakan_perbaikan_dilakuan')" />
                            <textarea id="tindakan_perbaikan" placeholder="Type here" wire:model='tindakan_perbaikan'
                                class="@error('tindakan_perbaikan') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('tindakan_perbaikan')" class="mt-0" />
                    </div>
                    <div>
                        <div wire:ignore class="w-full form-control">
                            <x-input-label-req :value="__('tindakan_perbaikan_disarankan')" />
                            <textarea id="tindakan_perbaikan_disarankan" placeholder="Type here" wire:model='tindakan_perbaikan_disarankan'
                                class="@error('tindakan_perbaikan_disarankan') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-sm w-full  focus:outline-none  focus:ring-success focus:ring-1"></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('tindakan_perbaikan_disarankan')" class="mt-0" />
                    </div>


                    @include('livewire.event-report-list.hazard-id.tablePenilaian')


                </div>

                <div class=" modal-action sticky bottom-0 h-8 px-2 bg-white">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                        <span wire:loading wire:target="store" wire:loading.delay.long
                            wire:loading.class="bg-rose-500" class="hidden loading loading-spinner loading-sm"></span>
                    </button>
                    <label wire:click='closeModal' class="text-white btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.event-report-list.hazard-id.modal')

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
