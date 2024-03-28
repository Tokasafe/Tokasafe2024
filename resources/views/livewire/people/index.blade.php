<div class="mt-10">
    @push('styles')
        @livewireStyles()
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="../../flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="../../flatpickr/dist/plugins/monthSelect/style.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../flatpickr/dist/themes/dark.css">
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
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="../../flatpickr/dist/plugins/monthSelect/index.js"></script>

        <script>
            flatpickr("#tgl_lahir", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#tgl_mulai", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
        </script>
    @endpush
    @include('toast.toast')

    <div class="flex justify-between m-3">
        <div class="">
            @livewire('people.create')
        </div>



        <div>
            <div class="relative ">
              
               
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 absolute left-0 my-1.5 ml-2 font-bold">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input  wire:model='search' type="text"  placeholder="Search People" class="input input-bordered placeholder:italic placeholder:text-slate-400 input-success input-xs w-full max-w-xs pl-6 focus:outline-none rounden-sm focus:ring-success focus:ring-1" />
                {{-- <input
                    class=" w-full py-2  shadow-sm input-sm placeholder:italic placeholder:text-slate-400 input-success focus:outline-none rounden-sm focus:ring-success focus:ring-1 sm:text-sm"
                    placeholder="Search People" type="text" name="search" /> --}}
            </div>
        </div>
    </div>
    <div class="grid px-2 ">

    <div class="w-auto mx-3 mt-2 overflow-x-auto rounded-sm shadow-md md:w-auto">
            
        <table class="table table-xs table-zebra-zebra">
            <thead class="bg-primary">
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Network Username') }}</th>
                    <th>{{ __('Workgroup') }}</th>
                    <th>{{ __('Employer') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($People as $index =>$item)
                    <tr class="text-center">
                        <th>{{ $People->firstItem() + $index }}</th>
                        <th>{{ $item->lookup_name }}</th>
                        <th>{{ $item->network_username }}</th>
                        <td>{{ $item->workgroup }}</td>
                        <td>@if (!empty($item->employer))
                            {{ $item->Employer->name }}
                        @endif</td>
                        <td>
                            <div class="flex flex-row justify-center gap-1">

                                <label wire:click='update_org({{ $item->id }})'
                                    class="btn btn-xs btn-warning ">{{__('Details')}}</label>
                                <label for="delete_data" wire:click="deletePeople({{ $item->id }})"
                                    class="btn btn-xs btn-error ">{{{__('Delete')}}}</label>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-rose-500">Not Found!!!</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="bg-primary">
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Network Username') }}</th>
                    <th>{{ __('Workgroup') }}</th>
                    <th>{{ __('Employer') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>{{ $People->links() }}</div>
   </div>
    @livewire('people.update')


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
