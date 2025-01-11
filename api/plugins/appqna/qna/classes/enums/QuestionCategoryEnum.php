<?php namespace AppQna\Qna\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum QuestionCategoryEnum: string
{
	use EnumResourceTrait;

	case GENERAL = 'GENERAL';

	case PAYMENT = 'PAYMENT';
}