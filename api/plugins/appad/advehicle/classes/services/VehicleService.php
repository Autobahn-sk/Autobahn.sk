<?php namespace AppAd\AdVehicle\Classes\Services;

use GuzzleHttp\Client;

class VehicleService
{
	public static function getVehicleData()
	{
		$client = new Client();

		$response = $client->get('https://api.api-ninjas.com/v1/cars?make=porsche', [
			'headers' => [
				'X-Api-Key' => env('NINJAS_API_KEY')
			]
		]);
		$data = json_decode($response->getBody()->getContents(), true);


	}
}
