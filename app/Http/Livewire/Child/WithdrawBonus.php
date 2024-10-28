<?php

namespace App\Http\Livewire\Child;

use App\Constants\Status;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class WithdrawBonus extends Component
{


    public function withdraw(){
        $amount =  auth()->user()->bonus;

        if($amount <=0){
                // dd($transaction);
                $this->emit('successConfirmation', [
                    'amount' => $amount,
                    'icon' =>'<i class="fa fa-wallet"></i>',
                    'message' =>  "Insufficient Bonus", //"Puchase of ". $this->service->name." of " .$general->cur_sym.$this->amount.' failed due to Insufficient fund',
                    'status' => "Insufficient Bonus",
                ]);
    
                return;
        }
        
        $general  = gs();


        $bonus =  bonusCreditTransaction(auth()->user(), $amount, "Bonus Withrawal", "debit");
        $blog =  $bonus['log'];
        $btransaction = $bonus['transaction'];
        $btransaction->status_id = 5;
        $blog->status = 1;
        $btransaction->update();
        $blog->update();

        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->where('id', 7)->first();
        // dd($gate);


        $data                  = new Deposit();
        $data->user_id         =auth()->user()->id;//$this->recipient->id;
        $data->method_code     = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->method_currency_symbol = strtoupper($gate->symbol);
        $data->method_currency_id = $gate->id;
        $data->amount          = $amount;
        $data->charge          = 0;
        $data->status = Status::PAYMENT_SUCCESS;
        $data->rate            = $gate->rate;
        $data->final_amo       = $amount;
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
        $transaction->details      = 'Bonus Deposit Via ' . $data->gatewayCurrency()->name;
        $transaction->trx          = $data->trx;
        $transaction->remark       = 'Bonus Withdrawal';
        $transaction->status_id = 5;

        $transaction->save();

        $this->emit('successConfirmation', [
            'amount' => $amount,
            'icon' =>'<i class="fa fa-check"></i>',
            'message' => "Successful Bonus of {$general->cur_sym} {$transaction->amount} to main balance",
            'status' => "Success",

        ]);
           
        $this->reset();
        
    }
    public function render()
    {
        return view('livewire.child.withdraw-bonus');
    }
}
