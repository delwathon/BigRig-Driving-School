<?php

namespace App\Http\Livewire\User\Services;

use App\Constants\Status;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class WalletTransfer extends Component
{

    public $username;
    public $verify_name;
    public $service;
    public $amount=0;
    public $recipient=null;
    public $transaction_pin;

    public $transaction;

    



  

    
    public function updatedUsername($card){
        $this->username = $card;
        $this->recipient = User::where('username', $this->username)->orwhere('account_number', $this->username)->first();
        if($this->recipient==null){
            $this->verify_name=null;
            $this->emit('successConfirmation', [
                'amount' => $this->amount,
                'icon' =>'<i class="fa fa-user"></i>',
                'message' =>  "User with with username or account number $this->username not found", //"Puchase of ". $this->service->name." of " .$general->cur_sym.$this->amount.' failed due to Insufficient fund',
                'status' => "Not Found",
            ]);
        }else{  
            $this->verify_name = "{$this->recipient->firstname} {$this->recipient->lastname} ({$this->recipient->username})";
        }
    }

    
    public function submit()
    {
        $this->validate(
            [
                'username' => 'required|string',
                'amount' => 'required|numeric|min:50',
            ]
        );


         $message = [];
         $general  = gs();

         if($this->recipient==null){
            $this->verify_name=null;
            $this->emit('successConfirmation', [
                'amount' => $this->amount,
                'icon' =>'<i class="fa fa-user"></i>',
                'message' =>  "User with with username or account number $this->username not found", //"Puchase of ". $this->service->name." of " .$general->cur_sym.$this->amount.' failed due to Insufficient fund',
                'status' => "Not Found",
            ]);
        }else{  
            $this->verify_name = "{$this->recipient->firstname} {$this->recipient->lastname} ({$this->recipient->username})";
        }
        $transactions = transactions(auth()->user(), $this->amount, $this->service->id, $this->transaction_pin,$this->username);

        if(count($transactions) < 3){
            $this->emit('successConfirmation', [
                'amount' => $this->amount,
                'icon' => '<i class="fa fa-times"></i>',
                'message' => "Puchase of " . $this->service->name . " of " . $general->cur_sym . $this->amount . ' Error Occurs',
                'status' => "failed",

            ]);

            return;
        }

        // if (in_array('transaction', array_keys($data)) && in_array('log', array_keys($data)) && in_array('status', array_keys($data))) {

        if(in_array('error', array_keys($transactions))){
            // dd($transaction);
            $this->emit('successConfirmation', [
                'amount' => $this->amount,
                'icon' =>$transactions['icon'],
                'message' =>  $transactions['error'], //"Puchase of ". $this->service->name." of " .$general->cur_sym.$this->amount.' failed due to Insufficient fund',
                'status' => $transactions['status'],
            ]);

            return;
        }





        // dd($transactions);
        $log =  $transactions['log'];
        $transaction = $transactions['transaction'];
        $log->status_id = 5;
        $log->status_id = 5;
        $log->update();
        $transaction->update();


        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->where('id', 7)->first();
        // dd($gate);


        $data                  = new Deposit();
        $data->user_id         = $this->recipient->id;
        $data->method_code     = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->method_currency_symbol = strtoupper($gate->symbol);
        $data->method_currency_id = $gate->id;
        $data->amount          = $this->amount;
        $data->charge          = 0;
        $data->status = Status::PAYMENT_SUCCESS;
        $data->rate            = $gate->rate;
        $data->final_amo       = $this->amount;
        $data->btc_amo         = 0;
        $data->btc_wallet      = "";
        $data->trx             = getTrx();
        $data->save();
        $user = User::find($data->user_id);
        $user->balance += $data->amount;
        $user->save();
       
        $transaction               = new Transaction();
        $transaction->user_id      = $data->user_id;
        $transaction->amount       = $data->amount;
        $transaction->post_balance = $user->balance;        
        $transaction->charge       = $data->charge;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Deposit Via ' . $data->gatewayCurrency()->name;
        $transaction->trx          = $data->trx;
        $transaction->remark       = 'Wallet Transfer';
        $transaction->status_id = 5;

        $transaction->save();

        $this->emit('successConfirmation', [
            'amount' => $this->amount,
            'icon' =>'<i class="fa fa-check"></i>',
            'message' => "Successful perfom ". $this->service->name." of " .$general->cur_sym.$transaction->amount." to {$this->username}",
            'status' => "Success",

        ]);
           
        $this->reset(['amount', 'recipient', 'username']);
        // dd($this->plan);


    }


    public function mount($service)
    {
        $this->service =  Service::where('id', $service)->first();
     
      
       
    }
    public function render()
    {
        return view('livewire.user.services.wallet-transfer');
    }
}
