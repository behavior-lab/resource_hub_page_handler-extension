
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

    \Illuminate\Support\Carbon::setlocale(config('app.locale'));
@endphp
    <!doctype html>

<html lang="{{ config('app.locale') }}" prefix="og:https://ogp.me/ns#">
    <head>
        @include('theme::partials.head-begin', ['site', 'shop', 'resource_hub'])

        <!-- Inline styles -->
        <style type="text/css">
        /* Inline styles */
        {!! inline_resource_content('theme::assets/generated/styles/resource-hub.min.css') !!}
        @if($page->resource_banner_type->getValue() === 'contained-image')
            {!! inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-contained-image.min.css') !!}
        @elseif($page->resource_banner_type->getValue() === 'media-on-color')
            {!! inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-media-on-color.min.css') !!}
        @elseif($page->resource_banner_type->getValue() === 'media-on-image')
            {!! inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-media-on-image.min.css') !!}
        @elseif($page->resource_banner_type->getValue() === 'graphical-image-on-color')
            {!! inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-graphical-image-on-color.min.css') !!}
        @elseif($page->resource_banner_type->getValue() === 'text-on-media')
            {!! inline_resource_content('theme::assets/generated/styles/components/resource-hub-entry-banner-text-on-media.min.css') !!}
        @endif
        @if($page->resource_blocks)
            @foreach($page->resource_blocks->pluck('type')->unique() as $blockType)
                @if($blockType)
                    {!! inline_resource_content('theme::assets/generated/styles/blocks/' . snake_to_kebab($blockType->slug->value) . '.min.css') !!}
                @endif
            @endforeach
        @endif
        </style>

        @include('theme::partials.head-end', ['site', 'shop', 'resource_hub'])
    </head>
    <body
        class="path::{{Request::path()}} {{$str::replace('.',':',Request::route()->getName())}}{{$page->hide_page ? ' page::hide' : ''}}">
        @include('theme::partials.body-begin')
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
                    {{ __('theme::resource-hub.resource__entry-below-banner-publish-info', ['date' => $page->publish_at->translatedFormat('F, Y'), 'author' => $page->resource_author->first()->display_name]) }}
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
        @include('theme::partials.body-end')
    </body>
</html>
