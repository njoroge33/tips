<?php
namespace App\Helpers;


class Utils{

static public  function internationalizeNumber($msisdn)
	{

		//get the country dial code
		$dialCode = '254';//Yii::app()->params['DEFAULT_COUNTRY_DIAL_CODE'];
		$msisdnLength = 12; //Yii::app()->params['DEFAULT_COUNTRY_MSISDN_LENGTH'];
		//if the first number is 0
		if (substr($msisdn, 0, 1) == '+' and  strlen($msisdn)==13) {
			$msisdn = substr($msisdn, 1);
		}

		//if the first number is 0, add default dial code
		if (substr($msisdn, 0, 1) == 0 and  strlen($msisdn)==10) {
			$msisdn = $dialCode . substr($msisdn, 1);
		}
		if (substr($msisdn, 0, 1) == 7 and strlen($msisdn)==9 ) {
			$msisdn = $dialCode.$msisdn;
		}

		//if the dialcode matches the default one & its the expected length
		if (substr($msisdn, 0, strlen($dialCode)) == $dialCode &&
				strlen($msisdn) == $msisdnLength) {
			return $msisdn;
		}
		return 0;
	}

	static public  function SendMessage($msisdn, $message)
	{
		$sms=["OTP_URL" => 'https://pyris.socialcom.co.ke/api/PushSMS.php?', 
        "OTP_USERNAME" => 'sub_api_user', 
        "OTP_PASSWORD" => '73wjzRNPAzgT8EZ1JQv8hpD2BsQ9', 
        "OTP_SHORTCODE" => 'SOCIALCOM'];

		$curl = curl_init();
            
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json',));

		# send request to send otp via sms
		$params = [
			'username' => $sms['OTP_USERNAME'], 
			'password' => $sms['OTP_PASSWORD'], 
			'shortcode'=> $sms['OTP_SHORTCODE'], 
			'mobile'=> $msisdn, 
			'message'=> $message
		];
		curl_setopt($curl, CURLOPT_URL, $sms['OTP_URL'].http_build_query($params));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$curl_response = curl_exec($curl);
		return json_decode($curl_response);

	}
}
	?>
	