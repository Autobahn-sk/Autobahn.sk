<?php namespace AppAd\AdVehicle\Classes\Services;

use GuzzleHttp\Client;
use AppAd\AdVehicle\Models\VehicleManufacturer;
use AppAd\AdVehicle\Classes\Enums\VehicleBodyTypeEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleFuelTypeEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleTransmissionEnum;

class VehicleService
{
	public static function getVehicleData(string $make, string $model): array
	{
		$client = new Client();

		$response = $client->get('https://api.api-ninjas.com/v1/cars?make=' . $make . '&model=' . $model, [
			'headers' => [
				'X-Api-Key' => env('NINJAS_API_KEY')
			]
		]);

		$data = json_decode($response->getBody()->getContents(), true);

		return self::parseVehicleData($data);
	}

	private static function parseVehicleData(array $data): array
	{
		$parsedData = [];

		foreach ($data as $item) {
			$manufacturer = VehicleManufacturer::where('code', $item['make'])->firstOrFail();

			$parsedData[] = [
				'manufacturer_id' => $manufacturer->id,
				'transmission' => self::mapTransmission($item['transmission']),
				'body_type' => self::mapBodyType($item['class']),
				'fuel_type' => self::mapFuelType($item['fuel_type']),
				'drive' => strtoupper($item['drive']),
				'model' => array_get($item, 'model'),
				'displacement' => array_get($item, 'displacement'),
				'cylinders' => array_get($item, 'cylinders'),
				'year' => array_get($item, 'year')
			];
		}

		return $parsedData;
	}

	private static function mapBodyType(string $bodyType): string
	{
		return match ($bodyType) {
			'sport utility vehicle' => VehicleBodyTypeEnum::SUV->value,
			'compact car', 'midsize car', 'large car', 'small station wagon' => VehicleBodyTypeEnum::SEDAN->value,
			'two seater', 'subcompact car' => VehicleBodyTypeEnum::COUPE->value,
			'convertible' => VehicleBodyTypeEnum::CONVERTIBLE->value,
			default => strtoupper($bodyType)
		};
	}

	private static function mapTransmission(string $transmission): string
	{
		return match ($transmission) {
			'm' => VehicleTransmissionEnum::MANUAL->value,
			'a' => VehicleTransmissionEnum::AUTOMATIC->value,
			default => strtoupper($transmission)
		};
	}

	private static function mapFuelType(string $fuelType): string
	{
		return match ($fuelType) {
			'gasoline' => VehicleFuelTypeEnum::GAS->value,
			'diesel' => VehicleFuelTypeEnum::DIESEL->value,
			'hybrid' => VehicleFuelTypeEnum::HYBRID->value,
			'electricity' => VehicleFuelTypeEnum::ELECTRIC->value,
			'lpg' => VehicleFuelTypeEnum::LPG->value,
			default => strtoupper($fuelType)
		};
	}

	public static function getElectricVehicleData(string $make, string $model): array
	{
		$client = new Client();

		$response = $client->get('https://api.api-ninjas.com/v1/electricvehicle?make=' . $make . '&model=' . $model, [
			'headers' => [
				'X-Api-Key' => env('NINJAS_API_KEY')
			]
		]);

		$data = json_decode($response->getBody()->getContents(), true);

		return self::parseVehicleData($data);
	}

	public static function getVINData(string $vin): array
	{
		$client = new Client();

		$response = $client->get('https://api.api-ninjas.com/v1/vinlookup?vin=' . $vin, [
			'headers' => [
				'X-Api-Key' => env('NINJAS_API_KEY')
			]
		]);

		return json_decode($response->getBody()->getContents(), true);
	}
}
