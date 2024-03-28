<div>
    @include('toast.toast')
    @push('styles')
        @livewireStyles()
        <script src="https://kit.fontawesome.com/3de311882c.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="../../flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="../../flatpickr/dist/plugins/monthSelect/style.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../flatpickr/dist/themes/dark.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        {{-- <script src="../../flatpickr/dist/plugins/rangePlugin.js"></script> --}}

        <script>
            flatpickr("#tanggal", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });

            flatpickr("#tglLapor", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#jamKejadian", {
                disableMobile: "true",
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
            flatpickr("#tgldilapor", {
                disableMobile: "true",
                dateFormat: "d-m-Y", //defaults to "F Y"
            });
            flatpickr("#month", {
                disableMobile: "true",
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true, //defaults to false
                        dateFormat: "M-Y", //defaults to "F Y"
                        altFormat: "F Y", //defaults to "F Y"
                        theme: "dark" // defaults to "light"
                    })
                ]
            });

            const tglll = $("#rangeDate").flatpickr({
                mode: 'range',
                dateFormat: "d-m-Y", //defaults to "F Y"
                onChange: function(dates) {
                    if (dates.length === 2) {
                        var start = dates[0].getDate() + "-" + dates[0].getMonth() + "-" + dates[0].getFullYear();
                        var end = dates[1].getDate() + "-" + dates[1].getMonth() + "-" + dates[1].getFullYear();;
                        livewire.emit('TglMulai', start);
                        livewire.emit('TglAkhir', end);
                    }
                }
            })
        </script>
    @endpush
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-rose-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="items-center justify-between flex-none gap-2 p-2 sm:flex sm:p-0">
        <div class="mt-2">
            @livewire('event-report.document.create', ['id' => $ID_Details])
          
        </div>

        <div class=" md:join">


            <input wire:model='search'
                class="w-full max-w-xs py-2 bg-white shadow-sm join-item input-xs input input-success placeholder:italic placeholder:text-slate-400 focus:outline-none focus:border-success focus:ring-success focus:ring-1 sm:text-sm"
                placeholder="Search Document..." type="text" />
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
    <div class="grid px-2 ">

        <div class="w-auto mx-4 mt-4 overflow-x-auto rounded-md shadow-md md:w-auto">
            <table class="table table-xs">
                <thead class="bg-emerald-300">
                    <tr class="text-center ">
                        <th>#</th>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Document as $index => $item)
                        <tr class="text-center">
                            <th>{{ $Document->firstItem() + $index }}</th>
                            <td class="font-semibold">{{ $item->fileTitle }}</td>
                            <td>

                                <label class="btn btn-ghost" wire:click="download('{{ $item->id }}')">
                                    <i
                                        class="
                                {{ pathinfo(public_path($item->fileName))['extension'] === 'jpg' ? 'fa-sharp fa-regular fa-file-image fa-2xl' : '' }}
                                {{ pathinfo(public_path($item->fileName))['extension'] === 'png' ? 'fa-sharp fa-regular fa-file-image fa-2xl' : '' }}
                                {{ pathinfo(public_path($item->fileName))['extension'] === 'xlsx' ? 'fa-sharp fa-regular fa-file-excel fa-2xl' : '' }}
                                {{ pathinfo(public_path($item->fileName))['extension'] === 'pdf' ? 'fa-sharp fa-regular fa-file-pdf fa-2xl' : '' }}
                                {{ pathinfo(public_path($item->fileName))['extension'] === 'docx' ? 'fa-sharp fa-regular fa-file-word fa-2xl' : '' }}
                                "></i>
                                </label>
                            </td>

                            <td>
                                <div class="flex flex-row justify-center gap-1">
                                    <label for="delete_data" wire:click="delete({{ $item->id }})"
                                        class="btn btn-xs btn-error ">Delete</label>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="10" class="font-semibold text-rose-500">

                                <p class="flex justify-center"> Data not found <span
                                        class="loading loading-bars loading-xs"> </span></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-emerald-300">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div>{{ $Document->links() }}</div>
    </div>

    <input type="checkbox" id="delete_data" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete file name : {{ $nameData }}?</h4>
            <form wire:submit.prevent='deleteFile'>
                <div class="modal-action">
                    <button id="close" type="submit" class="text-white btn btn-success btn-xs">Yes
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </button>
                    <label for="delete_data" id="closeModal" class="btn btn-xs btn-error">No!</label>
                </div>
            </form>
        </div>
    </div>

</div>