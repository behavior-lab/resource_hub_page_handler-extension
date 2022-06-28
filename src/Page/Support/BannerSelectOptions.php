<?php

namespace BehaviorLab\ResourceHubPageHandlerExtension\Page\Support;

use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Support\Str;

class BannerSelectOptions
{
    const OPTIONS = [
        'contained-image' => 'Contained image',
        'media-on-color' => 'Small media on color background',
        'media-on-image' => 'Small media on image background',
        'graphical-image-on-color' => 'Graphical image on color',
        'text-on-media' => 'Text on media',
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
