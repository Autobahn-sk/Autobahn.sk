<?php namespace AppAd\Ad\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum AdStatusEnum: string
{
	use EnumResourceTrait;

	case DRAFT = 'DRAFT';

	case PUBLISHED = 'PUBLISHED';

	case ARCHIVED = 'ARCHIVED';

	public static function toArray()
	{
		return [
			self::DRAFT->value => 'Draft',
			self::PUBLISHED->value => 'Published',
			self::ARCHIVED->value => 'Archived'
		];
	}
}