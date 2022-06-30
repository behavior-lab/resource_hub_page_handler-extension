<?php

namespace ConductLab\ResourceHubPageHandlerExtension\Page\Support;

use Anomaly\SelectFieldType\SelectFieldType;

class BannerThemeSelectOptions
{
    const OPTIONS = [
        'white' => 'White',
        'light-grey' => 'Light grey',
        'dark-blue' => 'Dark blue',
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
        if(array_key_exists($constName, self::OPTIONS)) {
            return self::OPTIONS[$constName];
        } else {
            return null;
        }
    }
}
