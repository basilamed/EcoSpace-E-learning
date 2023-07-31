<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Results') }}
        </h2>
    </x-slot>
    <style>
        .container {
            max-width: 50%;
            padding: 20px 40px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .btn{
            display: block;
            width: 100%;
            padding: 10px 20px;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            background-color: #a7288a;
        }
        .btn:hover {
            background-color: #691957;
        }
        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 10px;
        }
        .glavno{
            text-align: center;
            
        }
        .red-text {
            color: red;
        }

        .green-text {
            color: green;
        }
    </style>
    <div class="container">
        <div class="row">
            <div>
                <div class="row">
                    <div class='glavno'>
                        <h1><b>Your results</b></h1>
                        <h3 style="color: {{$results < 50 ? 'red' : 'green'}};"><b>{{$results}}%</b></h3>
                    </div>
                    <h2>Grading System:</h2>
                        <ul>
                            <li>10: 91% - 100%</li>
                            <li>9: 81% - 90%</li>
                            <li>8: 71% - 80%</li>
                            <li>7: 61% - 70%</li>
                            <li>6: 51% - 60%</li>
                            <li>5: Below 50%</li>
                        </ul>
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <a type="button" class="btn" href="/course/{{$course->id}}">Go Back</a>
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