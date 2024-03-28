<div>

    {{-- @include('toast.toast') --}}
    <!-- The button to open modal -->
    <!-- You can open the modal using ID.showModal() method -->
    <!-- The button to open modal -->




    <label wire:click='openModal' class="btn btn-sm btn-square btn-info tooltip tooltip-info tooltip-right  "><svg
            xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 pl-0.5 pt-0.5 " viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg>
    </label>




    <div class="modal {{ $modal }}">
        <div class="h-fit sm:w-10/12 sm:max-w-fit modal-box ">
            <button
                class="z-10 btn btn-sm btn-circle btn-ghost absolute right-2 top-2 tooltip tooltip-left font-bold text-blue-500"
                data-tip="{{ __('info') }}">?</button>
            <div class="divider divider-accent">
                <h3 class=" text-lg font-bold  shadow-2xl ">{{ __('add_hazard') }}</h3>
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
                            <div class="join">
                                <input type="text" placeholder="Type here" wire:model='nama_pelapor'
                                    class=" @error('nama_pelapor') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label wire:click='reportByClick' for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('nama_pelapor')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('tanggal_kejadian')" />
                            <input type="text" id="tglLapor" placeholder="Type here" wire:model='tanggal_kejadian'
                                readonly
                                class=" @error('tanggal_kejadian') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
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
                            <div class="join">
                                <input type="text" placeholder="Type here" wire:model='workgroup' readonly
                                    class=" @error('workgroup') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label wire:click='wgClick' for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                                    </svg>

                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('workgroup')" class="mt-0" />
                        </div>

                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('pengawas_area')" />
                            <div class="join">
                                <input type="text" placeholder="Type here" wire:model='pengawas_area'
                                    class=" @error('pengawas_area') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label wire:click='reportToClick' for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </div>
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
                    <div class="divider divider-info font-semibold">{{ __('penilaian') }}</div>
                    <div class="p-2">
                        <div class="flex flex-col-reverse justify-center mb-2 lg:flex-row">
                            <div class="divide-y divide-secondary basis-full divide-solid">
                                <div class="flex flex-col items-center gap-4 m-2 sm:flex-row">
                                    <div class="w-full max-w-xs basis-1/2 form-control">
                                        <x-input-label-req :value="__('Actual_Outcome')" />
                                        <select wire:model='actual_outcome' {{ $hazardClose ? 'disabled' : '' }}
                                            class="@error('actual_outcome') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                            <option value="" selected>select an item</option>
                                            @foreach ($Consequence as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('actual_outcome')" class="mt-0" />
                                    </div>
                                    <div class=" basis-full">
                                        <p class="text-xs text-justify">{{ $actual_outcome_description }}</p>
                                    </div>
                                </div>
    
                                <div class="flex flex-col items-center gap-4 m-2 sm:flex-row">
                                    <div class="w-full max-w-xs basis-1/2 form-control">
                                        <x-input-label-req :value="__('Potential_Consequence')" />
                                        <select wire:model='potential_consequence' {{ $hazardClose ? 'disabled' : '' }}
                                            class="@error('potential_consequence') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                            <option value="" selected>select an item</option>
                                            @foreach ($Consequence as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('potential_consequence')" class="mt-0" />
                                    </div>
                                    <div class=" basis-full">
                                        <p class="text-xs text-justify"> {{ $potential_consequence_description }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center gap-4 m-2 sm:flex-row">
                                    <div class="w-full max-w-xs basis-1/2 form-control">
                                        <x-input-label-req :value="__('Potential_Likelihood')" />
                                        <select wire:model='potential_likelihood' {{ $hazardClose ? 'disabled' : '' }}
                                            class="@error('potential_likelihood') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                            <option value="" selected>select an item</option>
                                            @foreach ($Likelihood as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('potential_likelihood')" class="mt-0" />
                                    </div>
                                    <div class=" basis-full self-end">
                                        <p class="text-xs text-justify"> {{ $potential_likelihood_description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="basis-full md:basis-1/4">
                                <div class="w-[21rem] p-2 flex justify-around  sm:w-full ">
                                    <div class=" p-4 bg-gray-200 overflow-x-auto rounded-md shadow-md ">
                                        <table class="table table-xs ">
                                            <thead>
                                                <tr>
                                                    <th class="text-xs border border-gray-300" rowspan="4">
                                                        <small>POSSIBILITY</small>
                                                    </th>
                                                </tr>
                                                <tr class="text-center">
    
                                                    <th class="text-xs border border-gray-300"><small>Legend</small>
                                                    </th>
                                                    <th class="text-xs text-white border bg-success"><small>Low</small>
                                                    </th>
                                                    <th class="text-xs text-white border bg-info">
                                                        <small>Moderate</small>
                                                    </th>
                                                    <th class="text-xs text-white border bg-warning">
                                                        <small>Hight</small>
                                                    </th>
                                                    <th class="text-xs text-white border bg-error">
                                                        <small>Extreme</small>
                                                    </th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th class="text-xs border border-gray-300" colspan="6">
                                                        <small>Consequence</small>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-xs border border-gray-300">
                                                        <small>5-Catastrophinic</small>
                                                    </th>
                                                    <th class="text-xs border border-gray-300"><small>4-Major</small>
                                                    </th>
                                                    <th class="text-xs border border-gray-300">
                                                        <small>3-Moderate</small>
                                                    </th>
                                                    <th class="text-xs border border-gray-300"><small>2-Minor</small>
                                                    </th>
                                                    <th class="text-xs border border-gray-300">
                                                        <small>1-Insignificant</small>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
    
                                                <tr>
                                                    <td class="border border-gray-300"><small>A-Almost Certain</small>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_a1'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 5 && $potential_likelihood == 1) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_a2'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 4 && $potential_likelihood == 1) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_a3'
                                                            class="w-full btn btn-xs btn-error  @if ($potential_consequence == 3 && $potential_likelihood == 1) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_a4'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 2 && $potential_likelihood == 1) border-4 border-black @endif">H</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_a5'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 1 && $potential_likelihood == 1) border-4 border-black @endif">H</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border border-gray-300"><small>B-Likely</small></td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_b1'
                                                            class="w-full btn btn-xs btn-error  @if ($potential_consequence == 5 && $potential_likelihood == 2) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_b2'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 4 && $potential_likelihood == 2) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_b3'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 3 && $potential_likelihood == 2) border-4 border-black @endif">H</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_b4'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 2 && $potential_likelihood == 2) border-4 border-black @endif">H</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_b5'
                                                            class="w-full btn btn-xs btn-info @if ($potential_consequence == 1 && $potential_likelihood == 2) border-4 border-black @endif">M</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border border-gray-300"><small>C-Possible</small></td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_c1'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 5 && $potential_likelihood == 3) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_c2'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 4 && $potential_likelihood == 3) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_c3'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 3 && $potential_likelihood == 3) border-4 border-black @endif">H</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_c4'
                                                            class="w-full btn btn-xs btn-info @if ($potential_consequence == 2 && $potential_likelihood == 3) border-4 border-black @endif">M</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_c5'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 1 && $potential_likelihood == 3) border-4 border-black @endif">L</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border border-gray-300"><small>D-Unlikely</small></td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_d1'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 5 && $potential_likelihood == 4) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_d2'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 4 && $potential_likelihood == 4) border-4 border-black @endif">H</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_d3'
                                                            class="w-full btn btn-xs btn-info @if ($potential_consequence == 3 && $potential_likelihood == 4) border-4 border-black @endif">M</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_d4'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 2 && $potential_likelihood == 4) border-4 border-black @endif">L</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_d5'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 1 && $potential_likelihood == 4) border-4 border-black @endif">L</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border border-gray-300"><small>E-Rare</small></td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_e1'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 5 && $potential_likelihood == 5) border-4 border-black @endif">H</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_e2'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 4 && $potential_likelihood == 5) border-4 border-black @endif">H</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_e3'
                                                            class="w-full btn btn-xs btn-info @if ($potential_consequence == 3 && $potential_likelihood == 5) border-4 border-black @endif">M</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_e4'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 2 && $potential_likelihood == 5) border-4 border-black @endif">L</label>
                                                    </td>
                                                    <td class="border border-gray-300"><label
                                                            {{ $hazardClose ? 'disabled' : '' }} wire:click='btn_e5'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 1 && $potential_likelihood == 5) border-4 border-black @endif">L</label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-center border-b sm:flex-row">
                            <div class="text-xs font-semibold basis-1/4 ">{{ __('risk_rank') }}</div>
                            <div class="text-xs basis-3/4">: {{ $name_assessment }}</div>
                        </div>
                        <div class="flex flex-col items-center border-b sm:flex-row">
                            <div class="text-xs font-semibold basis-1/4 ">{{ __('notify') }}</div>
                            <div class="text-xs basis-3/4">: {{ $notes_assessment }}</div>
                        </div>
                        <div class="flex flex-col items-center border-b sm:flex-row">
                            <div class="text-xs font-semibold basis-1/4 ">{{ __('deadline') }}</div>
                            <div class="text-xs basis-3/4">: {{ $reporting_obligation_assessment }}</div>
                        </div>
                        <div class="flex flex-col items-center border-b sm:flex-row">
                            <div class="text-xs font-semibold basis-1/4 ">{{ __('Coordinator') }}</div>
                            <div class="text-xs basis-3/4">: {{ $investigation_req_assessment }}</div>
                        </div>
                    </div>
                </div>

                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                        <span wire:loading wire:target="store" wire:loading.delay.long
                            wire:loading.class="bg-rose-500" class="loading loading-spinner loading-sm hidden"></span>
                    </button>
                    <label wire:click='closeModal' class="btn btn-xs btn-error text-white">Close!</label>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.event-report-list.hazard-id.modal')

</div>
