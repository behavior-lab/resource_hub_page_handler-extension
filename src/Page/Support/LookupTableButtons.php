<?php namespace ConductLab\ResourceHubPageHandlerExtension\Page\Support;

class LookupTableButtons
{

    /**
     * Handle the command.
     *
     * @param ResourceHubPagesLookupTableBuilder $builder
     */
    public function handle(ResourceHubPagesLookupTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'select' => [
                    'data-entry' => 'entry.id',
                    'data-key'   => $builder->config('key'),
                ],
            ]
        );
    }
}
