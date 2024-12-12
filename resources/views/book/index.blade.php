<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between ">
            <h2
                class="mb-0 d-flex justify-content-center align-items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Books') }}
            </h2>
            <button x-data='' x-on:click.prevent="$dispatch('open-modal',
        'book-create')"
                class="btn btn-primary">Create</button>
        </div>
        <x-modal name="book-create">
            <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-table>
                    <x-slot name="tableHead">
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Pdf</th>
                        <th>Price</th>

                    </x-slot>
                    <x-slot name="tableBody">
                        <td> <x-text-input type="text" maxlength="20" autocomplete="title" name="title"
                                class="form-control name" id="title" autofocus required />
                        </td>
                        <td> <x-text-input id="author" class="form-control " type="text" name="author" required
                                autocomplete="author" />
                        </td>
                        <td> <x-text-input id="category" class="form-control " type="text" name="category" required
                                autocomplete="category" />
                        </td>
                        <td><x-text-input type="number" name="stock" id="stock" class="form-control"
                                autocomplete="stock" required />
                        </td>
                        <td>
                            <x-text-input style="width:110px" id="pdf" name="pdf" type="file"
                                class="form-control" accept=".pdf" />

                        </td>
                        <td>
                            <x-text-input type="number" name="purchase_price" id="purchase_price"
                                class="form-control" />

                        </td>


                    </x-slot>
                </x-table>

                <x-input-error class="mt-2" :messages="$errors->get('pdf')" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                <x-input-error :messages="$errors->get('author')" class="mt-2" />
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                <x-input-error :messages="$errors->get('purchase_price')" class="mt-2" />
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary mb-3">Create</button>
                </div>
            </form>

        </x-modal>
    </x-slot>
    <x-slot name='slot'>
        <div class="container text-center mt-3 d-flex justify-content-center">
            <div class="row  ms-5  gap-5">
                @foreach ($books as $book)
                    <button x-data=''
                        x-on:click.prevent="$dispatch('open-modal',
                '{{ $book->title }}-info')"
                        class=" col rounded book-shape d-flex flex-wrapa justify-content-center">
                        <strong>{{ $book->title }}</strong>
                    </button>
                    <x-modal name="{{ $book->title }}-info">

                        <x-table>
                            <x-slot name="tableHead">
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Pdf</th>
                                <th>Price</th>

                            </x-slot>
                            <x-slot name="tableBody">
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->stock }}</td>
                                <td>{{ $book->pdf_url ? 'Yes' : 'No' }}</td>
                                <td>{{ $book->Price }}</td>
                            </x-slot>
                        </x-table>

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-danger mb-4" x-data=''
                                x-on:click.prevent="() => { $dispatch('close'); $dispatch('open-modal', '{{ $book->title }}-deletion'); }">Delete</button>
                            <button class="btn btn-warning ms-3 mb-4"
                                x-on:click.prevent="()=> {  $dispatch('close'); $dispatch('open-modal','{{ $book->title }}-edit');}">Edit</button>
                        </div>

                    </x-modal>

                    <x-modal name="{{ $book->title }}-deletion">
                        <form method="post" class="p-6">
                            @csrf
                            @method('DELETE')

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Are you sure you want to delete This User?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Once This User is deleted, all of its resources and data will be permanently deleted.') }}
                            </p>



                            <div class="mt-6 flex justify-center">
                                <x-secondary-button
                                    x-on:click.prevent="()=>$dispatch('close');$dispatch('open-modal','{{ $book->title }}-info')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Delete User') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                    <x-modal name="{{ $book->title }}-edit">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <x-table>
                                <x-slot name="tableHead">
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Pdf</th>
                                    <th>Price</th>

                                </x-slot>
                                <x-slot name="tableBody">
                                    <td><x-text-input style="border: none" class="form-control" name="title"
                                            maxlength="20" /></td>
                                    <td><x-text-input style="border: none" class="form-control" name="author" /></td>
                                    <td><x-text-input style="border: none" class="form-control" name="category" /></td>
                                    <td><x-text-input type="number" class="form-control" style="border: none"
                                            name="stock" /></td>
                                    <td><x-text-input type='file' class="form-control" accept=".pdf"
                                            style="border: none ;width:108px" name="pdf" /></td>
                                    <td><x-text-input type="number" class="form-control" style="border: none"
                                            name="purchase_price" /></td>
                                </x-slot></x-table>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                            <x-input-error :messages="$errors->get('categoryi')" class="mt-2" />

                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning mb-3">Confirm</button>
                            </div>
                        </form>
                    </x-modal>
                @endforeach
            </div>
        </div>

    </x-slot>
</x-app-layout>
