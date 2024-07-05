@extends('layouts.front-end.app')

@section('title', $product['name'])

@push('css_or_js')
    <meta name="description" content="{{ $product->slug }}">
    <meta name="keywords" content="@foreach (explode(' ', $product['name']) as $keyword) {{ $keyword . ' , ' }} @endforeach">
    @if ($product->added_by == 'seller')
        <meta name="author" content="{{ $product->seller->shop ? $product->seller->shop->name : $product->seller->f_name }}">
    @elseif($product->added_by == 'admin')
        <meta name="author" content="{{ $web_config['name']->value }}">
    @endif

    @if ($product['meta_image'] != null)
        <meta property="og:image" content="{{ asset('storage/app/public/product/meta') }}/{{ $product->meta_image }}" />
        <meta property="twitter:card" content="{{ asset('storage/app/public/product/meta') }}/{{ $product->meta_image }}" />
    @else
        <meta property="og:image" content="{{ asset('storage/app/public/product/thumbnail') }}/{{ $product->thumbnail }}" />
        <meta property="twitter:card"
            content="{{ asset('storage/app/public/product/thumbnail/') }}/{{ $product->thumbnail }}" />
    @endif

    @if ($product['meta_title'] != null)
        <meta property="og:title" content="{{ $product->meta_title }}" />
        <meta property="twitter:title" content="{{ $product->meta_title }}" />
    @else
        <meta property="og:title" content="{{ $product->name }}" />
        <meta property="twitter:title" content="{{ $product->name }}" />
    @endif
    <meta property="og:url" content="{{ route('product', [$product->slug]) }}">

    @if ($product['meta_description'] != null)
        <meta property="twitter:description" content="{!! $product['meta_description'] !!}">
        <meta property="og:description" content="{!! $product['meta_description'] !!}">
    @else
        <meta property="og:description"
            content="@foreach (explode(' ', $product['name']) as $keyword) {{ $keyword . ' , ' }} @endforeach">
        <meta property="twitter:description"
            content="@foreach (explode(' ', $product['name']) as $keyword) {{ $keyword . ' , ' }} @endforeach">
    @endif
    <meta property="twitter:url" content="{{ route('product', [$product->slug]) }}">

    <link rel="stylesheet" href="{{ asset('public/assets/front-end/css/product-details.css') }}" />
@endpush

