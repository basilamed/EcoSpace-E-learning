<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Difficult questions') }}
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
        .question-list {
        list-style: none;
        padding: 0;
        margin: 0;
        }

        .question-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            background-color: #fff;
        }

        .question-item:hover {
            border-color: #a7288a
        }

        .question {
            font-weight: bold;
        }

        .accuracy {
            font-size: 14px;
            color: #555;
        }
    </style>
    <div class="container">
        <h2>Difficult Questions for {{ $course->title }}</h2>

        @foreach ($difficultQuestions as $level => $questions)
            @if (count($questions) > 0)
                <h3>{{ ucfirst($level) }} Level</h3>
                <ul class='question-list'>
                    @foreach ($questions as $item)
                    <li class='question-item' >
                            <p class='question'><strong>Question: </strong>{{ $item['question']->question }}<br></p>
                            <p class='accuracy'><strong>Accuracy: </strong>{{ $item['accuracy'] }}%</p>
                    </li>
                    @endforeach
                </ul>
            @endif
        @endforeach
        <div>
            <a type="button" class="btn" href="/course/{{$course->id}}/results">Go Back</a>
        </div>
    </div>
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>