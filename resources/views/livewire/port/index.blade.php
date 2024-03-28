<div>
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
            const modalDel = document.getElementById("closeModal");
            $(document).on('click', '#close', function() {
                modalDel.click()
            });
        </script>
    @endpush

    <div class="flex justify-between mx-4">
        <div>
            @livewire('port.create')
        </div>
        <div class="join">


            <input wire:model='searchRole'
                class="w-full max-w-xs py-2 bg-white shadow-sm join-item input-xs input input-success placeholder:italic placeholder:text-slate-400 focus:outline-none focus:border-success focus:ring-success focus:ring-1 sm:text-sm"
                placeholder="Search Role..." type="text" />
            <span class="hidden bg-emerald-300 join-item btn-xs border-emerald-600 md:block">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M8.25 10.875a2.625 2.625 0 115.25 0 2.625 2.625 0 01-5.25 0z" />
                    <path fill-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.125 4.5a4.125 4.125 0 102.338 7.524l2.007 2.006a.75.75 0 101.06-1.06l-2.006-2.007a4.125 4.125 0 00-3.399-6.463z"
                        clip-rule="evenodd" />
                </svg>

            </span>

        </div>
    </div>

    <div class="mx-4 mt-4 overflow-x-auto rounded-t-lg rounded-b-lg shadow-md">

        <table class="table table-xs">

            <thead class="bg-emerald-300">

                <tr class="text-center">
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($Port as $index => $item)
                    <tr class="text-center">
                        <th>{{ $Port->firstItem() + $index }}</th>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <div class="flex flex-row justify-center gap-1">

                                <label wire:click="update_Port({{ $item->id }})"
                                    class="btn btn-xs btn-warning ">Edit</label>
                                <label for="delete_data" wire:click="deletePort({{ $item->id }})"
                                    class="btn btn-xs btn-error ">Delete</label>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td class="text-rose-500" colspan="4">Not Found!!</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="bg-emerald-300">
                <tr class="text-center">
                    <th>#</th>
                    <th>Code</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>{{ $Port->links() }}</div>
    @livewire('port.update')


    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="delete_data" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete?</h4>
            <form wire:submit.prevent='deleteFile'>
                <div class="mx-4 mt-4 overflow-x-auto rounded-t-lg rounded-b-lg shadow-md">
                    <table class="table table-xs">
                        <thead class="bg-emerald-300">
                            <tr class="text-center">
                                <th>Role Class</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $code }}</td>
                                <td>{{ $name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-action">
                    <button type="submit" id="close" class="text-white btn btn-success btn-xs">Yes
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </button>
                    <label id="closeModal" for="delete_data" class="btn btn-xs btn-error">No!</label>
                </div>
            </form>
        </div>
    </div>

</div>