@section('content')
    <style>
        .wish-list-btn:hover {
            background-color: #000;
        }

        .wish-list-btn:hover i {
            color: #fff;
        }
        .add-to-cart-btn{
            padding: 16px;
            width: calc(100% - 180px);
            border: 1px solid #000;
            color: #000;
            font-weight: 600;
            font-size: 16px;
            border-radius: 10px;
        }
        .add-to-cart-btn:hover{
            background-color: #000;
            color: #fff;
        }
        .buy-it-now-btn{
            padding: 16px;
            font-weight: 600;
            font-size: 16px;
            border-radius: 10px;
            color: #fff;
            background-color: #000;
        }
        .buy-it-now-btn:hover{
            color: #000;
            background-color: #d2ef9a;
        }
        .nav-tabs li a{
            color: #7f7f7f !important;
            font-size: 28px !important;
            font-weight: 600 !important;
            transition: width 1s ease-in-out !important;
        }
        .nav-tabs li a.active{
            color: #000 !important; 
            background: #fff !important; 
            text-decoration: underline;
            transition: width 1s ease-in-out !important;
        }
    </style>
    <div class="__inline-23">
        <div class="container mt-4 rtl text-align-direction">
            <div class="row {{ Session::get('direction') === 'rtl' ? '__dir-rtl' : '' }}">
                <div class="col-lg-12 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-5 col-12">
                            <div class="cz-product-gallery" style="padding-right: 45px;">
                                <div class="cz-preview p-0" style="height: 100vh; border-radius: 20px;">
                                    @if ($product->images != null && json_decode($product->images) > 0)
                                        @if (json_decode($product->colors) && $product->color_image)
                                            @foreach (json_decode($product->color_image) as $key => $photo)
                                                @if ($photo->color != null)
                                                    <div style="background: radial-gradient(circle, rgba(166, 166, 167, 1) 0%, rgba(114, 119, 126, 1) 100%); border-radius: 20px; border: none; padding: 0;"
                                                        class="cz-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                                        id="image{{ $photo->color }}">
                                                        <img class="cz-image-zoom img-responsive w-100"
                                                            style="max-height: 100% !important;"
                                                            src="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}"
                                                            data-zoom="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}"
                                                            alt="{{ translate('product') }}" width="">
                                                        <div class="cz-image-zoom-pane"></div>
                                                    </div>
                                                @else
                                                    <div style="background: radial-gradient(circle, rgba(166, 166, 167, 1) 0%, rgba(114, 119, 126, 1) 100%); border-radius: 20px; border: none; padding: 0;"
                                                        class="cz-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                                        id="image{{ $key }}">
                                                        <img class="cz-image-zoom img-responsive w-100"
                                                            style="max-height: 100% !important;"
                                                            src="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}"
                                                            data-zoom="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}"
                                                            alt="{{ translate('product') }}" width="">
                                                        <div class="cz-image-zoom-pane"></div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach (json_decode($product->images) as $key => $photo)
                                                <div class="cz-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                                    id="image{{ $key }}">
                                                    <img class="cz-image-zoom img-responsive w-100 __max-h-323px"
                                                        src="{{ getValidImage(path: 'storage/app/public/product/' . $photo, type: 'product') }}"
                                                        data-zoom="{{ getValidImage(path: 'storage/app/public/product/' . $photo, type: 'product') }}"
                                                        alt="{{ translate('product') }}" width="">
                                                    <div class="cz-image-zoom-pane"></div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                <div class="d-flex flex-column overflow-auto"
                                    style="position: absolute; z-index: 10; top: 17px; left: 25px; gap: 16px; height: calc(100vh - 35px); width: 119px;">
                                    @if ($product->images != null && json_decode($product->images) > 0)
                                        @if (json_decode($product->colors) && $product->color_image)
                                            @foreach (json_decode($product->color_image) as $key => $photo)
                                                @if ($photo->color != null)
                                                    <div class="" style="min-height: 140px">
                                                        <a class="cz-thumblist-item  {{ $key == 0 ? 'active' : '' }} d-flex align-items-center justify-content-center"
                                                            id="preview-img{{ $photo->color }}"
                                                            href="#image{{ $photo->color }}"
                                                            style="padding: 0; margin: 0; width: 100px; height: 140px; border-radius: 8px;">
                                                            <img alt="{{ translate('product') }}"
                                                                style="width: 100%; max-height: 100% !important; height: 140px !important; border-radius: 8px; background: radial-gradient(circle, rgba(166, 166, 167, 1) 0%, rgba(114, 119, 126, 1) 100%);"
                                                                src="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}">
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="" style="min-height: 140px">
                                                        <a class="cz-thumblist-item  {{ $key == 0 ? 'active' : '' }} d-flex align-items-center justify-content-center"
                                                            id="preview-img{{ $key }}"
                                                            href="#image{{ $key }}"
                                                            style="padding: 0; margin: 0; width: 100px; height: 140px; border-radius: 8px;">
                                                            <img alt="{{ translate('product') }}"
                                                                style="width: 100%; max-height: 100% !important; height: 140px !important; border-radius: 8px; background: radial-gradient(circle, rgba(166, 166, 167, 1) 0%, rgba(114, 119, 126, 1) 100%);"
                                                                src="{{ getValidImage(path: 'storage/app/public/product/' . $photo->image_name, type: 'product') }}">
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach (json_decode($product->images) as $key => $photo)
                                                <div class="cz-thumblist">
                                                    <a class="cz-thumblist-item  {{ $key == 0 ? 'active' : '' }} d-flex align-items-center justify-content-center"
                                                        id="preview-img{{ $key }}"
                                                        href="#image{{ $key }}">
                                                        <img alt="{{ translate('product') }}"
                                                            src="{{ getValidImage(path: 'storage/app/public/product/' . $photo, type: 'product') }}">
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                <div class="d-flex flex-column gap-3">
                                    <button type="button" data-product-id="{{ $product['id'] }}"
                                        class="btn __text-18px border wishList-pos-btn d-sm-none product-action-add-wishlist">
                                        <i class="fa {{ $wishlistStatus == 1 ? 'fa-heart' : 'fa-heart-o' }} wishlist_icon_{{ $product['id'] }} web-text-primary"
                                            aria-hidden="true"></i>
                                    </button>

                                    <div class="sharethis-inline-share-buttons share--icons text-align-direction"
                                        style="right: 68px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-7 col-12 mt-md-0 mt-sm-3 web-direction">
                            <div class="details __h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="mb-2 __inline-24"
                                            style="font-size: 30px !important; font-weight: 600px;">{{ $product->name }}</span>
                                        <div class="d-flex flex-wrap align-items-center mb-2 pro">
                                            <div class="star-rating me-2">
                                                @for ($inc = 1; $inc <= 5; $inc++)
                                                    @if ($inc <= (int) $overallRating[0])
                                                        <i class="tio-star text-warning"></i>
                                                    @elseif ($overallRating[0] != 0 && $inc <= (int) $overallRating[0] + 1.1 && $overallRating[0] > ((int) $overallRating[0]))
                                                        <i class="tio-star-half text-warning"></i>
                                                    @else
                                                        <i class="tio-star-outlined text-warning"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span
                                                class="d-inline-block  align-middle mt-1 {{ Session::get('direction') === 'rtl' ? 'ml-md-2 ml-sm-0' : 'mr-md-2 mr-sm-0' }} fs-14 text-muted">({{ $overallRating[0] }})</span>
                                            {{-- <span
                                                    class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}"><span class="web-text-primary">{{$overallRating[1]}}</span> {{translate('reviews')}}</span>
                                                <span class="__inline-25"></span>
                                                <span
                                                    class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}"><span class="web-text-primary">{{$countOrder}}</span> {{translate('orders')}}   </span>
                                                <span class="__inline-25">    </span>
                                                <span
                                                    class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}} text-capitalize"> <span class="web-text-primary countWishlist-{{ $product->id }}"> {{$countWishlist}}</span> {{translate('wish_listed')}} </span> --}}

                                        </div>
                                    </div>
                                    <button type="button" data-product-id="{{ $product['id'] }}"
                                        style="padding: 12px 17px !important;"
                                        class="__text-18px border d-none d-sm-block product-action-add-wishlist btn wish-list-btn">
                                        <i class="fa {{ $wishlistStatus == 1 ? 'fa-heart' : 'fa-heart-o' }} wishlist_icon_{{ $product['id'] }}"
                                            aria-hidden="true"></i>
                                        {{-- <span class="fs-14 text-muted align-bottom countWishlist-{{ $product['id'] }}">{{ $countWishlist }}</span> --}}
                                    </button>
                                </div>
                                <div class="mb-3">
                                    <span class="f-20 font-weight-normal text-accent "
                                        style="font-size: 27px; font-weight: 500 !important; color: #000 !important;">
                                        {!! getPriceRangeWithDiscount(product: $product) !!}
                                    </span>
                                </div>

                                <hr>

                                <form id="add-to-cart-form" class="mb-2 mt-4">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div
                                        class="position-relative {{ Session::get('direction') === 'rtl' ? 'ml-n4' : 'mr-n4' }} mb-2">
                                        @if (count(json_decode($product->colors)) > 0)
                                            <div class="flex-column align-items-center mb-2">
                                                <div class="product-description-label m-0 text-dark mb-2"
                                                    style="font-size: 16px; font-weight: 500;">
                                                    {{ translate('color') }}
                                                    :
                                                </div>
                                                <div>
                                                    <ul class="list-inline checkbox-color mb-0 flex-start">
                                                        @foreach (json_decode($product->colors) as $key => $color)
                                                            <li>
                                                                <input type="radio"
                                                                    id="{{ $product->id }}-color-{{ str_replace('#', '', $color) }}"
                                                                    name="color" value="{{ $color }}"
                                                                    @if ($key == 0) checked @endif>
                                                                <label style="background: {{ $color }};"
                                                                    class="focus-preview-image-by-color"
                                                                    for="{{ $product->id }}-color-{{ str_replace('#', '', $color) }}"
                                                                    data-toggle="tooltip"
                                                                    data-key="{{ str_replace('#', '', $color) }}">
                                                                    <span class="outline"></span></label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                            $qty = 0;
                                            if (!empty($product->variation)) {
                                                foreach (json_decode($product->variation) as $key => $variation) {
                                                    $qty += $variation->qty;
                                                }
                                            }
                                        @endphp
                                    </div>
                                    @foreach (json_decode($product->choice_options) as $key => $choice)
                                        <div class="row flex-column mx-0 mb-2">
                                            <div class="product-description-label text-dark font-bold {{ Session::get('direction') === 'rtl' ? 'pl-2' : 'pr-2' }} text-capitalize mb-2"
                                                style="font-size: 16px; font-weight: 500;">
                                                {{ $choice->title }}
                                                :
                                            </div>
                                            <div>
                                                <div
                                                    class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 row ps-0">
                                                    @foreach ($choice->options as $index => $option)
                                                        <div>
                                                            <div class="for-mobile-capacity"
                                                                style="min-width: 50px; max-width: 140px; height: 48px;">
                                                                <input type="radio"
                                                                    id="{{ $choice->name }}-{{ $option }}"
                                                                    name="{{ $choice->name }}"
                                                                    value="{{ $option }}"
                                                                    @if ($index == 0) checked @endif>
                                                                <label class="__text-12px"
                                                                    style="font-size: 20px !important; height: 100%; align-content: center; border-radius: 25px;"
                                                                    for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="mt-3">
                                        <div class="product-quantity d-flex flex-column __gap-15">
                                            <div class="d-flex  flex-column gap-3">
                                                <div class="product-description-label text-dark font-bold mt-0">
                                                    {{ translate('quantity') }} :
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <div class="d-flex justify-content-center align-items-center quantity-box border rounded border-base" style="background: #fff; width: 160px !important; border: 1px solid #000 !important; border-radius: 8px !important; justify-content: center !important;">
                                                        <span class="input-group-btn" style="padding: 0px 22px; font-size: 22px;">
                                                            <button class="btn btn-number __p-10 web-text-primary"
                                                                type="button" data-type="minus" data-field="quantity"
                                                                disabled="disabled" style="color: #000 !important;  font-weight: 600;">
                                                                -
                                                            </button>
                                                        </span>
                                                        <input type="text" name="quantity" style="color: #000 !important"
                                                            class="form-control input-number text-center cart-qty-field __inline-29 border-0 "
                                                            placeholder="{{ translate('1') }}"
                                                            value="{{ $product->minimum_order_qty ?? 1 }}"
                                                            data-producttype="{{ $product->product_type }}"
                                                            min="{{ $product->minimum_order_qty ?? 1 }}"
                                                            max="{{ $product['product_type'] == 'physical' ? $product->current_stock : 100 }}">
                                                        <span class="input-group-btn" style="padding: 0px 15px; font-size: 22px;">
                                                            <button class="btn btn-number __p-10 web-text-primary"
                                                                type="button"
                                                                data-producttype="{{ $product->product_type }}"
                                                                data-type="plus" data-field="quantity" style="color: #000 !important; font-weight: 600;">
                                                                +
                                                            </button>
                                                        </span>
                                                    </div>
                                                    @if (
                                                        ($product->added_by == 'seller' &&
                                                            ($sellerTemporaryClose ||
                                                                (isset($product->seller->shop) &&
                                                                    $product->seller->shop->vacation_status &&
                                                                    $currentDate >= $sellerVacationStartDate &&
                                                                    $currentDate <= $sellerVacationEndDate))) ||
                                                            ($product->added_by == 'admin' &&
                                                                ($inHouseTemporaryClose ||
                                                                    ($inHouseVacationStatus &&
                                                                        $currentDate >= $inHouseVacationStartDate &&
                                                                        $currentDate <= $inHouseVacationEndDate))))
                                                        <button class="btn add-to-cart-btn string-limit" type="button"
                                                            disabled>
                                                            ADD TO CART
                                                        </button>
                                                    @else
                                                        <button
                                                            class="btn add-to-cart-btn element-center btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} action-add-to-cart-form"
                                                            type="button">
                                                            <span
                                                                class="string-limit">ADD TO CART</span>
                                                        </button>
                                                    @endif
                                                </div>
                                                @if (
                                                    ($product->added_by == 'seller' &&
                                                        ($sellerTemporaryClose ||
                                                            (isset($product->seller->shop) &&
                                                                $product->seller->shop->vacation_status &&
                                                                $currentDate >= $sellerVacationStartDate &&
                                                                $currentDate <= $sellerVacationEndDate))) ||
                                                        ($product->added_by == 'admin' &&
                                                            ($inHouseTemporaryClose ||
                                                                ($inHouseVacationStatus &&
                                                                    $currentDate >= $inHouseVacationStartDate &&
                                                                    $currentDate <= $inHouseVacationEndDate))))
                                                    <button class="btn buy-it-now-btn" type="button" disabled>
                                                        BUY IT NOW
                                                    </button>
                                                @else
                                                    <button
                                                        class="btn buy-it-now-btn element-center btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} action-buy-now-this-product"
                                                        type="button">
                                                        <span class="string-limit">BUY IT NOW</span>
                                                    </button>
                                                @endif
                                            </div>
                                            <div id="chosen_price_div">
                                                <div
                                                    class="d-none d-sm-flex justify-content-start align-items-center me-2">
                                                    <div
                                                        class="product-description-label text-dark font-bold text-capitalize">
                                                        <strong>{{ translate('total_price') }}</strong> :
                                                    </div>
                                                    &nbsp; <strong id="chosen_price" class="text-base"></strong>
                                                    <small class="ms-2 font-regular">
                                                        (<small>{{ translate('tax') }} : </small>
                                                        <small id="set-tax-amount"></small>)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters d-none mt-2 flex-start d-flex">
                                        <div class="col-12">
                                            @if ($product['product_type'] == 'physical' && $product['current_stock'] <= 0)
                                                <h5 class="mt-3 text-danger">{{ translate('out_of_stock') }}</h5>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="__btn-grp mt-2 mb-3 d-none d-sm-flex">
                                        @if (($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) || ($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate))))
                                            <button class="btn btn-secondary" type="button" disabled>
                                                {{ translate('buy_now') }}
                                            </button>
                                            <button class="btn btn--primary string-limit" type="button" disabled>
                                                {{ translate('add_to_cart') }}
                                            </button>
                                        @else
                                            <button
                                                class="btn btn-secondary element-center btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} action-buy-now-this-product"
                                                type="button">
                                                <span class="string-limit">{{ translate('buy_now') }}</span>
                                            </button>
                                            <button
                                                class="btn btn--primary element-center btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} action-add-to-cart-form"
                                                type="button">
                                                <span class="string-limit">{{ translate('add_to_cart') }}</span>
                                            </button>
                                        @endif
                                        @if (($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) || ($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate))))
                                            <div class="alert alert-danger" role="alert">
                                                {{ translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now') }}
                                            </div>
                                        @endif
                                    </div> --}}
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-4 rtl col-12 text-align-direction">
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="px-4 pb-3 mb-3 mr-0 bg-white __review-overview __rounded-10 pt-3">
                                            <ul class="nav nav-tabs nav--tabs d-flex justify-content-center mt-3"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link __inline-27 active " href="#overview"
                                                       data-toggle="tab" role="tab">
                                                        {{translate('overview')}}
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link __inline-27" href="#reviews" data-toggle="tab"
                                                       role="tab">
                                                        {{translate('reviews')}}
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content px-lg-3">
                                                <div class="tab-pane fade show active text-justify" id="overview"
                                                     role="tabpanel">
                                                    <div class="row pt-2 specification">

                                                        @if ($product->video_url != null && str_contains($product->video_url, 'youtube.com/embed/'))
                                                            <div class="col-12 mb-4">
                                                                <iframe width="420" height="315"
                                                                        src="{{$product->video_url}}">
                                                                </iframe>
                                                            </div>
                                                        @endif
                                                        @if ($product['details'])
                                                            <div
                                                                class="text-body col-lg-12 col-md-12 overflow-scroll fs-13 text-justify">
                                                                {!! $product['details'] !!}
                                                            </div>
                                                        @endif

                                                    </div>
                                                    @if (!$product['details'] && ($product->video_url == null || !str_contains($product->video_url, 'youtube.com/embed/')))
                                                        <div>
                                                            <div class="text-center text-capitalize">
                                                                <img class="mw-90"
                                                                     src="{{asset('/public/assets/front-end/img/icons/nodata.svg')}}"
                                                                     alt="">
                                                                <p class="text-capitalize mt-2">
                                                                    <small>{{translate('product_details_not_found')}}
                                                                        !</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                                    @if (count($product->reviews) == 0 && $productReviews->total() == 0)
                                                        <div>
                                                            <div class="text-center text-capitalize">
                                                                <img class="mw-100"
                                                                     src="{{asset('/public/assets/front-end/img/icons/empty-review.svg')}}"
                                                                     alt="">
                                                                <p class="text-capitalize">
                                                                    <small>{{translate('No_review_given_yet')}}!</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row pt-2 pb-3">
                                                            <div class="col-lg-4 col-md-5 ">
                                                                <div
                                                                    class=" row d-flex justify-content-center align-items-center">
                                                                    <div
                                                                        class="col-12 d-flex justify-content-center align-items-center">
                                                                        <h2 class="overall_review mb-2 __inline-28">
                                                                            {{$overallRating[0]}}
                                                                        </h2>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center star-rating ">
                                                                        @for ($inc = 1; $inc <= 5; $inc++)
                                                                            @if ($inc <= (int) $overallRating[0])
                                                                                <i class="tio-star text-warning"></i>
                                                                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                                                                <i class="tio-star-half text-warning"></i>
                                                                            @else
                                                                                <i class="tio-star-outlined text-warning"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                    <div
                                                                        class="col-12 d-flex justify-content-center align-items-center mt-2">
                                                                        <span class="text-center">
                                                                            {{$productReviews->total()}} {{translate('ratings')}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0">
                                                                <div
                                                                    class="d-flex align-items-center mb-2 font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle text-body">{{translate('excellent')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress text-body __h-5px">
                                                                            <div class="progress-bar web--bg-primary"
                                                                                 role="progressbar"
                                                                                 style="width: <?php echo $widthRating = $rating[0] != 0 ? ($rating[0] / $overallRating[1]) * 100 : 0; ?>%;"
                                                                                 aria-valuenow="60" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 text-body">
                                                                        <span
                                                                            class=" {{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}} ">
                                                                            {{$rating[0]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('good')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                                 style="width: <?php echo $widthRating = $rating[1] != 0 ? ($rating[1] / $overallRating[1]) * 100 : 0; ?>%; background-color: #a7e453;"
                                                                                 aria-valuenow="27" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                                {{$rating[1]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('average')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                                 style="width: <?php echo $widthRating = $rating[2] != 0 ? ($rating[2] / $overallRating[1]) * 100 : 0; ?>%; background-color: #ffda75;"
                                                                                 aria-valuenow="17" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                            {{$rating[2]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt "><span
                                                                            class="d-inline-block align-middle">{{translate('below_Average')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                                 style="width: <?php echo $widthRating = $rating[3] != 0 ? ($rating[3] / $overallRating[1]) * 100 : 0; ?>%; background-color: #fea569;"
                                                                                 aria-valuenow="9" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                            {{$rating[3]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="d-flex align-items-center text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('poor')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                                 style="width: <?php echo $widthRating = $rating[4] != 0 ? ($rating[4] / $overallRating[1]) * 100 : 0; ?>%;"
                                                                                 aria-valuenow="4" aria-valuemin="0"
                                                                                 aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                                {{$rating[4]}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row pb-4 mb-3">
                                                            <div class="__inline-30">
                                                                <span
                                                                    class="text-capitalize">{{ translate('Product_review') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="row pb-4">
                                                        <div class="col-12" id="product-review-list">
                                                            @include('web-views.partials._product-reviews')
                                                        </div>

                                                        @if (count($product->reviews) > 2)
                                                            <div class="col-12">
                                                                <div
                                                                    class="card-footer d-flex justify-content-center align-items-center">
                                                                    <button class="btn text-white view_more_button web--bg-primary">
                                                                        {{ translate('view_more') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="bottom-sticky bg-white d-sm-none">
            <div class="d-flex flex-column gap-1 py-2">
                <div class="d-flex justify-content-center align-items-center fs-13">
                    <div class="product-description-label text-dark font-bold"><strong
                            class="text-capitalize">{{ translate('total_price') }}</strong> :
                    </div>
                    &nbsp; <strong id="chosen_price_mobile" class="text-base"></strong>
                    <small class="ml-2  font-regular">
                        (<small>{{ translate('tax') }} : </small>
                        <small id="set-tax-amount-mobile"></small>)
                    </small>
                </div>
                <div class="d-flex gap-3 justify-content-center">
                    @if (
                        ($product->added_by == 'seller' &&
                            ($sellerTemporaryClose ||
                                (isset($product->seller->shop) &&
                                    $product->seller->shop->vacation_status &&
                                    $currentDate >= $sellerVacationStartDate &&
                                    $currentDate <= $sellerVacationEndDate))) ||
                            ($product->added_by == 'admin' &&
                                ($inHouseTemporaryClose ||
                                    ($inHouseVacationStatus &&
                                        $currentDate >= $inHouseVacationStartDate &&
                                        $currentDate <= $inHouseVacationEndDate))))
                        <button
                            class="btn btn-secondary btn-sm btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"
                            type="button" disabled>
                            {{ translate('buy_now') }}
                        </button>
                        <button
                            class="btn btn--primary btn-sm string-limit btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"
                            type="button" disabled>
                            {{ translate('add_to_cart') }}
                        </button>
                    @else
                        <button
                            class="btn btn-secondary btn-sm btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} action-buy-now-this-product"
                            type="button">
                            <span class="string-limit">{{ translate('buy_now') }}</span>
                        </button>
                        <button
                            class="btn btn--primary btn-sm string-limit btn-gap-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} action-add-to-cart-form"
                            type="button">
                            <span class="string-limit">{{ translate('add_to_cart') }}</span>
                        </button>
                    @endif
                </div>
            </div>
        </div> --}}

        @if (count($relatedProducts) > 0)
            <div class="container rtl text-align-direction">
                <div class="card __card border-0">
                    <div class="card-body">
                        <div class="row flex-between">
                            <div class="ms-1">
                                <h4 class="text-capitalize font-bold">{{ translate('similar_products') }}</h4>
                            </div>
                            <div class="view_all d-flex justify-content-center align-items-center">
                                <div>
                                    @php($category = json_decode($product['category_ids']))
                                    @if ($category)
                                        <a class="text-capitalize view-all-text me-1" style="color: #000;"
                                            href="{{ route('products', ['id' => $category[0]->id, 'data_from' => 'category', 'page' => 1]) }}">{{ translate('view_all') }}
                                            <i class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 ' : 'right ml-1 mr-n1' }}" style="color: #000;"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            @foreach ($relatedProducts as $key => $relatedProduct)
                                <div class="col-xl-3 col-md-4 col-6">
                                    @include('web-views.partials._inline-single-product', [
                                        'product' => $relatedProduct,
                                        'decimal_point_settings' => $decimalPointSettings,
                                    ])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade rtl text-align-direction" id="show-modal-view" tabindex="-1" role="dialog"
            aria-labelledby="show-modal-image" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body flex justify-content-center">
                        <button class="btn btn-default __inline-33 dir-end-minus-7px" data-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                        <img class="element-center" id="attachment-view" src="" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.front-end.partials.modal._chatting', ['seller' => $product->seller])

    <div class="modal fade" id="remove-wishlist-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <div class="text-center">
                        <img src="{{ asset('/public/assets/front-end/img/icons/remove-wishlist.png') }}"
                            alt="{{ translate('wishlist') }}">
                        <h6 class="font-semibold mt-3 mb-4 mx-auto __max-w-220">
                            {{ translate('Product_has_been_removed_from_wishlist') }} ?
                        </h6>
                    </div>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="javascript:" class="btn btn--primary __rounded-10" data-dismiss="modal">
                            {{ translate('Okay') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <span id="route-review-list-product" data-url="{{ route('review-list-product') }}"></span>
    <span id="products-details-page-data" data-id="{{ $product['id'] }}"></span>
@endsection

@push('script')
    <script src="{{ asset('public/assets/front-end/js/product-details.js') }}"></script>
    <script type="text/javascript" async="async"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons">
    </script>
@endpush
