<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // start to login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // login process
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // check credentials has in database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // check role_id
            $roleId = Auth::user()->role_id;

            switch ($roleId) {
                case 1:
                    // role Admin
                    return redirect()->intended('/admin/dashboard');
                case 2:
                    // role Employee
                    return redirect()->intended('/employee/dashboard');
                default:
                    return redirect()->intended('/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'ข้อมูลอีเมล หรือ รหัสผ่านไม่ถูกต้อง', // show error in email field
        ]);
    }

    // logout process
        public function logout(Request $request)
        {
            Auth::logout(); // delete user login info
            $request->session()->invalidate(); // destroy all session
            $request->session()->regenerateToken(); // regenerate new token

            return redirect('/login');
        }
        
        

}
