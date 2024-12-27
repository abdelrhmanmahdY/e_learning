<x-student-layout>
    <x-slot name="slot">
        <main class="show"
            style=" 
    background: rgb(255, 255, 255);
    background: linear-gradient(45deg, rgb(136, 190, 195) 40%, rgb(146, 255, 204) 100%);
">
            <section class="d-flex justify-content-around
         align-items-center container show">

                <div class="info   text-center">
                    <div class="aboutbook">
                        <h1 class="q"><q>{{ $book->title }}</q></h1>
                        <h2 class="mt-2">Author : {{ $book->author }}</h2>
                    </div>

                    <div class="buttons
                        mt-5">
                        @if ($hasPurchased)
                            <form action="{{ route('pdf.index') }}" method="get">
                                @csrf
                                <input type="hidden" name="pdf_url" value="{{ encrypt($book->pdf_url) }}">

                                <button class="btn " style="background-color:rgb(7, 219, 247);color:white;">Start
                                    Read</button>
                            </form>
                        @else
                            <form action="{{ route('browse.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ encrypt(Auth::user()->id) }}">
                                <input type="hidden" name="book_id" value="{{ encrypt($book->id) }}">


                                <x-text-input type="date" id="date" name="borrow_date" />

                                <<<<<<< HEAD @if ($book->availability)
                                    <button class="borrow btn " name='submit' value="borrow"
                                        onclick="return validateDate()" value="borrow"
                                        style="background-color:rgb(7, 219, 247);color:white">Borrow</button>
                                    <br>
                                    <output class="mb-1" name="price" for="date"></output>
                                    <br>
                                    @if ($book->purchase_price > 1)
                                        <button class="purchies btn" name="submit" value="purchies"
                                            style="background-color:rgb(7, 219, 247);color:white">Purchies</button>
                                    @endif
                                @else
                                    <button class="reserve btn" value="reserve" name="submit"
                                        style="background-color:rgb(7, 219, 247);color:white">Reserve</button>
                        @endif
                        </form>
                        =======

                        <button class="borrow btn " onclick="return validateDate()" value="borrow"
                            style="background-color:rgb(7, 219, 247);color:white">Borrow</button>
                        <br>
                        <output class="mb-1" name="price" for="date"></output>
                        <br>

                        </form>
                        >>>>>>> e2e3a5740635800e4e49f6acba4046e72c5df78c
                        @endif
                    </div>
                </div>
                <div>
                    <div class="bookshape"
                        style="background-image:url(data:image/jpeg;base64,{{ base64_encode($book->photo) }});background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
} ">
                    </div>
                    <h3 class="mt-2 text-center">Price : {{ $book->purchase_price }}$</h3>

                </div>
            </section>
        </main>
    </x-slot>
    <x-slot name="script">
        <script>
            let days = document.getElementById('date');
            let price = document.querySelector('output[name="price"]');
            days.addEventListener('input', function() {
                let selectedDate = new Date(days.value);
                let today = new Date();

                let diff = selectedDate.getTime() - today.getTime();
                let daysDiff = Math.ceil(diff / (1000 * 3600 * 24));
                if (daysDiff == 7) {
                    price.innerText = 'Price : ' + 10 + '$';
                } else if (daysDiff < 7) {
                    days.value = '';
                    alert("Please Choose More Than 7 Days")

                } else if (daysDiff >= 7 && daysDiff <= 30) {
                    price.innerText = 'Price : ' + 20 + '$';
                } else if (daysDiff >= 30) {
                    price.innerText = 'Price : ' + 30 + '$';
                }

            });

            function validateDate() {
                const dateInput = document.getElementById('date');
                if (!dateInput.value) {
                    alert('Please select a date before borrowing.');
                    return false; // Prevent form submission
                }
                return true; // Allow form submission
            }
        </script>
    </x-slot>
</x-student-layout>
<x-student-layout>
    <x-slot name="slot">
        <main class="show"
            style=" 
    background: rgb(255, 255, 255);
    background: linear-gradient(90deg, rgba(255, 255, 255, 1) 40%, rgb(236 110 88) 100%);
">
            <section class="d-flex justify-content-around
         align-items-center container show">

                <div class="info   text-center">
                    <div class="aboutbook">
                        <h1 class="q"><q>{{ $book->title }}</q></h1>
                        <h2 class="mt-2">Author : {{ $book->author }}</h2>
                    </div>

                    <div class="buttons
                        mt-5">
                        @if ($book->availability)
                            <form action="" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ encrypt(Auth::user()->id) }}">
                                <input type="hidden" name="book_id" value="{{ encrypt($book->id) }}">

                                <x-text-input type="date" id="date" name="date" />

                                @if ($book->availability)
                                    <button class="borrow btn " name='submit' value="borrow"
                                        onclick="return validateDate()" value="borrow"
                                        style="background-color:rgb(7, 219, 247);color:white">Borrow</button>
                                    <br>
                                    <output class="mb-1" name="price" for="date"></output>
                                    <br>
                                    @if ($book->purchase_price > 1)
                                        <button class="purchies btn" name="submit" value="purchies"
                                            style="background-color:rgb(7, 219, 247);color:white">Purchies</button>
                                    @endif
                                @else
                                    <button class="reserve btn" value="reserve" name="submit"
                                        style="background-color:rgb(7, 219, 247);color:white">Reserve</button>
                                @endif
                            </form>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="bookshape"
                        style="background-image:url(data:image/jpeg;base64,{{ base64_encode($book->photo) }});background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
} ">
                    </div>
                    <h3 class="mt-2 text-center">Price : {{ $book->purchase_price }}$</h3>

                </div>
            </section>
        </main>
    </x-slot>
    <x-slot name="script">
        <script>
            let days = document.getElementById('date');
            let price = document.querySelector('output[name="price"]');
            days.addEventListener('input', function() {
                let selectedDate = new Date(days.value);
                let today = new Date();

                let diff = selectedDate.getTime() - today.getTime();
                let daysDiff = Math.ceil(diff / (1000 * 3600 * 24));
                if (daysDiff == 7) {
                    price.innerText = 'Price : ' + 10 + '$';
                } else if (daysDiff < 7) {
                    days.value = '';
                    alert("Please Choose More Than 7 Days")

                } else if (daysDiff >= 7 && daysDiff <= 30) {
                    price.innerText = 'Price : ' + 20 + '$';
                } else if (daysDiff >= 30) {
                    price.innerText = 'Price : ' + 30 + '$';
                }

            });

            function validateDate() {
                const dateInput = document.getElementById('date');
                if (!dateInput.value) {
                    alert('Please select a date before borrowing.');
                    return false; // Prevent form submission
                }
                return true; // Allow form submission
            }
        </script>
    </x-slot>
</x-student-layout>
