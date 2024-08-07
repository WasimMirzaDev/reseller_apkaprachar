@extends('layouts.front-end.app')

@section('title', $web_config['name']->value.' '.translate('online_Shopping').' | '.$web_config['name']->value.' '.translate('ecommerce'))

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <link rel="stylesheet" href="{{asset('public/assets/front-end/css/home.css')}}"/>
    <link rel="stylesheet" href="{{ asset('public/assets/front-end/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/front-end/css/owl.theme.default.min.css') }}">

    <style>
        /* body{
            background-color: #1f1f1f;
        } */
        /* .new-theme-card-bg-dark{
            background-color: #363636;
            color: #fff;
        } */
       
    </style>
@endpush

@section('content')
    <div class="__inline-61">
        @php($decimalPointSettings = !empty(getWebConfig(name: 'decimal_point_settings')) ? getWebConfig(name: 'decimal_point_settings') : 0)
        <section class="bg-transparent">
            <div class="container-fluid position-relative p-0">
                @include('web-views.partials._home-top-slider',['main_banner'=>$main_banner])
            </div>
        </section>

        {{-- @if ($web_config['flash_deals'] && count($web_config['flash_deals']->products) >0 )
            @include('web-views.partials._flash-deal', ['decimal_point_settings'=>$decimalPointSettings])
        @endif --}}

        

        {{-- @include('web-views.partials._category-section-home') --}}

        @if($web_config['featured_deals'] && (count($web_config['featured_deals'])>0))
            <section class="featured_deal rtl">
                <div class="container">
                    <div class="__featured-deal-wrap bg--light">
                        <div class="d-flex flex-wrap justify-content-between gap-8 mb-3">
                            <div class="w-0 flex-grow-1">
                                <span class="featured_deal_title font-bold text-dark">{{ translate('featured_deal')}}</span>
                                <br>
                                <span class="text-left text-nowrap">{{ translate('see_the_latest_deals_and_exciting_new_offers')}}!</span>
                            </div>
                            <div>
                                <a class="text-capitalize view-all-text web-text-primary" href="{{route('products',['data_from'=>'featured_deal'])}}">
                                    {{ translate('view_all')}}
                                    <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1'}}"></i>
                                </a>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme new-arrivals-product">
                            @foreach($web_config['featured_deals'] as $key=>$product)
                                @include('web-views.partials._product-card-1',['product'=>$product, 'decimal_point_settings'=>$decimalPointSettings])
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="container">
            @include('web-views.partials._category-section-home')
        </section>

        @if (isset($main_section_banner))
            <div class="container rtl pt-4 px-0 px-md-3">
                <a href="{{$main_section_banner->url}}" target="_blank"
                    class="cursor-pointer d-block">
                    <img class="d-block footer_banner_img __inline-63" alt=""
                         src="{{ getValidImage(path: 'storage/app/public/banner/'.$main_section_banner['photo'], type: 'wide-banner') }}">
                </a>
            </div>
        @endif

        @php($businessMode = getWebConfig(name: 'business_mode'))
        @if ($businessMode == 'multi' && count($top_sellers) > 0)
            @include('web-views.partials._top-sellers')
        @endif

       

        @if ($footer_banner->count() > 0 )
            @foreach($footer_banner as $key=>$banner)
            @if ($key == 0)
                <div class="container rtl d-sm-none">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <a href="{{$banner->url}}" class="d-block" target="_blank">
                                <img class="footer_banner_img __inline-63" alt=""
                                     src="{{ getValidImage(path: 'storage/app/public/banner/'.$banner['photo'], type: 'banner') }}">
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        @endif

        {{-- New arrival  --}}
        <div class="container">
            <ul class="nav nav-tabs d-flex align-items-center gap-2 adjust-tabs" style="">
                <li class="active" id="firstTab" onclick="changeCategoryTab(this.id)">
                    <a href="#tab1" id="firstTabA" data-toggle="tab" class="active" style="color: #696C70">Latest Prducts</a>
                </li>
                <li class="" id="secondTab" onclick="changeCategoryTab(this.id)"> 
                    <a href="#tab2" id="secondTabA" data-toggle="tab" class="" style="color: #696C70">New Arrivals</a>
                </li>
                <li class="" id="thirdTab" onclick="changeCategoryTab(this.id)">
                    <a href="#tab3" id="thirdTabA" data-toggle="tab" style="color: #696C70">Featured Products</a>
                </li>
                {{-- <li class="" id="forthTab" onclick="changeCategoryTab(this.id)">
                    <a href="#tab4" id="forthTabA" data-toggle="tab" style="color: #696C70">Categories</a>
                </li> --}}

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    @include('web-views.partials._deal-of-the-day', ['decimal_point_settings'=>$decimalPointSettings])
                </div>
                <div class="tab-pane" id="tab2">
                    <section class="new-arrival-section mt-3">

                        {{-- <div class="container rtl mt-4">
                            @if ($latest_products->count() >0 )
                                <div class="section-header">
                                    <div class="arrival-title d-block">
                                        <div class="text-capitalize">
                                            {{ translate('new_arrivals')}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div> --}}
                        <div class="container rtl mb-3 overflow-hidden">
                            <div class="py-2">
                                <div class="new_arrival_product">
                                    <div class="carousel-wrap">
                                        <div class="owl-carousel owl-theme new-arrivals-product">
                                            @foreach($latest_products as $key=> $product)
                                                @include('web-views.partials._product-card-2',['product'=>$product,'decimal_point_settings'=>$decimalPointSettings])
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="container rtl px-0 px-md-3">
                            <div class="row g-3 mx-max-md-0">
            
                                @if ($bestSellProduct->count() >0)
                                    @include('web-views.partials._best-selling')
                                @endif
            
                                @if ($topRated->count() >0)
                                    @include('web-views.partials._top-rated')
                                @endif
                            </div>
                        </div>
                    </section> 
                </div>
                <div class="tab-pane" id="tab3">
                    @if ($featured_products->count() > 0 )
                        <div class="container py-4 rtl px-0 px-md-3">
                            <div class="__inline-62 pt-3">
                                {{-- <div class="feature-product-title mt-0 web-text-primary">
                                    {{ translate('featured_products')}}
                                </div>
                                <div class="text-end px-3 d-none d-md-block">
                                    <a class="text-capitalize view-all-text web-text-primary" href="{{route('products',['data_from'=>'featured','page'=>1])}}">
                                        {{ translate('view_all')}}
                                        <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1'}}"></i>
                                    </a>
                                </div> --}}
                                <div class="feature-product">
                                    <div class="carousel-wrap p-1">
                                        <div class="owl-carousel owl-theme" id="featured_products_list">
                                            @foreach($featured_products as $product)
                                                <div>
                                                    @include('web-views.partials._feature-product',['product'=>$product, 'decimal_point_settings'=>$decimalPointSettings])
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="text-center pt-2 d-md-none">
                                        <a class="text-capitalize view-all-text web-text-primary" href="{{route('products',['data_from'=>'featured','page'=>1])}}">
                                            {{ translate('view_all')}}
                                            <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1' : 'right ml-1'}}"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                {{-- </div>
                <div class="tab-pane" id="tab4">
                    @include('web-views.partials._category-section-home')
                </div> --}}
            </div>
        </div>
        

        @if ($footer_banner->count() > 0 )
            @foreach($footer_banner as $key=>$banner)
            @if ($key == 1)
                <div class="container rtl pt-4 d-sm-none">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <a href="{{$banner->url}}" class="d-block" target="_blank">
                                <img class="footer_banner_img __inline-63"  alt=""
                                     src="{{ getValidImage(path: 'storage/app/public/banner/'.$banner['photo'], type: 'banner') }}">
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        @endif 

        @if ($footer_banner->count() > 0 )
            <div class="container rtl d-md-block d-none">
                <div class="row g-3">
                    @foreach($footer_banner as $banner)
                        <div class="col-md-6">
                            <a href="{{$banner->url}}" class="d-block" target="_blank">
                                <img class="footer_banner_img __inline-63"  alt=""
                                     src="{{ getValidImage(path: 'storage/app/public/banner/'.$banner['photo'], type: 'banner') }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if($web_config['brand_setting'] && $brands->count() > 0)
        <section class="container rtl pb-4 px-max-sm-0">
            <div class="">
                <div class="__p-20px rounded  overflow-hidden">
                    <div class="section-header">
                        <div class="text-black font-bold __text-22px">
                            <span> {{translate('brands')}}</span>
                        </div>
                        <div class="__mr-2px">
                            <a class="text-capitalize text-dark" href="{{route('brands')}}">
                                {{ translate('view_all')}}
                                <i class="text-dark czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                            </a>
                        </div>
                    </div>
    
                    <div class="mt-sm-3 mb-3 brand-slider">
                        <div class="owl-carousel owl-theme p-2 brands-slider pb-5 pb-sm-0">
                            @foreach($brands as $brand)
                                <div class="text-center">
                                    <a href="{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}"
                                       class="__brand-item">
                                        <img alt="{{ $brand->name }}"
                                            src="{{ getValidImage(path: "storage/app/public/brand/$brand->image", type: 'brand') }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif 

        @if ($home_categories->count() > 0)
            @foreach($home_categories as $category)
                @include('web-views.partials._category-wise-product', ['decimal_point_settings'=>$decimalPointSettings])
            @endforeach
        @endif 



        <!-- <section id="treandingProduct">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-4 col-xl-3"></div>
                </div>
            </div>
        </section> -->




        @php($companyReliability = getWebConfig(name: 'company_reliability'))
        @if($companyReliability != null)
            @include('web-views.partials._company-reliability')
        @endif
        

    </div>

    <span id="direction-from-session" data-value="{{ session()->get('direction') }}"></span>
