<x-student-layout>
    <x-slot name="slot">
        <main>

        <div class="rounded-lg w-full h-96" style="padding-left: 28px; padding-right: 28px; padding-top: 15px;">
        <div class="rounded-lg w-full h-96 bg-cover bg-center bg-no-repeat"
                                    style="background-image:url('{{ asset('img/library.jpeg') }}');background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 400px;
    opacity: 0.75;   
">

                                </div>
                                </div>


                                <div class="flex justify-center gap-5 items-top px-6 border-b">

            <section class="">
                <div class="p-4 border rounded-lg shadow-lg">
                    <h1 class="" style="text-align: center; font-weight: 400; font-style: normal; font-size: 1.875rem; line-height: 2.25rem; padding: 24px;">Top Borrowed Books</h1>
                    <div class="container text-center d-flex justify-content-center">
                        <div class="row row-cols-3 gap-3">
                            @foreach ($mostBorrowedBooks as $mostborrow)
                                <div class=" col rounded book-shape-custom d-flex flex-wrap justify-content-center  "
                                    style="background-image:url(data:image/jpeg;base64,{{ base64_encode($mostborrow->photo) }});background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
">

                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </section>
            <section class="">
                <div class="p-4 border rounded-lg shadow-lg">
                    <h1 class="" style="text-align: center; font-weight: 400; font-style: normal; font-size: 1.875rem; line-height: 2.25rem; padding: 24px; ">Top Purchased Books</h1>
                    <div class="container text-center d-flex justify-content-center">
                        <div class="row row-cols-3  gap-3">
                            @foreach ($mostPurchasedBooks as $mostpurchase)
                                <div class=" col rounded book-shape-custom d-flex flex-wrap justify-content-center  "
                                    style="background-image:url(data:image/jpeg;base64,{{ base64_encode($mostpurchase->photo) }});background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
">

                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </section>
            <section class="">
                <div class="p-4 border rounded-lg shadow-lg">
                    <h1 class="" style="text-align: center; font-weight: 400; font-style: normal; font-size: 1.875rem; line-height: 2.25rem; padding: 24px;">New Books</h1>
                    <div class="container text-center d-flex justify-content-center">
                        <div class="row  row-cols-3   gap-3">
                            @foreach ($newestBooks as $newbook)
                                <div class=" col rounded book-shape-custom d-flex flex-wrap justify-content-center  "
                                    style="background-image:url(data:image/jpeg;base64,{{ base64_encode($newbook->photo) }});background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
">

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </section>
        </div>
        </main>
    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-student-layout>
