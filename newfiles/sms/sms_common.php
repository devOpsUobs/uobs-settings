<meta charset="UTF-8">
<?php 
global $username, $password, $from;
$username = 'bpsc';
$password = 'techss@123';
$from = 'NON Branded';

function send($recipients, $message, $unicode)
{
	global $username, $password,$from;
	
	if($unicode == 1)
		$url = "http://Lifetimesms.com/plain?username=".$username."&password=".$password."&to=".$recipients."&type=unicode&from=".urlencode($from)."&message=".urlencode($message)."";
	else
		$url = "http://Lifetimesms.com/plain?username=".$username."&password=".$password."&to=".$recipients."&from=".urlencode($from)."&message=".urlencode($message)."";
	//Curl Start
	$ch  =  curl_init();
	$timeout  =  30;
	curl_setopt ($ch,CURLOPT_URL, $url) ;
	curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
	$response = curl_exec($ch);
	curl_close($ch) ; 
	//Write out the response
	return $response;
}

function balance()
{
	global $username, $password,$from;
	$url = "http://Lifetimesms.com/credit?username=".$username."&password=". $password;
	$ch  =  curl_init();
	$timeout  =  30;
	curl_setopt ($ch,CURLOPT_URL, $url) ;
	curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
	$response = curl_exec($ch);
	curl_close($ch) ; 
	//Write out the response
	echo $response;
}

function calculateSMS($response)
{
	$res_arr = explode(":",$response);
	$sms = 0;
	if(isset($res_arr[2]))
	{
		$count = explode(",",$res_arr[2]);
		$sms = $count[0];
	}
	else
	{
		if($res_arr[0] == "OK ")
			$sms = 1;
	}
	
	return str_replace('"', '', $sms); /// to remove double quotes from no the out put was like "2"
}
?>