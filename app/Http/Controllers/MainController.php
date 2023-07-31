<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MainController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function main()
    {
        $courses = Course::all();
        $notifications = Notification::where('created_at', '>=', now()->subWeek())->get();
        return view('dashboard', compact('courses' , 'notifications'));
    }
}
