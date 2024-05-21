{{-- MODAL REPORT TO --}}
<dialog class="{{ $open_Responsibility }}" role="dialog">
    <div  wire:ignore.self class="w-64 modal-box">
        <div
            class="-mt-3 text-sm font-extrabold text-transparent divider divider-accent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">
            Report To</div>
        <div class="relative flex items-center max-w-xs shadow-sm join-item">
            <input id="5" type="text" wire:model='search_reportBy'
                class="relative w-full max-w-xs peer input input-bordered input-xs focus:ring-1 focus:outline-none focus:drop-shadow-lg "
                placeholder="search people..." />

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                class="absolute w-4 h-4 opacity-70 right-2">
                <path fill-rule="evenodd"
                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                    clip-rule="evenodd" />
            </svg>

        </div>
        <div class="w-full max-w-xs text-xs shadow-md">


            <ul class="overflow-y-auto list-disc list-inside h-60">

                @foreach ($Responsibility as $index => $pelapor)
                    <li wire:click="cariResponsibility('{{ $pelapor->id }}')" class="px-2 cursor-pointer hover:bg-sky-400">
                        {{ $pelapor->lookup_name }}</li>
                @endforeach
            </ul>
        </div>
        <div wire:ignore.self >{{ $Responsibility->links('livewire.miniPagination') }}</div>
        <div class="modal-action">
            <label  wire:click='closeResponsibility' class="btn btn-xs btn-error">Close!</label>
        </div>
    </div>
</dialog>