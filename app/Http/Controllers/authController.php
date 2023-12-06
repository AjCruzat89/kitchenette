<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class authController extends Controller
{
    //<!--===============================================================================================-->
    public function Register(Request $req)
    {
        $req->validate([
            'name' => 'required|unique:users',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:users'
        ]);

        $token = Str::random(64);
        DB::table('email_verification')->insert([
            'email' => $req->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("emails.verification", ['token' => $token], function ($message) use ($req) {
            $message->to($req->email);
            $message->subject("Email Verification");
        });

        $user = new User();
        $user->name = $req->input('name');
        $user->password = Hash::make($req->input('password'));
        $user->email = $req->input('email');
        $user->save();
        if (!$user) {
            return redirect(route('registerPage'))->with('error', 'Registration Unsuccessful!.');
        }
        return redirect(route('loginPage'))->with('success', 'Email Verification Sent!.');
    }
    //<!--===============================================================================================-->
    public function verifyEmail(Request $req){
        $token = $req->token;

        $verification = DB::table('email_verification')->where('token', $token)->first();
        if($verification){
            $user = User::where('email', $verification->email)->first();
            $user->verified = 1;
            $user->save();
            DB::table('email_verification')->where('token', $token)->delete();
            return redirect(route('loginPage'))->with('success', 'Email Verified!!!.');
        }
        else{
            return redirect(route('loginPage'))->with('error', 'Invalid Token!!!.');
        }
    }
    //<!--===============================================================================================-->
    public function Login(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $req->input('email'))->first();
        if($user->verified == 0){
            return redirect(route('loginPage'))->withErrors(['email' => 'User Not Verified!'])->withInput();
        }

        $credentials = $req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->user_role) {
                case 'admin':
                    $activityLog = new Activity();
                    $activityLog->name = $user->name;
                    $activityLog->activity = $user->name . ' logged in at ' . Carbon::now();
                    $activityLog->save();
                    return redirect()->route('admin')->with('success', 'Login Successful!');
                    break;
                case 'user':
                    return redirect()->route('home')->with('success', 'Login Successful!');
                    break;
                default:
                    return redirect()->route('home')->with('success', 'Login Successful!');
            }
        }
        return redirect(route('loginPage'))->with('error', 'Incorrect Email/Password!.');
    }
    //<!--===============================================================================================-->
    public function ForgotPasswordRequest(Request $req)
    {
        $req->validate([
            'email' => "required|email|exists:users",
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $req->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user = User::where('email', $req->email)->first();

        Mail::send("emails.reset-password", ['token' => $token, 'username' => $user->name], function ($message) use ($req) {
            $message->to($req->email);
            $message->subject("Reset Password");
        });

        return redirect(route('forgotPassword'))->with('success', 'Email Sent!.');
    }
    //<!--===============================================================================================-->
    public function ResetPasswordPage($token)
    {
        $existingToken = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$existingToken) {
            return redirect()->route('loginPage');
        }

        return view('page.reset-password', compact('token'));
    }
    //<!--===============================================================================================-->
    public function ResetPasswordRequest(Request $req)
    {
        $req->validate([
            'token' => 'required|exists:password_reset_tokens',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $existingToken = DB::table('password_reset_tokens')->where('token', $req->token)->first();

        if (!$existingToken) {
            return redirect(route('resetPasswordPage', $req->token))->with('error', 'Invalid or expired token. Please try again.');
        }

        $user = User::where('email', $existingToken->email)->first();

        if (!$user) {
            return redirect(route('resetPasswordPage', $req->token))->with('error', 'User not found. Please try again.');
        }

        $user->password = Hash::make($req->password);
        $user->save();

        DB::table('password_reset_tokens')->where('token', $req->token)->delete();

        return redirect()->route('loginPage')->with('success', 'Password reset successful.');
    }
    //<!--===============================================================================================-->
    public function logout()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->user_role === 'admin') {
                $activityLog = new Activity();
                $activityLog->name = $user->name;
                $activityLog->activity = $user->name . ' Logged Out At ' . Carbon::now();
                $activityLog->save();
                Auth::logout();
                return redirect()->route('loginPage')->with('success', 'Logged Out Successfully.');
            }

            Auth::logout();
            return redirect()->route('home')->with('success', 'Logged Out Successfully.');
        }
    }
    //<!--===============================================================================================-->
}
