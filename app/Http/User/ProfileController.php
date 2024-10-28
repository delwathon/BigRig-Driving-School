<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function profile()
    {
        $pageTitle = "Profile Setting";
        $user = auth()->user();
        return view($this->activeTemplate. 'user.profile_setting', compact('pageTitle','user'));
    }

    public function submitProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ],[
            'firstname.required'=>'First name field is required',
            'lastname.required'=>'Last name field is required'
        ]);

        $user = auth()->user();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;

        $user->address = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => @$user->address->country,
            'city' => $request->city,
        ];

        $user->save();
        $notify[] = ['success', 'Profile updated successfully'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $pageTitle = 'Change Password';
        return view($this->activeTemplate . 'user.password', compact('pageTitle'));
    }

    public function submitPassword(Request $request)
    {
        // return $request->all();

        $passwordValidation = Password::min(6);
        $general = gs();
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required','confirmed',$passwordValidation]
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            $notify[] = ['success', 'Password changes successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The password doesn\'t match!'];
            return back()->withNotify($notify);
        }
    }



    public function submitPin(Request $request)
    {
        // return $request->all();

        $passwordValidation = Password::min(4);
        $general = gs();
        // if ($general->secure_password) {
            $passwordValidation = $passwordValidation->numbers();//->symbols()->uncompromised();
        // }

        $this->validate($request, [
            'current_pin' => 'required',
            'pin' => ['required','confirmed',$passwordValidation]
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_pin, $user->pin) && $user->pin !=null) {
            $pin = Hash::make($request->pin);
            $user->pin = $pin;
            $user->save();
            $notify[] = ['success', 'PIN changes successfully'];
            return back()->withNotify($notify);
        } elseif($user->pin ==null){
            $pin = Hash::make($request->pin);
            $user->pin = $pin;
            $user->save();
            $notify[] = ['success', 'New PIN set successfully'];
            return back()->withNotify($notify);

        } else {
            $notify[] = ['error', 'The PIN doesn\'t match!'];
            return back()->withNotify($notify);
        }
    }

}
