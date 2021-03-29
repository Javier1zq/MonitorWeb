<?php

namespace App\Http\Controllers;

use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupEmail($first_name, $email, $verification_code){
        $data = [
            'first_name'=> $first_name,
            'verification_code'=> $verification_code
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }
}
