<?php

namespace App\Http\Livewire\User\Services;

use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;


class CreateBankAccount extends Component
{

    public $bvn;
    public $name;
    public $verify_name;
    public $bvnData = [];


    public function updatedBvn($bvn){
        $client = new Client();


        try {
            $response = $client->post('https://backend.wirelessbeta.com/api/v1/verification', [
                'headers' => [
                    'ApiKey' => env('WIRELESSBETA'),
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'type' => 'bvn',
                    'validation_number' => $bvn,
                ],
            ]);

            $data = $response->getBody()->getContents();
            $data = (json_decode($data, TRUE));
            // dd($data);
            // info($data);
            if ($data['status'] == '00') {
                $data = ($data['data']);
                $this->bvnData  =  $data;
                $this->verify_name = trim($data['LastName'].' '. $data['FirstName'].' '.$data['MiddleName']);
                $this->name =  $this->verify_name;

                


           

        }     
            $data['error']='Sorry, we unable to verify you BVN, Kindly check and try again';
            // return $data;
            // dd($data);


        }catch (RequestException $e) {
            // return $e;
            // Handle any exceptions or errors that occur during the request
            if ($e->getResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorMessage = $e->getResponse()->getBody()->getContents();
                $errorMessage = json_decode($errorMessage, TRUE);
                $errorMessage = $errorMessage['message'];
            } else {
                $statusCode = $e->getCode();
                $errorMessage = $e->getMessage();
            }
            // $this->addError('bvn', $errorMessage);
          $data['error']= $errorMessage;
          dd($data);
        //   return $data;
            // return response()->json(['status' => 'failed', 'error' => $errorMessage], $statusCode);
        } catch (ConnectException $e) {
            $statusCode = 500;
           
            $data['error']='Verification Failed:Could not connect to the server, Kindly check your connection.';
            return $data;
            

        }

    }

    function generateRandomString($length = 3) {
        $randomString = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function submit()
    {
        $this->validate(
            [
                'bvn' => 'required|numeric|digits:11',
                'name' => 'required|string',
            ]
        );
        $user =  User::where('id', auth()->user()->id)->first();
        $rand = $randomString = $this->generateRandomString();


         $client = new Client();

        try {
            $response = $client->post('https://backup.wirelessbeta.com/api/v1/create-virtual-account-manually', [
                'headers' => [
                    'Accept' => 'application/json',
                    "api-key"=>env('WIRELESSBETA')
                ],
                'form_params' => [
                    "firstname" => "DOLPHINSUB/". $this->bvnData['LastName'],
                    "lastname" => $this->bvnData['FirstName'],
                    "phone" => $user->mobile,
                    "bank_code" => "190",
                    "email" => $rand.$user->email,
                    "dob" => date('Y-m-d', strtotime($this->bvnData['DateOfBirth'])),
                    "bvn" => $this->bvn,
                ],
            ]);

            $data = $response->getBody()->getContents();

            // return $data;
            $data = (json_decode($data, TRUE));
            // return $data;

            info($data);

            if ($data['status']=="success") {
                $data = $data['account'];

        $general = gs();

        if ($general->rb) {

            $user->balance += $general->register_bonus;
            $user->account_number = $data['account_number'];
            $user->bank_code = $data['bank_id'];
            $user->bank_id = 190;
            $user->profile_complete = 1;
            $user->kv = 2;
            $user->save();

            $this->emit('successConfirmation', [
                'amount' => 0.0,
                'icon' =>'<i class="fa fa-check"></i>',
                'message' => "Successful create account ". $user->bank->bank_name." with account number " . $user->account_number ,
                'status' => "Success",
    
            ]);
            
        }






    }


    // info([['status' => 'failed', 'message' => 'Account Creation failed'], 401]);
} catch (RequestException $e) {
    // return $e;
    // Handle any exceptions or errors that occur during the request
    if ($e->getResponse()) {
        $statusCode = $e->getResponse()->getStatusCode();
        $errorMessage = $e->getResponse()->getBody()->getContents();
    } else {
        $statusCode = $e->getCode();
        $errorMessage = json_decode($e->getMessage(), TRUE);

    }
    info($errorMessage);
    
    $this->emit('successConfirmation', [
        'amount' => 0.0,
        'icon' =>'<i class="fa fa-times"></i>',
        'message' => "Faile to create account, ". (isset($errorMessage['message']) ? @$errorMessage['message'] : "Encounter error while generating your acccount number ... kindly contact support"),
        'status' => "Success",

    ]);
    // $notify[] = ['error', isset($errorMessage['message']) ? @$errorMessage['message'] : "Encounter error while generating your acccount number ... kindly contact support"];
    // return back()->withNotify($notify)->withInput($request->all());

    // info([['status' => 'failed', 'error' => isset($errorMessage['message']) ? @$errorMessage['message'] : "Encounter error while generating your acccount number ... kindly contact support", 'errors' => $errorMessage, 'user involve' => user()], $statusCode]);
} catch (ConnectException $e) {
    // ConnectException (connection error)
    $statusCode = 500;
    $errorMessage = 'Could not connect to the server, Kindly chack your connection.';
    $notify[] = ['error', $errorMessage];
    // return back()->withNotify($notify)->withInput($request->all());
    $this->emit('successConfirmation', [
        'amount' => 0.0,
        'icon' =>'<i class="fa fa-wifi"></i>',
        'message' => "Check your internet connect and try again",
        'status' => "Success",

    ]);

    // Create the JSON response
    // info([['status' => 'failed', 'error' => $errorMessage], $statusCode]);
}

      
           
        $this->reset(['bvn', 'name', 'verify_name']);
        // dd($this->plan);


    }
    public function render()
    {
        return view('livewire.user.services.create-bank-account');
    }
}
