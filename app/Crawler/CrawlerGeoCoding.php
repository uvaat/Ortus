<?php 
namespace App\Crawler;

class CrawlerGeoCoding extends Crawler
{

	private $apiKey;

 	public function __construct($apiKey){
 		//AIzaSyDgpW1FNFI5NKLvmehA8pkAACw1vi2YZHo
 		$this->apiKey = $apiKey;
 		$this->baseUrl = 'http://maps.googleapis.com/maps/api/geocode/json?key' . $this->apiKey;
 	
 	}

 	public function getByAdress($adress, $city){

 		$url = $this->baseUrl. '&address=' . urlencode($adress) . ',+' . $city;
 		$result = $this->get($url);
 		$c = json_decode($result->content);
 		if($c->status == 'OK') return $c->results;
 		else return false;

 	}


}
