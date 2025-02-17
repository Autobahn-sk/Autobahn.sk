<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleTransmissionEnum: string
{
	use EnumResourceTrait;

	case MANUAL = 'MANUAL';
	case AUTOMATIC = 'AUTOMATIC';
}