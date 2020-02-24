<?php 
class rzvy_textlocal{
	/* Send SMS using TextLocal */
	public function rzvy_send_textlocal_sms($phone,$sms_body,$rzvy_textlocal_api_key,$rzvy_textlocal_country,$rzvy_textlocal_sender) {
		/* Account details */
		$apiKey = urlencode($rzvy_textlocal_api_key);
		
		$textlocal_url = 'https://api.txtlocal.com/send/';
		if($rzvy_textlocal_country == 'India'){
			$textlocal_url = 'https://api.textlocal.in/send/';
		}
		
		/* Message details */
		$sender = urlencode($rzvy_textlocal_sender);
		$message = rawurlencode($sms_body);
	 
		/* Prepare data for GET request */
		$queryinfo = array('apikey' => $apiKey, 'numbers' => $phone, "sender" => $sender, "message" => $message);
	 
		/* Send the GET request with cURL */
		$url = $textlocal_url.'?'.http_build_query($queryinfo);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
}