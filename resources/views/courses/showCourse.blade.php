<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="container2">
        <div class="content">
            <section class="header2">
                <img class="course-image" src="/storage/{{$course->image}}"/>
            </section>
        <div class="content-div">
            <h1 class="row justify-content-center">{{$course->title}}</h1>
            <div class="description">
                <p class="row justify-content-center">{{$course->description}}</p>
            </div>

        </div>
    </div>
<x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>