@php use App\Utils\Helpers;use App\Utils\ProductManager; @endphp
@extends('theme-views.layouts.app')

@section('title', $product['name'] . ' | ' . $web_config['name']->value . ' ' . translate('ecommerce'))

@push('css_or_js')
    <meta name="description" content="{{$product->slug}}">
    <meta name="keywords" content="@foreach(explode(' ', $product['name']) as $keyword) {{$keyword . ' , '}} @endforeach">
    @if($product->added_by == 'seller')
        <meta name="author" content="{{ $product->seller->shop ? $product->seller->shop->name : $product->seller->f_name}}">
    @elseif($product->added_by == 'admin')
        <meta name="author" content="{{$web_config['name']->value}}">
    @endif

    @if($product['meta_image'])
        <meta property="og:image" content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}" />
        <meta property="twitter:card" content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}" />
    @else

        <meta property="og:image" content="{{asset("storage/app/public/product/thumbnail")}}/{{$product->thumbnail}}" />
        <meta property="twitter:card" content="{{asset("storage/app/public/product/thumbnail/")}}/{{$product->thumbnail}}" />
    @endif


    @if($product['meta_title'])
        <meta property="og:title" content="{{$product->meta_title}}" />
        <meta property="twitter:title" content="{{$product->meta_title}}" />
    @else

        <meta property="og:title" content="{{$product->name}}" />
        <meta property="twitter:title" content="{{$product->name}}" />
    @endif

    <meta property="og:url" content="{{route('product', [$product->slug])}}">

    @if($product['meta_description'])
        <meta property="twitter:description" content="{!! $product['meta_description'] !!}">
        <meta property="og:description" content="{!! $product['meta_description'] !!}">
    @else

        <meta property="og:description"
            content="@foreach(explode(' ', $product['name']) as $keyword) {{$keyword . ' , '}} @endforeach">
        <meta property="twitter:description"
            content="@foreach(explode(' ', $product['name']) as $keyword) {{$keyword . ' , '}} @endforeach">
    @endif

    <meta property="twitter:url" content="{{route('product', [$product->slug])}}">
@endpush

<style>
    
     /* .quickviewSliderThumb2::-webkit-scrollbar{
        width: 5px;
     } */
     .quickviewSliderThumb2{
        overflow-x: auto;
        overflow-y: hidden;
        @media (min-width: 992px){
            height: 600px;
            overflow-y: auto;
            overflow-x: hidden;
        }
     }
</style>


