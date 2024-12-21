<x-student-layout>
    <x-slot name="slot">
        <main
            style=" background: rgb(255, 255, 255);
    background: linear-gradient(90deg, rgba(255, 255, 255, 1) 57%, rgba(139, 200, 229, 1) 100%);
">
            <section class="d-flex justify-content-around
         align-items-center container">

                <div class="info   text-center" style="width:800px">
                    <div class="aboutbook">
                        <h1><q>{{ $book->title }}</q></h1>
                        <h2 class="mt-2">Author : {{ $book->author }}</h2>
                        <h3 class="mt-2">Price : {{ $book->purchase_price }}$</h3>
                    </div>

                    <div class="buttons
                        mt-5">
                        @if ($book->availability)
                            <form action="" method="post">
                                @csrf
                                <x-input-label class='time' for="date">TimeLine : </x-input-label><br>
                                <x-text-input type="date" class="mb-3" id="date" name="date" />
                                <br>
                                <output class="mb-1" name="price" for="date"></output>
                                <br>

                                <button class="borrow btn btn-primary " onclick="return validateDate()"
                                    value="borrow">Borrow</button>
                                @if ($book->purchase_price > 1)
                                    <button class="purchies btn  btn-primary" value="purchies">Purchies</button>
                                @endif
                            @else
                                <button class="reserve btn  btn-primary" value="reserve">Reserve</button>
                        @endif
                        </form>
                    </div>
                </div>
                <div>
                    <div class="bookshape" style="background-image: {{}}"></div>
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
