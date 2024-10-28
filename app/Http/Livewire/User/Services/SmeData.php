<?php

namespace App\Http\Livewire\User\Services;

use Livewire\Component;
use App\Models\Service;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Vonage\Network;
class SmeData extends Component
{

    public $network;
    public $networks = [];
    public $phone_number;
    public $service;
    public $amount=0;
    public $plan;
    public $plans = [];
    public $transaction_pin;
    public $allPlans = [];
    public $filteredData = [];

    public $transaction;
    public $types  = [];
    public $typesPlans = [];

    public $type;

    public $discount;
    public $final_amount;


    public function updatedNetwork($net){
        $this->reset('plans');
        $this->reset('amount');

        // dd($this->allPlans);

        // $this->network = $net;
        if(!count($this->allPlans)){
            $this->addError('network', 'Selected network is not available at moment');
            return;
        }

        $this->typesPlans =  $this->allPlans[strtoupper($net)]??[];
        
        
        // dd($this->plans);
        // info($this->plans);

    }


    public function updatedType($t){


        // str_ends_with(strtolower($haystack), strtolower($needle))

        $filteredData = array_filter($this->typesPlans, function ($item) use ($t) {
            return str_ends_with(strtolower($item['name']), strtolower($t));
        });

        // $filteredData =  reset($filteredData);
        if(is_array($filteredData)){
            $this->plans =  $filteredData;
        }else{
            $this->plans =  [];
        }
        // $this->plans =  $filteredData;
        // info($filteredData);
      

    }
    public function updatedPlan($p){



        $filteredData = array_filter($this->plans, function ($item) use ($p) {
            return $item['planId'] === $p;
        });

        $filteredData =  reset($filteredData);

        // dd($filteredData);
        if (is_array($filteredData)){

            $this->amount = $filteredData['price']+($filteredData['price']*$this->service->markup_price/100);

            $this->discount =  ($this->amount*auth()->user()->userType->discount/100);

            $this->final_amount =  $this->amount;// - $this->discount;

         


        }else{
            $this->addError('general_error', 'Invalid Plan Selected');
            return;
        }
        // dd($filteredData);

        $this->filteredData = $filteredData;
        // dd($this->filteredData);

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
        //  dd($this->filteredData);

        $transactions = transactions(auth()->user(), $this->final_amount, $this->service->id, $this->transaction_pin,$this->phone_number);
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
            $response = $client->post('https://vtuapi.teetopdigitalapi.com/api/v1/data/buy', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization'=> env('TEETOP_AUTHORISATION'),
                
                ],
                'body' => json_encode([
                    'network' => $this->filteredData['network'],
                    'planId' => $this->filteredData['planId'],
                    'phone' => $this->phone_number,
                ]),
            ]);

            $data = $response->getBody()->getContents();
            // return $data;
            $tData = (json_decode($data, TRUE));
            if ($tData['data']) {
                $data = $tData['data'];

                $transaction->status_id = 5;
                $transaction->details = $transaction->details." ".  $data['message']; //trim(@$tData['content']['transactions']['product_name']." ". $transaction->details);
                $transaction->trx = $data['reference'];
                $log->status = 1;
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
                    'message' => $data['message'],//"Successful puchase of ". $this->service->name." of " .$general->cur_sym.$transaction->amount,
                    'status' => "Success",
        
                ]);
            }else{
                // $transaction->status_id = 6;
                // $log->status = 2;
                // $transaction->update();
                // $log->update();
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

            // dd($this->transaction);
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
        $this->networks = ['mtn' => 'MTN', 'glo' => 'Glo', '9Mobile' => '9Mobile', 'airtel' => 'Airtel'];
        $this->types = ['sme'=>'SME', 'sme2'=>'SME 2', 'dg'=>'DG', 'cg'=>'CG'];
        $client = new Client();


        try {
            $response = $client->get('https://vtuapi.teetopdigitalapi.com/api/v1/data', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization'=>env('TEETOP_AUTHORISATION'),
                ]

            ]);


            // return $request;
            $data = $response->getBody()->getContents();
            // return print_r($data);
            // dd($data);
            $data = (json_decode($data, TRUE));
            // return $tData;
            // info(['tdata'=>$data]);
            $data=$data['data'];
            $groupedData = array_reduce($data, function ($carry, $item) {
                $network = $item['network'];
                $carry[$network][] = $item;
                return $carry;
            }, []);

            // dd($groupedData);
            // dd($tData);
            $this->allPlans = $groupedData;
            // dd($this->allPlans);



         


        } catch (RequestException $e) {
            // info($e);

            if ($e->getResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorMessage = $e->getResponse()->getBody()->getContents();
                $errorMessage =  json_decode($errorMessage, TRUE);
                $errorMessage = @$errorMessage['error'];
                info($errorMessage);
                $errorMessage =  @$errorMessage['msg'];
            } else {
                $statusCode = $e->getCode();
                $errorMessage = $e->getMessage();
            }
          
            
            // info($errorMessage['error']);

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

        // dd($this->allPlans);
        // $this->phone_number =  auth()->user()->mobile;
     
    }

    public function render()
    {
        return view('livewire.user.services.sme-data');
    }
}
