<?php

namespace App\Http\Controllers\Gateway;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BankPaymentProcessing extends Controller
{
    //

    public function webhook(Request $request){


        Log::alert(['unvalidated request'=>$request->all()]);
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|digits:10',
            'amount'=>'required|numeric',
            'transaction_reference'=>'required|string|min:10|unique:transactions,trx',
            'narration'=>'required|string',
            'status'=>'required|string',
            'transaction_date'=>'required|string'

        ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 406);
        // }
        if ($validator->fails()) {
            $errorMessages = [];
            foreach ($validator->errors()->getMessages() as $field => $errors) {
                foreach ($errors as $error) {
                    $errorMessages = [
                        'status' => 'failed',
                        'error' =>  $error
                    ];
                }
            }
            return response()->json($errorMessages, 406);
        }

        // info(['request'=>$request->all()]);

       

        $user = User::where('account_number', $request->account_number)->first();

        if($user ==null){
            return response()->json(['status'=>'failed', 'message'=>'Account Not found'], 422);
        }


        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->where('id', 2)->first();
        // dd($gate);


        $data                  = new Deposit();
        $data->user_id         = $user->id;
        $data->method_code     = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->method_currency_symbol = strtoupper($gate->symbol);
        $data->method_currency_id = $gate->id;
        $data->amount          = $request->amount;
        $data->charge          = 0;
        $data->status = Status::PAYMENT_SUCCESS;
        $data->rate            = $gate->rate;
        $data->final_amo       = $request->amount;
        $data->btc_amo         = 0;
        $data->btc_wallet      = "";
        $data->trx             = $request->transaction_reference;
        $data->save();
        $user->balance += $data->amount;
        $user->save();
       
        $transaction               = new Transaction();
        $transaction->user_id      = $data->user_id;
        $transaction->amount       = $data->amount;
        $transaction->post_balance = $user->balance;        
        $transaction->charge       = $data->charge;
        $transaction->trx_type     = '+';
        $transaction->details      = $request->narration.' ' . $data->gatewayCurrency()->name;
        $transaction->trx          = $data->trx;
        $transaction->remark       = 'Bank Funding Transfer';
        $transaction->status_id = 5;

        $transaction->save();

        $response = ['status' => 'success', 'message' => 'Account Credit successfully'];
        info(['request'=>$request->all(), 'response'=>$response]);
        // return $accountWallet;
        return response()->json($response, 200);


    }
}
