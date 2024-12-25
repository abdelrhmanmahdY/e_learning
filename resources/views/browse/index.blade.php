<x-student-layout>
    <x-slot name="slot">
        <main>
            <section class="background" style="padding-block-end: 50px">
                <div class="container">
                    <div class=" text-center mt-5 d-flex justify-content-center">
                        <div class="row row-cols-4   gap-5" style="padding-inline-start:4em">
                            @foreach ($books as $book)
                                <a href="{{ route('browse.show', $book->id) }}     "
                                    class=" col rounded book-shape d-flex flex-wrap justify-content-center  "
                                    style="background-img:{{}};   width: 
                               250px;
   height: 300px;">
                                    df
                                </a>
                            @endforeach
                        </div>

            </section>
        </main>
    </x-slot>
    <x-slot name="script"></x-slot>
</x-student-layout>