@section('content')
<main class="main-content d-flex flex-column gap-3 pt-3 mb-sm-5 dark-support">
    <div class="container">

        <div class="row my-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="font-size: 14px; font-weight: 400px;">
                    <li class="breadcrumb-item" style="color: #d4d4d4;" ;><a href="#">Home</a></li>
                    <li class="breadcrumb-item" style="color: #d4d4d4;" ;><a href="#">Library</a></li>
                    <li class="breadcrumb-item" style="color: #000;" aria-current="page">Data</li>
                </ol>
            </nav>
        </div>

        <div class="quickview-content overflow-hidden">
            <div class="row gy-4">

                <div class="col-lg-2 order-2 order-lg-1 ">
                    <div class="user-select-none">
                        <div class="quickviewSliderThumb2 swiper-container position-relative "
                            style="overflow-y: auto; ">
                            @if($product->images != null && json_decode($product->images) > 0)
                                <div class="justify-content-lg-center justify-content-start w-100 d-flex flex-lg-column flex-row" style="gap: 13px;">
                                    @if(json_decode($product->colors) && $product->color_image)
                                        @foreach (json_decode($product->color_image) as $key => $photo)
                                            @if($photo->color != null)
                                                <div class="d-flex flex-column" style="background-color: #d6d6d6">
                                                    <img class="dark-support" alt="" style="height: 140px; min-width: 170px"
                                                        src="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}">
                                                </div>
                                            @endif
                                        @endforeach
                                        @foreach (json_decode($product->color_image) as $key => $photo)
                                            @if($photo->color == null)
                                                <div class="d-flex flex-column" style="margin-right: 0px;">
                                                    <img class="dark-support mb-3" alt="" style="width: 170px; height: 140px;"
                                                        src="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}">
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach (json_decode($product->images) as $key => $photo)
                                            <div class="d-flex flex-column" style="margin-right: 0px;">
                                                <<img class="dark-support mb-3" alt="" style="width: 170px; height: 140px;"
                                                    src="{{ getValidImage(path: 'storage/app/public/product/' . $photo, type: 'product') }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 order-1 order-lg-2 ">
                    <div class="pd-img-wrap position-relative h-100 overflow-hidden">
                        <div class="quickviewSlider2 aspect-1"
                            style="width: 100%; height: 600px; background-color: #d6d6d6;">
                            @if($product->images != null && json_decode($product->images) > 0)
                                <div class="swiper-wrapper">
                                    @if(json_decode($product->colors) && $product->color_image)
                                        @foreach (json_decode($product->color_image) as $key => $photo)
                                            @if($photo->color != null)
                                                <div class="swiper-slide position-relative" id="preview-box-{{ $photo->color }}">
                                                    @if ($product->discount > 0 && $product->discount_type === "percent")
                                                        <span class="product__discount-badge">
                                                            <span>
                                                                {{'-' . $product->discount . '%'}}
                                                            </span>
                                                        </span>
                                                    @elseif($product->discount > 0)
                                                        <span class="product__discount-badge">
                                                            <span>
                                                                {{'-' . Helpers::currency_converter($product->discount)}}
                                                            </span>
                                                        </span>
                                                    @endif
                                                    <div class="easyzoom easyzoom--overlay">
                                                        <a
                                                            href="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}">
                                                            <img class="dark-support" alt="" style="height: 600px;"
                                                                src="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="swiper-slide position-relative" id="preview-box-{{ $photo->color }}">
                                                    @if ($product->discount > 0 && $product->discount_type === "percent")
                                                        <span class="product__discount-badge">
                                                            <span>
                                                                {{'-' . $product->discount . '%'}}
                                                            </span>
                                                        </span>
                                                    @elseif($product->discount > 0)
                                                        <span class="product__discount-badge">
                                                            -{{Helpers::currency_converter($product->discount)}}
                                                        </span>
                                                    @endif

                                                    <div class="easyzoom easyzoom--overlay">
                                                        <a
                                                            href="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}">
                                                            <img class="dark-support" alt=""
                                                                src="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach (json_decode($product->images) as $key => $photo)
                                            <div class="swiper-slide position-relative">
                                                @if ($product->discount > 0 && $product->discount_type === "percent")
                                                    <span class="product__discount-badge">
                                                        <span>
                                                            -{{$product->discount}}%
                                                        </span>
                                                    </span>
                                                @elseif($product->discount > 0)
                                                    <span class="product__discount-badge">
                                                        <span>
                                                            {{'-' . Helpers::currency_converter($product->discount)}}
                                                        </span>
                                                    </span>
                                                @endif
                                                <div class="easyzoom easyzoom--overlay">
                                                    <a
                                                        href="{{ getValidImage(path: 'storage/app/public/product/' . $photo, type: 'product') }}">
                                                        <img class="dark-support" alt="" style="height: 600px;"
                                                            src="{{ getValidImage(path: 'storage/app/public/product/' . $photo, type: 'product') }}">
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 order-3 ps-4">
                    <div class="product-details-content position-relative">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <h1 class="product_title text-truncate">{{$product->name}}</h1>
                            @if ($product->discount > 0 && $product->discount_type === "percent")
                                <span class="product__save-amount">{{translate('save')}} {{$product->discount . '%'}}</span>
                            @elseif($product->discount > 0)
                                <span class="product__save-amount">{{translate('save')}}
                                    {{Helpers::currency_converter($product->discount)}}
                                </span>
                            @endif
                        </div>
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <div class="star-rating text-gold fs-12">
                                @for ($index = 1; $index <= 5; $index++)
                                    @if ($index <= (int) $overallRating[0])
                                        <i class="bi bi-star-fill"></i>
                                    @elseif ($overallRating[0] != 0 && $index <= (int) $overallRating[0] + 1.1 && $overallRating[0] > ((int) $overallRating[0]))
                                        <i class="bi bi-star-half"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span>({{$product->reviews_count}} Reviews)</span> |
                            @if(($product['product_type'] == 'physical') && ($product['current_stock'] <= 0))
                                <p class="fw-semibold text-muted">{{translate('out_of_stock')}}</p>
                            @else
                                @if($product['product_type'] === 'physical')
                                    <p class="fw-semibold" style="color: #00FF66">
                                        <span class="in_stock_status">{{$product->current_stock}}</span>
                                        {{translate('in_Stock')}}
                                    </p>
                                @endif
                            @endif
                        </div>

                        <div class="product__price d-flex flex-wrap align-items-end gap-2 mb-4 ">
                            <div class="text-dark " style="font-size: 24px; font-weight: 400; padding-top: 4px;">
                                {!! Helpers::get_price_range_with_discount($product) !!}
                            </div>
                        </div>

                        <div class="product-detail-custom mb-3" style="padding-bottom: 15px;">
                            <p style="font-size: 14px; line-height: 21px;">
                                PlayStation 5 Controller Skin High quality
                                vinyl with air channel adhesive for easy bubble free install & mess free removal
                                Pressure sensitive.
                            </p>
                        </div>
                        <hr>
                        <form class="cart add-to-cart-form mt-3" action="{{ route('cart.add') }}" id="add-to-cart-form"
                            data-redirecturl="{{route('checkout-details')}}"
                            data-varianturl="{{ route('cart.variant_price') }}"
                            data-errormessage="{{translate('please_choose_all_the_options')}}"
                            data-outofstock="{{translate('Sorry_Out_of_stock')}}.">
                            @csrf
                            <div class="">
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                @if (count(json_decode($product->colors)) > 0)
                                    <div class="d-flex gap-4 flex-wrap align-items-center mb-3 " style="padding-top: 10px;">
                                        <h6 style="font-size: 20px; font-weight: 400; line-height: 20px;" class="">
                                            {{translate('color_:')}}
                                        </h6>
                                        <ul
                                            class="option-select-btn custom_01_option flex-wrap weight-style--two gap-2 pt-2">
                                            @foreach (json_decode($product->colors) as $key => $color)
                                                <li>
                                                    <label>
                                                        <input type="radio" hidden=""
                                                            id="{{ $product->id }}-color-{{ str_replace('#', '', $color) }}"
                                                            name="color" value="{{ $color }}" {{ $key == 0 ? 'checked' : '' }}>
                                                        <span
                                                            class="color_variants rounded-circle focus-preview-image-by-color p-0 {{ $key == 0 ? 'color_variant_active' : ''}}"
                                                            style="background: {{ $color }};"
                                                            data-slide-id="preview-box-{{ str_replace('#', '', $color) }}"
                                                            id="color_variants_preview-box-{{ str_replace('#', '', $color) }}"></span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @foreach (json_decode($product->choice_options) as $choice)
                                    <div class="d-flex gap-4 flex-wrap align-items-center mb-4" style="padding-top: 10px;">
                                        <h6 style="font-size: 20px; font-weight: 400; line-height: 20px;" class="">
                                            {{translate($choice->title)}} :
                                        </h6>
                                        <ul class="option-select-btn custom_01_option flex-wrap weight-style--two gap-2">
                                            @foreach ($choice->options as $key => $option)
                                                <li>
                                                    <label>
                                                        <input type="radio" hidden="" id="{{ $choice->name }}-{{ $option }}"
                                                            name="{{ $choice->name }}" value="{{ $option }}" @if($key == 0)
                                                            checked @endif>
                                                        <span>{{$option}}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                                <div class="d-flex flex-wrap align-items-center mb-4 " style="padding-top: 10px;">
                                    <div class="quantity quantity--style-two"
                                        style="margin-right: 10px; padding: 7px 0px;">
                                        <span class="quantity__minus single-quantity-minus" style="padding: 0px 20px">
                                            <i class="bi bi-trash3-fill text-danger fs-10"></i>
                                        </span>
                                        <input type="text" class="quantity__qty product_quantity__qty" name="quantity"
                                            value="{{ $product?->minimum_order_qty ?? 1 }}"
                                            min="{{ $product?->minimum_order_qty ?? 1 }}"
                                            max="{{$product['product_type'] == 'physical' ? $product->current_stock : 100}}">
                                        <span style="padding: 0px 20px;" class="quantity__plus single-quantity-plus"
                                            {{($product->current_stock == 1 ? 'disabled' : '')}}>
                                            <i class="bi bi-plus"></i>
                                        </span>
                                    </div>
                                    @if(
                                            ($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) ||
                                            ($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate)))
                                        )
                                                                            <button type="button" class="btn btn-danger flex-grow-1" style="padding: 10px 40px;"
                                                                                disabled>{{translate('buy_now')}}
                                                                            </button>
                                    @else
                                    @php($guest_checkout=getWebConfig(name: 'guest_checkout'))
                                    <button type="button" class="btn btn-danger buy-now"
                                        style="padding: 10px 40px; margin-right: 10px;" data-form-id="add-to-cart-form"
                                        data-redirect-status="{{($guest_checkout == 1 || Auth::guard('customer')->check() ? 'true' : 'false')}}"
                                        data-action="{{route('shop-cart')}}">{{translate('buy_now')}}</span>
                                    </button>
                                    @endif

                                    <a class="btn-wishlist detail-product-btn-wish add-to-wishlist cursor-pointer wishlist-{{$product['id']}} {{($wishlistStatus == 1 ? 'wishlist_icon_active2' : '')}}"
                                        data-action="{{route('store-wishlist')}}" data-product-id="{{$product['id']}}"
                                        id="wishlist-{{$product['id']}}" title="{{translate('add_to_wishlist')}}">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                </div>
                                @if(
                                        ($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) ||
                                        ($product->added_by == 'admin' && ($sellerTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate)))
                                    )
                                                                    <div class="alert alert-danger mt-3" role="alert">
                                                                        {{translate('this_shop_is_temporary_closed_or_on_vacation') . '.' . translate('you_cannot_add_product_to_cart_from_this_shop_for_now')}}
                                                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="detail-custom-card">
                        <div class="card-body" style="border-radius: 4px 4px 0px 0px">
                            <div class="icon"><i class="bi bi-truck"></i></div>
                            <div class="content">
                                <h4>Free Delivery</h4>
                                <p>Enter your postal code for Delivery Availability</p>
                            </div>
                        </div>
                        <div class="card-body" style="border-radius: 0px 0px 4px 4px; border-top: none;">
                            <div class="icon"><i class="bi bi-arrow-repeat"></i></div>
                            <div class="content">
                                <h4>Return Delivery</h4>
                                <p>Free 30 Days Delivery Returns. Details</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @if (count($relatedProducts) > 0)
            <div class="py-5 mt-5">
                <div class="d-flex justify-content-between mb-5">
                    <span class="text-capitalize py-2 ps-3"
                        style="border-left: 14px solid red">{{translate('related_items')}}</span>
                </div>
                <div class="position-relative">
                    <div class="row">
                        @foreach($relatedProducts as $key => $relatedProduct)
                            @include('theme-views.partials._similar-product-large-card', ['product' => $relatedProduct])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif


    </div>
</main>
@endsection


@push('script')
    <script src="{{ theme_asset('assets/plugins/easyzoom/easyzoom.min.js') }}"></script>
    <script>
        'use strict';
        $(".easyzoom").each(function () {
            $(this).easyZoom();
        });
        getVariantPrice();
    </script>
@endpush