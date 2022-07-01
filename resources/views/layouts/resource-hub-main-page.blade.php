@php
    /** @var \Anomaly\PagesModule\Page\PageModel $pageModel */
    $pageModel = $page->getObject();
    const SITE = 'site';
    const SHOP = 'shop';
    const RESOURCE_HUB = 'resource_hub';
    $site = false;
    $shop = false;
    $resource_hub = false;
    if ($page->type->getHandler() == 'anomaly.extension.shop_page_handler'){
        $host = SHOP;
        $shop = true;
    } elseif ($page->type->getHandler() == 'anomaly.extension.resource_hub_page_handler'){
        $host = RESOURCE_HUB;
        $resource_hub = true;
    } else {
        $host = SITE;
        $site = true;
    }
    $str = app(\Anomaly\Streams\Platform\Support\Str::class);

    \Illuminate\Support\Carbon::setlocale(config('app.locale'));

    $display_resource_filter_bar = $page->entry->display_resource_filter_categories || $page->entry->display_resource_filter_topics || $page->entry->display_resource_filter_search;
@endphp
    <!doctype html>

<html lang="{{ config('app.locale') }}" prefix="og:https://ogp.me/ns#">
    <head>
        @include('theme::partials.head-begin')

        <!-- Inline styles -->
        <style type="text/css">
        /* Inline styles */
        {!! inline_resource_content('theme::assets/generated/styles/resource-hub.min.css') !!}
        {!! inline_resource_content('theme::assets/generated/styles/components/resource-hub-main-banner.min.css') !!}
        @if($display_resource_filter_bar)
            {!! inline_resource_content('theme::assets/generated/styles/components/resource-hub-main-filter-bar.min.css') !!}
        @endif
        {!! inline_resource_content('theme::assets/generated/styles/components/resource-hub-main-filter-results.min.css') !!}

        @if($page->resource_main_page_blocks)
            @foreach($page->resource_main_page_blocks->pluck('type')->unique() as $blockType)
                @if($blockType)
                    {!! inline_resource_content('theme::assets/generated/styles/blocks/' . snake_to_kebab($blockType->slug->value) . '.min.css') !!}
                @endif
            @endforeach
        @endif
        </style>

        @include('theme::partials.head-end')
    </head>
    <body
        class="path::{{Request::path()}} {{$str::replace('.',':',Request::route()->getName())}}{{$page->hide_page ? ' page::hide' : ''}}">
        @include('theme::partials.body-begin')
        @include('theme::components.resource-hub-main-banner', ['page' => $page])
        @if($display_resource_filter_bar)
            @livewire('theme::livewire.components.resource-hub-main-filter-bar', ['page' => $pageModel])
        @endif
        @livewire('theme::livewire.components.resource-hub-main-filter-results', ['page' => $pageModel])
        @if($page->resource_main_page_blocks)
            @foreach($page->resource_main_page_blocks as $block)
                @includeIf('theme::blocks.' . snake_to_kebab($block->type->slug->value))
            @endforeach
        @endif
        @include('theme::partials.body-end')
    </body>
</html>
