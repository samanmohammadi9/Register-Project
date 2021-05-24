<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest.student')->except('logout');
    }

    public function loginform()
    {
        if(auth('teacher')->check()){
            return redirect('/teacher');
        }
        return view('auth.login',['guard' => 'student']);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (\Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/student');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function signup(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'student_id' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        Student::Create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'sid' => $request->student_id,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (\Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/student');
        }
    }

    public function logout(Request $request)
    {
        auth('student')->logout();
        return redirect('/student/login');
    }
}
