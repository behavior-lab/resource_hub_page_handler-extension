<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class BehaviorLabExtensionResourceHubPageHandlerCreatePagesStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'pages',
        'title_column' => 'title',
        'translatable' => true,
        'versionable' => true,
        'trashable' => false,
        'searchable' => true,
        'sortable' => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title' => [
            'required' => true,
        ],
        'banner_type' => [
            'required' => true,
        ],
        'headline' => [
            'translatable' => true,
            'required' => true,
        ],
        'lead_paragraph' => [
            'translatable' => true,
            'required' => true,
        ],
        'author' => [
            'translatable' => true,
            'required' => true,
        ],
        'published' => [
            'translatable' => true,
            'required' => false,
        ],
        'hidden' => [
            'translatable' => true,
            'required' => false,
        ],
        'protected' => [
            'translatable' => true,
            'required' => false,
        ],
        'date_published' => [
            'translatable' => true,
            'required' => true,
        ],
        'auto_update_modified_date' => [
            'translatable' => true,
            'required' => true,
        ],
        'date_modified' => [
            'translatable' => true,
            'required' => false,
        ],
        'image' => [
            'translatable' => true,
            'required' => true,
        ],
        'media' => [
            'translatable' => true,
            'required' => true,
        ],
        'blocks' => [
            'translatable' => false,
            'required' => false,
        ],
        'autogenerate_related' => [
            'translatable' => false,
            'required' => false,
        ],
        'related' => [
            'translatable' => false,
            'required' => false,
        ],
        'autogenerate_related_max' => [
            'translatable' => false,
            'required' => false,
        ],
        'structured_data' => [
            'translatable' => true,
            'required' => true,
        ],
    ];

}
