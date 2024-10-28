<?php

namespace App\Http\Livewire\User\Services;

use App\Models\Service;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Livewire\Component;

class GiftingData extends Component
{
    public $network;
    public $networks = [];
    public $phone_number;
    public $service;
    public $amount;
    public $plan;
    public $plans = [];
    public $transaction_pin;
    public $transaction;
    public $discount;
    public $final_amount;



    public function updatedNetwork($net){
        $this->reset('plans');

        $client = new Client();
        $this->network = $net;


        try {
            $response = $client->get('https://api-service.vtpass.com/api/service-variations?serviceID='.$this->network.'-data', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization'=> env('VTPASS_AUTHORISATION'),
                    'api-key' => env('VTP_API_KEY'),
                    // "secret-key" => env('VTP_SECRET_KEY')
                    'public-key'=>env('VTP_PUBLIC_KEY'),
                ]

            ]);


            // return $request;
            $data = $response->getBody()->getContents();
            // return print_r($data);
            $tData = (json_decode($data, TRUE));
            // return $tData;
            // dd($tData);



            $tData = $tData['content'];
            // return $tData;
            // dd($tData);

            if (array_key_exists('errors', $tData)){
                // return $tData;
                $this->addError('general_error', $tData['errors']);
                return;
                // return response()->json(['status'=>'failed','error'=>$tData['errors']], 422);
            }


