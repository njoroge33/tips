<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Payments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helpers\Utils;
use Carbon\Carbon;

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

      Log::info("mPesa Confirmation | Request:=> ".json_encode($data)."| metadata =>".json_encode($metadata));

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
        // Utils::SendMessage($payment->MSISDN, $message);

        $profile = Profile::where(['msisdn'=> $payment->MSISDN])->first();

        function randomPassword() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 6; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        if($profile){
                Log::info($payment['MSISDN']."|Profile found renewal for amount".$payment['amount']);
            
                if ($payment['amount'] == 50 && $profile->unique_key_expiry <= Carbon::now() ){
                    // add 3 days to date
                    $profile['unique_key_expiry'] = date('y:m:d H:i:s', strtotime('+3 days'));
                    $profile->save();
        
                } elseif ($payment['amount'] == 100 && $profile->unique_key_expiry <= Carbon::now()){
                    // add 7 days to date
                    $profile['unique_key_expiry'] = date('y:m:d H:i:s', strtotime('+7 days'));
                    $profile->save();
                }elseif ($payment['amount'] == 50 && $profile->unique_key_expiry > Carbon::now() ){
                    // add 3 days to date
                    $profile['unique_key_expiry'] = date('y:m:d H:i:s', strtotime($profile->unique_key_expiry. '+3 days'));
                    $profile->save();
                }elseif ($payment['amount'] == 100 && $profile->unique_key_expiry > Carbon::now() ){
                    // add 7 days to date
                    $profile['unique_key_expiry'] = date('y:m:d H:i:s', strtotime($profile->unique_key_expiry. '+7 days'));
                    $profile->save();
                }else{
                    return redirect()->route('subscribe')->withError('You entered the wrong amount please choose between 50 and 100 Kshs');
                }

                $message = "<#SURETIPS>: Dear $profile->profile_name ,Your subscribtion has been renewed successfully.It will be expire on $profile->uniqe_key_expiry.";
                // Utils::SendMessage($user->msisdn, $message);

                return redirect()->route('login')->withSuccess('Your subscribtion has been renewed successfully.Please login');
        }else{
            Log::info($payment['MSISDN']."|No profile create a new profile");

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
                    $user['unique_key_expiry'] = date('y:m:d H:i:s', strtotime('+3 days'));
                    $user->save();
        
                } elseif ($payment['amount'] == 100){
                    // add 7 days to date
                    $user['unique_key_expiry'] = date('y:m:d H:i:s', strtotime('+7 days'));
                    $user->save();
                }

                $message = "<#SURETIPS>: Dear $user->profile_name ,Your Unique Key is $user->unique_key . It will be expire on $user->uniqe_key_expiry.";
                // Utils::SendMessage($user->msisdn, $message);

                return redirect()->route('login')->withSuccess('Unique key successfully sent to your phone.Please login');
            }
        }
        
        
    }

    }
}
