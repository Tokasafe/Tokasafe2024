<div class="font-extrabold text-transparent divider divider-info text-1xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">{{ __('penilaian') }}</div>
<div class="p-2">
    <div class="flex flex-col-reverse justify-center mb-2 sm:flex-row">
        <div class="divide-y divide-secondary basis-full divide-solid">
            <div class="flex flex-col items-center gap-4 m-2 sm:flex-row">
                <div class="w-full max-w-xs basis-1/2 form-control">
                    <x-input-label-req :value="__('Actual Outcome')" />
                    <select wire:model='actual_outcome' {{ $IncidentClose ? 'disabled' : '' }}
                        class="@error('actual_outcome') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option value="" selected>select an item</option>
                        @foreach ($Consequence as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('actual_outcome')" class="mt-0" />
                </div>
                <div class=" basis-full">
                    <p class="text-[10px] text-justify">{{ $actual_outcome_description }}</p>
                </div>
            </div>

            <div class="flex flex-col items-center gap-4 m-2 sm:flex-row">
                <div class="w-full max-w-xs basis-1/2 form-control">
                    <x-input-label-req :value="__('Potential Consequence')" />
                    <select wire:model='potential_consequence' {{ $IncidentClose ? 'disabled' : '' }}
                        class="@error('potential_consequence') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option value="" selected>select an item</option>
                        @foreach ($Consequence as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('potential_consequence')" class="mt-0" />
                </div>
                <div class=" basis-full">
                    <p class="text-[10px] text-justify"> {{ $potential_consequence_description }}</p>
                </div>
            </div>
            <div class="flex flex-col items-center gap-4 m-2 sm:flex-row">
                <div class="w-full max-w-xs basis-1/2 form-control">
                    <x-input-label-req :value="__('Potential Likelihood')" />
                    <select wire:model='potential_likelihood' {{ $IncidentClose ? 'disabled' : '' }}
                        class="@error('potential_likelihood') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option value="" selected>select an item</option>
                        @foreach ($Likelihood as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('potential_likelihood')" class="mt-0" />
                </div>
                <div class="self-end basis-full">
                    <p class="text-[10px] text-justify"> {{ $potential_likelihood_description }}</p>
                </div>
            </div>
        </div>
        <div class="basis-full md:basis-1/4">
            <div class="w-[17rem]">
                <div class="overflow-x-auto bg-gray-200 shadow-md ">
                    <table>
                       
                        <tr class="text-center">
                            
                            <th class="text-[9px] border w-[145px] text-black bg-white"><small>Legend</small>
                            </th>
                            
                            <th class="text-[9px] text-black border bg-success"><small>Low</small>
                            </th>
                            <th class="text-[9px] text-black border bg-info">
                                <small>Moderate</small>
                            </th>
                            <th class="text-[9px] text-black border bg-warning">
                                <small>Hight</small>
                            </th>
                            <th class="text-[9px] w-14 text-black border bg-error">
                                <small>Extreme</small>
                            </th>
                        </tr>
                    </table>
                    <table class="table table-xs ">
                        <thead>
                            <tr>
                                <th class="text-[9px] border text-center border-gray-300 p-0" rowspan="4">
                                    <small>POSSIBILITY</small>
                                </th>
                            </tr>
                           
                            <tr class="text-center">
                                <th class="p-0 text-xs text-black border border-gray-300" colspan="6">
                                    <div>Consequence</div>
                                </th>
                            </tr>
                            <tr class="text-center">
                                <th class="p-0 text-xs text-black border border-gray-300 rotated_cell">
                                    <small class="rotate_text">5-Castastrophic</small>
                                </th>
                                <th scope="col" class="p-0 text-xs text-black border border-gray-300 rotated_cell">
                                    <small class="rotate_text">4-Major</small>
                                </th>
                                <th scope="col" class="p-0 text-xs text-black border border-gray-300 rotated_cell">
                                    <small class="rotate_text">3-Moderate</small>
                                </th>
                                <th scope="col" class="p-0 text-xs text-black border border-gray-300 rotated_cell">
                                    <small class="rotate_text">2-Minor</small>
                                </th>
                                <th scope="col" class="p-0 text-xs text-black border border-gray-300 rotated_cell">
                                    <small class="rotate_text">1-Insignificant</small>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="p-0 text-center border border-gray-300 "><small>A-Almost Certain</small>
                                </td>
                                <td class="p-0 border border-gray-300 "><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_a1'
                                        class="btn btn-xs btn-error btn-square @if ($potential_consequence == 5 && $potential_likelihood == 1) border-4 border-black @endif">E</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_a2'
                                        class="btn btn-xs btn-error btn-square @if ($potential_consequence == 4 && $potential_likelihood == 1) border-4 border-black @endif">E</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_a3'
                                        class="btn btn-xs btn-error btn-square  @if ($potential_consequence == 3 && $potential_likelihood == 1) border-4 border-black @endif">E</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_a4'
                                        class="btn-square btn btn-xs btn-warning @if ($potential_consequence == 2 && $potential_likelihood == 1) border-4 border-black @endif">H</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_a5'
                                        class="btn-square btn btn-xs btn-warning @if ($potential_consequence == 1 && $potential_likelihood == 1) border-4 border-black @endif">H</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0 text-center border border-gray-300"><small>B-Likely</small></td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_b1'
                                        class="btn btn-xs btn-error btn-square  @if ($potential_consequence == 5 && $potential_likelihood == 2) border-4 border-black @endif">E</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_b2'
                                        class="btn btn-xs btn-error btn-square @if ($potential_consequence == 4 && $potential_likelihood == 2) border-4 border-black @endif">E</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_b3'
                                        class="btn-square btn btn-xs btn-warning @if ($potential_consequence == 3 && $potential_likelihood == 2) border-4 border-black @endif">H</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_b4'
                                        class="btn-square btn btn-xs btn-warning @if ($potential_consequence == 2 && $potential_likelihood == 2) border-4 border-black @endif">H</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_b5'
                                        class="btn-square btn btn-xs btn-info @if ($potential_consequence == 1 && $potential_likelihood == 2) border-4 border-black @endif">M</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0 text-center border border-gray-300"><small>C-Possible</small></td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_c1'
                                        class="btn btn-xs btn-error btn-square @if ($potential_consequence == 5 && $potential_likelihood == 3) border-4 border-black @endif">E</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_c2'
                                        class="btn btn-xs btn-error btn-square @if ($potential_consequence == 4 && $potential_likelihood == 3) border-4 border-black @endif">E</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_c3'
                                        class="btn-square btn btn-xs btn-warning @if ($potential_consequence == 3 && $potential_likelihood == 3) border-4 border-black @endif">H</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_c4'
                                        class="btn-square btn btn-xs btn-info @if ($potential_consequence == 2 && $potential_likelihood == 3) border-4 border-black @endif">M</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_c5'
                                        class="btn-square btn btn-xs btn-success @if ($potential_consequence == 1 && $potential_likelihood == 3) border-4 border-black @endif">L</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0 text-center border border-gray-300"><small>D-Unlikely</small></td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_d1'
                                        class="btn btn-xs btn-error btn-square @if ($potential_consequence == 5 && $potential_likelihood == 4) border-4 border-black @endif">E</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_d2'
                                        class="btn-square btn btn-xs btn-warning @if ($potential_consequence == 4 && $potential_likelihood == 4) border-4 border-black @endif">H</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_d3'
                                        class="btn-square btn btn-xs btn-info @if ($potential_consequence == 3 && $potential_likelihood == 4) border-4 border-black @endif">M</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_d4'
                                        class="btn-square btn btn-xs btn-success @if ($potential_consequence == 2 && $potential_likelihood == 4) border-4 border-black @endif">L</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_d5'
                                        class="btn-square btn btn-xs btn-success @if ($potential_consequence == 1 && $potential_likelihood == 4) border-4 border-black @endif">L</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0 text-center border border-gray-300"><small>E-Rare</small></td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_e1'
                                        class="btn-square btn btn-xs btn-warning @if ($potential_consequence == 5 && $potential_likelihood == 5) border-4 border-black @endif">H</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_e2'
                                        class="btn-square btn btn-xs btn-warning @if ($potential_consequence == 4 && $potential_likelihood == 5) border-4 border-black @endif">H</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_e3'
                                        class="btn-square btn btn-xs btn-info @if ($potential_consequence == 3 && $potential_likelihood == 5) border-4 border-black @endif">M</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_e4'
                                        class="btn-square btn btn-xs btn-success @if ($potential_consequence == 2 && $potential_likelihood == 5) border-4 border-black @endif">L</label>
                                </td>
                                <td class="p-0 border border-gray-300"><label {{ $IncidentClose ? 'disabled' : '' }}
                                        wire:click='btn_e5'
                                        class="btn-square btn btn-xs btn-success @if ($potential_consequence == 1 && $potential_likelihood == 5) border-4 border-black @endif">L</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-2 bg-gray-100 rounded-md shadow-md">
        <table class="table text-xs table-xs">
            <tbody>
                <tr>
                    <td class="font-bold">{{ __('risk_rank') }}</td>
                    <td class="text-justify text-[10px]">{{ $name_assessment }}</td>
                </tr>
                <tr>
                    <td class="font-bold">{{ __('notify') }}</td>
                    <td class="text-justify text-[10px]">{{ $notes_assessment }}</td>
                </tr>
                <tr>
                    <td class="font-bold">{{ __('deadline') }}</td>
                    <td class="text-justify text-[10px]">{{ $reporting_obligation_assessment }}</td>
                </tr>
                <tr>
                    <td class="font-bold">{{ __('Coordinator') }}</td>
                    <td class="text-justify text-[10px]">{{ $investigation_req_assessment }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .rotate_text {
        writing-mode: vertical-lr;
        -webkit-writing-mode: vertical-lr;
        -ms-writing-mode: vertical-lr;
        -webkit-transform: rotate(-180deg);
        -moz-transform: rotate(-180deg);
        -o-transform: rotate(-180deg);
        transform: rotate(-180deg);
    }

    .rotated_cell {
        width: 0%;
        text-align: center;
        vertical-align: bottom;
        padding: 1px;
        padding-bottom: 3px;
        padding-top: 3px;
    }
    .table-rotate {
        border-right: thin dashed grey;
        border-bottom: thin dashed grey;
        margin: 2px;
    }
</style>
