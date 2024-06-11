<div>
    @include('toast.toast')
    <div class="flex items-center justify-between bg-gray-300 rounded-t-lg">
        <div class="flex flex-col">
            <div class="flex flex-row pl-2 text-xs w-80">
                <div class="font-semibold w-36">{{ __('Current_Step') }}{{$responsibleRole}} </div>
                <div class="w-full font-bold">: {{ $current_step }}</div>
            </div>
            <form  wire:submit.prevent='storeUpdate' class="flex sm:flex-row flex-col  items-center  gap-1 pl-2 py-0.5 text-xs m-[3px]">
                @csrf
            @if ($userController)
                <label class="block w-full sm:max-w-xs ">
                    <x-span-label :value="__('Proceed_To')" />
                    <select wire:model='proceedTo'
                        class=" @error('proceedTo') border-rose-500 border-2 @enderror peer select select-bordered select-xs w-full max-w-xl focus:outline-none  focus:ring-success focus:ring-1">
                        <option value="" selected>{{ __('select_option') }}</option>
                        @foreach ($Workflow as $value)
                            <option value="{{ $value->destination_1 }}">{{ $value->destination_1_label }}</option>
                            @if ($value->destination_2)
                                <option value="{{ $value->destination_2 }}">{{ $value->destination_2_label }}</option>
                            @elseif($value->checkCancel)
                                <option value="{{ $value->checkCancel }}">{{ $value->checkCancel }}</option>
                            @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('proceedTo')" class="mt-0" />
                </label>
                <label class=" {{ $responsibleRole == 7 ? ' block w-full sm:max-w-xs' : 'hidden' }}">
                    <x-span-label :value="__('Assign_To')" />
                    <select wire:model='assignTo'
                        class=" @error('assignTo') border-rose-500 border-2 @enderror peer select select-bordered select-xs w-full max-w-xl focus:outline-none  focus:ring-success focus:ring-1">
                        <option value="" selected>{{ __('select_option') }}</option>
                        @foreach ($People as $index => $person)              
                                <option value="{{ $person->user_id }}">{{ $person->People->lookup_name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('assignTo')" class="mt-0" />
                </label>
                <label class="{{ $responsibleRole == 7 ? ' block w-full sm:max-w-xs' : 'hidden' }}">
                    <x-span-label :value="__('also_assignTo')" />
                    <select wire:model='also_assignTo'
                        class=" @error('also_assignTo') border-rose-500 border-2 @enderror peer select select-bordered select-xs w-full max-w-xl focus:outline-none  focus:ring-success focus:ring-1">
                        <option value="" selected>{{ __('select_option') }}</option>
                        @foreach ($People as $index => $person)              
                                <option value="{{ $person->user_id }}">{{ $person->People->lookup_name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('also_assignTo')" class="mt-0" />
                </label>
                <button type="submit" for=""
                    class="@error('proceedTo') self-center @enderror  btn btn-xs self-end sm:btn-square  sm:mx-0 btn-secondary sm:tooltip sm:tooltip-secondary"
                    data-tip="{{ __('Submit') }}">
                    <p class="sm:hidden">{{ __('Submit') }}</p>
                    <svg wire:loading.remove wire:target="storeUpdate" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                    <span wire:loading wire:target="storeUpdate"
                        wire:loading.class="bg-rose-500 loading loading-spinner loading-sm"></span>
                </button>
            </form>
            @endif
        </div>
        <div class="hidden text-xs sm:block">
            <button
                class="hidden mr-4 font-bold text-blue-500 btn btn-xs btn-circle btn-ghost tooltip tooltip-left lg:block"
                data-tip="{{ $moderator }} ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 pl-1">
                    <path
                        d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                </svg>
            </button>
        
        </div>
    </div>
</div>
