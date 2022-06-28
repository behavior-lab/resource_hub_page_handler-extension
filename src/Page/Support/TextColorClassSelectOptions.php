<?php

namespace BehaviorLab\ResourceHubPageHandlerExtension\Page\Support;

use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Support\Str;

class TextColorClassSelectOptions
{
    const OPTIONS = [
        'text-white' => 'White',
        'text-dark-grey' => 'Titanium',
    ];

    public function options()
    {
        return self::OPTIONS;
    }

    public function handle(SelectFieldType $fieldType)
    {
        $fieldType->setOptions(self::OPTIONS);
    }

    public static function getConstValue($constName)
    {
        if (array_key_exists($constName, self::OPTIONS)) {
            return self::OPTIONS[$constName];
        } else {
            return null;
        }
    }
}
