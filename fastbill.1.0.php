<?php

class fastbill
{
	private $email = '';
	private $apiKey = '';
	private $apiUrl = '';
	private $debug = false;
	
	public function __construct($email, $apiKey, $apiUrl = 'https://my.fastbill.com/api/1.0/api.php')
	{
		if($email != '' && $apiKey != '')
		{
			$this->email = $email;
			$this->apiKey = $apiKey;
			$this->apiUrl = $apiUrl;
		}
		else
		{
			return false;
		}
	}
	
	public function setDebug($bool = false)
	{
		if($bool != '')
		{
			$this->debug = $bool;
		}
		else
		{
			if($this->debug == true) { return array("RESPONSE" => array("ERROR" => array("Übergabeparameter 1 ist leer!"))); }
			else { return false; }
		}
	}
	
	public function request($data, $file = NULL)
	{
		if($data)
		{
			if($this->email != '' && $this->apiKey != '' && $this->apiUrl != '')
			{
				if($file == NULL)
				{
					$data_string = json_encode($data);
					
					$JSON = file_get_contents($this->apiUrl, NULL, stream_context_create(
					array(
						'http' => array(
							'method' => 'POST',
							'header' => 'Content-Type: application/json; charset=utf-8' . "\r\n"
							. 'Content-Length: ' . strlen($data_string) . "\r\n"
							. 'Authorization: Basic ' . base64_encode($this->email.':'.$this->apiKey),
							'content' => $data_string
						)
					)
					));
					
					$array = json_decode($JSON);
					return $array;
				}
				else
				{
					$ch = curl_init();
					
					$data_string = json_encode($data);
					$bodyStr = array("document" => "@".$file, "httpbody" => $data_string);
			
					curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('header' => 'Authorization: Basic ' . base64_encode($this->email.':'.$this->apiKey))); 
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyStr);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					
					$exec = curl_exec($ch);
					$result = json_decode($exec);
					
					curl_close($ch);
					
					return $result;
				}
			}
			else
			{
				if($this->debug == true) { return array("RESPONSE" => array("ERROR" => array("Email und/oder APIKey und/oder APIURL Fehlen!"))); }
				else { return false; }
			}
		}
		else
		{
			if($this->debug == true) { return array("RESPONSE" => array("ERROR" => array("Übergabeparameter 1 ist leer!"))); }
			else { return false; }
		}
	}
}

?>