            $tData = $tData['varations'];
            // info($tData);
            $this->plans = $tData;
         


        } catch (RequestException $e) {

            if ($e->getResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorMessage = $e->getResponse()->getBody()->getContents();
            } else {
                $statusCode = $e->getCode();
                $errorMessage = $e->getMessage();
            }
            $this->emit('successConfirmation', [
                'amount' => $this->amount,
                'icon' =>'<i class="fa fa-times"></i>',
                'message' => $errorMessage,//"Puchase of ". $this->service->name." of " .$general->cur_sym.$transaction->amount.' failed : '. $errorMessage,
                'status' => "failed",
    
            ]);
            
            // return response()->json(['status'=>'failed','error' => $errorMessage], $statusCode);
        }
        catch (ConnectException $e) {
            // ConnectException (connection error)
            $statusCode = 500;
            $errorMessage = 'Could not connect to the server, Kindly chack your connection.';

            // Log::error(['Conncetion error' => $errorMessage]);
            $this->emit('successConfirmation', [
                'amount' => $this->amount,
                'icon' =>'<i class="fa fa-wifi"></i>',
                'message' => $errorMessage,
                'status' => "success",
            ]);
        }

    }

    public function updatedPlan($p){



        $filteredData = array_filter($this->plans, function ($item) use ($p) {
            return $item['variation_code'] === $p;
        });


        $filteredData = reset($filteredData);
        // dd($filteredData);

        // return print_r(is_array($filteredData));
        if (is_array($filteredData)){
            $this->amount = $filteredData['variation_amount'];
            $this->amount = $this->amount+($this->amount*$this->service->markup_price/100);

            $this->discount =  ($this->amount*auth()->user()->userType->discount/100);
            $this->final_amount =  $this->amount;// - $this->discount;
            // $plan = $filteredData;

            // return response()->json(['status'=>'success', 'message'=>'data plan list', 'data'=>$plan]);

        }else{
            $this->addError('general_error', 'Invalid Plan Selected');
            // return response()->json(['status' => 'failed', 'error' => 'Invalid Plan Selected'], 423);
        }
    }
    
    public function submit()
    {
        $this->validate(
            [
                'network' => 'required|string',
                'phone_number' => 'required|digits_between:10,15',
                'amount' => 'required|numeric|min:50',
                'plan' => 'required|string|'
            ]
        );


         $message = [];
         $general  = gs();

        $transactions = transactions(auth()->user(), $this->final_amount, $this->service->id,$this->transaction_pin, $this->phone_number);
        // if (in_array('transaction', array_keys($data)) && in_array('log', array_keys($data)) && in_array('status', array_keys($data))) {

        if(count($transactions) < 3){
            $this->emit('successConfirmation', [
                'amount' => $this->amount,
                'icon' => '<i class="fa fa-times"></i>',
                'message' => "Puchase of " . $this->service->name . " of " . $general->cur_sym . $this->amount . ' Error Occurs',
                'status' => "failed",

            ]);

            return;
        }
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
       
        $this->transaction =  $transaction;

        
           
        // dd($this->plan);


        $client = new Client();
        try {
            $response = $client->post('https://api-service.vtpass.com/api/pay', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization'=> env('VTPASS_AUTHORISATION'),
                   // 'api-key' => env('VTP_API_KEY'),
                 //   "secret-key" => env('VTP_SECRET_KEY')
                ],
                'body' => json_encode([
                    'request_id' => $transaction->trx,
                    'serviceID' => $this->network.'-data',
                    'amount' => $transaction->amount,
                    'phone' => $this->phone_number,
                    // 'billersCode'=>'08130584550',
                    'variation_code'=>$this->plan,
                ]),
            ]);

            $data = $response->getBody()->getContents();

            // return $data;
            $tData = (json_decode($data, TRUE));
            // dd($tData);
            // info($tData);

            if ($tData['code'] == '000') {
                // dd($tData);
                // info($tData['content']['transactions']['product_name']);
                $transaction->status_id = 5;
                $transaction->details = trim(@$tData['content']['transactions']['product_name']." ". $transaction->details);
                $log->status = 1;
                $log->status_id = 5;

                $transaction->update();
                $log->update();


               
                if($this->discount > 0){
                    $bonus =  bonusCreditTransaction(auth()->user(), $this->discount, $transaction->trx);
                    $blog =  $bonus['log'];
                    $btransaction = $bonus['transaction'];
                    $btransaction->status_id = 5;
                    $blog->status = 1;
                    $btransaction->update();
                    $blog->update();
                }

                $this->emit('successConfirmation', [
                    'amount' => $this->amount,
                    'icon' =>'<i class="fa fa-check"></i>',
                    'message' => "Successful puchase of ". $this->service->name." of " .$general->cur_sym.$transaction->amount,
                    'status' => "Success",
        
                ]);
            }else{
                // $transaction->status_id = 6;
                // $log->status = 2;
                // $transaction->update();
                // $log->status_id = 6;

                $transactions = creditTransaction(auth()->user(), $this->final_amount, $this->service->id, $this->transaction_pin,$this->phone_number);
                
                if(count($transactions) < 3){
                    $this->emit('successConfirmation', [
                        'amount' => $this->amount,
                        'icon' => '<i class="fa fa-times"></i>',
                        'message' => "Puchase of " . $this->service->name . " of " . $general->cur_sym . $this->amount . ' Error Occurs',
                        'status' => "failed",

                    ]);

                    return;
                }
                $log =  $transactions['log'];
                $transaction = $transactions['transaction'];
                $this->transaction->status_id =  6;
                $this->transaction->update();
                $transaction->status_id = 7;
                $transaction->details = "Reversal of ". $this->transaction->details;
                $log->status = 1;
                $transaction->update();
                $log->status_id = 7;

                $log->update();
                $this->emit('successConfirmation', [
                    'amount' => $this->amount,
                    'icon' =>'<i class="fa fa-times"></i>',
                    'message' => "Puchase of ". $this->service->name." of " .$general->cur_sym.$transaction->amount." Failed",
                    'status' => $tData['response_description'],
        
                ]);
            }

            $this->plan =null;
            $this->network = null;
            $this->amount=null;
        } catch (RequestException $e) {

            if ($e->getResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorMessage = $e->getResponse()->getBody()->getContents();
            } else {
                $statusCode = $e->getCode();
                $errorMessage = $e->getMessage();
            }

            $transactions = creditTransaction(auth()->user(), $this->amount, $this->service->id, $this->transaction_pin,$this->phone_number);
            
            if(count($transactions) < 3){
                $this->emit('successConfirmation', [
                    'amount' => $this->amount,
                    'icon' => '<i class="fa fa-times"></i>',
                    'message' => "Puchase of " . $this->service->name . " of " . $general->cur_sym . $this->amount . ' Error Occurs',
                    'status' => "failed",

                ]);

                return;
            }
            $log =  $transactions['log'];
            $transaction = $transactions['transaction'];
            $this->transaction->status_id =  6;
            $this->transaction->update();
            $transaction->status_id = 7;
            $transaction->details = "Reversal of ". $this->transaction->details;
            $log->status = 1;
            $transaction->update();
            $log->status_id = 7;

            $log->update();
            $this->emit('successConfirmation', [
                'amount' => $this->amount,
                'icon' =>'<i class="fa fa-times"></i>',
                'message' => "Puchase of ". $this->service->name." of " .$general->cur_sym.$transaction->amount.' failed : '. $errorMessage,
                'status' => "failed",
    
            ]);

            // $errorMessage->trx =  $transaction->trx;
            // dd($errorMessage);
           

        } catch (ConnectException $e) {
            // ConnectException (connection error)
            $statusCode = 500;
            $errorMessage = 'Could not connect to the server, Kindly chack your connection.';

            // Log::error(['Conncetion error' => $errorMessage]);
            $this->emit('successConfirmation', [
                'amount' => $this->amount,
                'icon' =>'<i class="fa fa-wifi"></i>',
                'message' => $errorMessage,
                'status' => "success",
    
            ]);


    
        }
    }
    public function mount($service)
    {
        $this->service =  Service::where('id', $service)->first();
        $this->networks = ['mtn' => 'MTN', 'glo' => 'Glo', 'etisalat' => '9Mobile', 'airtel' => 'Airtel'];
        // $this->phone_number =  auth()->user()->mobile;
        // $this->emit('successConfirmation', [
        //     'amount' => 500,
        //     'message' => "Thanks",
        //     'status' => "success",

        // ]);
    }

    public function render()
    {
        return view('livewire.user.services.gifting-data');
    }
}
