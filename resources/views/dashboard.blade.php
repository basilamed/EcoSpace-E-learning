<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

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
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>

