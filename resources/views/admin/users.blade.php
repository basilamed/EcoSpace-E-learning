<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administration') }}
        </h2>
    </x-slot>
    <style>
    /* Styling for the main container */
    .container-fluid {
        margin: 20px;
    }

    /* Styling for the tables */
    table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            padding: 10px;
            text-align: center;
            
        }

        th {
            background-color: #1dc41d;
            color: #fff;

        }

        tr:nth-child(even) {
            background-color: #e5fbe5;
        }

    /* Styling for the card */
    .card {
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 20px;
        background-color: #f8f8f8;
    }

    /* Styling for the form elements */
    .form-group {
        margin-bottom: 15px;
    }

    /* Styling for the buttons */
    button {
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: #fff;
    }

    .btn-primary {
        background-color: #1dc41d;
        margin: 2px;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    /* Styling for alerts */
    .alert {
        padding: 8px;
        margin: 10px auto;
        border-radius: 4px;
        width: 80%;
    }

    .alert-info {
        background-color: #cce5ff;
    }

    .alert-danger {
        background-color: #f8d7da;
    }

    .alert-success {
        background-color: #d4edda;
    }

    /* Styling for the notification cards */
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin: 10px;
        width: 40%;
        margin: 0 auto;
    }
    .card-header {
        width: 100%;
        text-align: center;
    }
    .notification-container {
        margin: 20px auto;
        width: 40%;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        background-color: #f8f8f8;
    }
    .obavestenje {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin: 10px;
        width: 100%;
        margin: 5px auto;
        background-color: #e5fbe5;
    }

</style>
    <div class="container-fluid px-4">
        @if (session('approved'))
        <div class="alert alert-info myAlert" role="alert">
            {{ session('approved') }}
        </div>
        @endif
        @if (session('rejected'))
        <div class="alert alert-danger myAlert" role="alert">
            {{ session('rejected') }}
        </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Teachers to approve</h4>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                @if(count($users) == 0)
                            <div class="alert alert-danger">
                                {{ Session::get('message') }}
                            </div>
                @endif
                @if (count($users) > 0)   
                <tr>
                    <th>Name:</th>
                    <th>Surname:</th>
                    <th>Username:</th>
                    <th>Email:</th>
                    <th>Role:</th>
                    <th>Approve:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->surname}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td><form action="{{ route('users.approve', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-primary">Approve</button>
                    </form>
                    <form action="{{ route('users.reject', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Reject</button>
        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
            </table>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>All Users</h4>
                </div>
            </div>
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name:</th>
                    <th>Surname:</th>
                    <th>Username:</th>
                    <th>Email:</th>
                    <th>Role:</th>
                    <th>Delete Account:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allUsers as $user)
                @if($user->role != 'admin')
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->surname}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" id="delete-post-form-{{$user->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="confirmDelete('delete-post-form-{{$user->id}}')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
            </table>
        </div>
        <div class="notification-container">
            
        <form action="{{ url('/admin-notification') }}" method="POST">
        @csrf

        <div>
            <div>
                <div class="card-header">
                    <h1>Add Notification</h1>
                </div>
                <div class="form-group row">
                    <x-input-label for="title" class="col-md-4 col-form-label">Notification Title</x-input-label>

                    <x-text-input id="title"
                        type="text"
                        class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }} block mt-1 w-full"
                        name="title"
                        value="{{ old('title') }}"
                        autocomplete="title" autofocus></x-text-input>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group row">
                    <x-input-label for="description" class="col-md-4 col-form-label">Notification Description</x-input-label>

                    <x-textarea-input id="description"
                        type="text"
                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }} block mt-1 w-full"
                        name="description"
                        value="{{ old('description') }}"
                        autocomplete="description" autofocus></x-textarea-input>

                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row pt-4">
                        <button class="btn btn-primary">Add New Notification</button>
                </div>

            </div>
        </div>
        </form>
        </div>
        <div class="notification-container">

                <div class="row">
                    <h1>All Your Notifications</h1>
                </div>
                @foreach($notifications as $notification)
                <a href="{{ route('notification.edit', $notification->id) }}" style="text-decoration: none; color: black;">
                    <div class="obavestenje">
                            <h3>{{$notification->title}}</h3>
                    </div>
                </a>
                @endforeach
        </div>
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>