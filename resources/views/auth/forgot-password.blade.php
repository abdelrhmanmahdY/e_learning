<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container hi row justify-content-center">
        <div class="formain form rounded-4 p-1 pt-2 col-12 col-md-8 col-lg-6 col-xl-4">
            <img src="{{ asset('../resources/img/SUT_Logo-removebg-preview.png') }}" alt="Sut logo" width="140px">

            <form class="d-flex flex-column align-items-center" id="loginform" action="{{ route('password.email') }}"
                method="post">
                @csrf
                <h1 class="text-center mt-4 fw-bold loginText">Forget Password</h1>

                <!-- Input Field -->
                <div class="input-group flex-nowrap w-75 mt-5">
                    <span class="input-group-text" id="inputGroup-sizing-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                            class="bi bi-envelope" viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                        </svg>
                    </span>
                    <div class="form-floating">

                        <x-text-input type="email" name="email" class="form-control email"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                            placeholder="Email" id="email" required autofocus :value="old('email')" />
                        <x-input-label for="email" :value="__('Email')" />
                    </div>

                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />


                <!-- Submit Button -->
                <button class="btn btn-info mt-5 bu p-3 ps-5 pe-5" type="submit">Check</button>


            </form>
        </div>
    </div>

</x-guest-layout>
