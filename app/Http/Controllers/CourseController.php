<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\CourseUser;
use App\Models\Question;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use App\Models\Course;
use App\Models\CourseContent;
use App\Models\User;
use App\Models\AnswerUser;
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

    public function enroll(Request $request, $courseId)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        $course = Course::findOrFail($courseId);

        CourseUser::create([
            'user_id' => auth()->user()->id,
            'course_id' => $course->id,
        ]);

        return redirect()->back()->with('success', 'You have successfully enrolled in this course');
    }

    public function unenroll(Request $request, $courseId)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        $course = Course::findOrFail($courseId);

        CourseUser::where('user_id', auth()->user()->id)->where('course_id', $course->id)->delete();

        return redirect()->back()->with('success', 'You have successfully unenrolled from this course');
    }

    public function createTest($course_id)
    {
        $course = Course::find($course_id);

        return view('courses.createTest', compact('course'));
    }

    public function storeTest(Request $request, $course_id)
    {
        $data = request()->validate([
            'question' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'correct' => [],
            'level' => []
        ]);

        $question = new Question();
        $question->question = $data['question'];
        $question->course_id = $course_id;
        $question->level = $request->input('level');
        $question->save();

        if ($request->input('correct') == '1') {
            $answers = [
                ['question_id' => $question->id, 'answer' => $data['answer1'], 'correct' => true],
                ['question_id' => $question->id, 'answer' => $data['answer2'], 'correct' => false],
                ['question_id' => $question->id, 'answer' => $data['answer3'], 'correct' => false],
                ['question_id' => $question->id, 'answer' => $data['answer4'], 'correct' => false],
            ];
        } else if ($request->input('correct') == '2') {
            $answers = [
                ['question_id' => $question->id, 'answer' => $data['answer1'], 'correct' => false],
                ['question_id' => $question->id, 'answer' => $data['answer2'], 'correct' => true],
                ['question_id' => $question->id, 'answer' => $data['answer3'], 'correct' => false],
                ['question_id' => $question->id, 'answer' => $data['answer4'], 'correct' => false],
            ];
        } else if ($request->input('correct') == '3') {
            $answers = [
                ['question_id' => $question->id, 'answer' => $data['answer1'], 'correct' => false],
                ['question_id' => $question->id, 'answer' => $data['answer2'], 'correct' => false],
                ['question_id' => $question->id, 'answer' => $data['answer3'], 'correct' => true],
                ['question_id' => $question->id, 'answer' => $data['answer4'], 'correct' => false],
            ];
        } else if ($request->input('correct') == '4') {
            $answers = [
                ['question_id' => $question->id, 'answer' => $data['answer1'], 'correct' => false],
                ['question_id' => $question->id, 'answer' => $data['answer2'], 'correct' => false],
                ['question_id' => $question->id, 'answer' => $data['answer3'], 'correct' => false],
                ['question_id' => $question->id, 'answer' => $data['answer4'], 'correct' => true],
            ];
        }
        DB::table('answers')->insert($answers);

        return redirect("/course/{$course_id}/create-test");
    }

    public function showTest($course_id, $level)
    {
        $course = Course::find($course_id);
        $questions = Question::where('course_id', $course_id)->where('level', $level)->get();
        if (count($questions) == 0) {
            Session::flash('message', 'No questions on that level');
        }
        return view('courses.showTest', compact('course', 'questions'), ['level' => $level]);
    }

    public function showLevel($course_id)
    {
        $course = Course::find($course_id);
        return view('courses.level', compact('course'));
    }
    public function endTest(Request $request, $courseId, $level)
    {
        if (!Auth::check()) {
            return redirect()->back();
        }

        $userAnswers = $request->only(array_filter($request->keys(), function ($key) {
            return strpos($key, 'question') === 0;
        }));

        $times_helped = $request->input('times_help_used');

        $questions = Question::where('level', $level)->get();
        foreach ($userAnswers as $questionId => $answerId) {
            $questionId = intval(str_replace('question', '', $questionId));
            $answerId = intval($answerId);
            $questionAnswer = new AnswerUser();
            $questionAnswer->user_id = auth()->user()->id;
            $questionAnswer->answer_id = $answerId;
            $questionAnswer->save();
        }

        return redirect("/course/{$courseId}/{$level}/{$times_helped}/results/");

    }

    public function results($courseId, $level, $times_helped)
    {
        $user = Auth::user();
        $course = Course::find($courseId);
        $questions = Question::where('course_id', $courseId)->where('level', $level)->get();
        $questionsIds = $questions->pluck('id');

        $answerIds = [];
        $noQuestions = count($questionsIds);

        foreach ($questionsIds as $questionId) {
            $questionAnswers = Answer::where('question_id', $questionId)->pluck('id');
            $answerIds = array_merge($answerIds, $questionAnswers->toArray());
        }

        $userAnswers = AnswerUser::where('user_id', $user->id)->whereIn('answer_id', $answerIds)->get();

        $latestUserAnswers = $userAnswers->take(-$noQuestions);


        $correctAnswers = 0;
        foreach ($latestUserAnswers as $userAnswer) {
            $answer = Answer::find($userAnswer->answer_id);
            if ($answer->correct == 1) {
                $correctAnswers++;
            }
        }
        $totalPoints = $correctAnswers - ($times_helped * 0.5);

        $resultsWithHelp = $totalPoints > 0 ? number_format($totalPoints / $noQuestions * 100, 2, '.', '') : 0;
        $results = $totalPoints > 0 ? number_format($correctAnswers / $noQuestions * 100, 2, '.', '') : 0;
        $loss = $results - $resultsWithHelp;

        return view('courses.results', compact('results','resultsWithHelp', 'loss', 'course', 'correctAnswers', 'noQuestions', 'times_helped'));
    }

    

}
