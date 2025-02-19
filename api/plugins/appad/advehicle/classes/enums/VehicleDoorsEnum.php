<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleDoorsEnum: int
{
	use EnumResourceTrait;

	case _2 = 2;
	case _3 = 3;
	case _4 = 4;
	case _5 = 5;
}