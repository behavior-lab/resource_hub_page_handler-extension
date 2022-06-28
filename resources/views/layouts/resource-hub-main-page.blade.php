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

$display_resource_filter_bar = $page->entry->display_resource_filter_categories || $page->entry->display_resource_filter_topics || $page->entry->display_resource_filter_search;
@endphp
    <!doctype html>

<html lang="{{ config('app.locale') }}" prefix="og:https://ogp.me/ns#">
    <head>
        <title>{{$page->meta_title->value ?: $page->title->value}}</title>
        <meta name="page-type" content="{{$page->type->slug}}"/>
        <meta name="theme-layout" content="{{$page->type->theme_layout}}"/>
        <meta name="page-handler" content="{{$page->type->getHandler()}}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{$page->meta_description->value ?: setting_value('streams::description')}}">
        <!--<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
        <!-- head start snippets -->
        @if($site)
            @getSnippets('BOTH', 'HEAD_START')
            @getSnippets('SITE', 'HEAD_START')
        @elseif($shop)
            @getSnippets('BOTH', 'HEAD_START')
            @getSnippets('SHOP', 'HEAD_START')
        @endif
        <!-- /head start snippets -->

        {{--<link rel="stylesheet" href="{{ mix('/css/blade-styles.css') }}" type="text/css">
        <link rel="stylesheet" href="/assets/styles/global.css" type="text/css">--}}
        <!-- Inline styles -->
        <style type="text/css">
        /* Inline styles */
        {{ inline_resource_content('theme::assets/generated/styles/global.min.css') }}
        {{ inline_resource_content('theme::assets/generated/styles/components/global-topbar.min.css') }}
        {{ inline_resource_content('theme::assets/generated/styles/resource-hub.min.css') }}
        {{ inline_resource_content('theme::assets/generated/styles/components/resource-hub-main-banner.min.css') }}
        @if($display_resource_filter_bar)
        {{ inline_resource_content('theme::assets/generated/styles/components/resource-hub-main-filter-bar.min.css') }}
        @endif
        {{ inline_resource_content('theme::assets/generated/styles/components/resource-hub-main-filter-results.min.css') }}

        @if($page->resource_main_page_blocks)
        @foreach($page->resource_main_page_blocks->pluck('type')->unique() as $blockType)
        @if($blockType)


        /*


        {{'theme::assets/generated/styles/blocks/' . snake_to_kebab($blockType->slug->value)}}    */
        {{ inline_resource_content('theme::assets/generated/styles/blocks/' . snake_to_kebab($blockType->slug->value) . '.min.css') }}
        @endif
        @endforeach
        @endif
        </style>
        <script type="application/javascript">
        /**
         * Loads a JavaScript file and returns a Promise for when it is loaded
         */
        const loadScript = src => {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.type = 'text/javascript';
                script.async = true;
                script.onload = resolve;
                script.onerror = reject;
                script.src = src;
                document.head.append(script);
            });
        };</script>
        <script async src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.2/gsap.min.js"></script>
        @livewireStyles
        <!-- Alpine Plugins -->
        {{--        <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>--}}
        <!-- Alpine Core -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- head end snippets -->
        @if($site)
            @getSnippets('BOTH', 'HEAD_END')
            @getSnippets('SITE', 'HEAD_END')
        @elseif($shop)
            @getSnippets('BOTH', 'HEAD_END')
            @getSnippets('SHOP', 'HEAD_END')
        @endif
        <!-- /head end snippets -->
        {{-- @include('theme::components.navigation') --}}
    </head>
    <body
        class="path::{{Request::path()}} {{$str::replace('.',':',Request::route()->getName())}}{{$page->hide_page ? ' page::hide' : ''}}">
        @include('theme::components.global-topbar', ['page' => $page])
        @include('theme::components.resource-hub-main-banner', ['page' => $page])
        @if($display_resource_filter_bar)
            @livewire('theme::livewire.components.resource-hub-main-filter-bar', ['page' => $pageModel])
        @endif
        @livewire('theme::livewire.components.resource-hub-main-filter-results', ['page' => $pageModel])
        {{-- dd($page->resource_main_page_blocks) --}}
        @if($page->resource_main_page_blocks)
            @foreach($page->resource_main_page_blocks as $block)
                @includeIf('theme::blocks.' . snake_to_kebab($block->type->slug->value))
            @endforeach
        @endif

        @livewireScripts()
        <script data-turbo-eval="false" data-turbolinks-eval="false">
        {{-- loadScript('/vendor/livewire/livewire.js').then(() => {
            window.livewire = new Livewire();
            @if(config('app.debug'))
            window.livewire.devTools(true);
            @endif
            window.Livewire = window.livewire;
            window.livewire_app_url = '{{config('livewire.app_url')
            ?: rtrim($options['app_url'] ?? '', '/')
            ?: (config('livewire.asset_url') ?: rtrim($options['asset_url'] ?? '', '/'))}}';
            window.livewire_token = {!! app()->has('session.store') ? "'" . csrf_token() . "'" : 'null' !!};

            window.deferLoadingAlpine = function(callback) {
                window.addEventListener('livewire:load', function() {
                    callback();
                });
            };

            let started = false;

            window.addEventListener('alpine:initializing', function() {
                if (!started) {
                    window.livewire.start();

                    started = true;
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                if (!started) {
                    window.livewire.start();

                    started = true;
                }
            });
        });--}}
        </script>
        <script async src="/assets/scripts/svg-to-inline.min.js" data-cookieconsent="ignore"></script>

        <!-- Inline scripts -->
        <script type="application/javascript">
        {{ inline_resource_content('theme::assets/generated/scripts/components/global-topbar.min.js') }}
        @if($page->resource_main_page_blocks)
        @foreach($page->resource_main_page_blocks->pluck('type')->unique() as $blockType)
        @if($blockType)
        /* {{'theme::assets/generated/scripts/blocks/' . snake_to_kebab($blockType->slug->value)}} */
        {{ inline_resource_content('theme::assets/generated/scripts/blocks/' . snake_to_kebab($blockType->slug->value) . '.min.js') }}
        @endif
        @endforeach
        @endif
        </script>
        <!-- body end snippets -->
        @if($site)
            @getSnippets('BOTH', 'BODY_END')
            @getSnippets('SITE', 'BODY_END')
        @elseif($shop)
            @getSnippets('BOTH', 'BODY_END')
            @getSnippets('SHOP', 'BODY_END')
        @endif
        <!-- /body end snippets -->
    </body>
</html>
