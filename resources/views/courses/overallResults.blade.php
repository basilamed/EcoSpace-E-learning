<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Overall course results') }}
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
        .card-header{
            font-weight: bold;
            font-size: 20px;
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
    </style>
    <div class="container">
        <div class="card">
            <div class="card-header"> Overall test results for {{$course->title}} course</div>
                <div style="margin: 20px">
                    <p>Overall course results: <b>{{$results}} %</b></p>
                    <p>Easy Tests: <b>{{$resultsEasy}} %</b></p>
                    <p>Number of times the easy test was taken: <b>{{$noQuestionsE}}</b></p>
                    <p>Medium Tests: <b>{{$resultsMedium}} %</b></p>
                    <p>Number of times the medium test was taken: <b>{{$noQuestionsM}}</b></p>
                    <p>Hard Tests: <b>{{$resultsHard}} %</b></p>
                    <p>Number of times the hard test was taken: <b>{{$noQuestionsH}}</b></p>
                    <div>
                        <a type="button" class="btn" href="/course/{{$course->id}}/attendants">Go Back</a>
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