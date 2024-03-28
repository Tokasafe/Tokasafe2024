<div>
  
    @include('toast.toast')
    {{-- @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif --}}
    <div class="items-center justify-between flex bg-gray-200 rounded-t-lg ">
        <div class="flex flex-row pl-2 bg-gray-200 rounded-t-lg ">
            <div class="w-28 text-xs font-semibold ">Current Step</div>
            <div class="w-full text-xs">: {{ $current_step }}</div>
        </div>
       <div class="">
        @if ($userController)
        <details class="collapse bg-gray-200 flex justify-center px-6 rounded-t-lg cursor-pointer">
            <summary class="collapse-title text-xs font-medium">Moderate By</summary>
            <div class="collapse-content gap-2">
                <small>{{$reportBy}},</small>
               <small class="font-semibold"> {{__('Date')}}: {{date('d-M-Y H:i:s',strtotime($time))}}</small>
            </div>
        </details>
        @endif
       </div>
    </div>
    <form wire:submit.prevent='store'>
        @csrf
        @method('PATCH')
        @if ($userController)
        <div class="z-20 flex flex-row gap-1 pb-1 pl-2 bg-gray-200 shadow-md ">
            <div class="w-full max-w-max form-control">
                <x-input-label-req :value="__('Proceed To')" />
                <select wire:model='proceedTo'
                    class="@error('proceedTo') border-rose-500 border-2 @enderror w-full select max-w-max select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                    <option selected>Select an option</option>
                    <option value="{{ $destination_1 }}">{{ $destination_1_label }}</option>
                    <option value="{{ $destination_2 }}">{{ $destination_2_label }}</option>

                </select>
                <x-input-error :messages="$errors->get('proceedTo')" class="mt-0" />
            </div>

            <div class="{{ $responsibleRole == 1 ? ' w-full max-w-max form-control' : 'hidden' }}">
                <x-input-label-req :value="__('Assign To')" />
                <select wire:model='assignTo'
                    class="@error('assignTo') border-rose-500 border-2 @enderror w-full select max-w-max select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                    <option selected>Select an Person</option>
                    @foreach ($People as $index => $person)
                    @if (old('assignTo') == $person->id)
                    <option value="{{ $person->id }}">{{ $person->People->lookup_name }}</option>
                    @else
                    <option value="{{ $person->id }}">{{ $person->People->lookup_name }}</option>
                    @endif
                    @endforeach

                </select>
                <x-input-error :messages="$errors->get('assignTo')" class="mt-0" />
            </div>
            <div class="{{ $responsibleRole == 1 ? ' w-full max-w-max form-control' : 'hidden' }}">
                <x-input-label-req :value="__('Also Assign To')" />
                <select wire:model='also_assignTo'
                    class="@error('also_assignTo') border-rose-500 border-2 @enderror w-full select max-w-max select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                    <option selected>Select an Person</option>
                    @foreach ($People as $index => $person)
                    @if (old('assignTo') == $person->id)
                    <option value="{{ $person->id }}">{{ $person->People->lookup_name }}</option>
                    @else
                    <option value="{{ $person->id }}">{{ $person->People->lookup_name }}</option>
                    @endif
                    @endforeach

                </select>
                <x-input-error :messages="$errors->get('also_assignTo')" class="mt-0" />
            </div>
            <button type="submit" for=""
                class="@error('proceedTo') self-center @enderror self-end btn btn-xs btn-square btn-outline btn-accent">
                <svg wire:loading.remove wire:target="store" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span wire:loading wire:target="store"
                    wire:loading.class="bg-rose-500 loading loading-spinner loading-sm"></span>

            </button>
        </div>
        @endif
    </form>
</div>