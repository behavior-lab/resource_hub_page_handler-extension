<?php

return [
    'sub_site_main_page' => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'default_value' => '/resource_hub',
            'handler'       => 'ConductLab\ResourceHubPageHandlerExtension\Support\PageSlugOptions@handle',
        ],
    ],
    'sub_site_domain' => [
        'type'   => 'anomaly.field_type.text',
        'config' => [
            'default_value' => env('RESOURCE_HUB_URL') ?: env('SITE_URL') ?: env('APP_URL'),
        ],
    ],
    'sub_site_path' => [
        'type'   => 'anomaly.field_type.text',
        'config' => [
            'default_value' => ''
        ],
    ],
];
