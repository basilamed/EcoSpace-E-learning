<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Test for Course: ') }}{{ $course->title }}
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

        /* Style the "Finish Test" button */
        .btn-primary , .btn-finish, .btn-help{
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

        .btn-help{
            background-color: #f4a236;
        }

        .btn-primary {
            background-color: #a7288a;
        }

        .btn-finish {
            background-color: #f44336
        }

        .btn-primary:hover {
            background-color: #691957;
        }

        .btn-finish:hover {
            background-color: #d2190b;
        }

        .btn-help:hover{
            background-color: #f47336;
        }
        #level{
            border-radius: 5px;
        }
        [type=radio]:checked {
            border-color: transparent;
            background-color: #a7288a;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat
        }
        [type=checkbox]:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e")
        }

        [type=radio]:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e")
        }

        [type=checkbox]:checked:hover,[type=checkbox]:checked:focus,[type=radio]:checked:hover,[type=radio]:checked:focus {
            border-color: transparent;
            background-color: #691957
        }

        [type=checkbox]:indeterminate {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 16 16'%3e%3cpath stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8h8'/%3e%3c/svg%3e");
            border-color: transparent;
            background-color: #a7288a;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat
        }

        [type=checkbox]:indeterminate:hover,[type=checkbox]:indeterminate:focus {
            border-color: transparent;
            background-color: #691957
        }
        [type=checkbox]:focus,[type=radio]:focus {
            outline: 2px solid transparent;
            outline-offset: 2px;
            --tw-ring-inset: var(--tw-empty, );
            --tw-ring-offset-width: 2px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: #691957;
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)
        }
    
    </style>
    <div class="container">
        <div class="row">
                <div>
                    <div class="card">
                    @if(Session::has('message'))
                        <div class="alert alert-danger">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                        <form method="POST" action="/course/{{$course->id}}/{{$level}}/test">
                    @csrf
                    @foreach ($questions as $question)

                    <div class="checkQuestion">
                        <h2 class="text-center">{{ $question->question }}</h2>
                        <div class="answers">
                        @foreach ($question->answers as $answer)
                        <div class=" answer">
                            @if ($loop->first)
                            <input type="radio" name="question{{ $question->id }}" data-correct="{{ $answer->correct }}" id="answer{{ $answer->id }}" value="{{ $answer->id }}"
                            checked />
                            @else
                            <input type="radio" name="question{{ $question->id }}" data-correct="{{ $answer->correct }}" id="answer{{ $answer->id }}"
                            value="{{ $answer->id }} " />
                            @endif
                            <label for="answer{{ $answer->id }}">{{ $answer->answer }}</label>
                        </div>
                    
                        @endforeach
                        <button class="btn-help" data-question="{{ $question->id }}">50/50</button>

                        </div>
                    </div>
                    <hr style="margin: 1rem 70px;">
                    @endforeach
                <div>
                    <button class="btn btn-primary" type="submit">End Test</button>
                    <a type="button" class="btn btn-finish" href="/course/{{$course->id}}"><p style=' width: max-content; margin: 0 auto;'>Cancel</p></a>
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
<script>
    function showHelp(event) {
        const questionId = event.target.dataset.question;
        const questionAnswers = document.querySelectorAll(`[name="question${questionId}"]`);
        const answersArray = Array.from(questionAnswers);
        const incorrectAnswers = answersArray.filter(answer => answer.dataset.correct === '0');

        // Hide two incorrect answers
        let count = 0;
        for (const answer of incorrectAnswers) {
            answer.style.display = 'none';
            count++;
            if (count >= 2) {
                break;
            }
        }
        event.target.disabled = true;
    }

    // Attach click event listener to all "Help" buttons
    const helpButtons = document.querySelectorAll('.btn-help');
    helpButtons.forEach((button) => {
        button.addEventListener('click', showHelp);
    });
</script>




