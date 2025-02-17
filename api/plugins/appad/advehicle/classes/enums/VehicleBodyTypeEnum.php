<?php namespace AppAd\Ad\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleManufacturerEnum: string
{
	use EnumResourceTrait;

	case BMW = 'BMW';
	case MERCEDES = 'Mercedes';
	case AUDI = 'Audi';
	case VOLKSWAGEN = 'Volkswagen';
	case TOYOTA = 'Toyota';
	case HONDA = 'Honda';
	case FORD = 'Ford';
	case CHEVROLET = 'Chevrolet';
	case NISSAN = 'Nissan';
	case HYUNDAI = 'Hyundai';
	case KIA = 'Kia';
	case MAZDA = 'Mazda';
	case SUZUKI = 'Suzuki';
	case PEUGEOT = 'Peugeot';
	case CITROEN = 'Citroen';
	case RENAULT = 'Renault';
	case FIAT = 'Fiat';
	case OPEL = 'Opel';
	case SEAT = 'Seat';
	case SKODA = 'Skoda';
	case VOLVO = 'Volvo';
	case JEEP = 'Jeep';
	case LAND_ROVER = 'Land Rover';
	case PORSCHE = 'Porsche';
	case JAGUAR = 'Jaguar';
	case LEXUS = 'Lexus';
	case INFINITI = 'Infiniti';
	case ACURA = 'Acura';
	case CADILLAC = 'Cadillac';
	case LINCOLN = 'Lincoln';
	case BUICK = 'Buick';
	case CHRYSLER = 'Chrysler';
	case DODGE = 'Dodge';
	case RAM = 'Ram';
	case GMC = 'GMC';
	case TESLA = 'Tesla';
	case ALFA_ROMEO = 'Alfa Romeo';
	case MASERATI = 'Maserati';
	case FERRARI = 'Ferrari';
	case LAMBORGHINI = 'Lamborghini';
	case BUGATTI = 'Bugatti';
	case ASTON_MARTIN = 'Aston Martin';
	case BENTLEY = 'Bentley';
	case ROLLS_ROYCE = 'Rolls Royce';
	case LOTUS = 'Lotus';
	case MCLAREN = 'McLaren';
	case KOENIGSEGG = 'Koenigsegg';
	case PAGANI = 'Pagani';

	public function toArray()
	{

	}
}