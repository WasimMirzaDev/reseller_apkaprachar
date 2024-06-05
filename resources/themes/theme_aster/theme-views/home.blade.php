@extends('theme-views.layouts.app')

@section('title', 'Discover Affordable Chic | Your Ultimate Clothing Store | Apka Fashion')
@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}" />
    <meta property="og:title" content="Welcome To {{$web_config['name']->value}} Home" />
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
    <meta name="description"
        content="Elevate your style with Apka Fashion! Explore affordable and chic clothing, accessories, and more. Stay on trend and express your individuality. Your go-to destination for fashion that inspires.">
    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}" />
    <meta property="twitter:title" content="Welcome To {{$web_config['name']->value}} Home" />
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
@endpush

@section('content')
<main class="main-content d-flex flex-column gap-3 py-3">
    @include('theme-views.partials._main-banner')

    @if ($web_config['flash_deals'])
        @include('theme-views.partials._flash-deals')
    @endif

    <!-- @include('theme-views.partials._find-what-you-need') -->

    @if ($web_config['business_mode'] == 'multi' && count($top_sellers) > 0)
        <!-- @include('theme-views.partials._top-stores') -->
    @endif

    @if ($web_config['featured_deals']->count() > 0 && $featured_deals->count() > 0)
        <!-- @include('theme-views.partials._featured-deals') -->
    @endif

    <!-- @include('theme-views.partials._recommended-product') -->
    @if($web_config['business_mode'] == 'multi')
        <!-- @include('theme-views.partials._more-stores') -->
    @endif

    <style>
        .view {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .view a {
            padding: 5px 8px 4px;
            border: 1px solid #a2a2a2;
            border-radius: 50%;
            margin-bottom: 3px;
            display: none;
        }

        .card:hover .view a {
            display: block;
            transition: 2s;
        }

        .view a i {
            color: #a2a2a2;
        }

        .products-new .button {
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .category-card {
            background-color: #fff0;
            border: 1px solid #a2a2a2;
            border-radius: 0px;
            padding: 30px;
            min-width: 180px;
            color: #222;
        }

        .category-card img {
            text-align: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .category-card i {
            text-align: center;
            width: 100px;
            height: 100px;
            font-size: 50px;
            margin-bottom: 10px;
            color: #222;
        }

        .category-card:hover,
        .category-card:hover i {
            background-color: #db4444;
            color: #fff;
        }

        .nav-arrows {
            padding: 10px 12px;
            border-radius: 5px;
            background-color: #d3d3d3;
        }

        .feature-card {
            background-color: #fff0;
            border: none;
            text-align: center;
            box-shadow: none;

        }

        .feature-card .icon {
            background-color: #000;
            padding: 15px 20px;
            border: 8px solid #c1c0c1;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            margin: 0 auto;
        }

        .feature-card i {
            font-size: 26px;
            color: #fff;
        }

        .product-card {
            display: flex;
            justify-content: center;
            margin: 0 auto;
            box-shadow: none;
            border: none;
            border-radius: 0px;
            padding-bottom: 20px;
        }
        .product-card img{
            background-color: #ebebeb;
            padding: 25px;
            width: 100%;
        }
    </style>

    <section class="container-fluid">
        <div class="container">
            <div class="">
                <div class="py-4">
                    <span class="text-danger mb-2 ps-2 py-2"
                        style="border-left: 12px solid #db4444; font-weight: 700;">Our Products
                    </span>
                    <div class="d-flex flex-wrap justify-content-between gap-3 mb-5 mt-4">
                        <h2 class="text-capitalize">{{ translate('top_rated_products') }}</h2>
                        <div class="swiper-nav d-flex gap-2 align-items-center">
                            <div class="nav-arrows top-rated-nav-prev position-static rounded-circle">
                                <i class="bi bi-arrow-left"></i>
                            </div>
                            <div class="nav-arrows top-rated-nav-next position-static rounded-circle">
                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-container">
                        <div class="position-relative">
                            <div class="swiper" data-swiper-loop="true" data-swiper-margin="10"
                                data-swiper-pagination-el="null" data-swiper-navigation-next=".top-rated-nav-next"
                                data-swiper-navigation-prev=".top-rated-nav-prev"
                                data-swiper-breakpoints='{"0": {"slidesPerView": "1"}, "370": {"slidesPerView": "2"}, "560": {"slidesPerView": "3"}, "750": {"slidesPerView": "4"}, "970": {"slidesPerView": "5"}, "1200": {"slidesPerView": "6"}}'>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="category-card text-center">
                                            <!-- <img src="https://apkaprachar.com/storage/app/public/product/thumbnail/2024-02-25-65db3870ba80d.png" class="card-img-top" alt=""> -->
                                            <i class="bi bi-phone"></i>
                                            <div class="card-body">
                                                <p class="card-text">Mobile</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="category-card text-center">
                                            <!-- <img src="https://apkaprachar.com/storage/app/public/product/thumbnail/2024-02-25-65db3870ba80d.png" class="card-img-top" alt=""> -->
                                            <i class="bi bi-laptop"></i>
                                            <div class="card-body">
                                                <p class="card-text">Laptop</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="category-card text-center">
                                            <!-- <img src="https://apkaprachar.com/storage/app/public/product/thumbnail/2024-02-25-65db3870ba80d.png" class="card-img-top" alt=""> -->
                                            <i class="bi bi-smartwatch"></i>
                                            <div class="card-body">
                                                <p class="card-text">Watch</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="category-card text-center">
                                            <!-- <img src="https://apkaprachar.com/storage/app/public/product/thumbnail/2024-02-25-65db3870ba80d.png" class="card-img-top" alt=""> -->
                                            <i class="bi bi-camera"></i>
                                            <div class="card-body">
                                                <p class="card-text">Camera</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="category-card text-center">
                                            <!-- <img src="https://apkaprachar.com/storage/app/public/product/thumbnail/2024-02-25-65db3870ba80d.png" class="card-img-top" alt=""> -->
                                            <i class="bi bi-headphones"></i>
                                            <div class="card-body">
                                                <p class="card-text">Headphones</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="category-card text-center">
                                            <!-- <img src="https://apkaprachar.com/storage/app/public/product/thumbnail/2024-02-25-65db3870ba80d.png" class="card-img-top" alt=""> -->
                                            <i class="bi bi-controller"></i>
                                            <div class="card-body">
                                                <p class="card-text">Gaming</p>
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
    </section>


    @include('theme-views.partials._top-rated-products')


    <section class=" mt-5">
        <div class="container mt-4">
            <div class="py-5 rounded position-relative" style="height: 440px;">
                <img height="100%"
                    src="https://i.pinimg.com/originals/be/f5/11/bef5119b310a72b48e88ef40fcf2d9a9.jpg"
                    alt="" class="position-absolute dark-support img-fit start-0 top-0 index-n1 flipX-in-rtl h-100">
                <div class="row justify-content-center h-100" style="padding-left: 40px;" >
                    <div class=" ps-5 align-items-center">
                        <h6 class="text-primary mb-5 text-capitalize text-success">{{ translate('Category') }}!</h6>
                        <h2 class="fs-2 mb-5 text-capitalize text-light">
                            {{ translate('Enhance Your Experience With Us!!!') }}
                        </h2>
                        <div class="d-flex gap-3 mb-5">
                            <div class="flex-column bg-light rounded-circle p-3 text-center align-items-center"
                                style="width: 80px; height: 80px">
                                <h2>23</h2>
                                <small>Days</small>
                            </div>
                            <div class="flex-column bg-light rounded-circle p-3 text-center align-items-center"
                                style="width: 80px; height: 80px">
                                <h2>12</h2>
                                <small>Hours</small>
                            </div>
                            <div class="flex-column bg-light rounded-circle p-3 text-center align-items-center"
                                style="width: 80px; height: 80px">
                                <h2>34</h2>
                                <small>Min</small>
                            </div>
                            <div class="flex-column bg-light rounded-circle p-3 text-center align-items-center"
                                style="width: 80px; height: 80px">
                                <h2>59</h2>
                                <small>Sec</small>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a href="{{$main_section_banner ? $main_section_banner->url : ''}}"
                                class="btn btn-success text-capitalize">{{ translate('shop_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid mb-5">
        <div class="container">
            <div class="row g-4 mt-5 products-new">
                <div class="col-12">
                    <span class="text-danger mb-2 ps-2 py-2"
                        style="border-left: 12px solid #db4444; font-weight: 700">Our Products</span>
                </div>
                <div class="col-12">
                    <h2>Explore Our Products</h2>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="view">
                            <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                            <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                        </div>
                        <img src="http://techtrack.test/reseller_apkaprachar/storage/app/public/product/thumbnail/2024-02-25-65db28cf055a5.webp"
                            class="w-100" alt="...">
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            ( 2 )
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="view">
                            <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                            <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                        </div>
                        <img src="http://techtrack.test/reseller_apkaprachar/storage/app/public/product/thumbnail/2024-02-25-65db28cf055a5.webp"
                            class="w-100" alt="...">
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            ( 2 )
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="view">
                            <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                            <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                        </div>
                        <img src="http://techtrack.test/reseller_apkaprachar/storage/app/public/product/thumbnail/2024-02-25-65db28cf055a5.webp"
                            class="w-100" alt="...">
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            ( 2 )
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="view">
                            <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                            <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                        </div>
                        <img src="http://techtrack.test/reseller_apkaprachar/storage/app/public/product/thumbnail/2024-02-25-65db28cf055a5.webp"
                            class="w-100" alt="...">
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            ( 2 )
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="view">
                            <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                            <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                        </div>
                        <img src="http://techtrack.test/reseller_apkaprachar/storage/app/public/product/thumbnail/2024-02-25-65db28cf055a5.webp"
                            class="w-100" alt="...">
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            ( 2 )
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="view">
                            <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                            <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                        </div>
                        <img src="http://techtrack.test/reseller_apkaprachar/storage/app/public/product/thumbnail/2024-02-25-65db28cf055a5.webp"
                            class="w-100" alt="...">
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            ( 2 )
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="view">
                            <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                            <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                        </div>
                        <img src="http://techtrack.test/reseller_apkaprachar/storage/app/public/product/thumbnail/2024-02-25-65db28cf055a5.webp"
                            class="w-100" alt="...">
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            ( 2 )
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="view">
                            <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                            <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                        </div>
                        <img src="http://techtrack.test/reseller_apkaprachar/storage/app/public/product/thumbnail/2024-02-25-65db28cf055a5.webp"
                            class="w-100" alt="...">
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            ( 2 )
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-5 button">
                    <button type="button" class="btn btn-danger">View All Products</button>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid mb-5">
        <div class="container">
            <div class="row g-4 my-5 products-new">
                <div class="col-12">
                    <span class="text-danger mb-2 ps-2 py-2"
                        style="border-left: 12px solid #db4444; font-weight: 700;">Features</span>
                </div>
                <div class="col-12">
                    <h2>New Arrival</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-4">
                <div class="col-sm-12 col-md-6">
                    <img src="https://www.structural.net/wp-content/uploads/2016/06/PNG-Image-480-%c3%97-500-pixels.png" alt="" class="w-100">
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <img src="https://i.pinimg.com/564x/39/64/de/3964de7982d181507a5efefdef8ccbf7.jpg" alt="" class="w-100">
                        </div>
                        <div class="col-6">
                            <img src="https://www.structural.net/wp-content/uploads/2016/06/PNG-Image-480-%c3%97-500-pixels.png" alt="" class="w-100">
                        </div>
                        <div class="col-6">
                            <img src="https://www.structural.net/wp-content/uploads/2016/06/PNG-Image-480-%c3%97-500-pixels.png" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card card text-center">
                    <div class="icon ">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Free And Fast Delivery</h5>
                        <p class="card-text">Free Delievery For All Orders Over $140</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card card text-center">
                    <div class="icon ">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Free And Fast Delivery</h5>
                        <p class="card-text">Free Delievery For All Orders Over $140</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card card text-center">
                    <div class="icon ">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Free And Fast Delivery</h5>
                        <p class="card-text">Free Delievery For All Orders Over $140</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- @include('theme-views.partials._best-deal-just-for-you') -->

    <!-- @include('theme-views.partials._home-categories') -->
    <!-- @if (!empty($main_section_banner))
        <section class="">
            <div class="container">
                <div class="py-5 rounded position-relative">
                    <img src="{{ getValidImage(path: 'storage/app/public/banner/'.($main_section_banner ? $main_section_banner['photo'] : ''), type:'banner') }}"
                         alt="" class="rounded position-absolute dark-support img-fit start-0 top-0 index-n1 flipX-in-rtl">
                    <div class="row justify-content-center">
                        <div class="col-10 py-4">
                            <h6 class="text-primary mb-2 text-capitalize">{{ translate('do_not_miss_today`s_deal') }}!</h6>
                            <h2 class="fs-2 mb-4 absolute-dark text-capitalize">{{ translate('let_us_shopping_today') }}</h2>
                            <div class="d-flex">
                                <a href="{{$main_section_banner ? $main_section_banner->url:''}}" class="btn btn-primary fs-16 text-capitalize">{{ translate('shop_now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif -->
</main>
@endsection