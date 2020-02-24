<?php 
class rzvy_nexmo{
	/* Send SMS using Nexmo */
	public function rzvy_send_nexmo_sms($phone,$sms_body,$rzvy_nexmo_api_key,$rzvy_nexmo_api_secret,$rzvy_nexmo_from) {
		/* Prepare data for GET request */
		$queryinfo = array('api_key' => $rzvy_nexmo_api_key, 'api_secret' => $rzvy_nexmo_api_secret, 'to' => $phone, 'from' => $rzvy_nexmo_from, 'text' => $sms_body);
		$url = 'https://rest.nexmo.com/sms/json?' . http_build_query($queryinfo);
		
		/* Send the GET request with cURL */
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		return $response;
	}
}