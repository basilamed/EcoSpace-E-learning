<?php

namespace App\Http\Controllers;

use App\Models\CourseUser;
use App\Models\Notification;
use App\Models\User;
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

class AdminController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        $users = User::where('approved', 0)->get();
        if (count($users) == 0) {
            Session::flash('message', 'No teachers to approve');
        }

        $allUsers = User::all();
        $notifications = Notification::all();
        return view('admin.users', compact('users', 'allUsers', 'notifications'));
    }

    public function approve(User $user)
    {
        $user->update(['approved' => true]);
        Session::flash('approved', 'User approved');
        return redirect()->route('admin');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('rejected', 'User rejected and deleted from database');
        return redirect()->route('admin');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('rejected', 'User deleted from database');
        return redirect()->route('admin');
    }

    public function addNotification()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $notification = new Notification();
        $notification->title = $data['title'];
        $notification->description = $data['description'];
        $notification->save();
        Session::flash('approved', 'Notification added');
        return redirect()->back();

    }

    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        Session::flash('rejected', ' Notification deleted from database ');
        return redirect()->route('admin');
    }

    public function updateNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $notification->title = $data['title'];
        $notification->description = $data['description'];
        $notification->save();
        Session::flash('approved', ' Notification updated ');
        return redirect()->route('admin');
    }

    public function showNotification($id){
        $notification = Notification::findOrFail($id);
        return view('admin.showNotification', compact('notification'));
    }
}