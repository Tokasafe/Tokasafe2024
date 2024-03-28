<div>
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
    @include('toast.toast')

    <div class="flex justify-between">
        <div>
            @livewire('workflow-administration.create')
        </div>

        <div>

        </div>
    </div>

    <div class="mx-4 mt-4 overflow-x-auto rounded-sm shadow-md">
        <table class="table table-xs table-zebra-zebra">
            <thead class="bg-primary">
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ __('Step Properties') }}</th>
                    <th>{{ __('Step Transitions') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($WorkflowAdministration as $index =>$item)
                    <tr class="text-center">
                        <th>{{ $WorkflowAdministration->firstItem() + $index }}</th>
                        <td>
                            <div class="grid p-0 justify-items-center">
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('Name')" />
                                    <input type="text" placeholder="Type here" readonly value="{{ $item->name }}"
                                        class="w-full max-w-xs input input-ghost input-xs focus:outline-none focus:border-none focus:ring-none focus:ring-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('description')" />
                                    <input type="text" placeholder="Type here" readonly
                                        value="{{ $item->description }}"
                                        class="w-full max-w-xs input input-ghost input-xs focus:outline-none focus:border-none focus:ring-none focus:ring-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('status_code')" />
                                    <input type="text" placeholder="Type here" readonly
                                        value="{{ $item->StatusCode->name }}"
                                        class="w-full max-w-xs input input-ghost input-xs focus:outline-none focus:border-none focus:ring-none focus:ring-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('responsible_role')" />
                                    <input type="text" placeholder="Type here" readonly
                                        value="{{ $item->ResponsibleRole->name }}"
                                        class="w-full max-w-xs input input-ghost input-xs focus:outline-none focus:border-none focus:ring-none focus:ring-0" />
                                </div>
                                <div class="w-full max-w-xs form-control ">
                                    <label class="cursor-pointer label">
                                        <x-input-label-req :value="__('Is Cancel Step:')" />
                                        <label for=""> {{$item->checkCancel?'Yes':'No'}}</label>
                                    </label>
                                </div>
                            </div>

                        </td>
                        <td>
                            <div class="grid p-0 justify-items-center">
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('destination_1')" />
                                    <input type="text" placeholder="-" readonly value="{{ $item->destination_1 }}"
                                        class="w-full max-w-xs input input-ghost input-xs focus:outline-none focus:border-none focus:ring-none focus:ring-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('destination_1_label')" />
                                    <input type="text" placeholder="-" readonly
                                        value="{{ $item->destination_1_label }}"
                                        class="w-full max-w-xs input input-ghost input-xs focus:outline-none focus:border-none focus:ring-none focus:ring-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('destination_2')" />
                                    <input type="text" placeholder="-" readonly value="{{ $item->destination_2 }}"
                                        class="w-full max-w-xs input input-ghost input-xs focus:outline-none focus:border-none focus:ring-none focus:ring-0" />
                                </div>
                                <div class="w-full max-w-xs form-control">
                                    <x-input-label :value="__('destination_2_label')" />
                                    <input type="text" placeholder="-" readonly
                                        value="{{ $item->destination_2_label }}"
                                        class="w-full max-w-xs input input-ghost input-xs focus:outline-none focus:border-none focus:ring-none focus:ring-0" />
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center gap-1">

                                <label wire:click="update({{ $item->id }})"
                                    class="btn btn-xs btn-warning ">Edit</label>
                                <label for="delete_data" wire:click="deleteWorkflow({{ $item->id }})"
                                    class="btn btn-xs btn-error ">Delete</label>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr class="text-center">
                        <td colspan="7" class="font-semibold text-rose-500">data not found!!</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="bg-primary">
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ __('Step Properties') }}</th>
                    <th>{{ __('Step Transitions') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>{{ $EventType->links() }}</div>

    @livewire('workflow-administration.update')


    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="delete_data" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h4 class="text-lg font-bold text-center">Are You Sure Delete {{ $nameData }}?</h4>
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
