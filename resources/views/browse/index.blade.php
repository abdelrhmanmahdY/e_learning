<x-student-layout>
    <x-slot name="slot">
        <main>
            <section class="background" style="padding-block-end: 50px">
                <div class="container">
                    <div class="text-center mt-5 d-flex justify-content-center">
                        @if ($books->isEmpty())
                            <div class="d-flex justify-content-center">
                                <h3>No books yet</h3>
                            </div>
                        @else
                            <div class="row row-cols-4 browse gap-5" style="padding-inline-start:4em">
                                @foreach ($books as $book)
                                    <a href="{{ route('browse.show', $book->id) }}"
                                        class="col rounded book-shape d-flex flex-wrap justify-content-center"
                                        style="background-image:url(data:image/jpeg;base64,{{ base64_encode($book->photo) }});background-repeat: no-repeat; background-position: center;background-size: cover; width: 250px;height: 300px;">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </main>
    </x-slot>
    <x-slot name="script"></x-slot>
</x-student-layout>
