<?php namespace AppUtil\Util\Classes\Traits;

trait EnumResourceTrait
{
    public function resource(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'display_value' => title_case($this->value)
        ];
	}

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

	public static function map($value): ?string
	{
		foreach (self::cases() as $case) {
			if ($case->value === $value) {
				return $case->name;
			}
		}

		return null;
	}

    public static function resourceCollection(): array
    {
        $resources = [];

        foreach (self::cases() as $case) {
            $resources[] = $case->resource();
        }

        usort($resources, function ($a, $b) {
            return $a['display_value'] <=> $b['display_value'];
        });

        return $resources;
    }

    public static function optionsForBackend(): array
    {
        $options = [];

        foreach (self::resourceCollection() as $resource) {
            $options[$resource['value']] = $resource['display_value'];
        }

        return $options;
    }
}
