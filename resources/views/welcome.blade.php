<x-student-layout>
    <x-slot name="slot">
        <main>
            <section class="background">
            @if (session('success'))
                <strong class="text-center mb-2 alert alert-danger container d-block">you have panelty</strong>
                @endif
                <div class="most container">
                    <h1 class=" ms-3 h1borrowed">Most Borrowed Books</h1>
                    <div class="container text-center mt-5 d-flex justify-content-center">
                        <div class="row analize row-cols-3 gap-5">
                            @forelse ($mostBorrowedBooks as $mostborrow)
                                <div class=" col rounded book-shape d-flex flex-wrap justify-content-center  "
                                    style="background-image:url(data:image/jpeg;base64,{{ base64_encode($mostborrow->photo) }});background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
">
                               </div>
                            @empty
                                <p class="col-12">You haven't borrowed any books yet</p>
                            @endforelse
                            
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="rbackground">
                <div class="most container">
                    <h1 class="ms-3 h1purchesed">Most Purchased Books</h1>
                    <div class="container text-center mt-5 d-flex justify-content-center">
                        <div class="row row-cols-3 analize  gap-5">
                            @forelse ($mostPurchasedBooks as $mostpurchase)
                                <div class=" col rounded book-shape d-flex flex-wrap justify-content-center  "
                                style="background-image:url(data:image/jpeg;base64,{{ base64_encode($mostpurchase->photo) }});background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
">
                                </div>
                            @empty
                                <p class="col-12">You haven't purchased any books yet</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="background">
                <div class="most container">
                    <h1 class="ms-3 h1purchesed">New Books</h1>
                    <div class="container text-center mt-5 d-flex justify-content-center">
                        <div class="row analize  row-cols-3   gap-5">
                            @forelse ($newestBooks as $newbook)
                                <div class=" col rounded book-shape d-flex flex-wrap justify-content-center  "
                                    style="background-image:url(data:image/jpeg;base64,{{ base64_encode($newbook->photo) }});background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
">
                                </div>
                            @empty
                                <p class="col-12">Nothing new these days</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-student-layout>