<?php

namespace BehaviorLab\ResourceHubPageHandlerExtension;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use BehaviorLab\ResourceHubPageHandlerExtension\Page\PageSeederMain;
use BehaviorLab\ResourceHubPageHandlerExtension\Page\PageSeederEntry;

class ResourceHubPageHandlerExtensionSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(PageSeederMain::class);
        $this->call(PageSeederEntry::class);
    }
}
