<?php


namespace ConductLab\ResourceHubPageHandlerExtension\Page\Support\MultipleFieldType;


class SelectedTableBuilder extends \Anomaly\MultipleFieldType\Table\SelectedTableBuilder
{
    /**
     * The table columns.
     *
     * @var string
     */
    protected $columns = [
//        'title',
        'category' => [
            'header' => 'conduct_lab.extension.resource_hub_page_handler::field.resource_category.name',
            'value' => 'entry.resource_category.title'
        ],
        'resource' => [
            'header' => 'conduct_lab.extension.resource_hub_page_handler::field.resource.name',
            'wrapper' => '<div><b>{value.headline}</b><br>{value.lead_paragraph}</div>',
            'value' => [
                'headline' => "entry.resource_banner_headline",
                'lead_paragraph' => "entry.resource_banner_lead_paragraph",
            ],
        ],
//        'color_preview' => [
//            'header' => 'conduct_lab.module.themes::field.color_preview.name',
//            'wrapper' => '<div style="width: 80px; height: 52px; margin-bottom: -15px; margin-top: -15px; background-color: {value.code};"></div>',
//            'value' => [
//                'code' => "entry.color_code.value",
//            ],
//        ],
//        'slug',
    ];
}
