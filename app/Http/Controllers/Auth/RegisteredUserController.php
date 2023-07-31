<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
       
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'jmbg' => ['required', 'string', 'min:13', 'max:13', 'unique:users'],
            'role' => ['required', 'string', 'max:255', Rule::in(['teacher', 'student', 'admin'])],
            'gender' => ['required', 'string', 'max:1',  Rule::in(['M', 'F'])],
            'birthPlace' => ['required', 'string', 'max:255',],
            'birthCountry' => ['required', 'string', 'max:255'],
            'birthDate' => ['required', 'date'],
            'contact' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $num = rand(1, 100);
        $username = strtolower($request['name'] . $request['role'] . $num);

        $approved = $request->input('role') === 'teacher' ? false : true;

        // $path = request('picture')->store('temp');
        // $file = request('picture');
        // $fileName = $file->getClientOriginalName();
        // $file->move(public_path('uploads'), $fileName);
        
        $user = User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'jmbg' => $request->input('jmbg'),
            'role' => $request->input('role'),
            'gender' => $request->input('gender'),
            'birthPlace' => $request->input('birthPlace'),
            'birthCountry' => $request->input('birthCountry'),
            'birthDate' => $request->input('birthDate'),
            'contact' => $request->input('contact'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'picture' => 0,
            'approved' => $approved,
            'username' => $username,
        ]);
        
          if ($user->role === 'teacher') {
              Session::flash('success', 'You have successfully registered! Now, you must wait for the Admin to approve your registration request');
              event(new Registered($user));
              throw new AuthenticationException($redirectto = '/login');
          } 
        //  elseif ($user->role === 'student') {
        //      Session::flash('success', 'You have successfully registered! Now, you must verify your email address');
        //      $user->sendEmailVerificationNotification();
        //      event(new Registered($user));
        //      throw new AuthenticationException();
        //  }
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
