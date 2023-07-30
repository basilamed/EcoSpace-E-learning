<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <style>
        /* Course header styles */
        .header2 {
            text-align: center;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            width: 50%;
            padding: 20px 0;
        }

        .course-image {
            width: 70%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
        }

        /* Content section styles */
        .content {
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .description {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Profile actions styles */
        .profileActions {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .profileActions a {
            margin: 5px;
        }

        /* Enroll button style */
        .finish-dugme {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        /* Materials section styles */
        .content-div2 {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .naslov {
            text-align: center;
            margin-bottom: 20px;
        }

        .link {
            display: block;
            margin-bottom: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        /* Test button style */
        .content-div2 a.btn-primary {
            display: block;
            margin: 20px auto;
        }
        .dugme{
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            margin: 8px 0;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
        }
        #brisi{
            background-color: #f44336;
        }
        .profileActions{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            width: 60%;
            margin: 0 auto;
        }
        table {
            width:90%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #a3f1a3;
        }

        tr:nth-child(even) {
            background-color: #e5fbe5;
        }
        .card-header {
            padding: 10px;
            text-align: center;
        }
        #dugmence{
            margin: 8px auto;
            width: max-content;
        }
        .alert{
            margin: 20px auto;
            color: #f44336;

        }
        .link{
            color: #1dc41d;
            margin: 0 auto; 
            border-bottom: 1px solid #1dc41d;
            padding: 5px;
            width: 60%;

        }
        
    </style>

    <!-- Rest of your code -->

    <!-- update and delete-->
    <div class="header2">
        <img class="course-image" src="{{ asset($course->image) }}" />
        <h1><b>{{$course->title}}</b></h1>
        <div class="description">
            <p>{{$course->description}}</p>
        </div>
         @if (Auth::user()->ownsCourse($course))
            <div class="profileActions">
                <!-- Update course button -->
                <a type="button" class="dugme" href="/course/edit/{{$course->id}}">Update course</a>
                <!-- Delete course form -->
                <form id="delete-post-form" action="{{ route('course.destroy', $course->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
                <!-- Delete course button -->
                <button type="submit" class="dugme" id="brisi" onclick="confirmDelete()">Delete course</button>
            </div>
        @endif
    </div>

     <!-- Users that enrolled -->
     <div class="content">
        
        <!-- Profile actions for course owner -->
        @if (Auth::user()->ownsCourse($course))
            <div class="users">
                <div class="container-fluid px-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4><b>All Users that attend this course</b></h4>
                    </div>
                </div>
                <table class="table table-bordered">
                    @if(Session::has('message'))
                                    <div class="alert">
                                        {{ Session::get('message') }}
                                    </div>
                    @endif           
                    <thead>
                        <tr>
                            <th>Name:</th>
                            <th>Surname:</th>
                            <th>Username:</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($attendants as $attendant)
                        <tr>
                            <td>{{$attendant->user->name}}</td>
                            <td>{{$attendant->user->surname}}</td>
                            <td>{{$attendant->user->username}}</td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <!-- Course participants button -->
                <div  id='dugmence' >
                    <a href='/course/{{$course->id}}/attendants' class="dugme">
                    Show More About All Course participants
                </a>
                </div>
              </div>  
            
        @endif
    </div>
    <!-- Content section -->
    <div class="content">
        
        <!-- Profile actions for course owner -->
        @if (Auth::user()->ownsCourse($course))
            <div class="profileActions">
                
                <!-- Create test button -->
                <a href='/course/{{$course->id}}/create-test' class="btn btn-primary customBtn" style="margin-top: 10px;">
                    Create Test
                </a>
            </div>
        @endif
    </div>

    <!-- Enroll button -->
    <div class="finish-dugme">
        @if(Auth::user()->attendsCourse($course))
            <p>You are enrolled in this course</p>
        @else
            @if(Auth::user()->role == "student")
                <form action="{{ route('course.enroll', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Start this course</button>
                </form>
            @endif
        @endif
    </div>

    <!-- Materials section -->
    @if(Auth::user()->attendsCourse($course) || Auth::user()->ownsCourse($course))
        <hr style="margin-left: 242px; margin-right: 216px;">
        <div class="content-div2">
            <div class="naslov">
                <h2><b>Course study materials</b></h2>
            </div>
            @foreach($contents as $content)
                <div>
                    <a href="/assets/{{$content->file}}" class="link">
                        {{$content->title}}
                    </a>
                </div>
            @endforeach
            <!-- Add content button -->
            @if(Auth::user()->ownsCourse($course))
            <div id="dugmence">
                <a href='/course-content/{{$course->id}}/create' class="dugme">Add new material</a>
            </div>
            @endif
            
        </div>
    @endif
    @if(Auth::user()->attendsCourse($course) || Auth::user()->ownsCourse($course))
        <hr style="margin-left: 242px; margin-right: 216px;">
        <div class="content-div2">
            <div class="naslov">
                <h2>Test you knowlege</h2>
            </div>
            <div style="margin: 20px">
                <a href="/course/{{$course->id}}/level" class="btn btn-primary">
                    Test
                </a>
            </div>
        </div>
    @endif
    <x-slot name="footer">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
</x-app-layout>


<script>
    function confirmDelete() {
    if (confirm('Are you sure you want to delete this course?')) {
        document.getElementById('delete-post-form').submit();
    }
}
</script>