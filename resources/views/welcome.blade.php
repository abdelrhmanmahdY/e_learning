<x-student-layout>
    <x-slot name="slot">
        <main>
            <section class="background">
                <div class="most container">
                    <h1 class=" ms-3 h1borrowed">Most Borrowed Books</h1>
                    <div class="container text-center mt-5 d-flex justify-content-center">
                        <div class="row analize row-cols-3 gap-5">
                            @foreach ($mostBorrowedBooks as $mostborrow)
                                <div class=" col rounded book-shape d-flex flex-wrap justify-content-center  "
                                    style="background-img: ;   ">
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </section>
            <section class="rbackground">
                <div class="most container">
                    <h1 class="ms-3 h1purchesed">Most Purchesed Books</h1>
                    <div class="container text-center mt-5 d-flex justify-content-center">
                        <div class="row row-cols-3 analize  gap-5">
                            @foreach ($mostPurchasedBooks as $mostpurchase)
                                <div class=" col rounded book-shape d-flex flex-wrap justify-content-center  "
                                    style="background-img:;  ">
                                    df
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </section>
            <section class="background">
                <div class="most container">
                    <h1 class="ms-3 h1purchesed">New Books</h1>
                    <div class="container text-center mt-5 d-flex justify-content-center">
                        <div class="row analize  row-cols-3   gap-5">
                            @foreach ($newestBooks as $newbook)
                                <div class=" col rounded book-shape d-flex flex-wrap justify-content-center  "
                                    style="background-img:;">
                                    df
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </section>
        </main>
    </x-slot>
    <x-slot name="script"></x-slot>
</x-student-layout>
