<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\MailController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
class UserController extends Controller
{
    public function index(){
        return User::all();
    }
    public function user(Request $request){
        //print_r('hola');
        return $request->user();
    }
    public function data(Request $request){
        //print_r('hola2');
        $user_DNI = $request->user()->DNI;
        //print_r('this is the result of data');
        //print_r($user_DNI);
        $data = DB::table('data_consumption') ->where('DNI', '=', $user_DNI)->orderBy('month', 'desc')->get();

        if ($data) {
                return $data;
        }
        else return null;
    }
    public function services(Request $request){
        //print_r('hola2');
        $user_DNI = $request->user()->DNI;
        //print_r('this is the result of data');
        //print_r($user_DNI);
        $data = DB::table('hired_services') ->where('DNI', '=', $user_DNI)->get();

        if ($data) {
                return $data;
        }
        else return null;
    }
    /*public function register(UserRegisterRequest $request){//creates USER with the information on the form
        //print_r($request->DNI);
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'DNI' => $request->DNI,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);
        return 'User Created successfully';
    }*/
    public function register(Request $request){//creates USER with the information on the form
        //print_r($request->DNI);

        $user= new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->DNI = $request->DNI;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = sha1(time());

        $user->save();

        if ($user !=null) {
            MailController::sendSignupEmail($user->first_name, $user->email, $user->verification_code);
            return 'User Created successfully';

        }
        //show error message
        return 'User Not created';
    }


    public function verifyUser(Request $request){
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->email_verified_at = now();
            $user->remember_token = Str::random(10);
            $user->save();
            return 'User Verified successfully';
        }

        return 'User Not verified';
    }

    public function userIsVerified(Request $request){
        $user = User::where(['email' => $request->email])->first();

        if ($user!=null) {
            return $user->is_verified;
        }
        else return false;


    }
}
