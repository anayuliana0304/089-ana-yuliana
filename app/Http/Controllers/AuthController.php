<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function login(Request $request){

        $user = User::where('username', $request->username)->first();

        if($user == null){
            return redirect()->back()->with('error', 'User not found!');
        }

        if(!Hash::check($request->password, $user->password)){
            return redirect()->back()->with('error', 'Incorrect password!');
        }

        $request->session()->regenerate();
        $request->session()->put('isLogged', true);
        $request->session()->put('userId', $user->id);
        $request->session()->put('username', $user->username);
        $request->session()->put('name', $user->name);
        $request->session()->put('level', $user->level);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request){
         $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.loginPage');
    }
}
