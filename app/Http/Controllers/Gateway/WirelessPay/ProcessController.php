<?php

namespace App\Http\Controllers\Gateway\WirelessPay;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    //


    public static function process($deposit) {

        

        $wp = json_decode($deposit->gatewayCurrency()->gateway_parameter);

        $alias = $deposit->gateway->alias;
        info($deposit);

        // $send['ApiKey']      = $wp->ApiKey;
        // $send['preferred_bank_code']      = $wp->preferred_bank_code;
        
        // $send['email']    = auth()->user()->email;
        $send['amount']   = $deposit->final_amo;
        $send['currency'] = $deposit->method_currency;
        $send['invoice_reference']      = $deposit->trx;
        // return $send;
        $send['view']     = 'user.payment.' . $alias;
        $send['customer_phone'] = auth()->user()->mobile;
        $send['deposit'] =  $deposit;

        $client = new Client();

        try {
            $response = $client->post('http://127.0.0.1:8000/api/v1/third-party/temporary-account-checkout', [
                'headers' => [
                    'Accept' => 'application/json',
                    "ApiKey"=>"P4h1e2bahv6pWvZQReHL"
                ],
                'form_params' => $send,
            ]);

            $data = $response->getBody()->getContents();

            // return $data;
            $data = (json_decode($data, TRUE));
            if(isset($data['user'])){
                $send['payment'] =  $data['user'];
            }
            // return $data;
            // info($data);


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
            return response()->json(['status' => 'failed', 'error' => isset($errorMessage['message']) ? @$errorMessage['message'] : "Encounter error while generating your acccount number ... kindly contact support", 'errors' => $errorMessage], $statusCode);
        } catch (ConnectException $e) {
            // ConnectException (connection error)
            $statusCode = 500;
            $errorMessage = 'Could not connect to the server, Kindly check your connection.';

            // Create the JSON response
            return response()->json(['status' => 'failed', 'error' => $errorMessage], $statusCode);
        }






        
        info($send);
      

        return json_encode($send);
    }

    public function ipn(Request $request) {

        $request->validate([
            'reference'       => 'required',
            'paystack-trxref' => 'required',
        ]);
        $track       = $request->reference;
        $deposit     = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        $wp = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $secret_key  = $wp->ApiKey;

        $result = [];
        //The parameter after verify/ is the transaction reference to be verified
        // $url = 'http://127.0.0.1:8000/api/v1/third-party';// . $track;
        // $ch  = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, ['ApiKey:' . $secret_key]);
        // $response = curl_exec($ch);
        // curl_close($ch);
        info($request->all());



        $client = new Client();

        try {
            $response = $client->post('https://safe.wbalite.com/api/v1/users/api-register', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => $data,
            ]);

            $data = $response->getBody()->getContents();

            // return $data;
            $data = (json_decode($data, TRUE));
            // return $data;
          
            




        
        

                




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

            return response()->json(['status' => 'failed', 'error' => isset($errorMessage['message']) ? @$errorMessage['message'] : "Encounter error while generating your acccount number ... kindly contact support", 'errors' => $errorMessage], $statusCode);
        } catch (ConnectException $e) {
            // ConnectException (connection error)
            $statusCode = 500;
            $errorMessage = 'Could not connect to the server, Kindly check your connection.';

            // Create the JSON response
            return response()->json(['status' => 'failed', 'error' => $errorMessage], $statusCode);
        }


        if ($response) {
            $result = json_decode($response, true);

            if ($result) {
                if ($result['data']) {

                    $deposit->detail = $result['data'];
                    $deposit->save();

                    if ($result['data']['status'] == 'success') {

                        $am  = $result['data']['amount'] / 100;
                        $sam = round($deposit->final_amo, 2);

                        if ($am == $sam && $result['data']['currency'] == $deposit->method_currency && $deposit->status == Status::PAYMENT_INITIATE) {
                            PaymentController::userDataUpdate($deposit);
                            $notify[] = ['success', 'Payment captured successfully'];
                            return to_route(gatewayRedirectUrl(true))->withNotify($notify);
                        } else {
                            $notify[] = ['error', 'Less amount paid. Please contact with admin.'];
                        }
                    } else {
                        $notify[] = ['error', $result['data']['gateway_response']];
                    }
                } else {
                    $notify[] = ['error', $result['message']];
                }
            } else {
                $notify[] = ['error', 'Something went wrong while executing'];
            }
        } else {
            $notify[] = ['error', 'Something went wrong while executing'];
        }
        return to_route(gatewayRedirectUrl())->withNotify($notify);
    }
}
