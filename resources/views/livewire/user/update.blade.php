<div>
    @include('toast.toast')

    <div class="modal @if (!empty($openModal)) modal-open @endif">
        <div class="modal-box">
            <div class="divider divider-accent font-bold">Add User</div>
            <form wire:submit.prevent='store'>
                @csrf
                @method('PATCH')
                <div class="w-full max-w-xs form-control">

                    <x-input-label-req :value="__('Name')" />
                    <input type="text" placeholder="Type here" wire:model='name'
                        class=" @error('name') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                    <x-input-error :messages="$errors->get('name')" class="mt-0" />
                </div>
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('Username')" />
                    <input type="text" placeholder="Type here" wire:model='username'
                        class=" @error('username') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                    <x-input-error :messages="$errors->get('username')" class="mt-0" />
                </div>
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('Email')" />
                    <input type="email" placeholder="Type here" wire:model='email'
                        class=" @error('email') border-rose-500 border-2 @enderror w-full max-w-xs input input-bordered input-success input-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1" />
                    <x-input-error :messages="$errors->get('email')" class="mt-0" />
                </div>
                <div class="w-full max-w-xs form-control">
                    <x-input-label-req :value="__('Role Class')" />
                    <select wire:model='roles_id'
                        class=" @error('roles_id') border-rose-500 border-2 @enderror select select-success w-full select-xs max-w-xs focus:outline-none focus:border-success focus:ring-success focus:ring-1">
                        <option selected>Select Role</option>
                        @foreach ($Roles as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('roles_id')" class="mt-0" />
                </div>
               
                <div class="modal-action">
                    <button type="submit" class="text-white btn btn-success btn-xs">Save
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                    </button>
                    <label wire:click="outModal" class="btn btn-xs btn-error">Close!</label>
                </div>
            </form>
        </div>
    </div>
</div>
