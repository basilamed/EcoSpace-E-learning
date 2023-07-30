<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Notification;

class MainController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $courses = Course::all();
       // $notifications = Notification::all();
        return view('dashboard', compact('courses'));
    }
}
