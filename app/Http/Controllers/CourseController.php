<?php

namespace App\Http\Controllers;

use App\Models\CourseUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function create()
    {
        return view('courses.create');
    }

    public function createContent($course_id)
    {
        $course = Course::find($course_id);

        return view('courses.createContent', compact('course'));
    }

    public function storeContent(Request $request, $course_id)
    {
        $data = request()->validate([
            'title' => 'required',
            'file' => ['required'],
        ]);

        $content = new CourseContent();
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('assets', $filename);

        $content->title = $data['title'];
        $content->file = $filename;
        $content->course_id = $course_id;
        $content->save();

        return redirect('/course/' . $course_id);
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => ['required', 'image'],
        ]);
        $path = request('image')->store('temp');
        $file = request('image');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        $course = new Course();
        $course->title = $data['title'];
        $course->description = $data['description'];
        $course->image = "uploads/{$fileName}";
        $course->user_id = auth()->user()->id;
        $course->save();

        return redirect('/course/' . $course->id);
    }

    public function show(Course $course)
    {
        $contents = CourseContent::where('course_id', $course->id)->get();
        $attendants = CourseUser::where('course_id', $course->id)->get();
        if (count($attendants) == 0) {
            Session::flash('message', 'No attendants on this course');
        }
        return view('courses.show', compact('course', 'contents', 'attendants'));
    }

    public function showCourse(Course $course)
    {
        return view('courses.showCourse', compact('course'));
    }

    public function showAll()
    {
        $user = auth()->user();
        $courses = $user->courses()->get();
        if (count($courses) == 0) {
            Session::flash('message', 'You have not created any courses yet');
        }
        return view('courses.all', compact('courses'));
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect("/all-courses")
            ->with('success', 'Course deleted successfully');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable'
        ]);

        $validatedData['image'] = $request->file('image') ?? null;

        $course->title = $validatedData['title'];
        $course->description = $validatedData['description'];

        if ($validatedData['image'] != null) {
            $path = request('image')->store('temp');
            $file = request('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $course->image = "uploads/{$fileName}";
        }
        // else{
        //     $course->image = $course->image;
        // }

        Session::flash('success', 'You have successfully updated you course');
        $course->save();

        return redirect("/course/{$course->id}");
    }

    public function showAttendants($courseId)
    {
        $course = Course::find($courseId);
        $attendants = CourseUser::where('course_id', $courseId)->get();
        if (count($attendants) == 0) {
            Session::flash('message', 'No attendants on this course');
        }
        return view('courses.attendents', compact('attendants', 'course'));
    }
}
