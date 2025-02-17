<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleDriveEnum: string
{
	use EnumResourceTrait;

	case FWD = 'FWD';
	case RWD = 'RWD';
	case AWD = 'AWD';
	case _4WD = '4WD';
}