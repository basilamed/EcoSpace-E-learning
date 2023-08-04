<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Test results') }}
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
        .profileActions{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            width: 100%;
            margin: 20px auto;
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

        .btn-primary {
            background-color: #4ae44a;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #1dc41d;
        }
    </style>
    <div class="container">
        <div class="card">
            <div class="card-header"> Test results for {{$course->title}} course</div>
                <h3 style="margin: 20px">{{$user->name}} {{$user->surname}}</h3>
                <div style="margin: 20px">
                    <p>Easy Test: {{$resultsEasy}} %</p>
                    <h3><b>
                        @if ($noQuestionsE == 0)
                            No easy test to take
                        @else
                            First easy test: {{ $firstcorrectAnswersE }}/{{ $noQuestionsE }} with a {{$firstTestResultsEasy}}% as the final grade<br>
                            Latest easy test: {{ $latestcorrectAnswersE }}/{{ $noQuestionsE }}
                        @endif
                    </b></h3>
                    <p>Medium Test: {{$resultsMedium}} %</p>
                    <h3><b>
                        @if ($noQuestionsM == 0)
                            No medium test to take
                        @else
                            First medium test: {{ $firstcorrectAnswersM }}/{{ $noQuestionsM }} with a {{$firstTestResultsMedium}}% as the final grade<br>
                            Latest medium test: {{ $latestcorrectAnswersM }}/{{ $noQuestionsM }}
                        @endif
                    </b></h3>
                    <p>Hard Test: {{$resultsHard}} %</p>
                    <h3><b>
                        @if ($noQuestionsH == 0)
                            No hard test to take
                        @else
                            First hard test: {{ $firstcorrectAnswersH }}/{{ $noQuestionsH }} with a {{$firstTestResultsHard}}% as the final grade<br>
                            Latest hard test: {{ $latestcorrectAnswersH }}/{{ $noQuestionsH }}
                        @endif
                    </b></h3>
                    <div class="profileActions">
                        <a class="btn btn-primary" href="/course/{{$course->id}}">Go back to course details</a>
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