<?php


namespace BehaviorLab\ResourceHubPageHandlerExtension\Page\Support\MultipleFieldType;


use Anomaly\PagesModule\Page\PageModel;
use Anomaly\PagesModule\Type\TypeRepository;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

class LookupTableBuilder extends \Anomaly\MultipleFieldType\Table\LookupTableBuilder
{

    /**
     * The field type configuration.
     *
     * @var null|Collection
     */
    protected $config = null;

    /**
     * The ajax flag.
     *
     * @var bool
     */
    protected $ajax = true;

    /**
     * The table model.
     *
     * @var null|string
     */
    protected $model = PageModel::class;

    /**
     * The table filters.
     *
     * @var string
     */
    protected $filters = [
        'search' => [
            'fields' => [
                'title',
                'slug',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var string
     */
    protected $columns = [
//        'resource_banner_image' => [
//            'value' => 'entry.resource_banner_image.preview',
//            'is_safe' => true
//        ],
        'category' => [
            'header' => 'behavior_lab.extension.resource_hub_page_handler::field.resource_category.name',
            'value' => 'entry.resource_category.title'
        ],
        'resource' => [
            'header' => 'behavior_lab.extension.resource_hub_page_handler::field.resource.name',
            'wrapper' => '<div><b>{value.headline}</b><br>{value.lead_paragraph}</div>',
            'value' => [
                'headline' => "entry.resource_banner_headline",
                'lead_paragraph' => "entry.resource_banner_lead_paragraph",
            ],
        ],
//        'color_preview' => [
//            'header' => 'behavior_lab.module.themes::field.color_preview.name',
//            'wrapper' => '<div style="width: 80px; height: 52px; margin-bottom: -15px; margin-top: -15px; background-color: {value.code};"></div>',
//            'value' => [
//                'code' => "entry.color_code.value",
//            ],
//        ],
//        'slug',
    ];

    /**
     * The table buttons.
     *
     * @var string
     */
    protected $buttons = LookupTableButtons::class;

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'sortable' => false,
//        'title'    => 'anomaly.field_type.relationship::message.choose_entry'
    ];

    /**
     * Return a config value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function config($key, $default = null)
    {
        return $this->config->get($key, $default);
    }

    /**
     * Get the config.
     *
     * @return Collection|null
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the config.
     *
     * @param Collection $config
     * @return $this
     */
    public function setConfig(Collection $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Fired just before querying
     * for table entries.
     *
     * @param Builder $query
     */
    public function onQuerying(TypeRepository $typeRepository, Builder $query)
    {
        $resourceHubPageType = $typeRepository->findBySlug('resource_hub_entry');

        $query->where('type_id', $resourceHubPageType->id);

//        foreach ($query->get() as $item) {
//            dd($item);
//        }
//        dd($query->get());
    }
}
