<div>
    @include('toast.toast')
    <!-- The button to open modal -->
    <!-- You can open the modal using ID.showModal() method -->
    <!-- The button to open modal -->
    <label for="PihakTerlibatLangusung" class="btn btn-sm btn-square btn-info "><svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg></label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="PihakTerlibatLangusung" class="modal-toggle" />
    <div class="modal ">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-center">Pihak Terlibat Langusng!</h3>
            <form wire:submit.prevent='store'>
                @csrf

                <div class="overflow-y-auto h-80">
                    <div class="w-full max-w-xs form-control">
                        <x-input-label-req :value="__('Nama')" />
                        <div class="join">
                            <input type="text" placeholder="Type here" wire:model='name'
                                class=" @error('name') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <label wire:click='nameByClick' for=""
                                class="border btn btn-xs btn-square join-item border-info btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>


                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs form-control">

                        <x-input-label-req :value="__('ID Karyawan')" />
                        <input type="text" placeholder="Type here" wire:model='id_karyawan'
                            class=" @error('id_karyawan') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                        <x-input-error :messages="$errors->get('id_karyawan')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs form-control">
                        <x-input-label-req :value="__('Perusahaan')" />
                        <div class="join">
                            <input type="text" placeholder="Type here" wire:model='perusahaan'
                                class=" @error('perusahaan') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <label wire:click='perusahaanByClick' for=""
                                class="border btn btn-xs btn-square join-item border-info btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>


                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('perusahaan')" class="mt-0" />
                    </div>

                    <div class="w-full max-w-xs basis-1/2 form-control">
                        <x-input-label-req :value="__('Roster')" />
                        <select wire:model='roster'
                            class="@error('roster') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                            <option value="null" selected>select an item</option>
                            @foreach ($Roster as $key => $value)
                                @if (old('roster') == $value->name)
                                    ;
                                    <option value="{{ $value->name }}">{{ $value->name }}</option>
                                @else
                                    <option value="{{ $value->name }}">{{ $value->name }}</option>
                                @endif
                            @endforeach

                        </select>
                        <x-input-error :messages="$errors->get('roster')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs basis-1/2 form-control">
                        <x-input-label-req :value="__('Sift')" />
                        <select wire:model='sift'
                            class="@error('sift') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                            <option value="null" selected>select an item</option>
                            <option value="Siang" selected>Siang</option>
                            <option value="Malam" selected>Malam</option>

                        </select>
                        <x-input-error :messages="$errors->get('sift')" class="mt-0" />
                    </div>

                    <div class="w-full max-w-xs form-control">

                        <x-input-label-req :value="__('Keterlibatan')" />
                        <textarea type="text" placeholder="Type here" wire:model='keterlibatan'
                            class=" @error('keterlibatan') border-rose-500 border-2 @enderror w-full max-w-xs textarea textarea-bordered textarea-success textarea-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1"></textarea>
                        <x-input-error :messages="$errors->get('keterlibatan')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs form-control">

                        <x-input-label-req :value="__('Pengalaman (Tahun)')" />
                        <input type="text" placeholder="Type here" wire:model='pengalaman'
                            class=" @error('pengalaman') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                        <x-input-error :messages="$errors->get('pengalaman')" class="mt-0" />
                    </div>
                </div>


                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label for="PihakTerlibatLangusung" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.event-report.participan.modal')
</div>
