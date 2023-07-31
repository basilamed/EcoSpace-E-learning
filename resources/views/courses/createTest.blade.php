<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create test') }}
        </h2>
    </x-slot>
    <style>
    /* Center the container */
    .container {
        max-width: 50%;
        padding: 20px 40px;
        margin: 20px auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    /* Style the form heading */
    h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
    }

    /* Style the form labels */
    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Style the form inputs */
    .form-control {
        margin-bottom: 10px;
    }

    /* Style the select dropdowns */
    select.form-control {
        width: 100%;
    }

    /* Style the "Add Question" button */
    .finish-dugme {
        text-align: center;
        margin-top: 20px;
    }

    .finish-dugme .btn-primary {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .finish-dugme .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Style the "Finish Test" button */
    .btn-primary , .btn-finish{
        display: block;
        width: 100%;
        padding: 10px 20px;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #a7288a;
    }

    .btn-finish {
        background-color: #28a745;
    }

    .btn-primary:hover {
        background-color: #691957;
    }

    .btn-finish:hover {
        background-color: #1e7e34;
    }

    #level , #correct{
        border-radius: 5px;
    }
</style>

    <div class="container">
    
        <form action="/course/{{$course->id}}/create-test" enctype="multipart/form-data" method="POST">
        @csrf

            <div class="row">
                <div class="col-8 offset-2">

                    <div class="row">
                        <h1>Create Test For This Course</h1>
                    </div>
                    <div class="form-group row">
                        <x-input-label for="question" >Question</x-input-label>

                        <x-text-input id="question"
                            type="text"
                            class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }} block mt-1 w-full"
                            name="question"
                            value="{{ old('question') }}"
                            autocomplete="question" autofocus></x-text-input>

                        @if ($errors->has('question'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('question') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <x-input-label for="answer1" >Answer 1</x-input-label>

                        <x-text-input id="answer1"
                            type="text"
                            class="form-control{{ $errors->has('answer1') ? ' is-invalid' : '' }} block mt-1 w-full"
                            name="answer1"
                            value="{{ old('answer1') }}"
                            autocomplete="answer1" autofocus></x-text-input>

                        @if ($errors->has('answer1'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('answer1') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <x-input-label for="answer2" >Answer 2</x-input-label>

                        <x-text-input id="answer2"
                            type="text"
                            class="form-control{{ $errors->has('answer2') ? ' is-invalid' : '' }} block mt-1 w-full"
                            name="answer2"
                            value="{{ old('answer2') }}"
                            autocomplete="answer2" autofocus></x-text-input>

                        @if ($errors->has('answer2'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('answer2') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <x-input-label for="answer3" >Answer 3</x-input-label>

                        <x-text-input id="answer3"
                            type="text"
                            class="form-control{{ $errors->has('answer3') ? ' is-invalid' : '' }} block mt-1 w-full"
                            name="answer3"
                            value="{{ old('answer3') }}"
                            autocomplete="answer3" autofocus></x-text-input>

                        @if ($errors->has('answer3'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('answer3') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <x-input-label for="answer4" >Answer 4</x-input-label>

                        <x-text-input id="answer4"
                            type="text"
                            class="form-control{{ $errors->has('answer4') ? ' is-invalid' : '' }} block mt-1 w-full"
                            name="answer4"
                            value="{{ old('answer4') }}"
                            autocomplete="answer4" autofocus></x-text-input>

                        @if ($errors->has('answer4'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('answer4') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <x-input-label for="correct" >Correct Answer</x-input-label>
                    <div class="col-md-12">
                <select id="correct" name="correct" class="form-control">
                    <option value="1">Answer 1</option>
                    <option value="2">Answer 2</option>
                    <option value="3">Answer 3</option>
                    <option value="4">Answer 4</option>
                </select>
                </div>
            </div>

            <div class="form-group">
                    <label for="level" >Level</label>
                    <div class="col-md-12">
                <select id="level" name="level" class="form-control">
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                </select>
                </div>
            </div>
                    <div>
                        <button class="btn btn-primary">Add Question</button>
                    </div>

                </div>
            </div>
        </form>
        <div class="finish-dugme">
            <a href="/course/{{$course->id}}" class="btn btn-finish">Finish Test</a>
        </div>
        </div>
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>