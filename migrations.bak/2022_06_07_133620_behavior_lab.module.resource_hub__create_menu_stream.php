<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class BehaviorLabModuleResourceHubCreateMenuStream extends Migration
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
        'slug' => 'menu',
        'title_column' => 'title',
        'translatable' => true,
        'sortable' => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title' => [
            'translatable' => true,
            'required' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
        ],
        'categories' => [
            'translatable' => true,
            'required' => true,
        ],
    ];

}
