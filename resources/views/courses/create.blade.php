<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <style>
    .form-group label {
        color: #333;
    }
    #forma{
        width: 90%;
        margin: auto;
        padding: 30px;
    }
    .form-control {
        border: 1px solid purple;
        border-radius: 4px;
        padding: 8px;
        width: 100%;
        font-size: 14px;
        color: #555;
    }

    .form-control:focus {
        outline: none;
        border-color: #4c51bf;
        box-shadow: 0 0 0 2px rgba(76, 81, 191, 0.2);
    }
    .container{
        width: 100%;
        margin: auto;
    }
    #glavni{
        width: 60%;
        margin: auto;
    }
    #naslov{
        text-align: center;
        margin-bottom: 20px;
        font-size: 20px;
    }
    button{
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
    button:hover{
        background-color: #45a049;
    }
    #zadugmence{
        text-align: center;
    }

</style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" id="glavni">
                <div class="container">
                    <form action="/course" enctype="multipart/form-data" method="POST">
                        @csrf

                        <div class="row" id='forma'>
                            <div class="col-8 offset-2" >

                                <div class="row" id="naslov">
                                    <h1><b>Add New Course</b></h1>
                                </div>
                                <div class="form-group row">
                                    <x-input-label for="title" :value="__('Course Title')" />
                                    <x-text-input id="title" class="block mt-2 w-full" type="text" name="title" :value="old('title')" required autofocus />
                                    <x-input-error :messages="$errors->get('title')" />
                                </div>

                                <div class="form-group row">
                                    <x-input-label for="description" :value="__('Course Description')" />
                                    <x-textarea-input id="description" class="block mt-2 w-full" name="description" :value="old('description')" required autofocus />
                                    <x-input-error :messages="$errors->get('description')" />
                                </div>

                                <div class="row">
                                    <x-input-label for="image" :value="__('Course Image')" />
                                    <x-file-input id="image" name="image" accept="image/png, image/jpeg, image/jpg" />
                                    <x-input-error :messages="$errors->get('image')" />
                                </div>

                                <div class="row pt-4" id='zadugmence'>
                                    <button>Add New Course</button>
                                </div>

                            </div>
                        </div>
                    </form>
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
