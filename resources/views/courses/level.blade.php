<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Test levels') }}
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

    /* Style the "Finish Test" button */
    .btn-primary{
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

    .btn-primary:hover {
        background-color: #691957;
    }

    #level{
        border-radius: 5px;
    }
    .text{
        margin: 20px 0;
        color: #691957;   
    }
</style>
    <div class="container">
        <div class="row">
            <div>
                <div class="row">
                    <h1>Choose the level</h1>
                </div>

                <div class='text'>
                    <p>
                        Here, you can choose the difficulty level for your test. Each test consists of a set of questions, and for each question,
                        there are four options to choose from. Your task is to select the correct option for each question.
                    </p>

                    <h2>Test Difficulty Levels:</h2>
                    <ol>
                        <li>
                            <strong>Easy:</strong> This level is suitable for beginners and those who want to get familiar with the topic.
                        </li>
                        <li>
                            <strong>Medium:</strong> This level offers a balanced mix of easy and moderately challenging questions.
                        </li>
                        <li>
                            <strong>Hard:</strong> For those seeking a challenge, this level includes more difficult questions to test your knowledge.
                        </li>
                    </ol>

                    <p>
                        Remember, take your time to read each question carefully before selecting your answer. Once you've made your choice, click
                        on the <b>'End Test'</b> button at the end of the test.
                        After you've completed the test, you'll be able to see your score.
                    </p>

                    <p>
                        Good luck, and let's begin your learning journey!
                    </p>
                </div>

        <div class="form-group">
                <x-input-label for="level">Level</x-input-label>
                <div class="col-md-12">
            <select id="level" name="level" class="form-control">
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
            </div>
        </div>
                <div style="margin-top: 20px; display: flex; justify-content: center;">
                        <a href="#" id="begin-test">
                            <button class="btn btn-primary">Begin Test</button>
                        </a>
                </div>

            </div>
        </div>
    </div>
        <script>
            // Get the anchor tag and select element
            const beginTest = document.getElementById('begin-test');
            const levelSelect = document.getElementById('level');

            // Add an event listener to the anchor tag
            beginTest.addEventListener('mousedown', function() {
                // Get the selected level value
                const levelValue = levelSelect.value;
                
                // Construct the URL with the selected level value
                const url = `/course/{{$course->id}}/show-test/${levelValue}`;

                // Update the href attribute of the anchor tag
                beginTest.href = url;
            });
        </script>
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>