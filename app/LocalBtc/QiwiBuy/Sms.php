<?php

namespace App\LocalBtc\QiwiBuy;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
	private static $instance=null;
	public static function getInstance(){
		if(self::$instance==null){
			self::$instance=new self;
		}
		return self::$instance;
	}
	
	public function index($contact){
		$array_message=array(
		"login"=>"obmenneg",
		"psw"=>"Qwer1212",
		"phones"=>"79381148114;79889498095",
		"mes"=>"Дебилы атакуют № " . $contact . "скоро начну спор" ,
		"charset"=>"utf-8"
		);
		$curl = curl_init('https://smsc.ru/sys/send.php');
		$options = array(
		CURLOPT_HTTPGET => 1,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_POSTFIELDS => $array_message,
		CURLOPT_TIMEOUT => 40,
		CURLOPT_INTERFACE => "185.60.135.248",
		CURLOPT_FILETIME => TRUE,
		);
		curl_setopt_array($curl, $options);
		$json=(curl_exec ($curl));
		curl_close($curl);
	}
	
	public function problem($contact){
		$array_message=array(
		"login"=>"obmenneg",
		"psw"=>"Qwer1212",
		"phones"=>"79381148114;79889498095",
		"mes"=>"СРОЧНО! Перевод по сделке № " . $contact . "не удался" ,
		"charset"=>"utf-8"
		);
		$curl = curl_init('https://smsc.ru/sys/send.php');
		$options = array(
		CURLOPT_HTTPGET => 1,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_POSTFIELDS => $array_message,
		CURLOPT_TIMEOUT => 40,
		CURLOPT_INTERFACE => "185.60.135.248",
		CURLOPT_FILETIME => TRUE,
		);
		curl_setopt_array($curl, $options);
		$json=(curl_exec ($curl));
		curl_close($curl);
	}
}
