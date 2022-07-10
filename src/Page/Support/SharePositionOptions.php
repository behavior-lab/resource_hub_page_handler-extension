<?php

namespace ConductLab\ResourceHubPageHandlerExtension\Page\Support;

use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Support\Str;

class SharePositionOptions
{
    const OPTIONS = [
        'neither' => 'Do not display',
        'before' => 'Before content',
        'after' => 'After content',
        'before-n-after' => 'Before & after content',
    ];

    public function options(): array
    {
        return array_merge(['default' => 'Follow category'], self::OPTIONS);
    }

    public function handle(SelectFieldType $fieldType)
    {
        $fieldType->setOptions($this->options());
    }

    public static function settingsOptions(SelectFieldType $fieldType): array
    {
        $fieldType->setOptions(self::OPTIONS);
        return self::OPTIONS;
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
