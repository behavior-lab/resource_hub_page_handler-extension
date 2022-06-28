<?php

namespace BehaviorLab\ResourceHubPageHandlerExtension\Page\Support;

use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Support\Str;

class BlendModeSelectOptions
{
    const OPTIONS = [
        'unset' => 'None',
        'normal' => 'Normal - this attribute applies no blending whatsoever and is a classic color overlay.',
        'multiply' => 'Multiply - the element is multiplied by the background and replaces the background color. The resulting color is always as dark as the background.',
        'screen' => 'Screen - multiplies the background and the content then complements the result. This will result in content which is brighter than the background-color.',
        'overlay' => 'Overlay - multiplies or screens the content depending on the background color. This is the inverse of the hard-light blend mode.',
        'darken' => 'Darken - the background is replaced with the content where the content is darker, otherwise, it is left as it was.',
        'lighten' => 'Lighten - the background is replaced with the content where the content is lighter.',
        'color-dodge' => 'Color dodge - this attribute brightens the background color to reflect the color of the content.',
        'color-burn' => 'Color burn - this darkens the background to reflect the content’s natural color.',
        'hard-light' => 'Hard-light - depending on the color of the content this attribute will screen or multiply it.',
        'soft-light' => 'Soft light - depending on the color of the content this will darken or lighten it.',
        'difference' => 'Difference - this subtracts the darker of the two colors from the lightest color.',
        'exclusion' => 'Exclusion - similar to difference but with lower contrast.',
        'hue' => 'Hue - creates a color with the hue of the content combined with the saturation and luminosity of the background.',
        'saturation' => 'Saturation - creates a color with the saturation of the content combined with the hue and luminosity of the background.',
        'color' => 'Color - creates a color with the hue and saturation of the content and the luminosity of the background.',
        'luminosity' => 'Luminosity - creates a color with the luminosity of the content and the hue and saturation of the background. This is the inverse of the color attribute.',
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
