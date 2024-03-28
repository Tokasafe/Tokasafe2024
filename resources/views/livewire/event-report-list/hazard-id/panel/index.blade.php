<div>
    <div class="items-center justify-between flex bg-gray-300 rounded-t-lg ">
        <div class="flex flex-row pl-2 bg-gray-300 rounded-t-lg w-80">
            <div class="w-36 text-xs font-semibold ">{{ __('Current_Step') }}</div>
            <div class="w-full text-xs font-extrabold">: {{ $current_step }}</div>
        </div>
        @if ($userController)
            <button
                class="btn btn-xs btn-circle btn-ghost  right-2 top-2 tooltip tooltip-left font-bold text-blue-500 hidden lg:block"
                data-tip="{{ $moderator }} ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 pl-1">
                    <path
                        d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                </svg>
            </button>
        @endif
    </div>
    <form wire:submit.prevent='store'>
        @csrf
        @method('PATCH')
        @if ($userController)
            <div class="z-20 flex flex-col sm:flex-row gap-1 pb-1 px-2 bg-gray-300 shadow-md ">
                <div class="w-full sm:max-w-max form-control">
                    <x-input-label-req :value="__('Proceed_To')" />
                    <select wire:model='proceedTo'
                        class="@error('proceedTo') border-rose-500 border-2 @enderror w-full sm:max-w-max select select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option value="" selected>Select an option</option>
                        @foreach ($Workflow as $value)
                            <option value="{{ $value->destination_1 }}">{{ $value->destination_1_label }}</option>
                            @if (!empty($value->destination_2))
                                <option value="{{ $value->destination_2 }}">{{ $value->destination_2_label }}</option>
                            @elseif(!empty($value->checkCancel))
                                <option value="{{ $value->checkCancel }}">{{ $value->checkCancel }}</option>
                            @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('proceedTo')" class="mt-0" />
                </div>
                <div class="{{ $responsibleRole == 2 ? ' w-full sm:max-w-max form-control' : 'hidden' }}">
                    <x-input-label-req :value="__('Assign_To')" />
                    <select wire:model='assignTo'
                        class="@error('assignTo') border-rose-500 border-2 @enderror w-full select sm:max-w-max select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option value="" selected>Select an Person</option>
                        @foreach ($People as $index => $person)
                            @if (old('assignTo') == $person->user_id)
                                <option value="{{ $person->user_id }}">{{ $person->People->lookup_name }}</option>
                            @else
                                <option value="{{ $person->user_id }}">{{ $person->People->lookup_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('assignTo')" class="mt-0" />
                </div>
                <div class="{{ $responsibleRole == 2 ? ' w-full sm:max-w-max form-control' : 'hidden' }}">
                    <x-input-label-req :value="__('Also_Assign_To')" />
                    <select wire:model='also_assignTo'
                        class="@error('also_assignTo') border-rose-500 border-2 @enderror w-full select sm:max-w-max select-bordered select-xs select-success focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option value="" selected>Select an Person</option>
                        @foreach ($People as $index => $person)
                            @if (old('assignTo') == $person->user_id)
                                <option value="{{ $person->user_id }}">{{ $person->People->lookup_name }}</option>
                            @else
                                <option value="{{ $person->user_id }}">{{ $person->People->lookup_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('also_assignTo')" class="mt-0" />
                </div>
                <button type="submit" for=""
                    class="@error('proceedTo') self-center @enderror  btn btn-xs self-end sm:btn-square  sm:mx-0 btn-primary sm:tooltip sm:tooltip-primary"
                    data-tip="{{ __('Submit') }}">
                    <p class="sm:hidden">{{ __('Submit') }}</p>
                    <svg wire:loading.remove wire:target="store" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                    <span wire:loading wire:target="store"
                        wire:loading.class="bg-rose-500 loading loading-spinner loading-sm"></span>
                </button>
            </div>
        @endif
    </form>
</div>
