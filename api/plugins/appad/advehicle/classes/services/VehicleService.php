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

	public static function parseVehicleData(array $data): array
	{
		$parsedData = [];

		foreach ($data as $item) {
			$parsedData[] = [
				'vin' => $item['vin'],
				'license_plate' => $item['license_plate'],
				'manufacturer_id' => $item['manufacturer_id'],
				'model' => $item['model'],
				'body_type' => $item['body_type'],
				'color' => $item['color'],
				'kilowatts' => $item['kilowatts'],
				'torque' => $item['torque'],
				'displacement' => $item['displacement'],
				'top_speed' => $item['top_speed'],
				'fuel_type' => $item['fuel_type'],
				'drive' => $item['drive'],
				'transmission' => $item['transmission'],
				'gears' => $item['gears'],
				'enginetype' => $item['enginetype'],
				'cylinders' => $item['cylinders'],
				'doors' => $item['doors'],
				'seats' => $item['seats'],
				'year' => $item['year'],
				'mileage' => $item['mileage']
			];
		}

		return $parsedData;
	}
}
