<?php namespace ConductLab\ResourceHubPageHandlerExtension\Page;

use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

class PageSeederMain extends Seeder
{
    /**
     * Class PageSeeder
     *
     * @link   https://ConductLab.site/
     * @author Behavior CPH, ApS <support@ConductLab.site>
     * @author Claus Hjort Bube <chb@b-cph.com>
     */

    /**
     * Run the seeder.
     */
    public function run()
    {
        // Fetch or create Page Type
        $pageTypes = app(TypeRepositoryInterface::class);
        if (!$pageType = $pageTypes->findBySlug('resource_hub_main')) {
            $pageType = $pageTypes->create(
                [
                    'slug' => 'resource_hub_main',
                    'en' => [
                        'name' => 'Resource Hub Main',
                        'description' => 'The main page type for the Resource Hub.',
                    ],
                    'handler' => 'conduct_lab.extension.resource_hub_page_handler',
                    'theme_layout' => 'conduct_lab.extension.resource_hub_page_handler::layouts.resource-hub-main-page',
                    'layout' => '<h1>{{ page.title }}</h1>',
                ]
            );
        }
        $pageTypeStream = $pageType->getEntryStream();

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_categories', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_categories',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_categories.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_categories.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_categories.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_categories.instructions',
                    ],
                    'type' => 'anomaly.field_type.multiple',
                    'config' => [
                        'mode' => 'tags',
                        'related' => \ConductLab\ResourceHubModule\Category\CategoryModel::class
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => false,
                    'required' => true,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_main_headline', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_main_headline',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_main_headline.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_main_headline.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_main_headline.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_main_headline.instructions',
                    ],
                    'type' => 'anomaly.field_type.textarea',
                    'config' => [
                        "rows" => 2,
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => true,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('header_bg_media', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'header_bg_media',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_media.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_media.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_media.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_media.instructions',
                    ],
                    'type' => 'anomaly.field_type.file',
                    'config' => [
                        'allowed_types' => ['png', 'jpeg', 'jpg', 'webp', 'avif', 'svg']
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => true,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('header_bg_greyscale', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'header_bg_greyscale',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_greyscale.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_greyscale.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_greyscale.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_greyscale.instructions',
                    ],
                    'type' => 'anomaly.field_type.boolean',
                    "config" => [
                        "default_value" => true,
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('header_bg_opacity', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'header_bg_opacity',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_opacity.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_opacity.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_opacity.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_opacity.instructions',
                    ],
                    'type' => 'anomaly.field_type.integer',
                    "config" => [
                        "step" => 1,
                        "min" => 0,
                        "max" => 100,
                        "default_value" => 100,
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => true,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('header_bg_blend_mode', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'header_bg_blend_mode',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_blend_mode.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_blend_mode.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_blend_mode.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.header_bg_blend_mode.instructions',
                    ],
                    'type' => 'anomaly.field_type.select',
                    'config' => [
                        'mode' => 'dropdown',
                        "handler" => \ConductLab\ResourceHubPageHandlerExtension\Page\Support\BlendModeSelectOptions::class
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => false,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('header_text_class', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'header_text_class',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.header_text_class.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.header_text_class.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.header_text_class.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.header_text_class.instructions',
                    ],
                    'type' => 'anomaly.field_type.select',
                    'config' => [
                        'mode' => 'dropdown',
                        "handler" => \ConductLab\ResourceHubPageHandlerExtension\Page\Support\TextColorClassSelectOptions::class
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => false,
                    'required' => true,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_filter_bar_text', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_filter_bar_text',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_bar_text.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_bar_text.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_bar_text.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_bar_text.instructions',
                    ],
                    'type' => 'anomaly.field_type.text',
                    'config' => [
                        'default_value' => 'Use the filters below or the search box to find special content.',
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => true,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('display_resource_filter_categories', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'display_resource_filter_categories',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_categories.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_categories.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_categories.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_categories.instructions',
                    ],
                    'type' => 'anomaly.field_type.boolean',
                    "config" => [
                        "default_value" => true,
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_filter_categories_placeholder', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_filter_categories_placeholder',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_categories_placeholder.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_categories_placeholder.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_categories_placeholder.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_categories_placeholder.instructions',
                    ],
                    'type' => 'anomaly.field_type.text',
                    'config' => [
                        'default_value' => 'Select category',
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('display_resource_filter_topics', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'display_resource_filter_topics',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_topics.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_topics.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_topics.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_topics.instructions',
                    ],
                    'type' => 'anomaly.field_type.boolean',
                    "config" => [
                        "default_value" => true,
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_filter_topics_placeholder', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_filter_topics_placeholder',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_topics_placeholder.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_topics_placeholder.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_topics_placeholder.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_topics_placeholder.instructions',
                    ],
                    'type' => 'anomaly.field_type.text',
                    'config' => [
                        'default_value' => 'Select topic',
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('display_resource_filter_search', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'display_resource_filter_search',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_search.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_search.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_search.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.display_resource_filter_search.instructions',
                    ],
                    'type' => 'anomaly.field_type.boolean',
                    "config" => [
                        "default_value" => true,
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_filter_search_placeholder', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_filter_search_placeholder',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_search_placeholder.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_search_placeholder.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_search_placeholder.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_filter_search_placeholder.instructions',
                    ],
                    'type' => 'anomaly.field_type.text',
                    'config' => [
                        'default_value' => 'Search',
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('sort_resources_by', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'sort_resources_by',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.sort_resources_by.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.sort_resources_by.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.sort_resources_by.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.sort_resources_by.instructions',
                    ],
                    'type' => 'anomaly.field_type.select',
                    'config' => [
                        'mode' => 'dropdown',
                        "handler" => \ConductLab\ResourceHubPageHandlerExtension\Page\Support\SortResourcesBySelectOptions::class
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('load_resources_count', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'load_resources_count',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.load_resources_count.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.load_resources_count.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.load_resources_count.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.load_resources_count.instructions',
                    ],
                    'type' => 'anomaly.field_type.integer',
                    'config' => [
                        'default_value' => '9',
                        'min' => '0',
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => false,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('load_more_resources_count', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'load_more_resources_count',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.load_more_resources_count.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.load_more_resources_count.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.load_more_resources_count.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.load_more_resources_count.instructions',
                    ],
                    'type' => 'anomaly.field_type.integer',
                    'config' => [
                        'default_value' => '6',
                        'min' => '0',
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => false,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('load_more_resources_text', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'load_more_resources_text',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.load_more_resources_text.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.load_more_resources_text.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.load_more_resources_text.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.load_more_resources_text.instructions',
                    ],
                    'type' => 'anomaly.field_type.text',
                    'config' => [
                        'default_value' => 'Load more',
                    ],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => true,
                    'required' => true,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_main_page_blocks', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_main_page_blocks',
                    'en' => [
                        'name' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_main_page_blocks.name',
                        'placeholder' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_main_page_blocks.placeholder',
                        'warning' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_main_page_blocks.warning',
                        'instructions' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_main_page_blocks.instructions',
                    ],
                    'type' => 'anomaly.field_type.blocks',
                    'config' => [],
                    'locked' => '1',
                ]
            );
        }
        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
            $this->assignments->create(
                [
                    'translatable' => false,
                    'required' => false,
                    'stream' => $pageTypeStream,
                    'field' => $pageTypeField,
                ]
            );
        }


        $type = $pageType;

        $pages = app(PageRepositoryInterface::class);

        $pages->create(
            [
                'en'           => [
                    'title' => 'Resource Hub',
                ],
                'slug'         => 'resource-hub',
                'entry'        => $type->getEntryModel()->create(
                    [
                        'en' => [
                            'resource_main_headline' => 'Welcome to the Resource Hub',
                        ],
                    ]
                ),
                'type'         => $type,
                'enabled'      => true,
            ]
        )->allowedRoles()->sync([]);
    }
}
