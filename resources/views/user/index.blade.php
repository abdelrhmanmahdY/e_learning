<x-app-layout>
    <x-slot name="header">

        <div class="d-flex justify-content-between ">
            <h2
                class="mb-0 d-flex justify-content-center align-items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            @if (session('success'))
                <div class="alert alert-success p-1 w-50 text-center" style="margin: 0;padding:0;
            ">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger p-1 w-50 text-center" style="margin: 0;padding:0;
            ">
                    {{ session('error') }}
                </div>
            @endif

            <button x-data='' x-on:click.prevent="$dispatch('open-modal',
        'user-create')" class="btn"
                style="background-color: #1a99aa;color:white">Create</button>
        </div>
        <x-modal name="user-create">
            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                        <td><select id="role" name="role[]" class="form-select" style="width:110px">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
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
                    <button class="btn btn-primary mb-3" type="sumbit">Create</button>
                </div>
            </form>

        </x-modal>
    </x-slot>
    <x-slot name="slot">
        <div class="container text-center mt-3" style="padding-block-end: 50px">
            <div class="row row-cols-4 ms-1 gap-5">
                @foreach ($users as $user)
                    <div class="card col rounded-circle p-0" style="width:150px ;height:150px;">
                        <button x-data=''
                            x-on:click.prevent="$dispatch('open-modal',
        '{{ $user->name }}-info')">

                            @if ($user->photo)
                                <img src="data:image/jpeg;base64,{{ $user->photo }}" alt="{{ $user->name }}'s Photo"
                                    style="width:150px;height:150px" class="card-img-top rounded-circle">
                            @else
                                <img src="{{ asset('../resources/img/user.avif') }}" style="width:150px;height:150px"
                                    class="card-img-top rounded-circle" />
                            @endif


                        </button>

                       
                        @php
        $color = '';
        if ($user->hasPenalty('2')) {
            $color = 'red';
        } elseif ($user->hasPenalty('1')) {
            $color = 'orange';
            if ($user->hasPenalty('2')) {
                $color = 'red'; 
            }
        }
    @endphp

    <style>
        .user-name-circle-{{ $user->id }}::before {
            background-color: {{ $color }};
        }
    </style>

    <b class="user-name-circle user-name-circle-{{ $user->id }}">{{ $user->name }}</b>
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
                                <td>{{ $user->roles->pluck('role_name')->join(', ') }}</td>


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
                        <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST"
                            style="display:inline;">
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
                    <x-modal name="{{ $user->name }}-edit" action="/users/{{ $user->id }}">
                        <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <x-table>
                                <x-slot name="tableHead">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>password</th>
                                    <th>Role</th>
                                    <th>image</th>
                                </x-slot>
                                <x-slot name="tableBody">
                                    <td><x-text-input class="form-control" id="name" name="name"
                                            value="{{ $user->name }}" class="form-control" required /></td>
                                    <td><x-text-input class="form-control" id="email" name="email"
                                            value="{{ $user->email }}" class="form-control" required /></td>
                                            <td><x-text-input class="form-control" id="password" name="password"
                                             class="form-control"  /></td>
                                    <td><select class="form-control" id="roles" name="role[]"
                                            style="width:120px; height:40px">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $role->role_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="file" id="photo" name="photo" class="form-control"
                                            accept="image/*">
                                    </td>
                                </x-slot>
                            </x-table>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning mb-3">Confirm</button>
                            </div>
                        </form>


                    </x-modal>
                    <x-modal name="{{ $user->name }}-penalties" class="w-full max-w-2xl mx-auto">
                    <form action="{{ route('user.destroyPenalty', ['user' => $user->id]) }}" method="post" class="p-10">
    @csrf
    <x-table>
        <x-slot name="tableHead">
            <tr>
                <th>Select</th>
                <th>Penalty Type</th>
                <th>Block's Time</th>
            </tr>
        </x-slot>
        <x-slot name="tableBody">
            @foreach ($user->penalties as $penalty)
            <tr>
                <td>
                    <input type="checkbox" name="penalty_ids[]" value="{{ $penalty->id }}" class="form-checkbox">
                </td>
                <td>{{ $penalty->penalty_type }}</td>
                <td>{{ $penalty->duration }}</td>
            </tr>
            @endforeach
        </x-slot>
    </x-table>
    <div class="d-flex justify-content-center mt-4">
        <button class="btn btn-danger mb-4">Delete</button>
    </div>
</form>

                        <div class="mt-4">
                            <form action=" {{ route('user.addPenalty', ['user' => $user->id]) }}"
                                method="post" id="penaltyAddForm">
                                @csrf
                                <select name="penalty_id" class="form-select" required>
                                    <option value="">Select Penalty</option>
                                   
                                        <option value="1">LOW
                                        </option>
                                        <option value="2">HIGH
                                        </option>
                                </select>




                        </div>
                        <div class="d-flex justify-content-center mt-4">
                        <button  class="btn btn-primary   mb-4">Add</button>


                        </div>

                        </form>
                       

                        <!-- <form action="" method="post" id="penaltyAddForm">
=======
<form action="asdf.php" method="post" id="penaltyAddForm">
>>>>>>> 34e838908fe73359cc16dac6f8c12982ccee67dd
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

</div> -->

                    </x-modal>
                </div>
            @endforeach


        </div>
    </div>



</x-slot>

</x-app-layout>
