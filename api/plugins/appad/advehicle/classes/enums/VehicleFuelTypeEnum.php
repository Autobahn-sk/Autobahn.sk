<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleFuelTypeEnum: string
{
	use EnumResourceTrait;

	case GAS = 'GAS';
	case DIESEL = 'DIESEL';
	case ELECTRICITY = 'ELECTRICITY';
}