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
            const modalDel = document.getElementById("closeModalDel");
            $(document).on('click', '#closeDel', function() {
                modalDel.click()
            });
        </script>
        <script>
            $(".wrapper .tab").click(function() {
                $(".wrapper .tab").removeClass("tab-active font-bold text-success").eq($(this).index()).addClass(
                    "tab-active font-bold text-success");
                $(".tab_item").hide().eq($(this).index()).fadeIn()
            }).eq(0).addClass("tab-active font-bold text-success");
        </script>
    @endpush

    <div class="flex justify-between gap-4 mx-4">
        <div>
            @livewire('company-level.create')
        </div>

        <div class=" md:join">

            <select wire:model='searchBU'
                class="w-full max-w-xs mb-1 bg-white md:w-auto md:mb-0 join-item select select-success select-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                <option value="" selected>search Bussiness Unit </option>
                @foreach ($B_unit as $item)
                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                @endforeach
            </select>

            <select wire:model='searchLevel'
                class="w-full max-w-xs mb-1 bg-white md:w-auto md:mb-0 join-item select select-success select-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                <option value="" selected>Search Level</option>
                <option value="department" selected>department</option>
                <option value="contractor" selected>contractor
            </select>

            <select wire:model='searchDeptCont'
                class="w-full max-w-xs mb-1 bg-white md:w-auto md:mb-0 join-item select select-success select-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                <option value="" selected>Search Department / Contractor...</option>
                @if (!empty($searchLevel))
                    @foreach ($DeptCont as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                @else
                    @foreach ($Dept as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                    @foreach ($Cont as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                @endif
            </select>

        </div>
    </div>

    <div class="mx-4 mt-4 overflow-x-auto rounded-t-lg rounded-b-lg shadow-md">

        <table class="table table-xs">

            <thead class="bg-emerald-300">

                <tr class="text-center">
                    <th>#</th>
                    <th>Bussiness Unit</th>
                    <th>{{ $table_name }}</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($CompanyLevel as $index => $item)
                    <tr class="text-center">
                        <th>{{ $CompanyLevel->firstItem() + $index }}</th>
                        <td>{{ $item->BussinessUnit->name }}</td>
                        <td>{{ $item->deptORcont }}</td>
                        <td>
                            <div class="flex flex-row justify-center gap-1">

                                <label wire:click="update_CompanyLevel({{ $item->id }})"
                                    class="btn btn-xs btn-warning ">Edit</label>
                                <label for="delete_data" wire:click="deleteCompanyLevel({{ $item->id }})"
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
                    <th>Bussiness Unit</th>
                    <th>{{ $table_name }}</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>{{ $CompanyLevel->links() }}</div>
    @livewire('company-level.update')


    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="delete_data" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete?</h4>
            <form wire:submit.prevent='deleteFileCompanyLevel'>
                <div class="mx-4 mt-4 overflow-x-auto rounded-t-lg rounded-b-lg shadow-md">
                    <table class="table table-xs">
                        <thead class="bg-emerald-300">
                            <tr class="text-center">
                                <th>Bussiness Unit</th>
                                <th>Contractor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $bu_name }}</td>
                                <td>{{ $contractor_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-action">
                    <button type="submit" id="closeDel" class="text-white btn btn-success btn-xs">Yes
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </button>
                    <label id="closeModalDel" for="delete_data" class="btn btn-xs btn-error">No!</label>
                </div>
            </form>
        </div>
    </div>

</div>
