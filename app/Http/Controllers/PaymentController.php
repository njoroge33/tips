<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Payments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    
    public function confirmation(Request $request)
    {
        $data = json_decode($request ->getContent(),true);
      $metadata   =[
        "IP"=> $request->ip()??0,
        "request" => json_encode($data),
        "host"=>$request->getHost()
      ];

$validator = Validator::make($data,
        array(
            'MSISDN'  =>'required|numeric|min:254000000000|max:254999999999',
            'BusinessShortCode' =>    'required|numeric',
            'TransID' =>    'required|alpha_num|min:6',
            'BillRefNumber' => 'required|string|min:3',
            'TransAmount' => 'required|numeric|min:10',
            'FirstName' => 'required|alpha_num|min:3',
            'OrgAccountBalance'=>'required|numeric',
        ));

        // if ($validator->fails()) {
        //   Log::error($validator->errors()->all());
        //    return response()->json(['success'=>false,"message"=>"Error we are unable to complete your request "]);

        //         }
    $payment=  Payments::create([
         'MSISDN'=> $data['MSISDN'],
         'businessNumber'=>$data['BusinessShortCode'],
         'receiptNumber'=> $data['TransID'],
         'accountNumber'=>$data['BillRefNumber'],
         "amount"=>(int)$data['TransAmount'],
         'customerName'=>$data['FirstName']." ".$data['MiddleName']." ".$data['LastName'],
         'metadata'=>json_encode($metadata),
         'org_balance' =>(int)$data['OrgAccountBalance'],
     ]);

     if($payment)
    {
        $message = "<#SURETIPS>: Dear .$payment -> customerName ,Your deposit for KSH .$payment->amount was a success";
        Utils::SendMessage($payment->MSISDN, $message);

        function randomPassword() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        $user=  Profile::create([
            'profile_uuid'=> Str::uuid(),
            'msisdn' => $payment['MSISDN'],
            'profile_name' => $payment['customerName'],
            'unique_key'=> randomPassword(),
            // 'unique_key_expiry' => ,
        ]);

        if($user){

            if ($payment['amount'] == 50){
                // add 3 days to date
                $user['unique_key_expiry'] = date('y:m:d', strtotime('+3 days'));
                $user->save();
    
            } elseif ($payment['amount'] == 100){
                // add 3 days to date
                $user['unique_key_expiry'] = date('y:m:d', strtotime('+7 days'));
                $user->save();
            }

            $message = "<#SURETIPS>: Dear .$user->profile_name ,Your Unique Key is .$user->uniqe_key . It will be expire on .$user->uniqe_key_expiry.";
            Utils::SendMessage($user->msisdn, $message);
        }
        
        
    }
        // $response = json_decode($request -> getContent());

        // if($response->Body->stkCallback->ResultCode == 0){
        //     $trn = new Deposit;

        //     $trn -> profile_id = auth()->user()->profile_id;
        //     $trn -> uuid = Str::uuid();
        //     $trn-> result_desc = $response->Body->stkCallback->ResultDesc;
        //     $trn-> merchant_request_id = $response->Body->stkCallback->MerchantRequestID;
        //     $trn-> checkout_request_id = $response->Body->stkCallback->CheckoutRequestID;
        //     $trn-> amount = $response->Body->stkCallback->CallbackMetadata->Item[0]->Value;
        //     $trn-> mpesa_receipt_number = $response->Body->stkCallback->CallbackMetadata->Item[1]->Value;
        //     $trn-> transaction_date = $response->Body->stkCallback->CallbackMetadata->Item[2]->Value;
        //     $trn-> phone_number = $response->Body->stkCallback->CallbackMetadata->Item[3]->Value;
            
        //     if($trn->save()){
        //         $profile =auth()->user();
        //         $balance= (int)$profile->accountBalance;
        //         $profile-> accountBalance = ($balance + (int)$trn-> amount);
        //         $profile->save();

        //         return redirect() -> route('bids')->withSuccess("You sucessfully deposited Kshs '.$trn-> amount' ");
        //     }
        // }
    }
}
