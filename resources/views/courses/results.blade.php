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
                        <h3><b>{{ $times_helped == 0 ? 'You did not use any help' : 'You used help ' . $times_helped . ' times, and that made you lose ' . $loss . ' % of your score '}}</b></h3>
                        
                        <h3 style="color: {{$results < 50 ? 'red' : 'green'}};"><b>Test result: {{$resultsWithHelp}}%</b></h3>
                        <h3><b>{{$results < 50 ? 'Better luck next time' : 'Congratulations!'}}</b></h3>
                        <h3>{{$correctAnswers}}/{{$noQuestions}}</h3>
                    </div>
                    <div class="row">
                        <div>
                            <h2><b>Answers:</b></h2>
                            <br>
                            <ul>
                                @php
                                    $correctCount = 0;
                                @endphp
                                @foreach ($latestUserAnswers as $userAnswer)
                                    @php
                                        $foundCorrectAnswer = false;
                                    @endphp
                                    @foreach ($answersCorrect as $correctAnswer)
                                        @if ($userAnswer['answer_id'] === $correctAnswer['id'])
                                            @php
                                                $foundCorrectAnswer = true;
                                                $correctCount++;
                                            @endphp
                                            <li class="green-text">Question {{$correctCount}}: Correct. The correct answer is {{$correctAnswer['answer']}}</li>
                                            @break
                                        @endif
                                    @endforeach
                                    @if (!$foundCorrectAnswer)
                                        @php
                                            $correctCount++;
                                        @endphp
                                        <li class="red-text">Question {{$correctCount}}: Incorrect. The correct answer is {{$answersCorrect[$correctCount-1]['answer']}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
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