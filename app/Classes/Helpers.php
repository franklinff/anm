<?php
namespace App\Classes;

class Helpers{

	/**
	 *Render hindi text for storing purpose
	 *@param string $phc, string $type
	 *@return string
	 */
	public static function renderHindi($phc, $type)
	{
		$topphctext = '';
		$cnt = count($phc);
	    $last = $phc[$cnt-1];
	    if($cnt == 1){
	    	$topphctext .= $type.' '.$phc[0];
	    }
	    else{
		    for($i = 0; $i < $cnt; $i++){
		        if($last == $phc[$i]){
		            $topphctext = rtrim($topphctext, ', ').' तथा '.$type.' '.$phc[$i].'';
		        }else{
		            $topphctext .= $type.'  '.$phc[$i].', ';
		        }
		    }
	    }
	    return $topphctext;
	}




	/**
	 *Send a sms
	 *@param string $sms, string $mobile //maybe comma separated
	 *@return JSON
	 */
	public static function sendSms($sms, $mobile)
	{
		//return ["status" => true, "message" => "sms sent successfully"];
        //print_r($sms);
        //exit;
		$username = "";
		$password = "";
		$senderid = "RAJSMS";
		$deptSecureKey = "";
		$key = hash('sha512',trim($username).trim($senderid).trim($sms).trim($deptSecureKey));
		$url = "https://msdgweb.mgov.gov.in/esms/sendsmsrequest";
        $encryp_password = sha1(trim($password));
		$data = array(
		    "username" => trim($username),
		    "password" => trim($encryp_password),
		    "senderid" => trim($senderid),
		    "content" => trim($sms),
		    "smsservicetype" =>"singlemsg",
		    "mobileno" =>trim($mobile),
		    "key" => trim($key)
		);
		return self::postCurl($url, $data);
	}

    public static function sendSmsUnicode($sms, $mobile)
    {
        $finalmessage=self::string_to_finalmessage(trim($sms));
        $username = env('SMS_USERNAME');
        $password = env('SMS_PASS');
        $senderid = env('SMS_SENDERID');
        $deptSecureKey = env('SMS_SECURE_KEY');
        $key = hash('sha512',trim($username).trim($senderid).trim($finalmessage).trim($deptSecureKey));
        $url = env('SMS_URL');
        $encryp_password = sha1(trim($password));
        $data = array(
            "username" => trim($username),
            "password" => trim($encryp_password),
            "senderid" => trim($senderid),
            "content" => trim($finalmessage),
            "smsservicetype" =>"unicodemsg",
            "mobileno" =>trim($mobile),
            "key" => trim($key)
        );
        return self::post_to_url_unicode($url, $data);
    }

	/**
	 *Genarate number with suffix for e.g 1 => 1st, 2 => 2nd
	 *@param int $number
	 *@return string
	 */
	public static function ordinal($number) {
	    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
	    if ((($number % 100) >= 11) && (($number%100) <= 13)){
	        return $number. 'th';
	    }
	    else{
	        return $number. $ends[$number % 10];
	    }
	}

	/**
	 *Genarate number with suffix for e.g 1 => 1st, 2 => 2nd
	 *@param int $number
	 *@return int
	 */
	public static function convertToPercent($number){

	    if($number > 0){
	        $percentNumber = $number*100;
	        if(is_numeric($percentNumber) && floor($percentNumber) != $percentNumber){
	        	return preg_replace('/.00/', '', number_format((float)$percentNumber, 2, '.', ''));
	        }
	        return $percentNumber;
        }else{
	        return 0;
        }
    }


    public static function string_to_finalmessage($message){
        $finalmessage="";
        $sss = "";
        for($i=0;$i<mb_strlen($message,"UTF-8");$i++) {
            $sss=mb_substr($message,$i,1,"utf-8");
            $a=0;
            $abc="&#".self::ordutf8($sss,$a).";";
            $finalmessage.=$abc;
        }
        return $finalmessage;
    }

    public static function ordutf8($string, &$offset){
        $code=ord(substr($string, $offset,1));
        if ($code >= 128)
        { //otherwise 0xxxxxxx
            if ($code < 224) $bytesnumber = 2;//110xxxxx
            else if ($code < 240) $bytesnumber = 3; //1110xxxx
            else if ($code < 248) $bytesnumber = 4; //11110xxx
            $codetemp = $code - 192 - ($bytesnumber > 2 ? 32 : 0) -
                ($bytesnumber > 3 ? 16 : 0);
            for ($i = 2; $i <= $bytesnumber; $i++) {
                $offset ++;
                $code2 = ord(substr($string, $offset, 1)) - 128;//10xxxxxx
                $codetemp = $codetemp*64 + $code2;
            }
            $code = $codetemp;

        }
        return $code;
    }


    /**
	 *POST data to url using cURL
	 *@param int $number
	 *@return string
	 */
    public static function postCurl($url, $data)
    {
		$fields = '';
		foreach($data as $key => $value) {
		    $fields .= $key . '=' . urlencode($value) . '&';
		}
		rtrim($fields, '&');

		$post = curl_init();
		//curl_setopt($post, CURLOPT_SSLVERSION, 5); // uncomment for systems supporting TLSv1.1 only
		curl_setopt($post, CURLOPT_SSLVERSION, 6); // use for systems supporting TLSv1.2 or comment the line
		curl_setopt($post,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($post, CURLOPT_URL, $url);
		curl_setopt($post, CURLOPT_POST, count($data));
		curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($post, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded"));
		curl_setopt($post, CURLOPT_HTTPHEADER, array("Content-length:"
		    . strlen($fields) ));
		curl_setopt($post, CURLOPT_HTTPHEADER, array("User-Agent:Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt)"));
		curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($post); //result from mobile seva server
		curl_close($post);
		return $result;
    }

    public static function post_to_url_unicode($url, $data) {
        $fields = '';
        foreach($data as $key => $value) {
            $fields .= $key . '=' . urlencode($value) . '&';
        }
        rtrim($fields, '&');
        $post = curl_init();
        //curl_setopt($post, CURLOPT_SSLVERSION, 5); // uncomment for systems supporting TLSv1.1 only
        curl_setopt($post, CURLOPT_SSLVERSION, 6); // use for systems supporting TLSv1.2 or comment the line
        curl_setopt($post,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST, count($data));
        curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_HTTPHEADER, array("Content-Type:application/x-www-form-urlencoded"));
        curl_setopt($post, CURLOPT_HTTPHEADER, array("Content-length:"
            . strlen($fields) ));
        curl_setopt($post, CURLOPT_HTTPHEADER, array("User-Agent:Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt)"));
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($post); //result from mobile seva server
        $httpcode = curl_getinfo($post, CURLINFO_HTTP_CODE);
        curl_close($post);
        return ["status" => $httpcode, "response" => $result];
    }

    public static function tinyUrl($url)  {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
    }


    public static function ordinal_suffix($num){ $num = $num % 100;
        // protect against large numbers
        if($num < 11 || $num > 13){
            switch($num % 10){
                case 1: return $num.'st';
                case 2: return $num.'nd';
                case 3: return $num.'rd';
            }
        }
        return $num.'th';
    }


}
?>