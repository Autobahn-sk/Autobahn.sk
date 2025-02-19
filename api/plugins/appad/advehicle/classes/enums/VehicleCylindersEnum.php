<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleCylindersEnum: int
{
	use EnumResourceTrait;

	case _2 = 2;
	case _3 = 3;
	case _4 = 4;
	case _5 = 5;
	case _6 = 6;
	case _8 = 8;
	case _10 = 10;
	case _12 = 12;
	case _16 = 16;
}