<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleFeatureCategoryEnum: string
{
	use EnumResourceTrait;

	case INTERIOR = 'INTERIOR';
	case EXTERIOR = 'EXTERIOR';
	case SAFETY = 'SAFETY';
	case COMFORT = 'COMFORT';
}