@endsection

@push('script')
    <script src="{{asset('public/assets/front-end/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('public/assets/front-end/js/home.js') }}"></script>
    <script>
    $('.category-wise-product-slider-new').owlCarousel({
        loop: true,
        autoplay: true,
        margin: 20,
        nav: true,
        navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
        dots: false,
        autoplayHoverPause: true,
        rtl: directionFromSession === 'rtl',
        ltr: directionFromSession === 'ltr',
        responsive: {
            0: {
                items: 1.2
            },
            375: {
                items: 1.4
            },
            425: {
                items: 2
            },
            576: {
                items: 2
            },
            768: {
                items: 2.4
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            },
        },
    });

    function changetabs(id){
        if(id == 'firstTab'){
            return "tab1";
        }else if(id == 'secondTab'){
            return "tab2";
        }else if(id == 'thirdTab'){
            return "tab3";
        }else if(id == 'forthTab'){
            return "tab4";
        }
    }

    function changeCategoryTab(id){
        $('#firstTab').removeClass('active');
        $('#firstTabA').removeClass('active');
        $('#secondTab').removeClass('active');
        $('#secondTabA').removeClass('active');
        $('#thirdTab').removeClass('active');
        $('#thirdTabA').removeClass('active');
        $('#forthTab').removeClass('active');
        $('#forthTabA').removeClass('active');
        $('#tab1').removeClass('active');
        $('#tab2').removeClass('active');
        $('#tab3').removeClass('active');
        $('#tab4').removeClass('active');
        $('#' + id).addClass('active');
        $('#' + id + 'A').addClass('active');
        const tab = changetabs(id);
        $('#' + tab).addClass('active');
    }
    </script>
    
    {{-- <script src="https://app.taam.ai/user/serve-iframe-script/eyJpdiI6IkVuVTVnKzJ4MGpaUTAwaS9KQ05pMnc9PSIsInZhbHVlIjoiRGx4eGk2Unh5aU5wcHRGaWx1VUt6QT09IiwibWFjIjoiMjIwYTIyZGFiNzcxMGJhMmEwNjlmZGQ4NmNhNDcxMzc5YjBlMTY2MTFhOWUyZTA5ZGJjMzkwMTVjZGRmMGQwMyIsInRhZyI6IiJ9"></script> --}}
@endpush

