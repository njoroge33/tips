<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers\Utils;
use App\Models\CheckoutRequests;
use Illuminate\Http\Response;

class SubscribeController extends Controller
{
    public function index() {
	
        return view('subscribe');
    }
    public function store(Request $request) {
        
                $this->validate($request, [
                    'amount'=>'required',
                    // 'terms'=>'required',
                    'phone'=> 'required|regex:/(07)[0-9]{8}/',
                    // 'password'=> 'required|confirmed',
                ]);

                $input = $request->all();
                $metadata   =[
                  "IP"=> $request->ip()??0,
                  "request" => json_encode($input),
                  "host"=>$request->getHost()
                ];
              
                // dd($request);
                $mobilenumber = Utils::internationalizeNumber($request ->phone);

                $checkout = CheckoutRequests::create([
                    'msisdn'=> $mobilenumber,
                    "amount"=>$request->amount,
                    'overallstatus'=> "NEW",
                    'overallstatusHistory'=>"New checkout request",
                    'metadata'=>json_encode($metadata)
                ]);
        
                $mpesa=[
                    'MPESA_STK_URL' =>"https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest",
                    'MPESA_CREDENTIALS_URL' =>"https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials",
                'PASS_KEY'  =>"bb6e5fae3d046a6b9efdeefc94baf7b05475f768543d01fd527e465a9d042d12",
                'CONSUMER_KEY' =>"KxRADqUVyJky41GmHGq8mALgdJ9lCdwp",
                 'CONSUMER_SECRET' =>"xaOYS6Ll5DY9Twku",
                'MPESA_PAYBILL' => "633381",
                 'MPESA_CALLBACK_URL' => "https://api.dandiadoh.com:8085/services/payments/stkresults",
                    ];
        
                    $timestamp=Carbon::rawParse('now')->format('YmdHms');
                
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $mpesa['MPESA_STK_URL']);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken($mpesa)));
                $curl_post_data = [
                    //Fill in the request parameters with valid values
                    'BusinessShortCode' => $mpesa['MPESA_PAYBILL'],
                    'Password' => base64_encode($mpesa['MPESA_PAYBILL'].$mpesa['PASS_KEY'].$timestamp),
                    'Timestamp' => $timestamp,
                    'TransactionType' => 'CustomerPayBillOnline',
                    'Amount' => (int)$request->amount,
                    'PartyA' => $mobilenumber, // replace this with your phone number
                    'PartyB' => $mpesa['MPESA_PAYBILL'],
                    'PhoneNumber' => $mobilenumber, // replace this with your phone number
                    'CallBackURL' => 'https://a120cc1789e0.ngrok.io/api/mpesa',
                    'AccountReference' => "njoroge",
                    'TransactionDesc' => "Testing stk push on sandbox"
                ];
                $data_string = json_encode($curl_post_data);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
                $curl_response = curl_exec($curl);
                // $this -> mpesaConfirmation(Request);
                $results = json_decode($curl_response,true);
                if(isset($results['ResponseCode'])){
                    $checkout->overallstatus ="PENDING";
                    $checkout->overallstatusHistory ="Pending user to enter PIN";
                    $checkout->merchantRequestID =$results['MerchantRequestID'];
                    $checkout->checkoutRequestID  =$results['CheckoutRequestID'];
                    $checkout->save();
                    $message = 'Please check your phone and Enter your M-Pesa PIN to Confirm Payment' ;
                    return redirect()->back()->withSuccess($message);
                }
                else{
                    $checkout->overallstatus ="FAILED";
                    $checkout->overallstatusHistory ="Unable to complete request. Error =>".$results['errorMessage']??'unknown';
                    $checkout->save();
                    $message = 'Failed, Go to Lipa na M-PESA option from the MPESA menu and send at least KSh 10 to PayBill Business Number 633381, with account number ' ;
                    return redirect()->back()->withError($message);
                }
            }
        
            public function generateAccessToken($params)
            {
                $credentials = base64_encode($params['CONSUMER_KEY'] . ":" . $params['CONSUMER_SECRET']);
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $params['MPESA_CREDENTIALS_URL']);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
                curl_setopt($curl, CURLOPT_HEADER,false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $curl_response = curl_exec($curl);
                $access_token=json_decode($curl_response);
                return $access_token->access_token;
            }

}
