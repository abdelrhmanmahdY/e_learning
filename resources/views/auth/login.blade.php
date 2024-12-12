<x-guest-layout>
    <!-- Session Status -->
<<<<<<< HEAD
    <x-auth-session-status class="mb-4" :status="session('status')" />
=======
    <div class="container hi row justify-content-center">
        <div class="main form rounded-4 p-1 pt-2 col-12 col-md-8 col-lg-6 col-xl-4">
            <img src="{{ asset('../resources/img/SUT_Logo-removebg-preview.png') }}" alt="Sut logo" width="200px">
>>>>>>> main

    <form method="POST" action="{{ route('login') }}">
        @csrf

<<<<<<< HEAD
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
=======

                <h3 class="text-center mt-5 heading fw-bold loginText">Log In</h3>

                <!-- Email Input -->
                <div class="input-group flex-nowrap w-75 mt-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg">
                        <i class="fa-solid fa-envelope fa-2xl"></i>
                    </span>
                    <div class="form-floating">
                        <x-text-input type="email" name="email" id="email" autocomplete="username"
                            class="form-control email" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-lg" placeholder="Email" :value="old('email')"
                            autocomplete="username" required autofocus />
                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                </div>

                <!-- Password Input -->
                <div class="input-group flex-nowrap w-75 mt-4">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-lock fa-2xl"></i></span>
                    <div class="form-floating">
                        <x-text-input type="password" name="password" autocomplete="current-password"
                            class="form-control password" placeholder="Password" id="password"
                            autocomplete="current-password" required />
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Remember Me -->
                <div class="checkbox mb-3 forgotPass">
                    <label for="remember_me" class="form-label" id="rem">
                        <input type="checkbox" name="remember" id="remember_me" class="form-check-input" />
                        {{ __('Remember me') }} </label>
                </div>

                <!-- Forgot Password -->
                <p class="forgotPass">
                    @if (Route::has('password.request'))
                        <a id="forgotPasswordLink" href="{{ route('password.request') }}"
                            class=" forget link-offset-2 link-underline-opacity-0">
                            {{ __('Forgot your password?') }}

                        </a>
                    @endif
                </p>

                <!-- Submit Button -->
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
                <!-- Sign Up Link -->
                <span class="signupspace">
                    No account?
                    <a href="{{ route('register') }}"
                        class=" signUp link-opacity-50 link-offset-2 link-underline-opacity-0">
                        Create one!
                    </a>
                </span>
            </form>
>>>>>>> main
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
