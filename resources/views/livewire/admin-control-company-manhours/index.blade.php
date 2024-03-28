<div class="mt-8">
    @include('toast.toast')
    @push('styles')
        @livewireStyles()
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @endpush
    @push('scripts')
        @livewireScripts()
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            const modal = document.getElementById("closeModal");
            $(document).on('click', '#close', function() {
                modal.click()
            });
        </script>
    @endpush
    <div class="flex justify-between">
        <div>
            @livewire('admin-control-company-manhours.create')
        </div>
        <div class="md:join">


            <div class="relative join-item ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor"class="w-4 h-4 absolute left-0 my-1.5 ml-2 font-bold">
                    <path
                        d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                    <path fill-rule="evenodd"
                        d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                        clip-rule="evenodd" />
                </svg>

                <input type="text" placeholder="{{ __('Search User') }}" wire:model='searchUser' autocomplete="off"
                    class="input input-bordered placeholder:italic placeholder:text-slate-400 input-success input-xs w-full md:w-52 max-w-xs pl-6 focus:outline-none  focus:ring-success focus:ring-1" />

            </div>
            <div class="relative join-item ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-4 h-4 absolute left-0 my-1.5 ml-2 font-bold">
                    <path
                        d="M19.006 3.705a.75.75 0 1 0-.512-1.41L6 6.838V3a.75.75 0 0 0-.75-.75h-1.5A.75.75 0 0 0 3 3v4.93l-1.006.365a.75.75 0 0 0 .512 1.41l16.5-6Z" />
                    <path fill-rule="evenodd"
                        d="M3.019 11.114 18 5.667v3.421l4.006 1.457a.75.75 0 1 1-.512 1.41l-.494-.18v8.475h.75a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1 0-1.5H3v-9.129l.019-.007ZM18 20.25v-9.566l1.5.546v9.02H18Zm-9-6a.75.75 0 0 0-.75.75v4.5c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75H9Z"
                        clip-rule="evenodd" />
                </svg>

                <select wire:model='searchCompany'
                    class="select select-bordered placeholder:italic placeholder:text-slate-400 select-success select-xs w-full max-w-xs pl-6 focus:outline-none rounden-sm focus:ring-success focus:ring-1">
                    <option value="" selected class="text-gray-400">Select an company</option>
                    @foreach ($Company as $key => $value)
                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>
    <div class="mx-4 mt-4 overflow-x-auto rounded-t-lg rounded-b-lg">
        <table class="table table-xs table-zebra">
            <thead class=" bg-emerald-300">

                <tr class="text-center ">
                    <th>#</th>
                    <th>Company Category</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($User as $index => $item)
                    <tr class="text-center">
                        <th>{{ $User->firstItem() + $index }}</th>
                        <td>{{ $item->name }}</td>
                        <td>
                            @foreach ($item->companies()->get() as $role)
                                <label for="my_modal_7"
                                    wire:click="update_company({{ $item->id }}, {{ $role->id }})"
                                    class="btn btn-xs glass btn-primary me-2">{{ $role->name }}</label>
                            @endforeach
                        </td>

                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="4">empty data</td>
                    </tr>
                @endforelse



            </tbody>
            <tfoot class="bg-emerald-300">
                <tr class="text-center">
                    <th>#</th>
                    <th>Company Category</th>
                    <th>Company</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>{{ $User->links() }}</div>
    <input type="checkbox" id="my_modal_7" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <div class="divider divider-accent">Choose Options</div>

            <div class="modal-action">
                <label for="editModal" class="btn btn-xs btn-warning btn-outline">Edit</label>
                <label wire:click='deleteFile' class="btn btn-xs btn-error btn-outline">Delete</label>
            </div>
        </div>
        <label class="modal-backdrop" for="my_modal_7">Close</label>

    </div>


    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="editModal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <div class="divider divider-accent">Edit {{$id_ACCM}}</div>
            <form wire:submit.prevent='update'>
                @csrf
                @method('PATCH')
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('User')" />
                    <select wire:model='user_id'
                        class=" @error('user_id') border-rose-500 border-2 @enderror select select-success w-full select-sm max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option selected>Select Category</option>
                        @foreach ($User as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-0" />
                </div>
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('Company ')" />
                    <select wire:model='company_id'
                        class=" @error('company_id') border-rose-500 border-2 @enderror select select-success w-full select-sm max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option selected>Select Category</option>
                        @foreach ($Company as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('company_id')" class="mt-0" />
                </div>
               
                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg  xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                       
                    </button>
                   
                </div>
            </form>
        </div>
        <label class="modal-backdrop" for="editModal">Close</label>
    </div>
</div>
