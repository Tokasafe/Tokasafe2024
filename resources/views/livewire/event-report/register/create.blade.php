<div>

    {{-- @include('toast.toast') --}}
    <!-- The button to open modal -->
    <!-- You can open the modal using ID.showModal() method -->
    <!-- The button to open modal -->
    <label for="addPC" class="btn btn-sm btn-square btn-info tooltip tooltip-info tooltip-right"
        data-tip="add new event report"><svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 pl-0.5 pt-0.5 "
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg></label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="addPC" class="modal-toggle" />
    <div class="modal">
        <div class="h-fit sm:w-10/12 sm:max-w-fit modal-box ">
            <h3 class="w-full text-lg font-bold text-center shadow-2xl ">Add New Event Report</h3>
            <form wire:submit.prevent='store'>
                @csrf
                <div class="overflow-y-auto sm:h-80 lg2x:h-1/2">

                    <div class="flex flex-wrap gap-2">
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Tipe Kejadian')" />
                            <select wire:model='type_kejadian'
                                class="w-full select select-bordered select-xs select-success @error('type_kejadian') border-rose-400 border-2  @enderror  focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                @foreach ($Eventype as $type)
                                    @if (old('') == $type->id)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @else
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endif
                                @endforeach

                            </select>
                            <x-input-error :messages="$errors->get('type_kejadian')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Jenis Kejadian')" />
                            <select wire:model='jenis_kejadian'
                                class="@error('jenis_kejadian') border-rose-400 border-2  @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                @foreach ($SubType as $type)
                                    @if (old('') == $type->id)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @else
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('jenis_kejadian')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Responsible Workgroup')" />
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
                            <x-input-label-req :value="__('Dilaportkan Oleh')" />
                            <div class="join">
                                <input type="text" placeholder="Type here" wire:model='report_by'
                                    class=" @error('report_by') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label wire:click='reportByClick' for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('report_by')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Dilaportkan Ke')" />
                            <div class="join">
                                <input type="text" placeholder="Type here" wire:model='report_to'
                                    class=" @error('report_to') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label wire:click='reportToClick' for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('report_to')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Tanggal Kejadian')" />
                            <input type="text" id="tglLapor" placeholder="Type here" wire:model='tgl_kejadian'
                                readonly
                                class=" @error('tgl_kejadian') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('tgl_kejadian')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Waktu Kejadian')" />
                            <input type="text" id="jamKejadian" placeholder="Type here" wire:model='waktu_kejadian'
                                readonly
                                class=" @error('waktu_kejadian') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('waktu_kejadian')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Tanggal Dilaporkan')" />
                            <input type="text" id="tgldilapor" placeholder="Type here" wire:model='tgl_dilaporkan'
                                readonly
                                class=" @error('waktu_kejadian') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('waktu_kejadian')" class="mt-0" />
                        </div>

                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Lokasi Kejadian')" />
                            <select wire:model='lokasi_kejadian'
                                class=" @error('lokasi_kejadian') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                @foreach ($LocationEvent as $location)
                                    @if (old('lokasi_kejadian') == $location->name)
                                        <option value="{{ $location->name }}">{{ $location->name }}</option>
                                    @else
                                        <option value="{{ $location->name }}">{{ $location->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lokasi_kejadian')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Nama Site')" />
                            <select wire:model='site_name'
                                class="@error('site_name') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                @foreach ($EventSite as $site)
                                    @if (old('lokasi_kejadian') == $site->name)
                                        <option value="{{ $site->name }}">{{ $site->name }}</option>
                                    @else
                                        <option value="{{ $site->name }}">{{ $site->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('site_name')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Kontrak Wilayah Kerja')" />
                            <select wire:model='contract_area'
                                class="@error('contract_area') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>Select an option</option>
                                <option value="MSM">MSM</option>
                                <option value="TTN">TTN</option>
                                <option value="Off Site">Off Site</option>

                            </select>
                            <x-input-error :messages="$errors->get('contract_area')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Pekerjaan yang Dilakukan')" />
                            <input type="text" placeholder="Type here" wire:model='occupation'
                                class=" @error('occupation') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('occupation')" class="mt-0" />
                        </div>
                    </div>
                    <div class="w-full max-w-xs sm:max-w-screen-2xl form-control">
                        <x-input-label-req :value="__('Jelaskan Kejadian Secara Rinci')" />
                        <textarea placeholder="Bio" wire:model='explanation'
                            class="@error('explanation') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-success textarea-sm w-full  focus:outline-none focus:border-success focus:ring-success focus:ring-1"></textarea>
                        <x-input-error :messages="$errors->get('explanation')" class="mt-0" />
                    </div>
                    <div class="w-full max-w-xs sm:max-w-screen-2xl form-control">
                        <x-input-label-req :value="__('perbaikanSegera')" />
                        <textarea placeholder="Bio" wire:model='immediate'
                            class="@error('immediate') border-rose-500 border-2 @enderror textarea  textarea-bordered textarea-success textarea-sm w-full  focus:outline-none focus:border-success focus:ring-success focus:ring-1"></textarea>
                        <x-input-error :messages="$errors->get('immediate')" class="mt-0" />
                    </div>
                    @if ($showAccess)

                        <p>Initial Risk Assessment</p>
                        <div class="flex flex-col-reverse mb-2 md:flex-row">
                            <div class="divide-y divide-orange-400 basis-full divide-solid">
                                <div class="flex flex-col items-center gap-4 m-2 sm:flex-row">
                                    <div class="w-full max-w-xs basis-1/2 form-control">
                                        <x-input-label-req :value="__('Actual Outcome')" />
                                        <select wire:model='actual_outcome'
                                            class="@error('actual_outcome') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                            <option value="null" selected>select an item</option>
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
                                        <x-input-label-req :value="__('Potential Consequence')" />
                                        <select wire:model='potential_consequence'
                                            class="@error('potential_consequence') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                            <option value="null" selected>select an item</option>
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
                                        <x-input-label-req :value="__('Potential Likelihood')" />
                                        <select wire:model='potential_likelihood'
                                            class="@error('potential_likelihood') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                            <option value="null" selected>select an item</option>
                                            @foreach ($Likelihood as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('potential_likelihood')" class="mt-0" />
                                    </div>
                                    <div class=" basis-full">
                                        <p class="text-xs text-justify"> {{ $potential_likelihood_description }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="basis-1/4">

                                <div class="mx-2">
                                    <div class="overflow-x-auto">
                                        <table class="table table-xs">
                                            <thead>
                                                <tr>
                                                    <th class="text-xs border" rowspan="4"><small>POSSIBILITY
                                                            FREQUENCY</small></th>
                                                </tr>
                                                <tr class="text-center">

                                                    <th class="text-xs border"><small>Legend</small></th>
                                                    <th class="text-xs text-white border bg-emerald-500">
                                                        <small>Low</small>
                                                    </th>
                                                    <th class="text-xs text-white border bg-info">
                                                        <small>Moderate</small>
                                                    </th>
                                                    <th class="text-xs text-white border bg-amber-500">
                                                        <small>Hight</small>
                                                    </th>
                                                    <th class="text-xs text-white border bg-rose-500">
                                                        <small>Extreme</small>
                                                    </th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th class="text-xs border" colspan="6">
                                                        <small>Consequence</small>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-xs border"><small>5-Catastrophinic</small></th>
                                                    <th class="text-xs border"><small>4-Major</small></th>
                                                    <th class="text-xs border"><small>3-Moderate</small></th>
                                                    <th class="text-xs border"><small>2-Minor</small></th>
                                                    <th class="text-xs border"><small>1-Insignificant</small></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td class="border"><small>A-Almost Certain</small></td>
                                                    <td class="border"><label wire:click='btn_a1'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 6 && $potential_likelihood == 1) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_a2'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 5 && $potential_likelihood == 1) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_a3'
                                                            class="w-full btn btn-xs btn-error  @if ($potential_consequence == 4 && $potential_likelihood == 1) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_a4'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 3 && $potential_likelihood == 1) border-4 border-black @endif">H</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_a5'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 2 && $potential_likelihood == 1) border-4 border-black @endif">h</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border"><small>B-Likely</small></td>
                                                    <td class="border"><label wire:click='btn_b1'
                                                            class="w-full btn btn-xs btn-error  @if ($potential_consequence == 6 && $potential_likelihood == 2) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_b2'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 5 && $potential_likelihood == 2) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_b3'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 4 && $potential_likelihood == 2) border-4 border-black @endif">h</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_b4'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 3 && $potential_likelihood == 2) border-4 border-black @endif">h</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_b5'
                                                            class="w-full btn btn-xs btn-info @if ($potential_consequence == 2 && $potential_likelihood == 2) border-4 border-black @endif">m</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border"><small>C-Possible</small></td>
                                                    <td class="border"><label wire:click='btn_c1'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 6 && $potential_likelihood == 3) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_c2'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 5 && $potential_likelihood == 3) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_c3'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 4 && $potential_likelihood == 3) border-4 border-black @endif">h</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_c4'
                                                            class="w-full btn btn-xs btn-info @if ($potential_consequence == 3 && $potential_likelihood == 3) border-4 border-black @endif">m</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_c5'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 2 && $potential_likelihood == 3) border-4 border-black @endif">l</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border"><small>D-Unlikely</small></td>
                                                    <td class="border"><label wire:click='btn_d1'
                                                            class="w-full btn btn-xs btn-error @if ($potential_consequence == 6 && $potential_likelihood == 4) border-4 border-black @endif">E</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_d2'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 5 && $potential_likelihood == 4) border-4 border-black @endif">h</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_d3'
                                                            class="w-full btn btn-xs btn-info @if ($potential_consequence == 4 && $potential_likelihood == 4) border-4 border-black @endif">m</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_d4'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 3 && $potential_likelihood == 4) border-4 border-black @endif">l</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_d5'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 2 && $potential_likelihood == 4) border-4 border-black @endif">l</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border"><small>E-Rare</small></td>
                                                    <td class="border"><label wire:click='btn_e1'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 6 && $potential_likelihood == 6) border-4 border-black @endif">h</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_e2'
                                                            class="w-full btn btn-xs btn-warning @if ($potential_consequence == 5 && $potential_likelihood == 6) border-4 border-black @endif">h</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_e3'
                                                            class="w-full btn btn-xs btn-info @if ($potential_consequence == 4 && $potential_likelihood == 6) border-4 border-black @endif">m</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_e4'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 3 && $potential_likelihood == 6) border-4 border-black @endif">l</label>
                                                    </td>
                                                    <td class="border"><label wire:click='btn_e5'
                                                            class="w-full btn btn-xs btn-success @if ($potential_consequence == 2 && $potential_likelihood == 6) border-4 border-black @endif">l</label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="flex flex-col border-b sm:flex-row">
                            <div class="text-xs font-semibold basis-1/4 ">Potential Risk Rating:</div>
                            <div class="text-xs basis-3/4">{{ $name_assessment }}</div>
                        </div>
                        <div class="flex flex-col border-b sm:flex-row">
                            <div class="text-xs font-semibold basis-1/4 ">Notify:</div>
                            <div class="text-xs basis-3/4">{{ $notes_assessment }}</div>
                        </div>
                        <div class="flex flex-col border-b sm:flex-row">
                            <div class="text-xs font-semibold basis-1/4 ">Deadline:</div>
                            <div class="text-xs basis-3/4">{{ $investigation_req_assessment }}</div>
                        </div>
                        <div class="flex flex-col border-b sm:flex-row">
                            <div class="text-xs font-semibold basis-1/4 ">Coordinator:</div>
                            <div class="text-xs basis-3/4">{{ $reporting_obligation_assessment }}</div>
                        </div>
                    @endif

                </div>


                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                        <span wire:loading wire:target="store" wire:loading.delay.long
                            wire:loading.class="bg-rose-500" class="loading loading-spinner loading-sm"></span>
                    </button>
                    <label for="addPC" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.event-report.register.modal')

</div>
