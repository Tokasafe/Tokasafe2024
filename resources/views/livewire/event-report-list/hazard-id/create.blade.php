<div>

    @include('toast.toast')
    <!-- The button to open modal -->
    <!-- You can open the modal using ID.showModal() method -->
    <!-- The button to open modal -->




    <label wire:click='openModal' class="btn btn-sm btn-square btn-info tooltip tooltip-info tooltip-right "><svg
            xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 pl-0.5 pt-0.5 " viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg>
    </label>




    <div class="modal {{ $modal }}">
        <div class=" sm:w-10/12 sm:max-w-fit modal-box">
            <button
                class="absolute z-10 font-bold text-blue-500 btn btn-sm btn-circle btn-ghost right-2 top-2 tooltip tooltip-left"
                data-tip="{{ __('info') }}">?</button>
            <div class="divider divider-accent">
                <h3 class="text-lg font-bold shadow-2xl ">{{ __('add_hazard') }}</h3>
            </div>

            <form wire:submit.prevent='store'>
                @csrf
                <div class="overflow-y-auto sm:h-80 lg2x:h-1/2">

                    <div class="flex flex-wrap gap-2">
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('est')" />
                            <select wire:model='event_subtype'
                                class=" @error('event_subtype') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                @foreach ($EventSubType as $ets)
                                    @if (old('event_subtype') == $ets->id)
                                        <option value="{{ $ets->id }}">{{$ets->EventType->name}}-{{ $ets->name }}</option>
                                    @else
                                        <option value="{{ $ets->id }}">{{$ets->EventType->name}}-{{ $ets->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('event_subtype')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('nama_pelapor')" />
                            <label class="join" wire:click='reportByClick'>
                                <input type="text" placeholder="Type here" wire:model='nama_pelapor' readonly
                                    class=" @error('nama_pelapor') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label  for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('nama_pelapor')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('tanggal_kejadian')" />
                            <input type="text" id="tglLapor" placeholder="Type here" wire:model='tanggal_kejadian'
                                readonly
                                class=" @error('tanggal_kejadian') border-rose-500 border-2 @enderror  w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('tanggal_kejadian')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('time_event')" />
                            <input type="text" id="jamKejadian" placeholder="Type here" wire:model='waktu' readonly
                                class=" @error('waktu') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('waktu')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('rw')" />
                            <label class="join " wire:click='wgClick'>
                                <input type="text" placeholder="Type here" wire:model='workgroup' readonly
                                    class=" @error('workgroup') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label  for=""
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

                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('pengawas_area')" />
                            <label  wire:click='reportToClick' class="join">
                                <input type="text" placeholder="Type here" wire:model='pengawas_area'
                                    class=" @error('pengawas_area') border-rose-500 border-2 @enderror cursor-pointer w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </label>
                            <x-input-error :messages="$errors->get('pengawas_area')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('el')" />
                            <select wire:model='lokasi'
                                class=" @error('lokasi') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
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
                        <div class="w-full max-w-xs form-control">

                            <x-input-label-req :value="__('documentation')" />
                            <input type="file" placeholder="Type here" wire:model='documentation'
                                class=" @error('documentation') border-rose-500 border-2 @enderror w-full max-w-xs file-input file-input-bordered file-input-success file-input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('documentation')" class="mt-0" />
                        </div>
                    </div>

                    <div class="w-full max-w-xs sm:max-w-screen-2xl form-control">
                        <x-input-label-bahaya :value="__('rincian_bahaya')" />
                        <textarea placeholder="Bio" wire:model='rincian_bahaya'
                            class="@error('rincian_bahaya') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-success textarea-sm w-full  focus:outline-none focus:border-success focus:ring-success focus:ring-1"></textarea>
                        <x-input-error :messages="$errors->get('rincian_bahaya')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs sm:max-w-screen-2xl form-control">
                        <x-input-label-req :value="__('tindakan_perbaikan')" />
                        <textarea placeholder="Bio" wire:model='tindakan_perbaikan'
                            class="@error('tindakan_perbaikan') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-success textarea-sm w-full  focus:outline-none focus:border-success focus:ring-success focus:ring-1"></textarea>
                        <x-input-error :messages="$errors->get('tindakan_perbaikan')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs sm:max-w-screen-2xl form-control">
                        <x-input-label-req :value="__('tindakan_perbaikan_disarankan')" />
                        <textarea placeholder="Bio" wire:model='tindakan_perbaikan_disarankan'
                            class="@error('tindakan_perbaikan_disarankan') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-success textarea-sm w-full  focus:outline-none focus:border-success focus:ring-success focus:ring-1"></textarea>
                        <x-input-error :messages="$errors->get('tindakan_perbaikan_disarankan')" class="mt-0" />
                    </div>
                    @include('livewire.event-report-list.hazard-id.tablePenilaian')
                       
                  
                </div>

                <div class="modal-action">
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

</div>
