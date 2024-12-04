<x-guest-layout>
    <div class="container hi row justify-content-center">
        <div class="smain form rounded-4 p-1 pt-4 col-12 col-md-8 col-lg-6 col-xl-4">
            <form class="d-flex flex-column align-items-center was-validated" id="resetpass" name="signUp" method="POST"
                action="{{ route('password.store') }}">
                @csrf
                <h1 class="text-center mt-4 fw-bold loginText">Reset Password</h1>

                <h6 class="text-danger mt-4 fw-light text-opacity-75">Enter a New Password</h6>
                <div class="input-group input-group-lg w-75">
                    <span class="input-group-text" id="inputGroup-sizing-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-lock" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
                        </svg>
                    </span>
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <x-text-input hidden id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email', $request->email)" required autofocus autocomplete="username" />

                    <div class="form-floating">
                        <x-text-input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />


                <div class="input-group input-group-lg w-75 mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-lock" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
                        </svg>
                    </span>
                    <div class="form-floating">
                        <x-text-input id="confpass" class="form-control" type="password" name="password_confirmation"
                            required autocomplete="new-password" />
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />


                <button class="btn btn-info mt-5 bu p-3 ps-5 pe-5 mb-3" id="confirm" type="submit">Confirm</button>
            </form>
        </div>
    </div>

    {{-- <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">

            <x-text-input id="confpass" class="form-control"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-guest-layout>
