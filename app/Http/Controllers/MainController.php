<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MainController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $courses = Course::all();
        $notifications = Notification::all();
        return view('dashboard', compact('courses' , 'notifications'));
    }
}
