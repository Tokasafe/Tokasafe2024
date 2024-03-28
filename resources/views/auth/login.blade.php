<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />




    <div class="hero bg-base-100 flex justify-center" style="background-image: url(https://i.ibb.co/3zwLwfW/bg-app.png);">
        <div class="hero-content flex-col lg:flex-row-reverse ">
            <img src="https://i.ibb.co/mynvfs2/1.png" class="sm:max-w-xs w-20 sm:w-full rounded-lg shadow-2xl" />

            <div class="card flex-shrink-0  max-w-sm shadow-2xl bg-white">
                <form class="card-body" method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Username -->
                    <div>
                        <x-input-label for="username" :value="__('Username')" />
                        <x-text-input id="username"
                            class="appearance-none  rounded w-full py-3 px-3 leading-tight border-success  focus:outline-none  focus:bg-white text-gray-700 pr-16 font-mono"
                            type="text" name="username" :value="old('username')" required autofocus
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('username')" class="mt-0" />
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <div class="relative">
                           
                            <x-text-input name="password"
                                class="appearance-none  rounded w-full py-3 px-3 leading-tight border-success  focus:outline-none  focus:bg-white text-gray-700 pr-16 font-mono js-password"
                                id="password" type="password" autocomplete="off" />
                                <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                    <label id="btnToggle"
                                        class=" btn btn-xs btn-ghost btn-circle rounded px-2  text-sm text-gray-600 font-mono cursor-pointer "
                                        for="toggle"> <i id="eyeIcon"class="bi bi-eye-slash"></i>
                                    </label>
                                </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="text-success-600 border-gray-300 rounded shadow-sm focus:ring-success-500"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <x-primary-button class="ml-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
      
        const passwordInput = document.getElementById('password'),
            toggle = document.getElementById('btnToggle'),
            icon = document.getElementById('eyeIcon');

        function togglePassword() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.add("bi-eye");
                //toggle.innerHTML = 'hide';
            } else {
                passwordInput.type = 'password';
                icon.classList.remove("bi-eye");
                //toggle.innerHTML = 'show';
            }
        }
        toggle.addEventListener('click', togglePassword, false);
    </script>

</x-guest-layout>
