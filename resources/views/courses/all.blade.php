<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <style>
        .container3 {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            max-width: 75%;
            margin: 20px auto;
        }
        .kartica , #a{
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
        }
        #a{
            width: 40%;
        }
        .kartica {
            width: 100%;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #e5fbe5;
        }
        .kartica:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .notice-par {
            padding: 20px;
        }
        .notice-img img {
            width: 90%;
            height: auto;
            margin: 0 auto; 
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .notice-text {
            padding: 10px 40px;
        }
        .description {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            padding: 10px ;
        }
        h2{
            text-align: center;
        }
    </style>
    <div class="container3">
        @if(Session::has('message'))
        <div class="alert alert-danger">
            {{ Session::get('message') }}
        </div>
        @endif
        @foreach ($courses as $course)
        <a href="/course/{{ $course->id }}" style=" text-decoration: none; color: black;" id="a">
            <div class="kartica">
                <div class='notice-par'>
                    <div class='notice-img'>
                        <img src="{{ asset($course->image) }}" />
                    </div>
                    <div class='notice'>
                        <div class='notice-text'>
                            <h2><b>{{$course->title}}</b></h2>
                            <div class='description'>
                                {{$course->description}}
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>