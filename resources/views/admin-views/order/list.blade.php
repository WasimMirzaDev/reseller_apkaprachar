@extends('layouts.back-end.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@section('title', translate('order_List'))

@section('content')
    <div class="content container-fluid">
        <div>
            <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                <h2 class="h1 mb-0">
                    <img src="{{asset('/public/assets/back-end/img/all-orders.png')}}" class="mb-1 mr-1" alt="">
                    <span class="page-header-title">
                        @if($status =='processing')
                            {{translate('packaging')}}
                        @elseif($status =='failed')
                            {{translate('failed_to_Deliver')}}
                        @elseif($status == 'all')
                            {{translate('all')}}
                        @else
                            {{translate(str_replace('_',' ',$status))}}
                        @endif
                    </span>
                    {{translate('orders')}}
                </h2>
                <span class="badge badge-soft-dark radius-50 fz-14">{{$orders->total()}}</span>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.orders.list',['status'=>request('status')])}}" id="form-data" method="GET">
                        <div class="row gx-2">
                            <div class="col-12">
                                <h4 class="mb-3 text-capitalize">{{translate('filter_order')}}</h4>
                            </div>
                            @if(request('delivery_man_id'))
                                <input type="hidden" name="delivery_man_id" value="{{ request('delivery_man_id') }}">
                            @endif

                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label class="title-color text-capitalize" for="filter">{{translate('order_type')}}</label>
                                    <select name="filter" id="filter" class="form-control">
                                        <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>{{translate('all')}}</option>
                                        <option value="admin" {{ $filter == 'admin' ? 'selected' : '' }}>{{translate('in_House_Order')}}</option>
                                        <option value="seller" {{ $filter == 'seller' ? 'selected' : '' }}>{{translate('vendor_Order')}}</option>
                                        @if(($status == 'all' || $status == 'delivered') && !request()->has('delivery_man_id'))
                                        <option value="POS" {{ $filter == 'POS' ? 'selected' : '' }}>{{translate('POS_Order')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3" id="seller_id_area" style="{{ $filter && $filter == 'admin'?'display:none':'' }}">
                                <div class="form-group">
                                    <label class="title-color" for="store">{{translate('store')}}</label>
                                    <select name="seller_id" id="seller_id" class="form-control">
                                        <option value="all">{{translate('all_shop')}}</option>
                                        <option value="0" id="seller_id_inhouse" {{request('seller_id') == 0 ? 'selected' :''}}>{{translate('inhouse')}}</option>
                                        @foreach ($sellers as $seller)
                                            @isset($seller->shop)
                                                <option value="{{$seller->id}}"{{request('seller_id') == $seller->id ? 'selected' :''}}>
                                                    {{ $seller->shop->name }}
                                                </option>
                                            @endisset
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label class="title-color" for="customer">{{translate('customer')}}</label>

                                    <input type="hidden" id='customer_id'  name="customer_id" value="{{request('customer_id') ? request('customer_id') : 'all'}}">
                                    <select  id="customer_id_value"
                                    data-placeholder="@if($customer == 'all')
                                                        {{translate('all_customer')}}
                                                    @else
                                                        {{$customer->name ?? $customer->f_name.' '.$customer->l_name.' '.'('.$customer->phone.')'}}
                                                    @endif"
                                    class="js-data-example-ajax form-control form-ellipsis">
                                        <option value="all">{{translate('all_customer')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <label class="title-color" for="date_type">{{translate('date_type')}}</label>
                                <div class="form-group">
                                    <select class="form-control __form-control" name="date_type" id="date_type">
                                        <option value="" selected disabled>{{translate('select_Date_Type')}}</option>
                                        <option value="this_year" {{ $dateType == 'this_year'? 'selected' : '' }}>{{translate('this_Year')}}</option>
                                        <option value="this_month" {{ $dateType == 'this_month'? 'selected' : '' }}>{{translate('this_Month')}}</option>
                                        <option value="this_week" {{ $dateType == 'this_week'? 'selected' : '' }}>{{translate('this_Week')}}</option>
                                        <option value="custom_date" {{ $dateType == 'custom_date'? 'selected' : '' }}>{{translate('custom_Date')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3" id="from_div">
                                <label class="title-color" for="customer">{{translate('start_date')}}</label>
                                <div class="form-group">
                                    <input type="date" name="from" value="{{$from}}" id="from_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3" id="to_div">
                                <label class="title-color" for="customer">{{translate('end_date')}}</label>
                                <div class="form-group">
                                    <input type="date" value="{{$to}}" name="to" id="to_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="{{route('admin.orders.list',['status'=>request('status')])}}" class="btn btn-secondary px-5">
                                        {{translate('reset')}}
                                    </a>
                                    <button type="submit" class="btn btn--primary px-5" id="formUrlChange" data-action="{{ url()->current() }}">
                                        {{translate('show_data')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="px-3 py-4 light-bg">
                        <div class="row g-2 align-items-center flex-grow-1">
                            <div class="col-md-4">
                                <h5 class="text-capitalize d-flex gap-1">
                                    {{translate('order_list')}}
                                    <span class="badge badge-soft-dark radius-50 fz-12">{{$orders->total()}}</span>
                                </h5>
                            </div>
                            <div class="col-md-8 d-flex gap-3 flex-wrap flex-sm-nowrap justify-content-md-end">
                                <form action="" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="searchValue" class="form-control"
                                            placeholder="{{translate('search_by_Order_ID')}}" aria-label="Search by Order ID" value="{{ $searchValue }}">
                                        <button type="submit" class="btn btn--primary input-group-text">{{translate('search')}}</button>
                                    </div>
                                </form>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline--primary" data-toggle="dropdown">
                                        <i class="tio-download-to"></i>
                                        {{translate('export')}}
                                        <i class="tio-chevron-down"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a type="submit" class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.orders.export-excel', ['delivery_man_id' => request('delivery_man_id'), 'status' => $status, 'from' => $from, 'to' => $to, 'filter' => $filter, 'searchValue' => $searchValue,'seller_id'=>$vendorId,'customer_id'=>$customerId, 'date_type'=>$dateType]) }}">
                                                <img width="14" src="{{asset('/public/assets/back-end/img/excel.png')}}" alt="">
                                                {{translate('excel')}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 text-start">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{translate('SL')}}</th>
                                    <th>{{translate('order_ID')}}</th>
                                    <th>{{translate('order_Date')}}</th>
                                    <th>{{translate('customer_Info')}}</th>
                                    <th>{{translate('store')}}</th>
                                    <th class="text-right">{{translate('total_Amount')}}</th>
                                    <th class="text-center">{{translate('order_Status')}} </th>
                                    <th class="text-center">{{translate('action')}}</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($orders as $key=>$order)
                                @php
                                    $is_imported =  $order['details']->contains(function ($detail) {
                                                        return $detail->product && $detail->product->is_imported;
                                                    });
                                @endphp
                                <tr class="status-{{$order['order_status']}} class-all">
                                    <td class="">
                                        {{$orders->firstItem()+$key}}
                                    </td>
                                    <td >
                                        <a class="title-color {{ ($order['sent_to_seller'] == 1) ? 'text-warning':'' }}" href="{{route('admin.orders.details',['id'=>$order['id']])}}">{{$order['id']}} {!! $order->order_type == 'POS' ? '<span class="text--primary">(POS)</span>' : '' !!}</a>
                                    </td>
                                    <td>
                                        <div>{{date('d M Y',strtotime($order['created_at']))}},</div>
                                        <div>{{ date("h:i A",strtotime($order['created_at'])) }}</div>
                                    </td>
                                    <td>
                                        @if($order->is_guest)
                                            <strong class="title-name">{{translate('guest_customer')}}</strong>
                                        @elseif($order->customer_id == 0)
                                            <strong class="title-name">{{translate('walking_customer')}}</strong>
                                        @else
                                            @if($order->customer)
                                                <a class="text-body text-capitalize" href="{{route('admin.orders.details',['id'=>$order['id']])}}">
                                                    <strong class="title-name">{{$order->customer['f_name'].' '.$order->customer['l_name']}}</strong>
                                                </a>
                                                <a class="d-block title-color" href="tel:{{ $order->customer['phone'] }}">{{ $order->customer['phone'] }}</a>
                                            @else
                                                <label class="badge badge-danger fz-12">{{translate('invalid_customer_data')}}</label>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <span class="store-name font-weight-medium">
                                            @if($order->seller_is == 'seller')
                                                {{ isset($order->seller->shop) ? $order->seller->shop->name : translate('Store_not_found') }}
                                            @elseif($order->seller_is == 'admin')
                                                {{translate('in_House')}}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <div>
                                            @php($discount = 0)
                                            @if($order->order_type == 'default_type' && $order->coupon_discount_bearer == 'inhouse' && !in_array($order['coupon_code'], [0, NULL]))
                                                @php($discount = $order->discount_amount)
                                            @endif

                                            @php($free_shipping = 0)
                                            @if($order->is_shipping_free)
                                                @php($free_shipping = $order->shipping_cost)
                                            @endif

                                            {{setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->order_amount+$discount+$free_shipping), currencyCode: getCurrencyCode())}}
                                        </div>

                                        @if($order->payment_status=='paid')
                                            <span class="badge text-success fz-12 px-0">
                                                {{translate('paid')}}
                                            </span>
                                        @else
                                            <span class="badge text-danger fz-12 px-0">
                                                {{translate('unpaid')}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center text-capitalize">
                                        @if($order['order_status']=='pending' && $order['sent_to_seller'] == 0)
                                            <span class="badge badge-soft-info fz-12">
                                                {{translate($order['order_status'])}}
                                            </span>

                                        @elseif($order['order_status']=='processing' || $order['order_status']=='out_for_delivery')
                                            <span class="badge badge-soft-warning fz-12">
                                                {{str_replace('_',' ',$order['order_status'] == 'processing' ? translate('packaging'):translate($order['order_status']))}}
                                            </span>
                                        @elseif($order['order_status']=='confirmed')
                                            <span class="badge badge-soft-success fz-12">
                                                {{translate($order['order_status'])}}
                                            </span>
                                        @elseif($order['order_status']=='failed')
                                            <span class="badge badge-danger fz-12">
                                                {{translate('failed_to_deliver')}}
                                            </span>
                                        @elseif($order['order_status']=='delivered')
                                            <span class="badge badge-soft-success fz-12">
                                                {{translate($order['order_status'])}}
                                            </span>
                                        @elseif($order['order_status'] == 'pending' && $order['sent_to_seller'] == 1)
                                            <span class="badge badge-soft-info fz-12">
                                                Pending on Seller
                                            </span>
                                        @else
                                            <span class="badge badge-soft-danger fz-12">
                                                {{translate($order['order_status'])}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($is_imported == 1 && $order['sent_to_seller'] == 0)
                                            <button type="button" class="btn btn-outline--primary square-btn btn-sm mr-1" title="{{translate('Send to Seller')}}" onclick="checkoutExport({{$order->id}})">
                                                <img src="{{asset('/public/assets/back-end/img/arrow-right-for-frame.png')}}" class="png" alt="">
                                            </button>
                                                {{-- <a class="btn btn-outline--primary square-btn btn-sm mr-1" title="{{translate('Sent to Seller')}}"
                                                    href="{{route('admin.orders.sentToSeller',['id'=>$order['id']])}}">
                                                    <img src="{{asset('/public/assets/back-end/img/arrow-right-for-frame.png')}}" class="png" alt="">
                                                </a> --}}
                                            @endif
                                            <a class="btn btn-outline--primary square-btn btn-sm mr-1" title="{{translate('view')}}"
                                                href="{{route('admin.orders.details',['id'=>$order['id']])}}">
                                                <img src="{{asset('/public/assets/back-end/img/eye.svg')}}" class="svg" alt="">
                                            </a>
                                            <a class="btn btn-outline-success square-btn btn-sm mr-1" target="_blank" title="{{translate('invoice')}}"
                                                href="{{route('admin.orders.generate-invoice',[$order['id']])}}">
                                                <i class="tio-download-to"></i>
                                            </a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-outline-danger square-btn btn-sm mr-1" onclick="checkoutExport({{$order->id}})">
                                                <i class="tio-money"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            {!! $orders->links() !!}
                        </div>
                    </div>
                </div>
            </div>

        <!-- Modal -->
        <div class="modal fade" id="checkout_export_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @section('title', translate('choose_Payment_Method'))

                  
                        <link rel="stylesheet" href="{{ asset('public/assets/front-end/css/payment.css') }}">
                        <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
                        <script src="https://js.stripe.com/v3/"></script>
                 
                     
                        <div class="container pb-5 mb-2 mb-md-4 px-0 px-md-3 text-align-direction">
                            <div class="row mx-max-md-0">
                                <div class="col-md-12 mb-3 pt-3 px-max-md-0">
                                    <div class="feature_header px-3 px-md-0">
                                        <span>{{ translate('payment_method')}}</span>
                                    </div>
                                </div>
                                <div class="card mt-3 ml-3">
                                    <div class="card-body">
            
                                        <div class="gap-2 mb-4">
                                            {{-- <div class="d-flex justify-content-between">
                                                <h4 class="mb-2 text-nowrap">{{ translate('payment_method')}}</h4>
                                                <a href="{{route('checkout-details')}}" class="d-flex align-items-center gap-2 text-primary font-weight-bold text-nowrap">
                                                    <i class="tio-back-ui fs-12 text-capitalize"></i>
                                                    {{ translate('go_back') }}
                                                </a>
                                            </div> --}}
                                            <p class="text-capitalize mt-2">{{ translate('select_a_payment_method_to_proceed')}}</p>
                                        </div>
                                 
            
                                        <div class="d-flex flex-wrap gap-2 align-items-center mb-4 ">
                                            <h5 class="mb-0 text-capitalize">{{ translate('pay_via_online') }}</h5>
                                            <span class="fs-10 text-capitalize mt-1">({{ translate('faster_&_secure_way_to_pay_bill') }})</span>
                                        </div>
            
                                        @if ($digital_payment['status']==1)
                                            <div class="row gx-4 mb-4">
                                                @foreach ($payment_gateways_list as $payment_gateway)
                                                <div class="col-sm-6">
                                                    <form method="post" class="digital_payment" id="{{($payment_gateway->key_name)}}_form" action="{{ route('customer.web-payment-request') }}">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ auth('customer')->check() ? auth('customer')->user()->id : session('guest_id') }}">
                                                        <input type="hidden" name="customer_id" value="{{ auth('customer')->check() ? auth('customer')->user()->id : session('guest_id') }}">
                                                        <input type="hidden" name="payment_method" value="{{ $payment_gateway->key_name }}">
                                                        <input type="hidden" name="payment_platform" value="web">
                                                        <input type="hidden" name="order_id" id="order_id" value="">
            
                                                        @if ($payment_gateway->mode == 'live' && isset($payment_gateway->live_values['callback_url']))
                                                            <input type="hidden" name="callback" value="{{ $payment_gateway->live_values['callback_url'] }}">
                                                        @elseif ($payment_gateway->mode == 'test' && isset($payment_gateway->test_values['callback_url']))
                                                            <input type="hidden" name="callback" value="{{ $payment_gateway->test_values['callback_url'] }}">
                                                        @else
                                                            <input type="hidden" name="callback" value="">
                                                        @endif
            
                                                        <input type="hidden" name="external_redirect_link" value="{{ url('/').'/web-payment' }}">
                                                        <label class="d-flex align-items-center gap-2 mb-0 form-check py-2 cursor-pointer">
                                                            <input type="radio" id="{{($payment_gateway->key_name)}}" name="online_payment" class="form-check-input custom-radio" value="{{($payment_gateway->key_name)}}">
                                                            <img width="30"
                                                            src="{{asset('storage/app/public/payment_modules/gateway_image')}}/{{ $payment_gateway->additional_data && (json_decode($payment_gateway->additional_data)->gateway_image) != null ? (json_decode($payment_gateway->additional_data)->gateway_image) : ''}}" alt="">
                                                            <span class="text-capitalize form-check-label">
                                                                @if($payment_gateway->additional_data && json_decode($payment_gateway->additional_data)->gateway_title != null)
                                                                    {{ json_decode($payment_gateway->additional_data)->gateway_title }}
                                                                @else
                                                                    {{ str_replace('_', ' ',$payment_gateway->key_name) }}
                                                                @endif
            
                                                            </span>
                                                        </label>
                                                    </form>
                                                </div>
                                                @endforeach
                                            </div>
                                        @endif
            
                                        @if(isset($offline_payment) && $offline_payment['status'] && count($offline_payment_methods)>0)
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="bg-primary-light rounded p-4">
                                                    <div class="d-flex justify-content-between align-items-center gap-2 position-relative">
                                                        <span class="d-flex align-items-center gap-3">
                                                            <input type="radio" id="pay_offline" name="online_payment" class="custom-radio" value="pay_offline">
                                                            <label for="pay_offline" class="cursor-pointer d-flex align-items-center gap-2 mb-0 text-capitalize">{{translate('pay_offline')}}</label>
                                                        </span>
            
                                                        <div data-toggle="tooltip" title="{{translate('for_offline_payment_options,_please_follow_the_steps_below')}}">
                                                            <i class="tio-info text-primary"></i>
                                                        </div>
                                                    </div>
            
                                                    <div class="mt-4 pay_offline_card d-none">
                                                        <div class="d-flex flex-wrap gap-3">
                                                            @foreach ($offline_payment_methods as $method)
                                                                <button type="button" class="btn btn-light offline_payment_button text-capitalize" id="{{ $method->id }}">{{ $method->method_name }}</button>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>  
                            </div>
                        </div>
                    
                        @if(isset($offline_payment) && $offline_payment['status'])
                            <div class="modal fade" id="selectPaymentMethod" tabindex="-1" aria-labelledby="selectPaymentMethodLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header border-0 pb-0">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('offline-payment-checkout-complete')}}" method="post" class="needs-validation">
                                                @csrf
                                                <div class="d-flex justify-content-center mb-4">
                                                    <img width="52" src="{{asset('public/assets/front-end/img/select-payment-method.png')}}" alt="">
                                                </div>
                                                <p class="fs-14 text-center">{{translate('pay_your_bill_using_any_of_the_payment_method_below_and_input_the_required_information_in_the_form')}}</p>
                    
                                                <select class="form-control mx-xl-5 max-width-661" id="pay_offline_method" name="payment_by" required>
                                                    <option value="" disabled>{{ translate('select_Payment_Method') }}</option>
                                                    @foreach ($offline_payment_methods as $method)
                                                        <option value="{{ $method->id }}">{{ translate('payment_Method') }} : {{ $method->method_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="" id="payment_method_field">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    
                        @if(auth('customer')->check() && $wallet_status==1)
                          <div class="modal fade" id="wallet_submit_button" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">{{ translate('wallet_payment')}}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                @php($customer_balance = 100)
                                @php($remain_balance = 80)
                                <form action="{{route('checkout-complete-wallet')}}" method="get" class="needs-validation">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label for="">{{ translate('your_current_balance')}}</label>
                                                <input class="form-control" type="text" value="{{ webCurrencyConverter(amount: $customer_balance ?? 0) }}" readonly>
                                            </div>
                                        </div>
                    
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label for="">{{ translate('order_amount')}}</label>
                                                <input class="form-control" type="text" value="{{ webCurrencyConverter(amount: $amount ?? 0) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label for="">{{ translate('remaining_balance')}}</label>
                                                <input class="form-control" type="text" value="{{ webCurrencyConverter(amount: $remain_balance ?? 0) }}" readonly>
                                                @if ($remain_balance<0)
                                                <label class="__color-crimson mt-1">{{ translate('you_do_not_have_sufficient_balance_for_pay_this_order!!')}}</label>
                                                @endif
                                            </div>
                                        </div>
                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('close')}}</button>
                                    <button type="submit" class="btn btn--primary" {{$remain_balance>0? '':'disabled'}}>{{ translate('submit')}}</button>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        @endif
                    
                        <span id="route-action-checkout-function" data-route="checkout-payment"></span>
                    
                        <script src="{{ asset('public/assets/front-end/js/payment.js') }}"></script>
                    
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="sendToSeller()" title="{{translate('Send to Seller')}}">Send to Seller</button>
                </div>
            </div>
            </div>
        </div>

            <div class="js-nav-scroller hs-nav-scroller-horizontal d-none">
                <span class="hs-nav-scroller-arrow-prev d-none">
                    <a class="hs-nav-scroller-arrow-link" href="javascript:">
                        <i class="tio-chevron-left"></i>
                    </a>
                </span>

                <span class="hs-nav-scroller-arrow-next d-none">
                    <a class="hs-nav-scroller-arrow-link" href="javascript:">
                        <i class="tio-chevron-right"></i>
                    </a>
                </span>
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">{{translate('order_list')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <span id="message-date-range-text" data-text="{{ translate("invalid_date_range") }}"></span>
    <span id="js-data-example-ajax-url" data-url="{{ route('admin.orders.customers') }}"></span>
@endsection

@push('script_2')
    <script src="{{asset('public/assets/back-end/js/admin/order.js')}}"></script>
@endpush


<script>

    function checkoutExport(orderId)
    {
        $("#checkout_export_modal").modal('show');
        $('#order_id').val(orderId);
    }
    function sendToSeller() {
        const orderId = $('#order_id').val();
        const paymentMethod = document.querySelector(`input[name="online_payment"]:checked`).value;
        const paymentPlatform = document.querySelector(`input[name="payment_platform"]`).value;
        const url = `{{route('admin.orders.web-payment-request')}}?order_id=${orderId}&payment_method=${paymentMethod}&payment_platform=${paymentPlatform}`;
        window.location.href = url;
    }

</script>