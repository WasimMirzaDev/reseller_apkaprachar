@php($announcement = getWebConfig(name: 'announcement'))

@if (isset($announcement) && $announcement['status'] == 1)
    <div class="text-center position-relative px-4 py-1" id="announcement"
        style="background-color: {{ $announcement['color'] }};color:{{ $announcement['text_color'] }}">
        <span>{{ $announcement['announcement'] }} </span>
        <span class="__close-announcement web-announcement-slideUp">X</span>
    </div>
@endif
<style>
    .navbar-expand-md .navbar-nav .nav-item button,
    .navbar-expand-md .navbar-nav .nav-item>a {
        transition: all ease 0.3s;
        color: #000 !important;

    }
    @media (max-width: 600px) {

    .theme_new_header li {
        width: 100%;
        text-align: start;
    }
    .nav-item .dropdown {
        padding: 0.425rem 0rem;
    }
    .adjust-tabs li a {
        font-size: 12px !important;
    }
    .store-contents {
        justify-content: center !important;
    }
    .page-footer .form-control {
        color: #000 !important;
    }
}

.navbar-tool-icon-box{
    width: 40px !important;
}
</style>

<header class="box-shadow-sm rtl __inline-10">
    {{-- <div class="topbar ">
        <div class="container">

            <div>
                <div class="topbar-text dropdown d-md-none ms-auto">
                    <a class="topbar-link" href="tel: {{$web_config['phone']->value}}">
                        <i class="fa fa-phone"></i> {{$web_config['phone']->value}}
                    </a>
                </div>
                <div class="d-none d-md-block mr-2 text-nowrap">
                    <a class="topbar-link d-none d-md-inline-block" href="tel:{{$web_config['phone']->value}}">
                        <i class="fa fa-phone"></i> {{$web_config['phone']->value}}
                    </a>
                </div>
            </div>

            <div>
                @php($currency_model = getWebConfig(name: 'currency_model'))
                @if ($currency_model == 'multi_currency')
                    <div class="topbar-text dropdown disable-autohide mr-4">
                        <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                            <span>{{session('currency_code')}} {{session('currency_symbol')}}</span>
                        </a>
                        <ul class="text-align-direction dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} min-width-160px">
                            @foreach (\App\Models\Currency::where('status', 1)->get() as $key => $currency)
                                <li class="dropdown-item cursor-pointer get-currency-change-function"
                                    data-code="{{$currency['code']}}">
                                    {{ $currency->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="topbar-text dropdown disable-autohide  __language-bar text-capitalize">
                    <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                        @foreach (json_decode($language['value'], true) as $data)
                            @if ($data['code'] == getDefaultLanguage())
                                <img class="mr-2" width="20"
                                     src="{{asset('public/assets/front-end/img/flags/'.$data['code'].'.png')}}"
                                     alt="{{$data['name']}}">
                                {{$data['name']}}
                            @endif
                        @endforeach
                    </a>
                    <ul class="text-align-direction dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}">
                        @foreach (json_decode($language['value'], true) as $key => $data)
                            @if ($data['status'] == 1)
                                <li class="change-language" data-action="{{route('change-language')}}" data-language-code="{{$data['code']}}">
                                    <a class="dropdown-item pb-1" href="javascript:">
                                        <img class="mr-2"
                                             width="20"
                                             src="{{asset('public/assets/front-end/img/flags/'.$data['code'].'.png')}}"
                                             alt="{{$data['name']}}"/>
                                        <span class="text-capitalize">{{$data['name']}}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- background-color: #d2ef9a; --}}

    <div class="navbar-sticky bg-light mobile-head">
        <div class="navbar navbar-expand-md navbar-light" style=" padding: 8px 0px;">
            <div class="container ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    {{-- <span class="navbar-toggler-icon"></span> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="#000" fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75M2 8a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 8m0 4.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75" clip-rule="evenodd"/></svg>
                </button>
                {{-- <a class="navbar-brand d-none d-sm-block mr-3 flex-shrink-0 __min-w-7rem"
                   href="{{route('home')}}">
                    <img class="__inline-11"
                         src="{{ getValidImage(path: 'storage/app/public/company/'.$web_config['web_logo']->value, type: 'logo') }}"
                         alt="{{$web_config['name']->value}}">
                </a> --}}
                {{-- <a class="navbar-brand d-sm-none"
                   href="{{route('home')}}">
                    <img class="mobile-logo-img __inline-12"
                         src="{{ getValidImage(path: 'storage/app/public/company/'.$web_config['mob_logo']->value, type: 'logo') }}"
                         alt="{{$web_config['name']->value}}"/>
                </a> --}}

                <div class="input-group-overlay search-form-mobile text-align-direction" style="width: 200px !important">
                    <div class="text-align-direction d-lg-none">
                        <button class="btn close-search-form-mobile">
                            <i class="tio-clear"></i>
                        </button>
                    </div>
                    <form action="{{ route('products') }}" type="submit" class="search_form"
                        style="border-radius: 6px; margin-bottom: 0px !important;">
                        <button class="input-group-append-overlay search_button" type="submit"
                            style="position: absolute; top: 1px; width: 40px; left: 1px; padding: 0px; height: calc(100% - 2px); border: none; background: #fff; border-radius: 7px;">
                            <span class="input-group-text h-100">
                                <i class="czi-search"></i>
                            </span>
                        </button>
                        <input class="form-control" type="text" style="padding-left: 42px; font-size: 11px; width: 200px !important;"
                            autocomplete="off" placeholder="{{ translate('What are you looking for?') }}..."
                            name="name">

                        <input name="data_from" value="search" hidden>
                        <input name="page" value="1" hidden>
                        <diV class="card search-card __inline-13">
                            <div class="card-body search-result-box __h-400px overflow-x-hidden overflow-y-auto"></div>
                        </diV>
                    </form>
                </div>
                <ul class="navbar-nav text-dark navbar-collapse theme_new_header collapse" id="navbarCollapse" style="width: 100% !important; max-width: 100% !important;">
                    <div class="w-100 d-md-none text-align-direction">
                        <button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-expanded="true">
                            <i class="tio-clear __text-26px"></i>
                        </button>
                    </div>
                    <li class="nav-item nav-item-home dropdown {{ request()->is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">{{ translate('home') }}</a>
                    </li>

                    @if (getWebConfig(name: 'product_brand'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"
                                data-toggle="dropdown">{{ translate('brand') }}</a>
                            <ul
                                class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }} scroll-bar">
                                @foreach (\App\Utils\BrandManager::get_active_brands() as $brand)
                                    <li class="__inline-17" style="border: none !important;">
                                        <div>
                                            <a class="dropdown-item"
                                                href="{{ route('products', ['id' => $brand['id'], 'data_from' => 'brand', 'page' => 1]) }}">
                                                {{ $brand['name'] }}
                                            </a>
                                        </div>
                                        <div class="align-baseline">
                                            @if ($brand['brand_products_count'] > 0)
                                                <span class="count-value px-2">({{ $brand['brand_products_count'] }})</span>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                                <li class="__inline-17" style="border: none !important;">
                                    <div>
                                        <a class="dropdown-item web-text-primary" href="{{ route('brands') }}">
                                            {{ translate('view_more') }}
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @php(
                        $discount_product = App\Models\Product::with(['reviews'])->active()->where('discount', '!=', 0)->count()
                        )
                    @if ($discount_product > 0)
                        <li class="nav-item dropdown {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link text-capitalize"
                                href="{{ route('products', ['data_from' => 'discounted', 'page' => 1]) }}">{{ translate('discounted_products') }}</a>
                        </li>
                    @endif

                    @php($businessMode = getWebConfig(name: 'business_mode'))
                    @if ($businessMode == 'multi')
                        <li class="nav-item dropdown {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link text-capitalize"
                                href="{{ route('vendors') }}">{{ translate('all_vendors') }}</a>
                        </li>
                    @endif

                    @if (auth('customer')->check())
                        <li class="nav-item d-md-none">
                            <a href="{{ route('user-account') }}" class="nav-link text-capitalize">
                                {{ translate('user_profile') }}
                            </a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a href="{{ route('wishlists') }}" class="nav-link">
                                {{ translate('Wishlist') }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item d-md-none">
                            <a class="dropdown-item pl-2" href="{{ route('customer.auth.login') }}">
                                <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in') }}
                            </a>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="dropdown-item pl-2" href="{{ route('customer.auth.sign-up') }}">
                                <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up') }}
                            </a>
                        </li>
                    @endif

                    @if ($businessMode == 'multi')
                        @if (getWebConfig(name: 'seller_registration'))
                            <li class="nav-item">
                                <div class="dropdown dropdown-item px-1">
                                    <button class="btn dropdown-toggle text-white text-max-md-dark text-capitalize px-2"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{ translate('vendor_zone') }}
                                    </button>
                                    <div class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction"
                                        aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item text-capitalize" href="{{ route('shop.apply') }}">
                                            {{ translate('become_a_vendor') }}
                                        </a>
                                        {{-- <div class="dropdown-divider"></div> --}}
                                        <a class="dropdown-item" href="{{ route('vendor.auth.login') }}">
                                            {{ translate('vendor_login') }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle ps-0"
                           href="javascript:" data-toggle="dropdown">
                            {{-- <i class="czi-menu align-middle mt-n1 me-2"></i> --}}
                            <span class="me-4">
                                {{ translate('categories')}}
                            </span>
                        </a>
                        <ul class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction">
                            @foreach($categories as $category)
                                <li class="dropdown-item dropdown d-flex justify-content-between">

                                    <a <?php if ($category->childes->count() > 0) echo "" ?>
                                       href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                        <span>{{$category['name']}}</span>

                                    </a>
                                    @if ($category->childes->count() > 0)
                                        <a data-toggle='dropdown' class=''>
                                            <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-16"></i>
                                        </a>
                                    @endif

                                    @if($category->childes->count()>0)
                                        <ul class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction">
                                            @foreach($category['childes'] as $subCategory)
                                                <li class="dropdown-item">
                                                    <a href="{{route('products',['id'=> $subCategory['id'],'data_from'=>'category','page'=>1])}}">
                                                        <span>{{$subCategory['name']}}</span>
                                                    </a>

                                                    @if($subCategory->childes->count()>0)
                                                        <a class="header-subcategories-links"
                                                           data-toggle='dropdown'>
                                                            <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-16"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            @foreach($subCategory['childes'] as $subSubCategory)
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                       href="{{route('products',['id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])}}">{{$subSubCategory['name']}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                    <a class="navbar-tool navbar-stuck-toggler d-md-none" href="#">
                        <span class="navbar-tool-tooltip">{{ translate('expand_Menu') }}</span>
                        <div class="navbar-tool-icon-box">
                            <i class="navbar-tool-icon czi-menu open-icon"></i>
                            <i class="navbar-tool-icon czi-close close-icon"></i>
                        </div>
                    </a>
                    <div
                        class="navbar-tool open-search-form-mobile d-lg-none {{ Session::get('direction') === 'rtl' ? 'mr-md-2' : 'ml-md-2' }}">
                        <a class="navbar-tool-icon-box" href="javascript:">
                            {{-- <i class="tio-search"></i> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="" viewBox="0 0 24 24"><path fill="none" stroke="#000" stroke-linecap="round" stroke-width="2" d="m21 21l-4.486-4.494M19 10.5a8.5 8.5 0 1 1-17 0a8.5 8.5 0 0 1 17 0Z"/></svg>
                        </a>
                    </div>
                    
                    @if (auth('customer')->check())
                        <div class="dropdown">
                            <a class="navbar-tool ml-2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="navbar-tool-icon-box">
                                    <div class="navbar-tool-icon-box">
                                        <img class="img-profile rounded-circle __inline-14" alt=""
                                            src="{{ getValidImage(path: 'storage/app/public/profile/' . auth('customer')->user()->image, type: 'avatar') }}">
                                    </div>
                                </div>
                                <div class="navbar-tool-text">
                                    <small>{{ translate('hello') }}, {{ auth('customer')->user()->f_name }}</small>
                                    {{ translate('dashboard') }}
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"
                                aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('account-oder') }}">
                                    {{ translate('my_Order') }} </a>
                                <a class="dropdown-item" href="{{ route('user-account') }}">
                                    {{ translate('my_Profile') }}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="{{ route('customer.auth.logout') }}">{{ translate('logout') }}</a>
                            </div>
                        </div>
                    @else
                        <div class="dropdown">
                            <a class="navbar-tool {{ Session::get('direction') === 'rtl' ? 'mr-md-2' : 'ml-md-2' }}"
                                type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="navbar-tool-icon-box">
                                    <div class="navbar-tool-icon-box">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="" viewBox="0 0 256 256"><path fill="#000000" d="M234.38 210a123.36 123.36 0 0 0-60.78-53.23a76 76 0 1 0-91.2 0A123.36 123.36 0 0 0 21.62 210a12 12 0 1 0 20.77 12c18.12-31.32 50.12-50 85.61-50s67.49 18.69 85.61 50a12 12 0 0 0 20.77-12M76 96a52 52 0 1 1 52 52a52.06 52.06 0 0 1-52-52"/></svg>

                                    </div>
                                </div>
                            </a>
                            <div class="text-align-direction dropdown-menu __auth-dropdown dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"
                                aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('customer.auth.login') }}">
                                    <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('customer.auth.sign-up') }}">
                                    <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up') }}
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="navbar-tool dropdown d-none d-md-block {{ Session::get('direction') === 'rtl' ? 'mr-md-2' : 'ml-md-2' }}">
                        <a class="navbar-tool-icon-box dropdown-toggle" href="{{ route('wishlists') }}">
                            <span class="navbar-tool-label" style="margin-top: 6px !important; margin-right: 6px !important;">
                                <span class="countWishlist">
                                    {{ session()->has('wish_list') ? count(session('wish_list')) : 0 }}
                                </span>
                            </span>
                            {{-- <i class="navbar-tool-icon czi-heart"></i> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="" viewBox="0 0 256 256"><path fill="#000" d="M178 36c-20.09 0-37.92 7.93-50 21.56C115.92 43.93 98.09 36 78 36a66.08 66.08 0 0 0-66 66c0 72.34 105.81 130.14 110.31 132.57a12 12 0 0 0 11.38 0C138.19 232.14 244 174.34 244 102a66.08 66.08 0 0 0-66-66m-5.49 142.36a328.7 328.7 0 0 1-44.51 31.8a328.7 328.7 0 0 1-44.51-31.8C61.82 159.77 36 131.42 36 102a42 42 0 0 1 42-42c17.8 0 32.7 9.4 38.89 24.54a12 12 0 0 0 22.22 0C145.3 69.4 160.2 60 178 60a42 42 0 0 1 42 42c0 29.42-25.82 57.77-47.49 76.36"/></svg>
                        </a>
                    </div>
                    <div id="cart_items">
                        @include('layouts.front-end.partials._cart')
                    </div>
                </div>
            </div>
        </div>
        @php(
                        $categories = \App\Models\Category::with(['childes.childes'])->where('position', 0)->priority()->paginate(11)
                    )
        {{-- <div class="navbar navbar-expand-md navbar-stuck-menu">
            <div class="container px-10px">
                <div class="collapse navbar-collapse text-align-direction" id="navbarCollapse">
                    <div class="w-100 d-md-none text-align-direction">
                        <button class="navbar-toggler p-0" type="button" data-toggle="collapse"
                            data-target="#navbarCollapse">
                            <i class="tio-clear __text-26px"></i>
                        </button>
                    </div>
                    @php(
                        $categories = \App\Models\Category::with(['childes.childes'])->where('position', 0)->priority()->paginate(11)
                    )
                    <ul class="navbar-nav mega-nav pr-lg-2 pl-lg-2 mr-2 d-none d-md-block __mega-nav">
                        <li class="nav-item {{ !request()->is('/') ? 'dropdown' : '' }}">

                            <a class="nav-link dropdown-toggle category-menu-toggle-btn ps-0" href="javascript:">
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.875 12.9195C9.875 12.422 9.6775 11.9452 9.32563 11.5939C8.97438 11.242 8.4975 11.0445 8 11.0445C6.75875 11.0445 4.86625 11.0445 3.625 11.0445C3.1275 11.0445 2.65062 11.242 2.29937 11.5939C1.9475 11.9452 1.75 12.422 1.75 12.9195V17.2945C1.75 17.792 1.9475 18.2689 2.29937 18.6202C2.65062 18.972 3.1275 19.1695 3.625 19.1695H8C8.4975 19.1695 8.97438 18.972 9.32563 18.6202C9.6775 18.2689 9.875 17.792 9.875 17.2945V12.9195ZM19.25 12.9195C19.25 12.422 19.0525 11.9452 18.7006 11.5939C18.3494 11.242 17.8725 11.0445 17.375 11.0445C16.1337 11.0445 14.2413 11.0445 13 11.0445C12.5025 11.0445 12.0256 11.242 11.6744 11.5939C11.3225 11.9452 11.125 12.422 11.125 12.9195V17.2945C11.125 17.792 11.3225 18.2689 11.6744 18.6202C12.0256 18.972 12.5025 19.1695 13 19.1695H17.375C17.8725 19.1695 18.3494 18.972 18.7006 18.6202C19.0525 18.2689 19.25 17.792 19.25 17.2945V12.9195ZM16.5131 9.66516L19.1206 7.05766C19.8525 6.32578 19.8525 5.13828 19.1206 4.4064L16.5131 1.79891C15.7813 1.06703 14.5937 1.06703 13.8619 1.79891L11.2544 4.4064C10.5225 5.13828 10.5225 6.32578 11.2544 7.05766L13.8619 9.66516C14.5937 10.397 15.7813 10.397 16.5131 9.66516ZM9.875 3.54453C9.875 3.04703 9.6775 2.57015 9.32563 2.2189C8.97438 1.86703 8.4975 1.66953 8 1.66953C6.75875 1.66953 4.86625 1.66953 3.625 1.66953C3.1275 1.66953 2.65062 1.86703 2.29937 2.2189C1.9475 2.57015 1.75 3.04703 1.75 3.54453V7.91953C1.75 8.41703 1.9475 8.89391 2.29937 9.24516C2.65062 9.59703 3.1275 9.79453 3.625 9.79453H8C8.4975 9.79453 8.97438 9.59703 9.32563 9.24516C9.6775 8.89391 9.875 8.41703 9.875 7.91953V3.54453Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="category-menu-toggle-btn-text">
                                    {{ translate('categories') }}
                                </span>
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mega-nav1 pr-md-2 pl-md-2 d-block d-xl-none">
                        <li class="nav-item dropdown d-md-none">
                            <a class="nav-link dropdown-toggle ps-0" href="javascript:" data-toggle="dropdown">
                                <i class="czi-menu align-middle mt-n1 me-2"></i>
                                <span class="me-4">
                                    {{ translate('categories') }}
                                </span>
                            </a>
                            <ul class="dropdown-menu __dropdown-menu-2 text-align-direction">
                                @foreach ($categories as $category)
                                    <li class="dropdown">

                                        <a <?php if ($category->childes->count() > 0) {
                                            echo '';
                                        } ?>
                                            href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                                            <span>{{ $category['name'] }}</span>

                                        </a>
                                        @if ($category->childes->count() > 0)
                                            <a data-toggle='dropdown' class='__ml-50px'>
                                                <i
                                                    class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} __inline-16"></i>
                                            </a>
                                        @endif

                                        @if ($category->childes->count() > 0)
                                            <ul class="dropdown-menu text-align-direction">
                                                @foreach ($category['childes'] as $subCategory)
                                                    <li class="dropdown">
                                                        <a
                                                            href="{{ route('products', ['id' => $subCategory['id'], 'data_from' => 'category', 'page' => 1]) }}">
                                                            <span>{{ $subCategory['name'] }}</span>
                                                        </a>

                                                        @if ($subCategory->childes->count() > 0)
                                                            <a class="header-subcategories-links"
                                                                data-toggle='dropdown'>
                                                                <i
                                                                    class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} __inline-16"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                @foreach ($subCategory['childes'] as $subSubCategory)
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('products', ['id' => $subSubCategory['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $subSubCategory['name'] }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item nav-item-home dropdown {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">{{ translate('home') }}</a>
                        </li>

                        @if (getWebConfig(name: 'product_brand'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                    data-toggle="dropdown">{{ translate('brand') }}</a>
                                <ul
                                    class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }} scroll-bar">
                                    @foreach (\App\Utils\BrandManager::get_active_brands() as $brand)
                                        <li class="__inline-17">
                                            <div>
                                                <a class="dropdown-item"
                                                    href="{{ route('products', ['id' => $brand['id'], 'data_from' => 'brand', 'page' => 1]) }}">
                                                    {{ $brand['name'] }}
                                                </a>
                                            </div>
                                            <div class="align-baseline">
                                                @if ($brand['brand_products_count'] > 0)
                                                    <span class="count-value px-2">(
                                                        {{ $brand['brand_products_count'] }} )</span>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="__inline-17">
                                        <div>
                                            <a class="dropdown-item web-text-primary" href="{{ route('brands') }}">
                                                {{ translate('view_more') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @php(
                $discount_product = App\Models\Product::with(['reviews'])->active()->where('discount', '!=', 0)->count()
            )
                        @if ($discount_product > 0)
                            <li class="nav-item dropdown {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link text-capitalize"
                                    href="{{ route('products', ['data_from' => 'discounted', 'page' => 1]) }}">{{ translate('discounted_products') }}</a>
                            </li>
                        @endif

                        @php($businessMode = getWebConfig(name: 'business_mode'))
                        @if ($businessMode == 'multi')
                            <li class="nav-item dropdown {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link text-capitalize"
                                    href="{{ route('vendors') }}">{{ translate('all_vendors') }}</a>
                            </li>
                        @endif

                        @if (auth('customer')->check())
                            <li class="nav-item d-md-none">
                                <a href="{{ route('user-account') }}" class="nav-link text-capitalize">
                                    {{ translate('user_profile') }}
                                </a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a href="{{ route('wishlists') }}" class="nav-link">
                                    {{ translate('Wishlist') }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item pl-2" href="{{ route('customer.auth.login') }}">
                                    <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in') }}
                                </a>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item pl-2" href="{{ route('customer.auth.sign-up') }}">
                                    <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up') }}
                                </a>
                            </li>
                        @endif

                        @if ($businessMode == 'multi')
                            @if (getWebConfig(name: 'seller_registration'))
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <button
                                            class="btn dropdown-toggle text-white text-max-md-dark text-capitalize ps-2"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            {{ translate('vendor_zone') }}
                                        </button>
                                        <div class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction"
                                            aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item text-capitalize"
                                                href="{{ route('shop.apply') }}">
                                                {{ translate('become_a_vendor') }}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('vendor.auth.login') }}">
                                                {{ translate('vendor_login') }}
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endif
                    </ul>
                    @if (auth('customer')->check())
                        <div class="logout-btn mt-auto d-md-none">
                            <hr>
                            <a href="{{ route('customer.auth.logout') }}" class="nav-link">
                                <strong class="text-base">{{ translate('logout') }}</strong>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div> --}}

        <div class="megamenu-wrap">
            <div class="container">
                <div class="category-menu-wrap">
                    <ul class="category-menu">
                        @foreach ($categories as $key => $category)
                            <li>
                                <a
                                    href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $category->name }}</a>
                                @if ($category->childes->count() > 0)
                                    <div class="mega_menu z-2">
                                        @foreach ($category->childes as $sub_category)
                                            <div class="mega_menu_inner">
                                                <h6>
                                                    <a
                                                        href="{{ route('products', ['id' => $sub_category['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $sub_category->name }}</a>
                                                </h6>
                                                @if ($sub_category->childes->count() > 0)
                                                    @foreach ($sub_category->childes as $sub_sub_category)
                                                        <div>
                                                            <a
                                                                href="{{ route('products', ['id' => $sub_sub_category['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $sub_sub_category->name }}</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        <li class="text-center">
                            <a href="{{ route('categories') }}"
                                class="text-primary font-weight-bold justify-content-center">
                                {{ translate('View_All') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

@push('script')
    <script>
        "use strict";

        $(".category-menu").find(".mega_menu").parents("li")
            .addClass("has-sub-item").find("> a")
            .append("<i class='czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}'></i>");
    </script>
@endpush
