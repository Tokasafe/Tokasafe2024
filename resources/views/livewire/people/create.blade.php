<div>

    @include('toast.toast')
    <!-- The button to open modal -->
    <!-- You can open the modal using ID.showModal() method -->
    <!-- The button to open modal -->
    <label for="addPeople" class="btn btn-sm btn-square btn-info tooltip tooltip-info "
        data-tip="add new event report"><svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 pl-0.5 pt-0.5 "
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg>
    </label>
    <label for="uploadPeople" class="btn btn-sm btn-square btn-warning tooltip-warning tooltip-top tooltip"
        data-tip="Import">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 pt-0.5">
            <path
                d="M9.97.97a.75.75 0 011.06 0l3 3a.75.75 0 01-1.06 1.06l-1.72-1.72v3.44h-1.5V3.31L8.03 5.03a.75.75 0 01-1.06-1.06l3-3zM9.75 6.75v6a.75.75 0 001.5 0v-6h3a3 3 0 013 3v7.5a3 3 0 01-3 3h-7.5a3 3 0 01-3-3v-7.5a3 3 0 013-3h3z" />
            <path
                d="M7.151 21.75a2.999 2.999 0 002.599 1.5h7.5a3 3 0 003-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 01-4.5 4.5H7.151z" />
        </svg>
    </label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="addPeople" class="modal-toggle" />
    <div class="modal ">
        <div class="p-4 h-fit sm:w-10/12 sm:max-w-fit modal-box">
            <h3 class="w-full text-lg font-bold text-center shadow-2xl ">{{ __('add_new_person') }}</h3>
            <form wire:submit.prevent='store'>
                @csrf
                <div class="overflow-y-auto sm:h-96 lg2x:h-1/2">

                    <div class="flex flex-wrap gap-2">
                        <div class="w-full max-w-xs form-control">
                            <x-input-label :value="__('first_name')" />
                            <input type="text" placeholder="Type here" wire:model='first_name'
                                class=" @error('first_name') border-rose-500 border-2 @enderror capitalize w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label :value="__('last_name')" />
                            <input type="text" placeholder="Type here" wire:model='last_name'
                                class=" @error('last_name') border-rose-500 border-2 @enderror uppercase w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('lookup_name')" />
                            <input type="text" placeholder="Type here" wire:model='lookup_name'
                                class=" @error('lookup_name') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('lookup_name')" class="mt-0" />
                        </div>

                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('Workgroup')" />
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
                            <x-input-label-req :value="__('Employer')" />
                            <div class="join">
                                <input type="text" placeholder="Type here" wire:model='employer' readonly
                                    class=" @error('employer') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label wire:click='EmployeClick' for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('employer')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label :value="__('emergency_response')" />
                            <select wire:model='emergency_response'
                                class=" @error('emergency_response') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>Small</option>
                                <option value="1">Small Apple</option>
                                <option value="2">Small Orange</option>
                                <option value="3">Small Tomato</option>
                            </select>
                            <x-input-error :messages="$errors->get('emergency_response')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label :value="__('Supervisor')" />
                            <div class="join">
                                <input type="text" placeholder="Type here" wire:model='supervisor'
                                    class=" @error('supervisor') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                                <label wire:click='spvClick' for=""
                                    class="border btn btn-xs btn-square join-item border-info btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>


                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('supervisor')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('employe_id')" />
                            <input type="text" placeholder="Type here" wire:model='employe_id'
                                class=" @error('employe_id') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('employe_id')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('gender')" />
                            <select wire:model='gender'
                                class=" @error('gender') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>{{ __('select_option') }} </option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('tgl_lahir')" />
                            <input type="text" id="tgl_lahir" placeholder="Type here" wire:model='date_of_birth'
                                readonly
                                class=" @error('date_of_birth') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('tgl_mulai')" />
                            <input type="text" id="tgl_mulai" placeholder="Type here" wire:model='date_commenced'
                                readonly
                                class=" @error('date_commenced') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('date_commenced')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label-req :value="__('home_port')" />
                            <select wire:model='home_port'
                                class="@error('home_port') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>{{ __('select_option') }}</option>
                                @foreach ($Port as $item)
                                    @if (old('point_of_hire') == $item->id)
                                        <option value="{{ $item->id }}">{{ $item->code }}-{{ $item->name }}
                                        </option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->code }}-{{ $item->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('home_port')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label :value="__('point_of_hire')" />
                            <select wire:model='point_of_hire'
                                class="@error('point_of_hire') border-rose-500 border-2 @enderror w-full select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                                <option selected>{{ __('select_option') }}</option>
                                @foreach ($Port as $item)
                                    @if (old('point_of_hire') == $item->id)
                                        <option value="{{ $item->id }}">{{ $item->code }}-{{ $item->name }}
                                        </option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->code }}-{{ $item->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('point_of_hire')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label :value="__('network_username')" />
                            <input type="text" placeholder="Type here" wire:model='network_username'
                                class=" @error('network_username') border-rose-500 border-2 @enderror w-full input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                            <x-input-error :messages="$errors->get('network_username')" class="mt-0" />
                        </div>
                        <div class="w-full max-w-xs form-control">
                            <x-input-label :value="__('employee_photo')" />
                            <input type="file" wire:click='employee_photo'
                                class="w-full max-w-xs file-input file-input-xs file-input-bordered file-input-success focus:outline-none focus:border-success focus:ring-success focus:ring-1 @error('employee_photo') border-rose-500 border-2 @enderror" />
                            <x-input-error :messages="$errors->get('employee_photo')" class="mt-0" />
                        </div>
                        <div class="avatar">
                            <div class="w-24 rounded">
                                <img src="" />
                            </div>
                        </div>
                    </div>

                </div>


                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">{{ __('Save') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label for="addPeople" class="btn btn-xs btn-error">{{ __('Close') }}!</label>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.people.modal')
</div>
