<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 30px auto;
            width: 80%;
            max-width: 600px;
        }
        .card{
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-control-file {
            padding: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .invalid-feedback {
            color: red;
            display: block;
        }
        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            margin: 8px 0;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
        .profileActions {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>
    <div class="container">
    
   <form action="/course-content/{{$course->id}}" enctype="multipart/form-data" method="POST">
   @csrf

    <div class="row">
        <div class="card">

            <div class="row">
                <h1><b>Add Content</b></h1>
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label">Content Title</label>

                <input id="title"
                    type="text"
                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                    name="title"
                    value="{{ old('title') }}"
                    autocomplete="title" autofocus>

                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <label for="file" class="col-md-4 col-form-label">Content File</label>
                <input type="file" class="form-control-file" id="file" name="file"
                @if ($errors->has('file'))
                    <strong>{{ $errors->first('file') }}</strong>
                @endif
            </div>
            <div class="row mb-0">
                <div class="profileActions">
                    <button>Add New Content</button>
                </div>
            </div>

        </div>
    </div>
    </form>
    </div>
    
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>