<?php namespace BehaviorLab\ResourceHubPageHandlerExtension\Page;

use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

class PageSeederEntry extends Seeder
{
    /**
     * Class PageSeeder
     *
     * @link   https://behaviorlab.site/
     * @author Behavior CPH, ApS <support@behaviorlab.site>
     * @author Claus Hjort Bube <chb@b-cph.com>
     */

    /**
     * Run the seeder.
     */
    public function run()
    {
        // Fetch or create Page Type
        $pageTypes = app(TypeRepositoryInterface::class);
        if (!$pageType = $pageTypes->findBySlug('resource_hub_entry')) {
            $pageType = $pageTypes->create(
                [
                    'slug' => 'resource_hub_entry',
                    'en' => [
                        'name' => 'Resource Hub Entry',
                        'description' => 'A entry page type for the Resource Hub.',
                    ],
                    'handler' => 'behavior_lab.extension.resource_hub_page_handler',
                    'theme_layout' => 'behavior_lab.extension.resource_hub_page_handler::layouts.resource-hub-entry-page',
                    'layout' => '<h1>{{ page.title }}</h1>',
                ]
            );
        }
        $pageTypeStream = $pageType->getEntryStream();

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_category', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_category',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_category.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_category.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_category.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_category.instructions',
                    ],
                    'type' => 'anomaly.field_type.relationship',
                    'config' => [
                        'mode' => 'dropdown',
                        'related' => \BehaviorLab\ResourceHubModule\Category\CategoryModel::class
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_category', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_category',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_category.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_category.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_category.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_category.instructions',
                    ],
                    'type' => 'anomaly.field_type.relationship',
                    'config' => [
                        'mode' => 'dropdown',
                        'related' => \BehaviorLab\ResourceHubModule\Category\CategoryModel::class
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_topics', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_topics',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_topics.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_topics.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_topics.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_topics.instructions',
                    ],
                    'type' => 'anomaly.field_type.multiple',
                    'config' => [
                        'mode' => 'tags',
                        'related' => \BehaviorLab\ResourceHubModule\Topic\TopicModel::class
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_headline', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_headline',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_headline.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_headline.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_headline.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_headline.instructions',
                    ],
                    'type' => 'anomaly.field_type.text',
                    'config' => [],
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_lead_paragraph', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_lead_paragraph',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_lead_paragraph.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_lead_paragraph.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_lead_paragraph.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_lead_paragraph.instructions',
                    ],
                    'type' => 'anomaly.field_type.textarea',
                    'config' => [
                        "rows" => 3,
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_type', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_type',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_type.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_type.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_type.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_type.instructions',
                    ],
                    'type' => 'anomaly.field_type.select',
                    'config' => [
                        'mode' => 'radio',
                        "handler" => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\BannerSelectOptions::class
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_theme', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_theme',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_theme.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_theme.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_theme.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_theme.instructions',
                    ],
                    'type' => 'anomaly.field_type.select',
                    'config' => [
                        'mode' => 'radio',
                        "handler" => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\BannerThemeSelectOptions::class
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_author', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_author',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_author.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_author.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_author.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_author.instructions',
                    ],
                    'type' => 'anomaly.field_type.multiple',
                    'config' => [
                        'mode' => 'lookup',
                        'related' => \BehaviorLab\AuthorsModule\Author\AuthorModel::class,
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

//        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_published', 'pages')) {
//            $pageTypeField = $this->fields->create(
//                [
//                    'namespace' => 'pages',
//                    'slug' => 'resource_published',
//                    'en' => [
//                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_published.name',
//                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_published.placeholder',
//                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_published.warning',
//                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_published.instructions',
//                    ],
//                    'type' => 'anomaly.field_type.boolean',
//                    "config" => [
//                        "default_value" => false,
//                    ],
//                    'locked' => '1',
//                ]
//            );
//        }
//        if (!$this->assignments->findByStreamAndField($pageTypeStream, $pageTypeField)) {
//            $this->assignments->create(
//                [
//                    'translatable' => true,
//                    'required' => false,
//                    'stream' => $pageTypeStream,
//                    'field' => $pageTypeField,
//                ]
//            );
//        }

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_hidden', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_hidden',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_hidden.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_hidden.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_hidden.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_hidden.instructions',
                    ],
                    'type' => 'anomaly.field_type.boolean',
                    "config" => [
                        "default_value" => false,
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_protected', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_protected',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_protected.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_protected.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_protected.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_protected.instructions',
                    ],
                    'type' => 'anomaly.field_type.boolean',
                    "config" => [
                        "default_value" => false,
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_image', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_image',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_image.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_image.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_image.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_image.instructions',
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_media', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_media',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_media.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_media.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_media.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_media.instructions',
                    ],
                    'type' => 'anomaly.field_type.file',
                    'config' => [
                        'allowed_types' => ['png', 'jpeg', 'jpg', 'webp', 'avif', 'svg', 'mp4', 'mpeg', 'webm', 'mov']
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_file', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_file',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_file.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_file.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_file.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_file.instructions',
                    ],
                    'type' => 'anomaly.field_type.file',
                    'config' => [],
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_url', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_url',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_url.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_url.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_url.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_url.instructions',
                    ],
                    'type' => 'anomaly.field_type.text',
                    'config' => [],
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_bg_greyscale', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_bg_greyscale',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_greyscale.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_greyscale.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_greyscale.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_greyscale.instructions',
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_bg_opacity', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_bg_opacity',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_opacity.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_opacity.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_opacity.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_opacity.instructions',
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_bg_blend_mode', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_bg_blend_mode',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_blend_mode.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_blend_mode.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_blend_mode.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_bg_blend_mode.instructions',
                    ],
                    'type' => 'anomaly.field_type.select',
                    'config' => [
                        'mode' => 'dropdown',
                        "handler" => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\BlendModeSelectOptions::class
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_banner_text_class', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_banner_text_class',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_text_class.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_text_class.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_text_class.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_banner_text_class.instructions',
                    ],
                    'type' => 'anomaly.field_type.select',
                    'config' => [
                        'mode' => 'dropdown',
                        "handler" => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\TextColorClassSelectOptions::class
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource_blocks', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'resource_blocks',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_blocks.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_blocks.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_blocks.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_blocks.instructions',
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('autogenerate_related_resources', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'autogenerate_related_resources',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_autogenerate_related.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_autogenerate_related.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_autogenerate_related.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_autogenerate_related.instructions',
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('autogenerate_related_resources_max', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'autogenerate_related_resources_max',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_autogenerate_related_max.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_autogenerate_related_max.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_autogenerate_related_max.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_autogenerate_related_max.instructions',
                    ],
                    'type' => 'anomaly.field_type.integer',
                    'config' => [
                        'default_value' => 3
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

        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('related_resources', 'pages')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'pages',
                    'slug' => 'related_resources',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_related.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_related.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_related.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_related.instructions',
                    ],
                    'type' => 'anomaly.field_type.multiple',
                    'config' => [
                        'mode' => 'lookup',
                        'related' => \Anomaly\PagesModule\Page\PageModel::class,
                        'value_table' => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\MultipleFieldType\ValueTableBuilder::class,
                        'selected_table' => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\MultipleFieldType\SelectedTableBuilder::class,
                        'lookup_table' => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\MultipleFieldType\LookupTableBuilder::class,
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

        // Field for blocks
        if (!$pageTypeField = $this->fields->findBySlugAndNamespace('resource', 'blocks')) {
            $pageTypeField = $this->fields->create(
                [
                    'namespace' => 'blocks',
                    'slug' => 'resource',
                    'en' => [
                        'name' => 'behavior_lab.extension.resource_hub_page_handler::field.resource.name',
                        'placeholder' => 'behavior_lab.extension.resource_hub_page_handler::field.resource.placeholder',
                        'warning' => 'behavior_lab.extension.resource_hub_page_handler::field.resource.warning',
                        'instructions' => 'behavior_lab.extension.resource_hub_page_handler::field.resource.instructions',
                    ],
                    'type' => 'anomaly.field_type.relationship',
                    'config' => [
                        'mode' => 'lookup',
                        'related' => '\Anomaly\PagesModule\Page\PageModel',
                        'value_table' => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\RelationshipFieldType\ValueTableBuilder::class,
                        'selected_table' => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\RelationshipFieldType\SelectedTableBuilder::class,
                        'lookup_table' => \BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\RelationshipFieldType\LookupTableBuilder::class,
                    ],
                    'locked' => '1',
                ]
            );
        }
    }
}
