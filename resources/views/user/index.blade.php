<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between ">
            <h2
                class="mb-0 d-flex justify-content-center align-items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            <button x-data='' x-on:click.prevent="$dispatch('open-modal',
        'user-create')"
                class="btn
                btn-primary">Create</button>
        </div>
        <x-modal name="user-create">
            <form action="" method="post" enctype="multipart/form-data">
                <x-table>
                    <x-slot name="tableHead">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Photo</th>

                    </x-slot>
                    <x-slot name="tableBody">
                        <td> <x-text-input type="text" maxlength="12" autocomplete="name" name="name"
                                class="form-control name" placeholder="UserName" id="name" autofocus required />
                        </td>
                        <td> <x-text-input id="email" class="form-control email" type="email" name="email"
                                required autocomplete="username" />
                        </td>
                        <td> <x-text-input id="password" class="form-control password" type="password" name="password"
                                required autocomplete="new-password" />
                        </td>
                        <td><select name="role" class="form-select" style="width:110px">
                                <option selected value="student">Student</option>
                                <option value="admin">Admin</option>
                            </select>
                        </td>
                        <td>
                            <x-text-input style="width:110px" id="photo" name="photo" type="file"
                                class="form-control" accept="image/*" />

                        </td>


                    </x-slot>
                </x-table>

                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary mb-3">Create</button>
                </div>
            </form>

        </x-modal>
    </x-slot>
    <x-slot name="slot">
        <div class="container text-center mt-3">
            <div class="row row-cols-4 ms-1 gap-5">
                @foreach ($users as $user)
                    <div class="card col rounded-circle p-0" style="width:150px ;height:150px;">
                        <button x-data=''
                            x-on:click.prevent="$dispatch('open-modal',
        '{{ $user->name }}-info')">
                            @if ($user->photo)
                                <img src="storage/{{ $user->photo }}" style="width:150px"
                                    class="card-img-top rounded-circle" alt="...">
                            @else
                                <div style="width:150px; height:150px" class="card-img-top rounded-circle"
                                    alt="..."></div>
                            @endif


                        </button>

                        @foreach ($user->penalties as $penalty)
                            @if ($penalty->severity_level === 'HIGH')
                                <style>
                                    .user-name-circle::before {
                                        background-color: red;
                                    }
                                </style>
                            @break

                        @elseif ($penalty->severity_level === 'LOW')
                            <style>
                                .user-name-circle::before {
                                    background-color: orange;
                                }
                            </style>
                        @endif
                    @endforeach
                    <b class="user-name-circle">{{ $user->name }}</b>
                    <x-modal name="{{ $user->name }}-info">
                        <x-table>
                            <x-slot name="tableHead">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>


                            </x-slot>
                            <x-slot name="tableBody">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>


                            </x-slot></x-table>

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-danger mb-4" x-data=''
                                x-on:click.prevent="() => { $dispatch('close'); $dispatch('open-modal', '{{ $user->name }}-deletion'); }">Delete</button>
                            <button class="btn btn-warning ms-3 mb-4"
                                x-on:click.prevent="()=> {  $dispatch('close'); $dispatch('open-modal','{{ $user->name }}-edit');}">Edit</button>
                            <button class="btn btn-success ms-3 mb-4" x-data=''
                                x-on:click.prevent="() => { $dispatch('close'); $dispatch('open-modal', '{{ $user->name }}-penalties'); }">Penalty</button>
                        </div>

                    </x-modal>

                    <x-modal name="{{ $user->name }}-deletion">
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
                                    x-on:click.prevent="()=>$dispatch('close');$dispatch('open-modal','{{ $user->name }}-info')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Delete User') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                    <x-modal name="{{ $user->name }}-edit">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <x-table>
                                <x-slot name="tableHead">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>

                                </x-slot>
                                <x-slot name="tableBody">
                                    <td><x-text-input class="form-control" id="name" name="name"
                                            value="{{ $user->name }}" style="border: none" required /></td>
                                    <td><x-text-input class="form-control" id="email" name="email"
                                            value="{{ $user->email }}" style="border: none" required /></td>
                                    <td><select name="role" class="form-select"
                                            style="width:196px; height:40px">
                                            <option selected value="student">Student</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </td>
                                </x-slot></x-table>

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning mb-3">Confirm</button>
                            </div>
                        </form>
                    </x-modal>
                    <x-modal name="{{ $user->name }}-penalties">
                        <form action="" method="post" id="penaltyDeleteForm">
                            @csrf
                            @method('DELETE')
                            <x-table>
                                <x-slot name="tableHead">
                                    <th>Select</th>
                                    <th>Penalty Type</th>
                                    <th>Block's Time</th>
                                </x-slot>
                                <x-slot name="tableBody">
                                    @foreach ($user->penalties as $penalty)
                                        <td>
                                            <input type="checkbox" name="penalty_ids[]"
                                                value="{{ $penalty->id }}" class="form-checkbox">
                                        </td>
                                        <td>{{ $penalty->penalty_type }}</td>
                                        <td>{{ $penalty->duration }}</td>
                                    @endforeach
                                </x-slot>
                            </x-table>

                        </form>
                        <div class="mt-4">
                            <form action="" method="post" id="penaltyAddForm">
                                @csrf
                                <select id="penalty-dropdown"
                                    class=" form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                    <option value="">Select a penalty</option>
                                    @foreach ($user->penalties->groupBy('duration') as $duration => $penalties)
                                        <optgroup label="{{ $duration }}">
                                            @foreach ($penalties as $penalty)
                                                <option value="{{ $penalty->id }}">{{ $penalty->penalty_type }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>


                            </form>

                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button form="penaltyAddForm" class="btn btn-primary   mb-4">Add</button>
                            <button form="penaltyDeleteForm" class="btn btn-danger ms-3 mb-4 ">Delete</button>

                        </div>



                    </x-modal>
                </div>
            @endforeach


        </div>
    </div>



</x-slot>

</x-app-layout>
