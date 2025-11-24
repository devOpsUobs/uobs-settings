<?php

$username = 'intouch';
$password = 'intouch@123';
$from = 'SMARTSCHOOL';

function send($recipients, $message, $unicode)
{   
	$api_token = "28531107e9018c2cdf60b07af3f583a486fcbebfa8e3f69543dbbcc049ac";
	$api_secret = "InTouch@123";
	$to = $recipients; //"92xxxxxxxxxx";
	$from = "SMARTSCHOOL";
	//$message = "Testing SMS";
	//$url = "https://smartsms.pk/plain?api_token=".urlencode($api_token)."&api_secret=".urlencode($api_secret)."&to=".$to."&from=".urlencode($from)."&message=".urlencode($message)."";
	
	$url = "https://smartsms.pk/plain?api_token=".urlencode($api_token)."&api_secret=".urlencode($api_secret)."&to=".$to."&from=".urlencode($from)."&message=".urlencode($message)."";

	$ch  =  curl_init();
	$timeout  =  30;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$response = curl_exec($ch);
	curl_close($ch);

	return $response;
}



	$response = send('03435783878', 'Test', 0);
	print $response;
	//balance();
	
	?>