<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <style>
         .wrapper {
            margin: 20px auto;
            width: 80%;
            max-width: 1200px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            background-color: #fff;
        }

        .image-container {
            text-align: center;
        }

        .card-img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .card-title {
            margin-top: 10px;
            text-align: center;
        }

        .card-h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .card-p {
            color: #666;
        }

        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            color: #007bff;
        }

        .justify-content-center {
            text-align: center;
        }
        .notification-container {
        margin: 20px auto;
        width: 80%;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        background-color: #f8f8f8;
        }
        .obavestenje {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 100%;
            margin: 5px auto;
            background-color: #e5fbe5;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <img src="/images/saksijeT.jpg" alt="dijete i cvijet"/>
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center" style="width:90%; margin:auto;">
                    <h1 class="text-lg font-semibold mb-4">Welcome to our E-Learning App!</h1>
                    <div class="text-center">
                        <p class="text-base">
                            Are you passionate about gardening and ecology? You're in the right place!
                            Our E-Learning platform offers a wide range of courses that will help you
                            explore the fascinating world of gardening, environmental conservation, and sustainable practices.
                        </p>
                        <p class="text-base mt-2">
                            Whether you are a beginner looking to start your gardening journey or an experienced gardener
                            seeking to deepen your knowledge, we have courses suitable for everyone.
                        </p>
                        <p class="text-base mt-2">
                            Our expert instructors will guide you through the different aspects of gardening, including plant care,
                            landscaping, organic gardening, permaculture, and much more.
                        </p>
                        <p class="text-base mt-2">
                            Join our community of like-minded individuals and embark on an educational adventure in gardening
                            and ecology. Start your learning journey today!
                        </p>
                    </div>
                </div>
                <hr style="margin: 1rem 130px;">
                <h1 class="row justify-content-center"><b>The courses we offer</b></h1>
                <div class="wrapper">
                    
                    <div class="grid">
                        @foreach ($courses as $course)
                        <div>
                            @if(Auth::user())
                            <a href="/course/{{ $course->id }}" style=" text-decoration: none; color: black; ">
                            @endif
                            @guest
                            <a href="/course-view/{{ $course->id }}" style=" text-decoration: none; color: black; ">
                            @endguest
                            <div class='card-container'>
                                <div class='image-container'>
                                    <img src="{{ asset($course->image) }}" class='card-img'/>
                                </div>
                                <div class='card-title'>
                                    <h3 class='card-h3' data-testid="company-name"> {{$course->title}} </h3>
                                    <p class='card-p'>By: {{ $course->user->name }} {{ $course->user->surname }}</p>
                                </div>
                            </div>
                            </a>
                        </div>
                        @endforeach
                            
                </div>
                <h1 class="row justify-content-center">Notifications</h1>
                <div class="wrapper">
                    <div class="notification-container">
                    @foreach($notifications as $notification)
                        <div class="obavestenje">
                                <h3><b>{{$notification->title}}</b></h3>
                                <p>{{$notification->description}}</p>
                        </div>
                    @endforeach
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

