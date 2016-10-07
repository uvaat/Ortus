<?php 
namespace App\library;

class GoogleGeoCoding
{

	private $apiKey;

 	public function __construct($apiKey){
 		//AIzaSyDgpW1FNFI5NKLvmehA8pkAACw1vi2YZHo
 		$this->apiKey = $apiKey;
 		$this->baseUrl = 'http://maps.googleapis.com/maps/api/geocode/json?key' . $this->apiKey;
 	
 	}

 	public static function curl($url){

		$options = array( 
			CURLOPT_CONNECTTIMEOUT => 0,
			CURLOPT_TIMEOUT => 1000,
			CURLOPT_URL => $url,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => 0,
			CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36",
			CURLINFO_HEADER_OUT  => true,
	    ); 
	 
	    $curl      = curl_init($url); 
	    curl_setopt_array($curl, $options); 

	    $response = new \StdClass();
	    $response->content = curl_exec($curl); 
	    $response->err = curl_errno($curl); 
	    $response->errmsg = curl_error($curl); 
	    $response->header = curl_getinfo($curl);

	    curl_close($curl); 
	 
	    return $response;

	}

 	public function getByAdress($adress, $city){

 		$url = $this->baseUrl. '&address=' . urlencode($adress) . ',+' . $city;
 		return $this->curl($url);

 	}


}
