
@php
    /** @var \Anomaly\PagesModule\Page\PageModel $page */
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- head start snippets -->
        @if($site)
            @getSnippets('BOTH', 'HEAD_START')
            @getSnippets('SITE', 'HEAD_START')
        @elseif($shop)
            @getSnippets('BOTH', 'HEAD_START')
            @getSnippets('SHOP', 'HEAD_START')
        @endif
        <!-- /head start snippets -->

        <!-- Inline styles -->
        <style type="text/css">
        /* Inline styles */
        {{ inline_resource_content('theme::assets/generated/styles/global.min.css') }}
        {{ inline_resource_content('theme::assets/generated/styles/components/global-topbar.min.css') }}
        {{ inline_resource_content('theme::assets/generated/styles/resource-hub.min.css') }}
        @if($page->resource_banner_type->getValue() === 'contained-image')
            {{ inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-contained-image.min.css') }}
        @elseif($page->resource_banner_type->getValue() === 'media-on-color')
            {{ inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-media-on-color.min.css') }}
        @elseif($page->resource_banner_type->getValue() === 'media-on-image')
            {{ inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-media-on-image.min.css') }}
        @elseif($page->resource_banner_type->getValue() === 'graphical-image-on-color')
            {{ inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-graphical-image-on-color.min.css') }}
        @elseif($page->resource_banner_type->getValue() === 'text-on-media')
            {{ inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-text-on-media.min.css') }}
        @endif
        @if($page->resource_blocks)
            @foreach($page->resource_blocks->pluck('type')->unique() as $blockType)
                @if($blockType)
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
        @if($page->resource_banner_type->getValue() === 'contained-image')
            @include('theme::components.resource-hub-entry-banner-contained-image', ['page' => $page])
        @elseif($page->resource_banner_type->getValue() === 'media-on-color')
            @include('theme::components.resource-hub-entry-banner-media-on-color', ['page' => $page])
        @elseif($page->resource_banner_type->getValue() === 'media-on-image')
            @include('theme::components.resource-hub-entry-banner-media-on-image', ['page' => $page])
        @elseif($page->resource_banner_type->getValue() === 'graphical-image-on-color')
            @include('theme::components.resource-hub-entry-banner-graphical-image-on-color', ['page' => $page])
        @elseif($page->resource_banner_type->getValue() === 'text-on-media')
            @include('theme::components.resource-hub-entry-banner-text-on-media', ['page' => $page])
        @endif
        @if($page->enabled->value && $page->publish_at)
            <div class="container resource__entry-below-banner">
                <small class="resource__entry-below-banner--publish-info">
                    {{ __('theme::resource-hub.resource__entry-below-banner-publish-info', ['date' => $page->publish_at->format('F, Y'), 'author' => $page->resource_author->first()->display_name]) }}
                    {{ ($page->modified_at)->format('d.m.Y') }}
                </small>
                <small class="resource__entry-below-banner--share" x-data="resourceShareData()">
                    <label>{{ __('theme::resource-hub.resource__entry-below-banner-share--label') }}</label>
                    <div class="resource__entry-below-banner--share-facebook" x-on:click="openFacebook"></div>
                    <div class="resource__entry-below-banner--share-linkedin" x-on:click="openLinkedIn"></div>
                    <div class="resource__entry-below-banner--share-copy-url" x-on:click="copyUrl"></div>
                </small>
            </div>
        @endif
        <article>
            @if($page->resource_blocks)
                @foreach($page->resource_blocks as $block)
                    @includeIf('theme::blocks.' . snake_to_kebab($block->type->slug->value))
                @endforeach
            @endif
        </article>
        @if($page->related_resources && $page->related_resources->count())
            <div class="container column resources__related-resources">
                <h2 class="resources__related-resources--label">{{ __('theme::resource-hub.resources__related-resources--label') }}</h2>
                <div class="resources__list">
                    @foreach($page->related_resources as $resource)
                        <a id="{{$resource->entry->id}}" class="resources__list-entry link--no-hover" href="{{localizePath($resource->getPath())}}"
                           wire:key="{{$resource->entry->id}}">
                            @php
                                $image = getImageFromEntry($resource->entry, 'resource_banner_image', ['cover' => [370, 228], 'crop' => [370, 228]]);
                                $media = getImageFromEntry($resource->entry, 'resource_banner_media', ['cover' => [370, 228], 'crop' => [370, 228]]);
                                $file = getFileFromEntry($resource->entry, 'resource_file');
                                if (!$media) {
                                    $media_type = 'empty';
                                } elseif (in_array($media?->getExtension(), config('anomaly.module.files::mimes.types.image'))) {
                                    $media_type = 'image';
                                } elseif (in_array($media?->getExtension(), config('anomaly.module.files::mimes.types.video'))) {
                                    $media_type = 'video';
                                } else {
                                    $media_type = 'unknown';
                                }
                                if (!$file) {
                                    $file_type = 'empty';
                                } elseif (in_array($file?->getExtension(), config('anomaly.module.files::mimes.types.image'))) {
                                    $file_type = 'image';
                                } elseif (in_array($file?->getExtension(), config('anomaly.module.files::mimes.types.video'))) {
                                    $file_type = 'video';
                                } elseif ($file?->getExtension() === 'pdf') {
                                    $file_type = 'document';
                                } elseif ($resource->entry->translateOrDefault()->resource_url?->value) {
                                    $file_type = 'url';
                                } else {
                                    $file_type = 'unknown';
                                }
                            $media_url = Str::replace('+', ' ', $media?->route('view') ?? '');
                            @endphp
                            <div class="resources__list-entry-media">
                                @if($media_type === 'image')
                                    <img src="{{$media_url}}" alt="{{$media?->getAttributes()['alt'] ?? ''}}" width="370px"
                                         height="228px">
                                @elseif($media_type === 'video')
                                    <video playsinline autoplay muted loop width="370px" height="228px">
                                        <source src="{{$media_url}}" type="video/mp4">
                                    </video>
                                @else
                                    <img src="{{Str::replace('+', ' ', $image->route('view'))}}" alt="{{$image->getAttributes()['alt'] ?? ''}}" width="370px"
                                         height="228px">
                                @endif
                                @if($file_type === 'video')
                                    <div class="resource__icon resource__icon--video"></div>
                                @elseif($file_type === 'document')
                                    <div class="resource__icon resource__icon--document"></div>
                                @elseif($file_type === 'url')
                                    <div class="resource__icon resource__icon--url"></div>
                                @endif
                                <div class="resources__list-entry-category">
                                    {{$resource->entry->translateOrDefault()->resource_category->title}}
                                </div>
                            </div>
                            <div class="resources__list-entry-text">
                                <small class="resources__list-entry-published-date">
                                    {{$resource->publish_at->format('d.m.Y')}}
                                </small>
                                <p class="resources__list-entry-headline">
                                    {{$resource->entry->translateOrDefault()->resource_banner_headline}}
                                </p>
                                <p class="resources__list-entry-lead-paragraph">
                                    {{$resource->entry->translateOrDefault()->resource_banner_lead_paragraph}}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
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
        <script>
        const resourceShareData = () => {
            return {
                get currentUrl() {
                    return window.location.host + window.location.pathname;
                },
                openFacebook: function() {
                    const left = screen.width / 2 - 600 / 2;
                    const top = screen.height / 2 - 600 / 2;
                    window.open(
                        'https://www.facebook.com/sharer/sharer.php?u=' + this.currentUrl + '&amp;src=sdkpreparse',
                        'facebookWindow',
                        'resizable=no, toolbar=no, scrollbars=no, menubar=no, status=no, directories=no, width=' + 600 + ', height=' + 600 + ', left=' + left + ', top=' + top
                    );
                },
                openLinkedIn: function() {
                    const left = screen.width / 2 - 700 / 2;
                    const top = screen.height / 2 - 800 / 2;
                    window.open(
                        'https://www.linkedin.com/sharing/share-offsite/?url=' + this.currentUrl,
                        'linkedInWindow',
                        'toolbar=no, scrollbars=no, menubar=no, status=no, directories=no, width=' + 700 + ', height=' + 800 + ', left=' + left + ', top=' + top
                    );
                },
                copyUrl: function() {
                    const dummy = document.createElement('input');
                    const text = window.location.href;

                    document.body.appendChild(dummy);
                    dummy.value = text;
                    dummy.select();
                    document.execCommand('copy');
                    document.body.removeChild(dummy);
                    alert('clipboard successfully set');

                    /*navigator.clipboard.writeText(window.location.href).then(function() {
                        /* clipboard successfully set */
                    /*     alert('clipboard successfully set');
                     }, function() {
                         /* clipboard write failed */
                    /*});*/
                }
            }
        }
        </script>
        <script async src="/assets/scripts/svg-to-inline.min.js" data-cookieconsent="ignore"></script>

        <!-- Inline scripts -->
        <script type="application/javascript">
        {{ inline_resource_content('theme::assets/generated/scripts/components/global-topbar.min.js') }}
        @if($page->resource_blocks)
            @foreach($page->resource_blocks->pluck('type')->unique() as $blockType)
                @if($blockType)
        /* {{'theme::assets/generated/scripts/blocks/' . snake_to_kebab($blockType->slug->value)}} */
        {{ inline_resource_content('theme::assets/generated/scripts/blocks/' . snake_to_kebab($blockType->slug->value) . '.min.css') }}
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
