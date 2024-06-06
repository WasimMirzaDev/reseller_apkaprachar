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

    <section class="container-fluid my-5">
        <div class="container">
            <div class="row pb-5">
                <div class="col-12">
                    <span class="text-danger mb-2 ps-2 py-2"
                        style="border-left: 12px solid #db4444; font-weight: 700;">Our Products
                    </span>
                </div>
                <div class="col-12">
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
                </div>
                <div class="col-12">
                    <div class="swiper-container">
                        <div class="position-relative">
                            <div class="swiper" data-swiper-loop="true" data-swiper-margin="20"
                                data-swiper-pagination-el="null" data-swiper-navigation-next=".top-rated-nav-next"
                                data-swiper-navigation-prev=".top-rated-nav-prev"
                                data-swiper-breakpoints='{"0": {"slidesPerView": "1"}, "410": {"slidesPerView": "2"}, "768": {"slidesPerView": "3"}, "993": {"slidesPerView": "4"}, "1200": {"slidesPerView": "5"}, "1440": {"slidesPerView": "6"}}'>
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
            <hr>
        </div>
    </section>

    @include('theme-views.partials._top-rated-products')


    <section class="mt-5">
        <div class="container mt-4">
            <div class="py-5 rounded position-relative" style="height: 440px;">
                <img height="100%" src="https://i.pinimg.com/originals/be/f5/11/bef5119b310a72b48e88ef40fcf2d9a9.jpg"
                    alt="" class="position-absolute dark-support img-fit start-0 top-0 index-n1 flipX-in-rtl h-100">
                <div class="row h-100 ps-0 ps-md-3">
                    <div class="col-6">
                        <div class=" ps-3 ps-md-5 align-items-center">
                            <h6 class="text-primary mb-5 text-capitalize text-success">{{ translate('Category') }}!</h6>
                            <h2 class="fs-2 mb-5 text-capitalize text-light">
                                {{ translate('Enhance Your Experience With Us!!!') }}
                            </h2>
                            <div class="d-flex gap-2 mb-5">
                                <div class="flex-column bg-light rounded-circle p-2 text-center align-items-center"
                                    style="width: 55px;">
                                    <h4>23</h4>
                                    <small>Days</small>
                                </div>
                                <div class="flex-column bg-light rounded-circle p-2 text-center align-items-center"
                                    style="width: 55px;">
                                    <h4>12</h4>
                                    <small>Hours</small>
                                </div>
                                <div class="flex-column bg-light rounded-circle p-2 text-center align-items-center"
                                    style="width: 55px;">
                                    <h4>34</h4>
                                    <small>Min</small>
                                </div>
                                <div class="flex-column bg-light rounded-circle p-2 text-center align-items-center"
                                    style="width: 55px;">
                                    <h4>59</h4>
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
                        <div class="img">
                            <div class="view">
                                <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                                <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                            </div>
                            <div class="buyNowBtn">
                                <a href="#" class="btn bg-dark text-light w-100">Add To Cart</a>
                            </div>
                            <img src="http://techtrack.test/reseller_apkaprachar/resources/themes/theme_aster/public/assets/img/KEYBOARD.jpg"
                                class="w-100" alt="...">
                        </div>
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>(2)</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="img">
                            <div class="view">
                                <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                                <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                            </div>
                            <div class="buyNowBtn">
                                <a href="#" class="btn bg-dark text-light w-100">Add To Cart</a>
                            </div>
                            <img src="http://techtrack.test/reseller_apkaprachar/resources/themes/theme_aster/public/assets/img/KEYBOARD.jpg"
                                class="w-100" alt="...">
                        </div>
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>(2)</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="img">
                            <div class="view">
                                <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                                <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                            </div>
                            <div class="buyNowBtn">
                                <a href="#" class="btn bg-dark text-light w-100">Add To Cart</a>
                            </div>
                            <img src="http://techtrack.test/reseller_apkaprachar/resources/themes/theme_aster/public/assets/img/KEYBOARD.jpg"
                                class="w-100" alt="...">
                        </div>
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>(2)</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="img">
                            <div class="view">
                                <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                                <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                            </div>
                            <div class="buyNowBtn">
                                <a href="#" class="btn bg-dark text-light w-100">Add To Cart</a>
                            </div>
                            <img src="http://techtrack.test/reseller_apkaprachar/resources/themes/theme_aster/public/assets/img/KEYBOARD.jpg"
                                class="w-100" alt="...">
                        </div>
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>(2)</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="img">
                            <div class="view">
                                <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                                <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                            </div>
                            <div class="buyNowBtn">
                                <a href="#" class="btn bg-dark text-light w-100">Add To Cart</a>
                            </div>
                            <img src="http://techtrack.test/reseller_apkaprachar/resources/themes/theme_aster/public/assets/img/KEYBOARD.jpg"
                                class="w-100" alt="...">
                        </div>
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>(2)</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="img">
                            <div class="view">
                                <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                                <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                            </div>
                            <div class="buyNowBtn">
                                <a href="#" class="btn bg-dark text-light w-100">Add To Cart</a>
                            </div>
                            <img src="http://techtrack.test/reseller_apkaprachar/resources/themes/theme_aster/public/assets/img/KEYBOARD.jpg"
                                class="w-100" alt="...">
                        </div>
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>(2)</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="img">
                            <div class="view">
                                <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                                <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                            </div>
                            <div class="buyNowBtn">
                                <a href="#" class="btn bg-dark text-light w-100">Add To Cart</a>
                            </div>
                            <img src="http://techtrack.test/reseller_apkaprachar/resources/themes/theme_aster/public/assets/img/KEYBOARD.jpg"
                                class="w-100" alt="...">
                        </div>
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>(2)</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card" style="background-color: #fff0;">
                        <div class="img">
                            <div class="view">
                                <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                                <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
                            </div>
                            <div class="buyNowBtn">
                                <a href="#" class="btn bg-dark text-light w-100">Add To Cart</a>
                            </div>
                            <img src="http://techtrack.test/reseller_apkaprachar/resources/themes/theme_aster/public/assets/img/KEYBOARD.jpg"
                                class="w-100" alt="...">
                        </div>
                        <div class="card-body p-0 pt-3">
                            <h5 class="card-title">Product Name</h5>
                            <strong class="text-danger pe-2">$45</strong> <wbr>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>(2)</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-5 button">
                    <button type="button" class="btn btn-danger py-2 px-4">View All Products</button>
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
                    <img src="https://www.structural.net/wp-content/uploads/2016/06/PNG-Image-480-%c3%97-500-pixels.png"
                        alt="" class="w-100">
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <img src="https://i.pinimg.com/564x/39/64/de/3964de7982d181507a5efefdef8ccbf7.jpg" alt=""
                                class="w-100">
                        </div>
                        <div class="col-6">
                            <img src="https://www.structural.net/wp-content/uploads/2016/06/PNG-Image-480-%c3%97-500-pixels.png"
                                alt="" class="w-100">
                        </div>
                        <div class="col-6">
                            <img src="https://www.structural.net/wp-content/uploads/2016/06/PNG-Image-480-%c3%97-500-pixels.png"
                                alt="" class="w-100">
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