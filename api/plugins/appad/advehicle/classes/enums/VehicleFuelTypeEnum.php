<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleConditionEnum: string
{
	use EnumResourceTrait;

	case NEW = 'NEW';
	case USED = 'USED';
}