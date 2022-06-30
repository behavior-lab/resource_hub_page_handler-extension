<?php

namespace ConductLab\ResourceHubPageHandlerExtension;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use ConductLab\ResourceHubPageHandlerExtension\Page\PageSeederMain;
use ConductLab\ResourceHubPageHandlerExtension\Page\PageSeederEntry;

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
