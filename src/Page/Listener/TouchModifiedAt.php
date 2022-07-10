<?php namespace ConductLab\ResourceHubPageHandlerExtension\Page\Listener;

use Anomaly\PagesModule\Page\Event\PageIsSaving;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Support\Carbon;

class TouchModifiedAt
{

    /**
     * Create a new TouchLastLogin instance.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param PageIsSaving $event
     */
    public function handle(PageIsSaving $event)
    {
        $page = $event->getPage();
        if ($page->getType()->getSlug() !== 'resource_hub_entry') {
            return;
        }
        if ($page->auto_update_modified_at === 'yes') {
            $page->modified_at = Carbon::now();
            return;
        }
        if ($page->auto_update_modified_at === 'follow') {
            $settings = app(SettingRepositoryInterface::class);
            $settingValue = $settings->value('conduct_lab.module.resource_hub::auto_update_modified_date');
            if ($settingValue) {
                $page->modified_at = Carbon::now();
            }
        }
    }
}
