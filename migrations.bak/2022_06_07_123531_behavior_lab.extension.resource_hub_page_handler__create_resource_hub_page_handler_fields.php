<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class BehaviorLabExtensionResourceHubPageHandlerCreateResourceHubPageHandlerFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'title' => 'anomaly.field_type.text',
        'filterable' => [
            'type' => 'anomaly.field_type.boolean',
            "config" => [
                "default_value" => true,
            ]
        ],

        // Resources
        'banner_type' => [
            'type' => 'anomaly.field_type.select',
            'config' => [
                'mode' => 'radio',
                "handler" => \ConductLab\ResourceHubModule\Resource\Support\BannerSelectOptions::class
            ],
        ],
        'headline' => 'anomaly.field_type.text',
        'lead_paragraph' => [
            'type' => 'anomaly.field_type.textarea',
            'config' => [
                "rows" => 3,
            ],
        ],
//        'button_action' => 'anomaly.field_type.text',
        'author' => [
            'type' => 'anomaly.field_type.multiple',
            'config' => [
                'mode' => 'lookup',
                'related' => \ConductLab\AuthorsModule\Author\AuthorModel::class,
            ],
        ],
        'published' => [
            'type' => 'anomaly.field_type.boolean',
            "config" => [
                "default_value" => false,
            ]
        ],
        'hidden' => [
            'type' => 'anomaly.field_type.boolean',
            "config" => [
                "default_value" => false,
            ]
        ],
        'protected' => [
            'type' => 'anomaly.field_type.boolean',
            "config" => [
                "default_value" => false,
            ]
        ],
        'date_published' => [
            'type' => 'anomaly.field_type.datetime',
            'config' => [
                "mode" => "datetime",
                "date_format" => "Y-m-d",
                "year_range" => "-50:+1",
                "timezone" => null,
                "picker" => true,
            ],
        ],
        'auto_update_modified_date' => [
            'type' => 'anomaly.field_type.select',
            "config" => [
                "options" => [
                    'follow' => 'conduct_lab.module.resource_hub::field.auto_update_modified_date.options.follow',
                    'no' => 'conduct_lab.module.resource_hub::field.auto_update_modified_date.options.no',
                    'yes' => 'conduct_lab.module.resource_hub::field.auto_update_modified_date.options.yes',
                ],
                "mode" => "buttons",
                "default_value" => '',
            ]
        ],
        'date_modified' => [
            'type' => 'anomaly.field_type.datetime',
            'config' => [
                "mode" => "datetime",
                "date_format" => "Y-m-d",
                "year_range" => "-50:+1",
                "timezone" => null,
                "picker" => true,
            ],
        ],
        'image' => [
            'type' => 'anomaly.field_type.file',
            'config' => [],
        ],
        'media' => [
            'type' => 'anomaly.field_type.file',
            'config' => [],
        ],
        'blocks' => 'anomaly.field_type.blocks',
        'autogenerate_related' => [
            'type' => 'anomaly.field_type.boolean',
            "config" => [
                "default_value" => true,
            ]
        ],
        'share' => [
            'type' => 'anomaly.field_type.boolean',
            "config" => [
                "default_value" => false,
            ]
        ],
        'related' => [
            'type' => 'anomaly.field_type.multiple',
            'config' => [
                'mode' => 'lookup',
                'related' => \ConductLab\ResourceHubModule\Resource\ResourceModel::class,
            ],
        ],
        'autogenerate_related_max' => [
            'type' => 'anomaly.field_type.integer',
            'config' => [
                'default_value' => 3
            ]
        ],
        'structured_data' => 'conduct_lab.field_type.struct_data',
    ];

}
