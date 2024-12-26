<x-guest-layout>
    <div class="container hi row justify-content-center">
        <div class="smain form rounded-4 p-1 pt-2 col-12 col-md-8 col-lg-6 col-xl-4 visible">
            <img src="{{ asset('../resources/img/SUT_Logo-removebg-preview.png') }}" alt="mcv logo" width="200px">

            <form class="d-flex flex-column align-items-center was-validated" id="signupform"
                action="{{ route('register') }}" method="post" name="signUp" enctype="multipart/form-data">
                @csrf

                <h3 class="text-center mt-3 heading fw-bold loginText">Sign Up</h3>

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


                <!-- Email -->
                <div class="input-group input-group-lg w-75 mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa-solid fa-envelope"></i></span>
                    <div class="form-floating">
                        <x-text-input id="email" class="form-control email" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />

                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <!-- Password -->
                <div class="input-group input-group-lg w-75 mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa-solid fa-lock"></i></span>
                    <div class="form-floating">

                        <x-text-input id="password" class="form-control password" type="password" name="password"
                            required autocomplete="new-password" />
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <!-- Confirm Password -->
                <div class="input-group input-group-lg w-75 mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa-solid fa-lock"></i></span>
                    <div class="form-floating">
                        <x-text-input id="confpass" class="form-control confpass" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-label for="confpass" :value="__('Confirm Password')" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />


                <div class="input-group input-group-lg w-75 mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa-solid fa-image"></i></span>
                    <div class="form-floating">
                    <input type="file" id="photo" name="photo" class="form-control"
                    accept="image/*">
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
        </div>
    </div>

</x-guest-layout>
