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

}
	?>
	