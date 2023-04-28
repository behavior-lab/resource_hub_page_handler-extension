<?php namespace ConductLab\ResourceHubPageHandlerExtension\Page\Listener;

use Anomaly\PagesModule\Page\Event\PageIsSaving;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Support\Carbon;

class TouchPinnedAt
{

    /**
     * Create a new TouchPinnedAt instance.
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
        $entry = $page->getEntry();

        if ($page->getType()->getSlug() !== 'resource_hub_entry') {
            return;
        }
//        dd($entry->resource_pinned, $entry->resource_pinned_at);
        if ($entry->resource_pinned && !$entry->resource_pinned_at) {
            $entry->resource_pinned_at = Carbon::now();
            $entry->save();
        } elseif (!$entry->resource_pinned && $entry->resource_pinned_at) {
            $entry->resource_pinned_at = null;
            $entry->save();
        }
    }
}
