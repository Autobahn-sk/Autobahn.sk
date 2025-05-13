<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleBodyTypeEnum: string
{
	use EnumResourceTrait;

	case SEDAN = 'SEDAN';
	case HATCHBACK = 'HATCHBACK';
	case SUV = 'SUV';
	case PICKUP = 'PICKUP';
	case VAN = 'VAN';
	case COUPE = 'COUPE';
	case CONVERTIBLE = 'CONVERTIBLE';
	case MICRO = 'MICRO';
	case CROSSOVER = 'CROSSOVER';
	case MPV = 'MPV';
	case SUPERCAR = 'SUPERCAR';
	case LIMOUSINE = 'LIMOUSINE';
	case MUSCLE = 'MUSCLE';
	case WAGON = 'WAGON';
}