<?php namespace AppAd\AdVehicle\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum VehicleEngineTypeEnum: string
{
	use EnumResourceTrait;

	case INLINE = 'INLINE';
	case V = 'V';
	case FLAT = 'FLAT';
	case BOXER = 'BOXER';
	case ROTARY = 'ROTARY';
	case W = 'W';
	case H = 'H';
	case OTHER = 'OTHER';
	case ELECTRIC = 'ELECTRIC';
}