<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleFuelTypeEnum: string
{
	use EnumResourceTrait;

	case GAS = 'GAS';
	case DIESEL = 'DIESEL';
	case ELECTRIC = 'ELECTRIC';
	case HYBRID = 'HYBRID';
	case HYDROGEN = 'HYDROGEN';
	case LPG = 'LPG';
}