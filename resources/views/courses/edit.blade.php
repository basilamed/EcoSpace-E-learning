<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    
    <style>
        .container {
            width: 50%;
            margin: 30px auto;
        }
        .card{
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
        }
        .card-header {
            font-size: 20px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .div-picture {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 60%;
            margin: 0 auto;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .row.mb-3 {
            margin-bottom: 15px;
        }

        .col-form-label.text-md-end {
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 8px;
        }

        .invalid-feedback {
            color: #dc3545;
        }

        .btn-primary.customBtn {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-primary.customBtn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        #description {
            resize: none;
            border-radius: 5px;
        }
        #dugmence {
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
        #dugmence:hover {
            background-color: #45a049;
        }
        .profileActions {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit course</div>

                    <div class="card-body">
                        <!-- Your success alert code here -->
                        <div class="div-picture">
                            <img src="{{ asset($course->image) }}" class="profile-picture" alt="Course Picture">
                        </div>
                        <form id="regForm" method="POST" action="{{ route('course.update', $course->id) }}"
                            novalidate enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <x-input-label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</x-input-label>

                                <div class="col-md-6">
                                    <x-text-input id="title" type="text" class="@error('title') is-invalid @enderror block mt-1 w-full"
                                        name="title" value="{{ $course->title }}" autocomplete="name" autofocus />

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="titleError"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <x-input-label for="description" class="col-md-4 col-form-label text-md-end">Description</x-input-label>

                                <div class="col-md-6">
                                    <textarea id="description" class="@error('description') is-invalid @enderror block mt-1 w-full"
                                        name="description" autofocus rows="5">{{ $course->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="descriptionError"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <x-input-label for="image" class="col-md-4 col-form-label text-md-end">Course Picture</x-input-label>

                                <div class="col-md-6">
                                    <x-file-input id="image" class="@error('image') is-invalid @enderror" name="image"
                                        accept="image/png, image/jpeg, image/jpg" />

                                    @error('image')
                                        <span class="invalid-feedback" role="alert" id="imageServerError">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <span class="invalid-feedback" role="alert" id="profilePictureError"></span>
                                    <small class="d-block text-center"><i>To not change the image leave blank</i></small>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="profileActions">
                                    <button type="submit" id="dugmence">
                                        Update course
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>