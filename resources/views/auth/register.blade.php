<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

<<<<<<< HEAD
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
=======
            <form class="d-flex flex-column align-items-center was-validated" id="signupform"
                action="{{ route('register') }}" method="post" name="signUp" enctype="multipart/form-data">
                @csrf
>>>>>>> main

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

<<<<<<< HEAD
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
=======
                <!-- Username -->
                <div class="input-group input-group-lg w-75 mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <div class="form-floating">
                        <x-text-input type="text" maxlength="12" autocomplete="name" name="name"
                            class="form-control name" placeholder="UserName" id="name" autofocus required
                            :value="old('name')" />
                        <x-input-label for="name" :value="__('Name')" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
>>>>>>> main

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

<<<<<<< HEAD
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
=======
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />


                <div class="input-group input-group-lg w-75 mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa-solid fa-image"></i></span>
                    <div class="form-floating">
                        <x-text-input id="photo" class="form-control" type="file" name="photo"
                            accept="image/*" />
                        <x-input-label for="photo" :value="__('Profile Photo')" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />


                <!-- Submit Button -->
                <x-primary-button>
                    {{ __('Register') }}
                </x-primary-button>
                <!-- Error Summary -->


                <!-- Login Link -->
                <span class="loginspace">
                    Already have an account?
                    <a href="{{ route('login') }}"
                        class=" login link-opacity-50 link-offset-2 link-underline-opacity-0">
                        Log In
                    </a>
                </span>
            </form>
>>>>>>> main
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
