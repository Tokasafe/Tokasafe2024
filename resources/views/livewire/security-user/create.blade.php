<div>
    @include('toast.toast')
    <!-- The button to open modal -->
    <!-- You can open the modal using ID.showModal() method -->
    <!-- The button to open modal -->
    <label for="addPC" class="btn btn-sm btn-square btn-info "><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                clip-rule="evenodd" />
        </svg></label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="addPC" class="modal-toggle" />
    <div class="modal " >
        <div class="w-auto modal-box">
            <div class="divider divider-accent m-0">Add User Security!</div>
            <form wire:submit.prevent='store' >
                @csrf
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('Workflow Role')" />
                    <select wire:model='workflow'
                        class="@error('workflow') border-rose-500 border-2 @enderror w-full select max-w-xs select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option selected>Select an option</option>
                        @foreach($ResponsibleRole as $key)
                        <option value="{{$key->name}}">{{$key->name}}</option>
                        @endforeach
                       

                    </select>
                    <x-input-error :messages="$errors->get('workflow')" class="mt-0" />
                </div>
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('Company Level')" />
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
                    <x-input-label-req :value="__('Event Subtype')" />
                    <div class="join">
                        <input type="text" placeholder="Type here" wire:model='event_sub_types' readonly
                            class=" @error('event_sub_types') border-rose-500 border-2 @enderror w-full join-item input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                        <label wire:click='EventSubtypeClick' for=""
                            class="border btn btn-xs btn-square join-item border-info btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                            </svg>

                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('event_sub_types')" class="mt-0" />
                </div>

                <div class="px-4 m-2 overflow-y-auto border w-80 border-stone-400 h-52">
                    <div class="flex gap-2 py-1">
                        <label class="relative block ">
                          
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute  left-0 mt-0.5 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>

                          
                            <input wire:model='search'
                                class="block w-full py-2 pr-3 bg-white border-2 rounded-md shadow-sm input-xs placeholder:italic placeholder:text-slate-400 border-emerald-300 pl-6 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
                                placeholder="Search people..." type="text" name="search" />
                        </label>
                        <label wire:click='clearSelect' for=""
                            class=" btn btn-info btn-square btn-xs tooltip btn-outline tooltip-info tooltip-bottom"
                            data-tip='clear filter'>
                            <svg class="pb-3 pr-2" width="35px" height="35px" viewBox="0 0 512 512" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>clear-filter-filled</title>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="clear-filter" fill="#000000" transform="translate(42.666667, 85.333333)">
                                        <path
                                            d="M320,170.666667 C348.289759,170.666667 375.420843,181.90473 395.424723,201.90861 C415.428604,221.91249 426.666667,249.043574 426.666667,277.333333 C426.666667,336.243707 378.910373,384 320,384 C261.089627,384 213.333333,336.243707 213.333333,277.333333 C213.333333,218.42296 261.089627,170.666667 320,170.666667 Z M320,192 C272.871701,192 234.666667,230.205035 234.666667,277.333333 C234.666667,324.461632 272.871701,362.666667 320,362.666667 C367.128299,362.666667 405.333333,324.461632 405.333333,277.333333 C405.333333,230.205035 367.128299,192 320,192 Z M356.543147,225.705237 L371.628096,240.790187 L335.083904,277.333237 L371.628096,313.87648 L356.543147,328.961429 L319.999904,292.417237 L283.456853,328.961429 L268.371904,313.87648 L304.914904,277.333237 L268.371904,240.790187 L283.456853,225.705237 L319.999904,262.248237 L356.543147,225.705237 Z M341.333333,1.42108547e-14 L192,181.999 L192,304 L149.333333,304 L149.333,182 L7.10542736e-15,1.42108547e-14 L341.333333,1.42108547e-14 Z"
                                            id="Combined-Shape">

                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </label>
                    </div>
                    <ol class="max-w-xs list-decimal cursor-pointer">
                        @foreach ($People as $index => $person)
                            <tr class="gap-2">
                                <label>
                                    <li class="flex m-2 text-xs hover:bg-cyan-200">
                                        <input wire:model="selectedUser" value="{{ $person->id }}" type="checkbox"
                                            class="mr-2 checkbox checkbox-xs checkbox-success @error('selectedUser') border border-rose-500 @enderror" />
                                        <p class="@error('selectedUser')  text-rose-500 @enderror">
                                            {{ $person->lookup_name }} </p>
                                    </li>
                                </label>
                            </tr>
                        @endforeach
                    </ol>
                </div>
                {{$People->links('livewire.miniPagination')}}
                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label for="addPC" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.security-user.modal')
</div>
