<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(User $user){
        return view('profilePage', ['user' => $user]);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);
        if(Auth::attempt(['name' => $fields['loginname'], 'password' => $fields['loginpassword']])){
            $request->session()->regenerate();
        }
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request){
        $fields =  $request->validate([
            'name' => ['required', 'min:2', 'max:20', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:2', 'max:30']
        ]);
        $fields['password'] = bcrypt($fields['password']);
        $user = User::create($fields);
        Auth::login($user);
        return redirect('/');
    }
}
