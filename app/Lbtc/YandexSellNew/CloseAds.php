<?php

namespace App\Lbtc\YandexSellNew;

use Illuminate\Database\Eloquent\Model;

class CloseAds extends Model
{
	private static $instance=null;
	public static function getInstance(){
		if(self::$instance==null){
			self::$instance=new self;
		}
		return self::$instance;
	}
	
	public function index($lbtckey, $lbtcsecret, $contact_id){
		$url='/api/contact_release/' . $contact_id . '/';
		$time=microtime();
		$int=substr($time,11);
		$flo=substr($time,2,5);
		$nonce=$int.$flo;
		$array_message=array(
		);
		$message=http_build_query($array_message);
		$apiauth = $nonce.$lbtckey.$url.$message;
		$signature = strtoupper(hash_hmac('sha256',$apiauth,$lbtcsecret));
		$curl = curl_init('https://localbitcoins.net'.$url);
		$options = array(
			CURLOPT_POST => 1,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_TIMEOUT => 40,
			CURLOPT_FILETIME => TRUE,
			CURLOPT_HTTPHEADER => array(
			'Apiauth-Key:'.$lbtckey,
			'Apiauth-Nonce:'.$nonce,
			'Apiauth-Signature:'.$signature
			),
		);
		curl_setopt_array($curl, $options);
		$json=(curl_exec ($curl));
		curl_close($curl);
		$result=json_decode($json);
		if ($result->data->message=="The escrow of contact has been released successfully."){
			$rob=\App\Lbtc\LbtcRobot::where('contact_id', $contact_id)->first();
			$rob->status=6;
			$rob->save();
			return $rob->status;
		}
	}
}
