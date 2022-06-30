<?php

namespace ConductLab\ResourceHubPageHandlerExtension\Support;

use Anomaly\PagesModule\Page\PageModel;
use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Contracts\Config\Repository;

class PageSlugOptions
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     * @param Repository $config
     */
    public function handle(SelectFieldType $fieldType, Repository $config)
    {
        $rootPages = PageModel::whereNull('parent_id')->get();
        $rootPagesArray = [];

        /** @var PageModel $rootPage */
        foreach ($rootPages as $rootPage) {
            $rootPagesArray[$rootPage->getPath()] = $rootPage->getPath() . ' - ' . $rootPage->getTitle();
        }

        $fieldType->setOptions($rootPagesArray);
    }
}
