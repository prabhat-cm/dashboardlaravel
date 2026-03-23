<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; // 🔥 ADD

class ForgotController extends Controller
{
    public function showForm()
    {
        return view('forgot');
    }

    public function reset(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            //  MAIL SEND KAR RAHE HAI
            Mail::raw('Your password has been successfully updated.', function ($msg) use ($user) {
                $msg->to($user->email)
                    ->subject('Password Reset Successful');
            });

            return back()->with('msg', 'Password updated & mail sent ✅');
        } else {
            return back()->with('msg', 'Email not found');
        }
    }
}