<?php

namespace App\Http\Livewire\Child;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetCurrentPin extends Component
{
    public $notify = [];

    public function resetPIN(){
        $code = verificationCode(4);


        $user = User::find(auth()->user()->id);
        // dd($user);
        $pin = Hash::make($code);
        $user->pin = $pin;

        $user->save();
      

        $userIpInfo = getIpInfo();
        $userBrowserInfo = osBrowser();
        notify($user, 'PIN_RESET_CODE', [
            'code' => $code,
            'operating_system' => @$userBrowserInfo['os_platform'],
            'browser' => @$userBrowserInfo['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ],['email']);

        $email = $user->email;
        session()->put('pass_res_mail',$email);

        // $notify[] = ['success', 'Password reset email sent successfully'];
        // $this->notify = $notify;


    }
    public function render()
    {
        return view('livewire.child.reset-current-pin');
    }
}
