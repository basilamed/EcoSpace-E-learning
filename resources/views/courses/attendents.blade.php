<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Attendents') }}
        </h2>
    </x-slot>
    <style>
        /* Custom CSS styles go here */
        .container-fluid {
            padding: 20px;
            width: 70%;
            margin: 0 auto;
        }

        .card-header {
            padding: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .btn {
            padding: 5px 10px;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #4ae44a;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #1dc41d;
        }
        .alert{
            margin-top: 20px;
            color: #f44336;
            justify-content: center;
        }
    </style>
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4>All Users that attend this course</h4>
            </div>
        </div>
        <table class="table table-bordered">
            @if(Session::has('message'))
                            <div class="alert alert-danger">
                                {{ Session::get('message') }}
                            </div>
            @else
            <thead>
                <tr>
                    <th>Name:</th>
                    <th>Surname:</th>
                    <th>Username:</th>
                    <th>Email:</th>
                    <th>Results on a test:</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($attendants as $attendant)
                <tr>
                    <td>{{$attendant->user->name}}</td>
                    <td>{{$attendant->user->surname}}</td>
                    <td>{{$attendant->user->username}}</td>
                    <td>{{$attendant->user->email}}</td>
                    <td><a class="btn btn-primary" href="/course/{{$course->id}}/{{$attendant->user->id}}/r">Results</a></td>
                </tr>
            @endforeach
            </tbody>
            @endif
        </table>
    </div>

</div>
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>