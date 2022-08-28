<?php namespace ConductLab\ResourceHubPageHandlerExtension\Page\Form;

use Anomaly\PagesModule\Page\Form\PageEntryFormBuilder;
use Anomaly\PagesModule\Page\PageModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class PageEntryFormSections
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageEntryFormSections extends \Anomaly\PagesModule\Page\Form\PageEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param PageEntryFormBuilder $builder
     */
    public function handle(PageEntryFormBuilder $builder)
    {
//        dd($builder);
        if ($builder->getForms()['page']->getType()?->getSlug() === 'resource_hub_entry' ||
            $builder->getEntry()?->getType()?->getSlug() === 'resource_hub_entry') {

            $fieldsForContentSection = array_map(
                function (FieldType $field) {
                    return 'entry_' . $field->getField();
                },
                array_filter(
                    $builder->getFormFields()->base()->all(),
                    function (FieldType $field) {
                        if (in_array($field->getField(), [
                            'resource_banner_type',
                            'resource_banner_theme',
                            'resource_banner_headline',
                            'resource_banner_lead_paragraph',
                            'resource_banner_image',
                            'resource_banner_media',
                            'resource_banner_bg_greyscale',
                            'resource_banner_bg_opacity',
                            'resource_banner_bg_blend_mode',
                            'resource_banner_text_class',
                            'resource_share_position',
                            'resource_publication_info_position',
                            'resource_keywords',
                            'resource_category',
                            'resource_topics',
                            'resource_hidden',
                            'resource_protected',
                        ])) {
                            return false;
                        }
                        return (!$field->getEntry() instanceof PageModel);
                    }
                )
            );

//            dd($fieldsForContentSection);
            $builder->setSections(
                [
                    'page' => [
                        'tabs' => [
                            'content' => [
                                'title' => 'anomaly.module.pages::tab.content',
                                'fields' => array_merge(
                                    [
                                        'page_title',
                                        'page_slug',
                                        'entry_resource_category',
                                        'entry_resource_topics',
                                        'entry_resource_keywords'
                                    ],
                                    $fieldsForContentSection
                                ),
                            ],
                            'banner' => [
                                'title' => 'conduct_lab.extension.resource_hub_page_handler::tab.banner',
//                            'fields' => function (PageEntryFormBuilder $builder) {
//                                return array_map(
//                                    function (FieldType $field) {
//                                        return 'entry_' . $field->getField();
//                                    },
//                                    array_filter(
//                                        $builder->getFormFields()->base()->all(),
//                                        function (FieldType $field) {
//                                            return (!$field->getEntry() instanceof PageModel);
//                                        }
//                                    )
//                                );
//                            },
                                'fields' => [
                                    'entry_resource_banner_type',
                                    'entry_resource_banner_theme',
                                    'entry_resource_banner_headline',
                                    'entry_resource_banner_lead_paragraph',
                                    'entry_resource_banner_image',
                                    'entry_resource_banner_media',
                                    'entry_resource_banner_bg_greyscale',
                                    'entry_resource_banner_bg_opacity',
                                    'entry_resource_banner_bg_blend_mode',
                                    'entry_resource_banner_text_class',
                                ],
                            ],
                            'general' => [
                                'title' => 'anomaly.module.pages::tab.general',
                                'fields' => [
                                    'page_parent',
                                    'page_enabled',
                                    'entry_resource_publication_info_position',
                                    'page_publish_at',
                                    'page_auto_update_modified_at',
                                    'page_modified_at',
                                    'page_display_modified_at',
                                    'entry_resource_hidden',
                                    'entry_resource_protected',
                                ],
                            ],
                            'seo' => [
                                'title' => 'anomaly.module.pages::tab.seo',
                                'fields' => [
                                    'page_meta_title',
                                    'page_meta_description',
                                    'page_structured_data',
                                ],
                            ],
                            'share' => [
                                'title' => 'anomaly.module.pages::tab.share',
                                'fields' => [
                                    'page_share',
                                    'entry_resource_share_position',
                                    'page_open_graph_type',
                                    'page_open_graph_title',
                                    'page_open_graph_description',
                                    'page_open_graph_image',
                                    'page_open_graph_card_type_twitter',
                                    'page_open_graph_image_twitter',
                                    'page_open_graph_raw',
                                ],
                            ],
                            'options' => [
                                'title' => 'anomaly.module.pages::tab.options',
                                'fields' => [
                                    'page_home',
                                    'page_visible',
                                    'page_exact',
                                    'page_allowed_roles',
                                    'page_theme_layout',
                                    'page_route_name',
                                ],
                            ],
                        ],
                    ],
                ]
            );
//        } elseif ($builder->getEntry()->getType()->getSlug() !== 'resource_hub_entry') {
//            parent::handle($builder);
        } else {
            parent::handle($builder);
        }
    }
}
