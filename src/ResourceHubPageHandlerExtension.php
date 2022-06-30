<?php namespace ConductLab\ResourceHubPageHandlerExtension;

use Anomaly\DefaultPageHandlerExtension\Command\MakePage;
use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Handler\PageHandlerExtension;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Model\Pages\PagesPagesEntryTranslationsModel;
use Illuminate\Support\Str;

class ResourceHubPageHandlerExtension extends PageHandlerExtension
{

    /**
     * This extension provides...
     *
     * This should contain the dot namespace
     * of the addon this extension is for followed
     * by the purpose.variation of the extension.
     *
     * For example anomaly.module.store::gateway.stripe
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.pages::handler.resource_hub';

    /**
     * Make the page's response.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        $this->dispatch(new MakePage($page));
    }

    /**
     * Return the page's route dump.
     *
     * @param PageInterface $page
     * @return null|string
     */
    public function route(PageInterface $page)
    {
        $translations = $page->getTranslations();
        $settings = app(SettingRepositoryInterface::class);
        $subSiteMainPage = $settings->value('conduct_lab.extension.resource_hub_page_handler::sub_site_main_page') ?: '';
        $subSiteDomain = $settings->value('conduct_lab.extension.resource_hub_page_handler::sub_site_domain') ?: '';
        $subSitePath = $settings->value('conduct_lab.extension.resource_hub_page_handler::sub_site_path') ?: '';

//        if ($page->getId() === 4) {
//            dd($translations);
//        }
        /**
         * If the page is exact then
         * return it as is with no {any}.
         */
        if ($page->isExact()) {
            return implode(
                "\n\n",
                $translations->map(
                /**
                 * @var PageInterface|PagesPagesEntryTranslationsModel $translation
                 */
                    function ($translation) use ($page, $subSiteMainPage, $subSiteDomain, $subSitePath) {

//                        if ($page->getId() === 4 && $translation->locale == 'zh-cn') {
//                            dd($translation, $page->translate());
//                        }
                        $path = $translation->path;
                        if ($translation->getSlug()) {
                            $path = $page->translateOrDefault()->path;
                        }
                        $path = Str::replaceFirst($subSiteMainPage, '', $path);
                        $route = "
    Route::any('{$path}', [
        'uses'                       => 'Anomaly\\PagesModule\\Http\\Controller\\PagesController@view',
        'as'                         => 'pages::{$page->getId()}.{$translation->locale}',
        'streams::addon'             => 'anomaly.module.pages',
        'anomaly.module.pages::page' => {$page->getId()},
    ]);
";
                        if ($subSitePath) {
                            $route = "Route::prefix('" . $subSitePath . "')->group(function () {" . $route . "});";
                        }
                        $route = "Route::domain('" . $subSiteDomain . "')->group(function () {" . $route . "});";
                        return $route;
                    }
                )->all()
            );
        }

        /**
         * If the page is not exact
         * it must accommodate {any}.
         */
        if (!$page->isExact() && !$page->isHome()) {
            return implode(
                "\n\n",
                $translations->map(
                /**
                 * @var PageInterface|PagesPagesEntryTranslationsModel $translation
                 */
                    function ($translation) use ($page, $subSiteMainPage, $subSiteDomain, $subSitePath) {
                        $path = str_replace($subSiteMainPage, '', $translation->path);

                        return "Route::any('{$path}/{any?}', [
    'uses'                       => 'Anomaly\\PagesModule\\Http\\Controller\\PagesController@view',
    'as'                         => 'pages::{$page->getId()}.{$translation->locale}',
    'streams::addon'             => 'anomaly.module.pages',
    'anomaly.module.pages::page' => {$page->getId()},
    'where'                      => [
        'any' => '(.*)',
    ],
]);";
                    }
                )->all()
            );
        }

        return null;
    }
}
