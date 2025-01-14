<x-guest-layout>
    
    <div class="container hi row justify-content-center">
        <div class="main form rounded-4 p-1 pt-2 col-12 col-md-8 col-lg-6 col-xl-4">
            <img src="{{ asset('../resources/img/SUT_Logo-removebg-preview.png') }}" alt="Sut logo" width="200px">

            <form class="d-flex flex-column align-items-center" id="loginform" action="{{ route('login') }}" method="post">
                @csrf


                <h3 class="text-center mt-5 heading fw-bold loginText">Log In</h3>

               
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

               
                <div class="checkbox mb-3 forgotPass">
                    <label for="remember_me" class="form-label" id="rem">
                        <input type="checkbox" name="remember" id="remember_me" class="form-check-input" />
                        {{ __('Remember me') }} </label>
                </div>

                
                <p class="forgotPass">
                    @if (Route::has('password.request'))
                        <a id="forgotPasswordLink" href="{{ route('password.request') }}"
                            class=" forget link-offset-2 link-underline-opacity-0">
                            {{ __('Forgot your password?') }}

                        </a>
                    @endif
                </p>

            
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
               
                <span class="signupspace">
                    No account?
                    <a href="{{ route('register') }}"
                        class=" signUp link-opacity-50 link-offset-2 link-underline-opacity-0">
                        Create one!
                    </a>
                </span>
            </form>
        </div>
    </div>
</x-guest-layout>
