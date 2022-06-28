<?php

namespace BehaviorLab\ResourceHubPageHandlerExtension\Page\Support;

use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Support\Str;

class SortResourcesBySelectOptions
{
    const OPTIONS = [
        'published_date_asc' => 'Published date - ascending',
        'published_date_desc' => 'Published date - descending',
        'modified_date_asc' => 'Modified date - ascending',
        'modified_date_desc' => 'Modified date - descending',
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
