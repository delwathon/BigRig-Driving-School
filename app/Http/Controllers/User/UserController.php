<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Lib\GoogleAuthenticator;
use App\Models\CommissionLog;
use App\Models\Deposit;
use App\Models\Form;
use App\Models\Game;
use App\Models\GameLog;
use App\Models\Referral;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function home() {
        $pageTitle                 = 'Dashboard';
        $services                     = Service::active()->get();
        $user                      = auth()->user();
        $widget['total_balance']   = $user->balance;
        $widget['total_bonus']   = $user->bonus;
        $widget['total_deposit']   = Deposit::successful()->where('user_id', $user->id)->sum('amount');
        $widget['total_withdrawn'] = Withdrawal::approved()->where('user_id', $user->id)->sum('amount');

        $widget['total_invest'] = GameLog::where('user_id', $user->id)->sum('invest');
        $widget['total_win']    = GameLog::win()->where('user_id', $user->id)->sum('invest');
        $widget['total_loss']   = GameLog::loss()->where('user_id', $user->id)->sum('invest');
        // return $this->activeTemplate;
        return view($this->activeTemplate . 'user.dashboard', compact('pageTitle', 'services', 'widget', 'user'));
    }


    public function submitNFT(Request $request) {


        $user = User::where('id', Auth::user()->id)->first();
        // if ($request->hasFile('nft')) {
        //     try {
        //         $old         = $user->nft;
        //         $user->nft = fileUploader($request->nft, getFilePath('nft'), getFileSize('nft'), $old);
        //     } catch (\Exception$exp) {
        //         $notify[] = ['error', 'Couldn\'t upload your NFT image'];
        //         return back()->withNotify($notify);
        //     }
        // }

        $user->nft = $request->nft;
        $wallet = Wallet::find($request->wallet);
        $hash = ['network'=>$wallet->network, 'wallet'=>$wallet->wallet];
        // return json_encode($hash);
        $user->txHash = json_encode($hash);
        // $user->nft = $request->amount;


        $user->update();
        $notify[] = ['success', 'NFT Payment  successfully'];
        return redirect()->back()->withNotify($notify);

        // return $request->all();
    }

    public function depositHistory(Request $request) {
        $pageTitle = 'Deposit History';
        $deposits  = auth()->user()->deposits()->searchable(['trx'])->with(['gateway'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.deposit_history', compact('pageTitle', 'deposits'));
    }

    public function show2faForm() {
        $general   = gs();
        $ga        = new GoogleAuthenticator();
        $user      = auth()->user();
        $secret    = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->site_name, $secret);
        $pageTitle = '2FA Setting';
        return view($this->activeTemplate . 'user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request) {
        $user = auth()->user();
        $this->validate($request, [
            'key'  => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user, $request->code, $request->key);

        if ($response) {
            $user->tsc = $request->key;
            $user->ts  = 1;
            $user->save();
            $notify[] = ['success', 'Google authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request) {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user     = auth()->user();
        $response = verifyG2fa($user, $request->code);

        if ($response) {
            $user->tsc = null;
            $user->ts  = 0;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }

        return back()->withNotify($notify);
    }

    public function transactions(Request $request) {
        $pageTitle    = 'Transactions';
        // $remarks      = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $remarks = TransactionType::get();
        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.transactions', compact('pageTitle', 'transactions', 'remarks'));
    }

    public function kycForm() {

        if (auth()->user()->kv == 2) {
            $notify[] = ['error', 'Your KYC is under review'];
            return to_route('user.home')->withNotify($notify);
        }

        if (auth()->user()->kv == 1) {
            $notify[] = ['error', 'You are already KYC verified'];
            return to_route('user.home')->withNotify($notify);
        }

        $pageTitle = 'KYC Form';
        $form      = Form::where('act', 'kyc')->first();
        return view($this->activeTemplate . 'user.kyc.form', compact('pageTitle', 'form'));
    }

    public function kycData() {
        $user      = auth()->user();
        $pageTitle = 'KYC Data';
        return view($this->activeTemplate . 'user.kyc.info', compact('pageTitle', 'user'));
    }

    public function kycSubmit(Request $request) {
        $form           = Form::where('act', 'kyc')->first();
        $formData       = $form->form_data;
        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData       = $formProcessor->processFormData($request, $formData);
        $user           = auth()->user();
        $user->kyc_data = $userData;
        $user->kv       = 2;
        $user->save();

        $notify[] = ['success', 'KYC data submitted successfully'];
        return to_route('user.home')->withNotify($notify);
    }

    public function attachmentDownload($fileHash) {
        $filePath  = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general   = gs();
        $title     = slug($general->site_name) . '- attachments.' . $extension;
        $mimetype  = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

    public function userData() {
        $user = auth()->user();


        // return $user;

        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }

        $pageTitle = 'User Data';
        return view($this->activeTemplate . 'user.user_data', compact('pageTitle', 'user'));
    }

    public function userDataSubmit(Request $request) {
        $user = auth()->user();

        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }

        $request->validate([
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'pin'  => 'required|confirmed|digits:4',
            'phone_number' => 'required|digits_between:10,15'
        ]);
        $user->firstname = $request->firstname;
        $user->lastname  = $request->lastname;
        $user->mobile   =   $request->phone_number;
        $user->pin = Hash::make($request->pin);
        $user->address   = [
            'country' => @$user->address->country,
            'address' => $request->address,
            'state'   => $request->state,
            'zip'     => $request->zip,
            'city'    => $request->city,
        ];
        $user->save();

        // return $user;


        // $client = new Client();

        // try {
        //     $response = $client->post('https://backup.wirelessbeta.com/api/v1/create-virtual-account-manually', [
        //         'headers' => [
        //             'Accept' => 'application/json',
        //             "api-key"=>env('WIRELESSBETA')
        //         ],
        //         'form_params' => [
        //             "firstname" => "DOLPHINSUB/$user->firstname",
        //             "lastname" => $user->lastname,
        //             "phone" => $user->mobile,
        //             "bank_code" => "190",
        //             "email" => "vbc$user->email",
        //             "dob" => "04-04-1994",
        //             "bvn" => "22438989193",
        //         ],
        //     ]);

        //     $data = $response->getBody()->getContents();

        //     // return $data;
        //     $data = (json_decode($data, TRUE));
        //     // return $data;

        //     info($data);

        //     if ($data['status']=="success") {
        //         $data = $data['account'];

                $general = gs();

                if ($general->rb) {
        
                    $user->balance += $general->register_bonus;
                    // $user->account_number = $data['account_number'];
                    // $user->bank_code = $data['bank_id'];
                    // $user->bank_id = 190;
                    $user->profile_complete = 1;
                    $user->kv = 3;
                    $user->save();
                    $transaction               = new Transaction();
                    $transaction->user_id      = $user->id;
                    $transaction->amount       = $general->register_bonus;
                    $transaction->charge       = 0;
                    $transaction->trx_type     = '+';
                    $transaction->details      = 'You have got register bonus';
                    $transaction->remark       = 'register_bonus';
                    $transaction->trx          = getTrx();
                    $transaction->post_balance = $user->balance;
                    $transaction->save();
        
                    notify($user, 'REGISTER_BONUS', [
                        'username'     => $user->username,
                        'amount'       => showAmount($general->register_bonus),
                        'trx'          => $transaction->trx,
                        'post_balance' => showAmount($user->balance),
                    ]);
                }




        //     }


        //     info([['status' => 'failed', 'message' => 'Account Creation failed'], 401]);
        // } catch (RequestException $e) {
        //     // return $e;
        //     // Handle any exceptions or errors that occur during the request
        //     if ($e->getResponse()) {
        //         $statusCode = $e->getResponse()->getStatusCode();
        //         $errorMessage = $e->getResponse()->getBody()->getContents();
        //     } else {
        //         $statusCode = $e->getCode();
        //         $errorMessage = json_decode($e->getMessage(), TRUE);

        //     }
        //     info($errorMessage);
        //     $notify[] = ['error', isset($errorMessage['message']) ? @$errorMessage['message'] : "Encounter error while generating your acccount number ... kindly contact support"];
        //     return back()->withNotify($notify)->withInput($request->all());

        //     // info([['status' => 'failed', 'error' => isset($errorMessage['message']) ? @$errorMessage['message'] : "Encounter error while generating your acccount number ... kindly contact support", 'errors' => $errorMessage, 'user involve' => user()], $statusCode]);
        // } catch (ConnectException $e) {
        //     // ConnectException (connection error)
        //     $statusCode = 500;
        //     $errorMessage = 'Could not connect to the server, Kindly chack your connection.';
        //     $notify[] = ['error', $errorMessage];
        //     return back()->withNotify($notify)->withInput($request->all());


        //     // Create the JSON response
        //     info([['status' => 'failed', 'error' => $errorMessage], $statusCode]);
        // }



      

        $notify[] = ['success', 'Registration process completed successfully'];
        // return $user;
        return to_route('user.home')->withNotify($notify);
    }

    public function referrals() {
        $pageTitle = 'Referrals';
        $user      = User::where('id', auth()->id())->with('allReferrals')->firstOrFail();
        $maxLevel  = Referral::max('level');
        // return $maxLevel;
        return view($this->activeTemplate . 'user.referrals', compact('pageTitle', 'user', 'maxLevel'));
    }

    public function gameLog() {
        $pageTitle = "Game Logs";
        $logs      = GameLog::where('user_id', auth()->id())->where('status', 1)->latest()->with('game')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.game_log', compact('pageTitle', 'logs'));
    }

    public function commissionLog() {
        $pageTitle = "Commission Logs";
        $logs      = CommissionLog::where('user_id', auth()->id())->with('userFrom')->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.commission_log', compact('pageTitle', 'logs'));
    }
}
