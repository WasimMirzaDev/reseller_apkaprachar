<style>
    /* .page-footer {
        background: #000;
    }
    .custom-light-primary-color-20 {
        background-color: #000;
    }
    .footer-header {
        color: #fff;
    }
    .__inline-9 .widget-list-link {
        color: #fff !important;
    }
    .page-footer {
        color: #fff;
    }
    .page-footer .form-control {
        background: #fff !important;
    } */

    footer, .custom-light-primary-color-20{
        background-color: #f7f7f7 !important;
        color: #000 !important;
    }
    .widget-list-item .widget-list-link{
        color: #000 !important;
        /* font-size: 18px !important;
        font-weight: 600 !important;
        transition: width 1s ease-in-out !important; */
    }
    .widget-list-link::before{
        content: "";
        position: absolute !important;
        left: 0 !important;
        bottom: 0px !important;
        width: 0 !important;
        height: 1px !important;
        background-color: #000 !important;
        transition: all ease 0.3s;
    }
    .widget-list-link:hover::before{
        width: 100%;
    }
    .footer-padding-bottom .text-nowrap form input::placeholder {
        color: #abb1bb;
        font-weight: 600;
    }
</style>
<div class="__inline-9 rtl">
    <div class="d-flex justify-content-center text-center custom-light-primary-color text-md-start mt-3 p-4" style="background-color: #fff;">
        <div class="col-md-3 d-flex justify-content-center">
            <div>
                <a href="{{route('about-us')}}">
                    <div class="text-center">
                        {{-- <img class="size-60" src="{{asset("public/assets/front-end/png/about-company.png")}}"
                             alt=""> --}}
                             <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"><g fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#000"><path d="m16 10l2.15.645c1.373.412 2.06.618 2.455 1.15c.395.53.395 1.248.395 2.681V22M8 9h3m-3 4h3m1 9v-3c0-.943 0-1.414-.293-1.707S10.943 17 10 17H9c-.943 0-1.414 0-1.707.293S7 18.057 7 19v3m-5 0h20"/><path d="M3 22V6.717c0-2.51 0-3.766.791-4.389s1.956-.284 4.287.392l5 1.451c1.406.408 2.109.612 2.515 1.169C16 5.896 16 6.653 16 8.169V22"/></g></svg>
                    </div>
                    <div class="text-center">
                        <p class="m-0">
                            {{ translate('about_Company')}}
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 d-flex justify-content-center">
            <div>
                <a href="{{route('contacts')}}">
                    <div class="text-center">
                        {{-- <img class="size-60" src="{{asset("public/assets/front-end/png/contact-us.png")}}"
                             alt=""> --}}
                             <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 14 14"><path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" d="M3 7V4.37A3.93 3.93 0 0 1 7 .5h0a3.93 3.93 0 0 1 4 3.87V7M1.5 5.5h1A.5.5 0 0 1 3 6v3a.5.5 0 0 1-.5.5h-1a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1Zm11 4h-1A.5.5 0 0 1 11 9V6a.5.5 0 0 1 .5-.5h1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1ZM9 12.25a2 2 0 0 0 2-2h0V8m-2 4.25a1.25 1.25 0 0 1-1.25 1.25h-1.5a1.25 1.25 0 0 1 0-2.5h1.5A1.25 1.25 0 0 1 9 12.25Z"/></svg>
                    </div>
                    <div class="text-center">
                        <p class="m-0">
                            {{ translate('contact_Us')}}
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 d-flex justify-content-center">
            <div>
                <a href="{{route('helpTopic')}}">
                    <div class="text-center">
                        {{-- <img class="size-60" src="{{asset("public/assets/front-end/png/faq.png")}}"
                             alt=""> --}}
                             <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 2048 2048"><path fill="#000" d="M587 1536h437l128 128H640l-384 384v-384H0V384h128v1152h256v203zM256 0h1664v1408h-384v384l-384-384H256zm1536 1280V128H384v1152h821l203 203v-203zm-768-128v-128h128v128zM832 512q0-53 20-99t55-82t81-55t100-20q53 0 99 20t82 55t55 81t20 100h-128q0-27-10-50t-27-40t-41-28t-50-10q-27 0-50 10t-40 27t-28 41t-10 50q0 29 14 52t35 45t47 44t46 51t36 63t14 81v48h-128v-48q0-29-14-52t-35-45t-47-44t-46-51t-36-62t-14-82"/></svg>
                    </div>
                    <div class="text-center">
                        <p class="m-0">
                            {{ translate('FAQ')}}
                        </p>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <footer class="page-footer font-small mdb-color rtl">
        <div class="pt-4 custom-light-primary-color-20">
            <div class="container text-center pe-md-1 px-md-0">

                <div
                    class="row text-center text-md-start mt-3">
                    <div class="col-md-3 footer-web-logo">
                        <a class="d-block" href="{{route('home')}}">
                            <img class="{{Session::get('direction') === "rtl" ? 'right-align' : ''}}"
                                 src="{{ getValidImage(path: 'storage/app/public/company/'.$web_config['footer_logo']->value, type: 'logo') }}"
                                 alt="{{ $web_config['name']->value }}"/>
                        </a>

                        @if($web_config['ios']['status'] || $web_config['android']['status'])
                            <div class="mt-4 pt-lg-4">
                                <h6 class="text-uppercase font-weight-bold footer-header align-items-center" style="color: #000 !important;">
                                    {{ translate('download_our_app')}}
                                </h6>
                            </div>
                        @endif

                        <div class="store-contents d-flex justify-content-start pr-lg-4">
                            @if($web_config['ios']['status'])
                                <div class="me-2 mb-2">
                                    <a class="" href="{{ $web_config['ios']['link'] }}" role="button">
                                        <img width="100" src="{{asset("public/assets/front-end/png/apple_app.png")}}"
                                             alt="">
                                    </a>
                                </div>
                            @endif

                            @if($web_config['android']['status'])
                                <div class="me-2 mb-2">
                                    <a href="{{ $web_config['android']['link'] }}" role="button">
                                        <img width="100" src="{{asset("public/assets/front-end/png/google_app.png")}}"
                                             alt="">
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">

                            <div class="col-md-4 footer-padding-bottom">
                                <h6 class="text-uppercase mb-4 font-weight-bold">{{ translate('special')}}</h6>
                                <ul class="widget-list __pb-10px" style="color: #000 !important;">
                                    @php($flash_deals=\App\Models\FlashDeal::where(['status'=>1,'deal_type'=>'flash_deal'])->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->first())
                                    @if(isset($flash_deals))
                                        <li class="widget-list-item">
                                            <a class="widget-list-link"
                                               href="{{route('flash-deals',[$flash_deals['id']])}}">
                                                {{ translate('flash_deal')}}
                                            </a>
                                        </li>
                                    @endif
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                           href="{{route('products',['data_from'=>'featured','page'=>1])}}">
                                            {{ translate('featured_products')}}
                                        </a>
                                    </li>
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                           href="{{route('products',['data_from'=>'latest','page'=>1])}}">
                                            {{ translate('latest_products')}}
                                        </a>
                                    </li>
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                           href="{{route('products',['data_from'=>'best-selling','page'=>1])}}">
                                            {{ translate('best_selling_product')}}
                                        </a>
                                    </li>
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                           href="{{route('products',['data_from'=>'top-rated','page'=>1])}}">
                                            {{ translate('top_rated_product')}}
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-md-4 footer-padding-bottom">
                                <h6 class="text-uppercase mb-4 font-weight-bold">{{ translate('account_&_shipping_info')}}</h6>
                                @php($refund_policy = getWebConfig(name: 'refund-policy'))
                                @php($return_policy = getWebConfig(name: 'return-policy'))
                                @php($cancellation_policy = getWebConfig(name: 'cancellation-policy'))
                                @if(auth('customer')->check())
                                    <ul class="widget-list __pb-10px">
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('user-account')}}">
                                                {{ translate('profile_info')}}
                                            </a>
                                        </li>

                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('track-order.index')}}">
                                                {{ translate('track_order')}}
                                            </a>
                                        </li>

                                        @if(isset($refund_policy['status']) && $refund_policy['status'] == 1)
                                            <li class="widget-list-item">
                                                <a class="widget-list-link" href="{{route('refund-policy')}}">
                                                    {{ translate('refund_policy')}}
                                                </a>
                                            </li>
                                        @endif

                                        @if(isset($return_policy['status']) && $return_policy['status'] == 1)
                                            <li class="widget-list-item">
                                                <a class="widget-list-link" href="{{route('return-policy')}}">
                                                    {{ translate('return_policy')}}
                                                </a>
                                            </li>
                                        @endif

                                        @if(isset($cancellation_policy['status']) && $cancellation_policy['status'] == 1)
                                            <li class="widget-list-item">
                                                <a class="widget-list-link" href="{{route('cancellation-policy')}}">
                                                    {{ translate('cancellation_policy')}}
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                @else
                                    <ul class="widget-list __pb-10px">
                                        <li class="widget-list-item">
                                            <a class="widget-list-link"
                                               href="{{route('customer.auth.login')}}">{{ translate('profile_info')}}</a>
                                        </li>
                                        <li class="widget-list-item">
                                            <a class="widget-list-link"
                                               href="{{route('customer.auth.login')}}">{{ translate('wish_list')}}</a>
                                        </li>

                                        <li class="widget-list-item">
                                            <a class="widget-list-link"
                                               href="{{route('track-order.index')}}">{{ translate('track_order')}}</a>
                                        </li>

                                        @if(isset($refund_policy['status']) && $refund_policy['status'] == 1)
                                            <li class="widget-list-item">
                                                <a class="widget-list-link"
                                                   href="{{route('refund-policy')}}">{{ translate('refund_policy')}}</a>
                                            </li>
                                        @endif

                                        @if(isset($return_policy['status']) && $return_policy['status'] == 1)
                                            <li class="widget-list-item">
                                                <a class="widget-list-link"
                                                   href="{{route('return-policy')}}">{{ translate('return_policy')}}</a>
                                            </li>
                                        @endif

                                        @if(isset($cancellation_policy['status']) && $cancellation_policy['status'] == 1)
                                            <li class="widget-list-item">
                                                <a class="widget-list-link"
                                                   href="{{route('cancellation-policy')}}">{{ translate('cancellation_policy')}}</a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            </div>
                            <div class="col-md-4 footer-padding-bottom">
                                <div class="mb-2">
                                    <h6 class="text-uppercase mb-4 font-weight-bold">{{ translate('newsletter')}}</h6>
                                    <span>{{ translate('subscribe_to_our_new_channel_to_get_latest_updates')}}</span>
                                </div>
                                <div class="text-nowrap mb-4 position-relative">
                                    <form action="{{ route('subscription') }}" method="post">
                                        @csrf
                                        <input type="email" name="subscription_email" style="font-size: 13px; font-weight: 600; border-radius: 13px; border: 1px solid #000 !important; color: #000 !important;"
                                               class="form-control subscribe-border text-align-direction p-12px"
                                               placeholder="{{ translate('your_Email_Address')}}" required>
                                        <button class="subscribe-button" type="submit" style="background: #000; border-radius: 14px !important; padding: 0px 10px !important;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 9"><path fill="#fff" d="M12.5 5h-9c-.28 0-.5-.22-.5-.5s.22-.5.5-.5h9c.28 0 .5.22.5.5s-.22.5-.5.5"/><path fill="#fff" d="M10 8.5a.47.47 0 0 1-.35-.15c-.2-.2-.2-.51 0-.71l3.15-3.15l-3.15-3.15c-.2-.2-.2-.51 0-.71s.51-.2.71 0l3.5 3.5c.2.2.2.51 0 .71l-3.5 3.5c-.1.1-.23.15-.35.15Z"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 {{Session::get('direction') === "rtl" ? ' flex-row-reverse' : ''}}">
                            <div class="col-md-7">
                                <div
                                    class="row d-flex align-items-center mobile-view-center-align justify-content-center justify-content-md-start">
                                    <div class="me-3">
                                        <span
                                            class="mb-4 font-weight-bold">{{ translate('start_a_conversation')}}</span>
                                    </div>
                                    <div
                                        class="flex-grow-1 d-none d-md-block {{Session::get('direction') === "rtl" ? 'mr-4 mx-sm-4' : 'mx-sm-4'}}" style="background: #000">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 start_address ">
                                        <div class="">
                                            <a class="widget-list-link" style="color: #000 !important;" href="{{ 'tel:'.$web_config['phone']->value }}">
                                                <span class="">
                                                    <i class="fa fa-phone m-2" style="color: #000 !important;"></i>{{getWebConfig(name: 'company_phone')}}
                                                </span>
                                            </a>

                                        </div>
                                        <div>
                                            <a class="widget-list-link" style="color: #000 !important;"
                                               href="{{ 'mailto:'.getWebConfig(name: 'company_email') }}">
                                                <span><i class="fa fa-envelope m-2" style="color: #000 !important;"></i> {{getWebConfig(name: 'company_email')}} </span>
                                            </a>
                                        </div>
                                        <div>
                                            @if(auth('customer')->check())
                                                <a class="widget-list-link" style="color: #000 !important;" href="{{route('account-tickets')}}">
                                                    <span><i class="fa fa-user-o m-2" style="color: #000 !important;"></i> {{ translate('support_ticket')}} </span>
                                                </a><br>
                                            @else
                                                <a class="widget-list-link" style="color: #000 !important;" href="{{route('customer.auth.login')}}">
                                                    <span><i class="fa fa-user-o m-2" style="color: #000 !important;"></i> {{ translate('support_ticket')}} </span>
                                                </a><br>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 ">
                                <div
                                    class="row pl-2 d-flex align-items-center mobile-view-center-align justify-content-center justify-content-md-start">
                                    <div>
                                        <span
                                            class="mb-4 font-weight-bold">{{ translate('address')}}</span>
                                    </div>
                                    <div
                                        class="flex-grow-1 d-none d-md-block {{Session::get('direction') === "rtl" ? 'mr-3 ' : 'ml-3'}}">
                                        <hr class="address_under_line" style="background-color: #000 !important;"/>
                                    </div>
                                </div>
                                <div class="pl-2">
                                    <span
                                        class="__text-14px d-flex align-items-sm-center flex-column flex-sm-row justify-content-center">
                                        <i class="fa fa-map-marker m-2"></i>
                                        <span>{{ getWebConfig(name: 'shop_address')}}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white-overlay-50">
            <div class="container px-0" style="border-top: 1px solid #abb1bb !important;">
                <div class="d-flex flex-wrap end-footer footer-end last-footer-content-align" style="padding: 10px 0px 6px;">
                    <div class="">
                        <p class="text-align-direction __text-16px mb-0">{{ $web_config['copyright_text']->value }}</p>
                    </div>
                    <div
                        class="max-sm-100 justify-content-center d-flex flex-wrap mt-md-3 mt-0 mb-md-3 text-align-direction">
                        @if($web_config['social_media'])
                            @foreach ($web_config['social_media'] as $item)
                                <span class="social-media ">
                                    @if ($item->name == "twitter")
                                        <a class="social-btn text-white sb-light sb-{{$item->name}} me-2 mb-2 d-flex justify-content-center align-items-center"
                                           target="_blank" href="{{$item->link}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16"
                                                 height="16" viewBox="0 0 24 24">
                                                <g opacity=".3">
                                                    <polygon fill="#fff" fill-rule="evenodd"
                                                     points="16.002,19 6.208,5 8.255,5 18.035,19"
                                                             clip-rule="evenodd">
                                                    </polygon>
                                                    <polygon points="8.776,4 4.288,4 15.481,20 19.953,20 8.776,4">
                                                    </polygon>
                                                </g>
                                                <polygon fill-rule="evenodd"
                                                         points="10.13,12.36 11.32,14.04 5.38,21 2.74,21"
                                                    clip-rule="evenodd">
                                                </polygon>
                                                <polygon fill-rule="evenodd"
                                                         points="20.74,3 13.78,11.16 12.6,9.47 18.14,3"
                                                         clip-rule="evenodd">
                                                </polygon>
                                                <path
                                                    d="M8.255,5l9.779,14h-2.032L6.208,5H8.255 M9.298,3h-6.93l12.593,18h6.91L9.298,3L9.298,3z"
                                                    fill="currentColor">
                                                </path>
                                            </svg>
                                        </a>
                                    @else
                                        <a class="social-btn text-white sb-light sb-{{$item->name}} me-2 mb-2"
                                           target="_blank" href="{{$item->link}}">
                                            <i class="{{$item->icon}}" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    </div>
                    <div class="d-flex __text-14px">
                        <div class="me-3">
                            <a class="widget-list-link" style="color: #000 !important;"
                               href="{{route('terms')}}">{{ translate('terms_&_conditions')}}</a>
                        </div>
                        <div>
                            <a class="widget-list-link" style="color: #000 !important;" href="{{route('privacy-policy')}}">
                                {{ translate('privacy_policy')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php($cookie = $web_config['cookie_setting'] ? json_decode($web_config['cookie_setting']['value'], true):null)
        @if($cookie && $cookie['status']==1)
            <section id="cookie-section"></section>
        @endif
    </footer>
</div>
