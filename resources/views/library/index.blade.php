<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between ">
            <h2
                class="mb-0 d-flex justify-content-center align-items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Libraries') }}
            </h2>
            <button class="btn btn-primary">Create</button>
        </div>
    </x-slot>
    <x-slot name="slot">
        <div class="container text-center mt-3 d-flex justify-content-center">
            <div class="row row-cols-4  gap-3">
                <button x-data='' x-on:click.prevent="$dispatch('open-modal',
        'user-info')">
                    <div class="card col" style="padding-inline:0;width: 18rem;">
                        <img src="../resources/img/library.jpeg" class="card-img-top  " alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                </button>
            </div>
        </div>
        <x-modal name="user-info">
            <x-table>
                <x-slot name="tableHead">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>

                </x-slot>
                <x-slot name="tableBody">
                    <td>Messi</td>
                    <td>Messi.com</td>
                    <td>Player</td>
                </x-slot></x-table>

            <div class="d-flex justify-content-center">
                <button class="btn btn-danger mb-4" x-data=''
                    x-on:click.prevent="() => { $dispatch('close'); $dispatch('open-modal', 'user-deletion'); }">Delete</button>
                <button class="btn btn-warning ms-3 mb-4"
                    x-on:click.prevent="()=> {  $dispatch('close'); $dispatch('open-modal','user-edit');}">Edit</button>
            </div>

        </x-modal>

        <x-modal name="user-deletion">
            <form method="post" class="p-6">
                @csrf


                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete This User?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once This User is deleted, all of its resources and data will be permanently deleted.') }}
                </p>



                <div class="mt-6 flex justify-center">
                    <x-secondary-button x-on:click.prevent="()=>$dispatch('close');$dispatch('open-modal','user-info')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Delete User') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
        <x-modal name="user-edit">
            <form action="" method="post">
                @csrf
                <x-table>
                    <x-slot name="tableHead">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>

                    </x-slot>
                    <x-slot name="tableBody">
                        <td><x-text-input style="border: none" /></td>
                        <td><x-text-input style="border: none" /></td>
                        <td><x-text-input style="border: none" /></td>
                    </x-slot></x-table>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-warning mb-3">Confirm</button>
                </div>
            </form>
        </x-modal>
    </x-slot>
</x-app-layout>
