<?php namespace AppService\Diagnostic\Classes\Enums;

use AppUtil\Util\Classes\Traits\EnumResourceTrait;

enum DiagnosticStatusEnum: string
{
	use EnumResourceTrait;

	case PENDING = 'PENDING';
	case SUCCESS = 'SUCCESS';
	case ERROR = 'ERROR';
}