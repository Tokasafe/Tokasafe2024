<div>
    @push('styles')
        @livewireStyles()
        <link rel="stylesheet" type="text/css" href="{{ asset('toastify/css/toastify.css') }}">
    @endpush
    @push('scripts')
        @livewireScripts()
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script type="text/javascript" src="{{ asset('toastify/js/toastify.js') }}"></script>
        <script>
            const modal = document.getElementById("closeModal");
            $(document).on('click', '#close', function() {
                modal.click()
            });
        </script>
    @endpush
    @include('toast.toast')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-rose-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex justify-between">
        <div>
            @livewire('risk.assessment.create')
        </div>

        <div>
            <label class="relative block">
                <span class="sr-only">Search</span>
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>
                <input wire:model='search'
                    class="block w-full py-2 pr-3 bg-white border-2 rounded-md shadow-sm input-sm placeholder:italic placeholder:text-slate-400 border-emerald-300 pl-9 focus:outline-none focus:border-emerald-500 focus:ring-emerald-500 focus:ring-1 sm:text-sm"
                    placeholder="Search Assessment..." type="text" name="search" />
            </label>
        </div>
    </div>
    <div class="mx-4 mt-4 overflow-x-auto rounded-t-lg rounded-b-lg shadow-md">
        <table class="table table-xs ">
            <thead class="bg-emerald-300">
                <tr class="text-center">
                    <th>#</th>
                    <th>Name</th>
                    <th>Notes</th>
                    <th>Investigation Req</th>
                    <th>Reporting Obligation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($Assessment as $index => $item)
                    <tr class="text-center">
                        <th>{{ $Assessment->firstItem() + $index }}</th>
                        <td class="text-left border  border-slate-300">
                            <p class="text-xs">{{ $item->name }}</p>
                        </td>
                        <td class="text-left border border-slate-300">
                            <p class="text-justify">{{ $item->notes }}</p>
                        </td>
                        <td class="text-left border border-slate-300">
                            <p class="text-justify">{{ $item->investigation_req }}</p>
                        </td>
                        <td class="text-left border border-slate-300">
                            <p class="text-justify">{{ $item->reporting_obligation }}</p>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center gap-1">

                                <label wire:click="update_Assessment({{ $item->id }})"
                                    class="btn btn-xs btn-warning ">Edit</label>
                                <label for="delete_data" wire:click="delete_Assessment({{ $item->id }})"
                                    class="btn btn-xs btn-error ">Delete</label>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-rose-500 font-semibold text-center">Not Found!!</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="bg-emerald-300">
                <tr class="text-center">
                    <th>#</th>
                    <th>Name</th>
                    <th>Notes</th>
                    <th>Investigation Req</th>
                    <th>Reporting Obligation</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>{{ $Assessment->links() }}</div>
    @livewire('risk.assessment.update')


    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="delete_data" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete {{ $name }}?</h4>
            <form wire:submit.prevent='deleteFile'>
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
