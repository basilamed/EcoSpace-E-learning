<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EcoSpace</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body class="antialiased">
    <div class="min-h-screen bg-center bg-gray-100 selection:text-white">

        <!-- Navigation Bar -->
        <div class="bg-white dark:bg-gray-800 shadow">
            @if (Route::has('login'))
            <header class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between" style="padding: 20px;">
                <div class="flex items-center" style=" padding: 0 25px;"> <!-- Flex container for the logo and text -->
                    <x-application-logo/>
                </div>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class=" ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </header>
            @endif
        </div>
        <!-- Content Section -->
        <div class="py-12" style=" width:85%; margin: auto; padding-bottom: 25px;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="width:95%; margin: auto; border-radius: 10px;">
                    <div>
                        <img src="/images/saksijeT.jpg" alt="dijete i cvijet" style="border-radius: 10px 10px 0 0 ;"/>
                    </div>

                    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center" style="width:90%; margin:auto;">
                        <div class="text-center">
                        <div class="mb-6">
                            <h2 class="text-base font-semibold">Welcome to our E-Learning App!</h2>
                        </div>
                        <div class="mb-4"> 
                            <p class="text-base">
                                Are you passionate about gardening and ecology? You're in the right place!
                                Our E-Learning platform offers a wide range of courses that will help you
                                explore the fascinating world of gardening, environmental conservation, and sustainable practices.
                            </p>
                        </div>
                        <div class="mb-4">
                            <p class="text-base">
                                Whether you are a beginner looking to start your gardening journey or an experienced gardener
                                seeking to deepen your knowledge, we have courses suitable for everyone.
                            </p>
                        </div>
                        <div class="mb-4">
                            <p class="text-base">
                                Our expert instructors will guide you through the different aspects of gardening, including plant care,
                                landscaping, organic gardening, permaculture, and much more.
                            </p>
                        </div>
                        <div class="mb-4">
                            <p class="text-base">
                                Join our community of like-minded individuals and embark on an educational adventure in gardening
                                and ecology. Start your learning journey today!
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="footer dark:bg-gray-800 " style="background-color: #fff; padding: 20px; text-align: center; padding-top:20px;">
        <h4 style="font-size: 1.2rem; margin-bottom: 10px;">EcoSpace</h4>
        <a style="color: #888;">&copy;CopyRight BM 2023</a>
    </div>
</body>
</html>
