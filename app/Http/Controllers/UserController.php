<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserController extends Controller
{
    public function index(){
        return User::all();
    }
    public function user(Request $request){
        return $request->user();
    }
    public function register(UserRegisterRequest $request){
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->first_name)

        ]);
        return 'User Created successfully';
    }
}
