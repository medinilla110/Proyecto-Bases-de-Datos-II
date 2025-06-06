@extends('storefront::public.layout')

@section('title', $product->name)

@push('meta')
    <meta name="title" content="{{ $product->meta->meta_title ?: $product->name }}">
    <meta name="description" content="{{ $product->meta->meta_description ?: $product->short_description }}">
    <meta name="twitter:card" content="summary">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ $product->variant?->url() ?? $product->url() }}">
    <meta property="og:title" content="{{ $product->meta->meta_title ?: $product->name }}">
    <meta property="og:description" content="{{ $product->meta->meta_description ?: $product->short_description }}">
    <meta property="og:image" content="{{ ($product->variant && $product->variant->base_image->id) ? $product->variant->base_image?->path : $product->base_image?->path ?? asset('build/assets/image-placeholder.png') }}">
    <meta property="og:locale" content="{{ locale() }}">

    @foreach (supported_locale_keys() as $code)
        <meta property="og:locale:alternate" content="{{ $code }}">
    @endforeach

    <meta property="product:price:amount" content="{{ $product->variant?->selling_price->convertToCurrentCurrency()->amount() ?? $product->selling_price->convertToCurrentCurrency()->amount() }}">
    <meta property="product:price:currency" content="{{ currency() }}">
@endpush

@section('breadcrumb')
    @if (!$categoryBreadcrumb)
        <li><a href="{{ route('products.index') }}">{{ trans('storefront::products.shop') }}</a></li>
    @endif

    {!! $categoryBreadcrumb !!}

    <li class="active">{{ $product->name }}</li>
@endsection

@section('content')
    <section
        x-data="ProductShow({
            product: {{ $product }},
            
            @if ($product->variant)
                variant: {{ $product->variant }},
            @endif

            reviewCount: {{ $review->count ?? 0 }},
            avgRating: {{ $review->avg_rating ?? 0 }},
        })"
        class="product-details-wrap"
    >
        <div class="container">
            <div class="product-details-top">
                <div class="d-flex flex-column flex-lg-row flex-lg-nowrap ">
                    @if ($product->variant)
                        @include('storefront::public.products.show.variant_gallery')
                    @else
                        @include('storefront::public.products.show.gallery')
                    @endif 
                    
                    @include('storefront::public.products.show.details', ['item' => $product->variant ?? $product])

                    @if (setting('storefront_features_section_enabled'))
                        @include('storefront::public.products.show.right_sidebar')
                    @endif
                </div>
            </div>

            <div class="product-details-bottom flex-column-reverse flex-lg-row">
                @include('storefront::public.products.show.left_sidebar')

                <div class="product-details-bottom-inner">
                    <div class="product-details-tab clearfix">
                        <div class="product-details-tab-overflow">
                            <ul class="nav nav-tabs tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#description" data-bs-toggle="tab" class="nav-link active">
                                        {{ trans('storefront::product.description') }}
                                    </a>
                                </li>

                                @if ($product->hasAnyAttribute())
                                    <li class="nav-item" role="presentation">
                                        <a href="#specification" data-bs-toggle="tab" class="nav-link">
                                            {{ trans('storefront::product.specification') }}
                                        </a>
                                    </li>
                                @endif

                                @if (setting('reviews_enabled'))
                                    <li class="nav-item" role="presentation">
                                        <a
                                            href="#reviews"
                                            data-bs-toggle="tab"
                                            class="nav-link"
                                            x-text="trans('storefront::product.reviews', { count: totalReviews })"
                                        >
                                            {{ trans('storefront::product.reviews', ['count' => $product->reviews->count() ]) }}
                                        </a>
                                    </li>
                                @endif
                            </ul>

                            <hr>
                        </div>

                        <div class="tab-content">
                            @include('storefront::public.products.show.tab_description')
                            @include('storefront::public.products.show.tab_specification')
                            @include('storefront::public.products.show.tab_reviews')
                        </div>
                    </div>

                    @if ($relatedProducts->isNotEmpty())
                        @include('storefront::public.products.show.related_products')
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('globals')
    {!! $productSchemaMarkup->toScript() !!}
    
    <script>
        FleetCart.langs['storefront::product.left_in_stock'] = '{{ trans('storefront::product.left_in_stock') }}';
        FleetCart.langs['storefront::product.reviews'] = '{{ trans("storefront::product.reviews") }}';
        FleetCart.langs['storefront::product.review_submitted'] = '{{ trans("storefront::product.review_submitted") }}';
    </script>

    @vite([
        'modules/Storefront/Resources/assets/public/sass/pages/products/show/main.scss', 
        'modules/Storefront/Resources/assets/public/js/pages/products/show/main.js',
        'modules/Storefront/Resources/assets/public/js/vendors/flatpickr.js'
    ])
@endpush