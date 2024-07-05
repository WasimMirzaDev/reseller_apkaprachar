<style>
    .heading5 {
        font-size: 21px;
        font-weight: 600;
    }

    .dropdown-view-btn {
        width: 50%;
        padding: 15px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.35s ease-in-out;
    }

    .dropdown-view-btn:hover {
        color: #fff;
        background-color: #000 !important;
        transition: all 0.35s ease-in-out;
    }

    .dropdown-check-btn {
        width: 50%;
        padding: 15px;
        border-radius: 12px;
        font-weight: 600;
        border: 1px solid #000;
        background: #000;
        color: #fff;
        transition: all 0.35s ease-in-out;
    }

    .dropdown-check-btn:hover {
        background: #D2EF9A;
        color: #000;
        transition: all 0.35s ease-in-out;
    }

    .dropdown-continue-btn a {
        border-bottom: 1px solid #000;
        border-width: 0px;
        transition: width 1s ease-in-out;
    }

    .dropdown-continue-btn a:hover {
        border-bottom: 1px solid #000;
        border-width: 100%;
        transition: width 1s ease-in-out;
    }
    .product-item {
        --tw-border-opacity: 1;
        border-color: rgb(233 233 233 / var(--tw-border-opacity));
        cursor: pointer;
        animation: showProduct 0.4s linear;
        border-bottom: 1px solid lightgray;
    }
    .text-button {
        font-size: 16px;
        line-height: 26px;
        font-weight: 600;
        text-transform: capitalize;
    }
</style>
@php
    use App\Models\Product;
    use App\Utils\CartManager;
    use App\Utils\Helpers;
    use App\Utils\ProductManager;
@endphp
<div class="navbar-tool dropdown me-2 {{ Session::get('direction') === 'rtl' ? 'mr-md-2' : 'ml-md-2' }}">
    @if ($web_config['guest_checkout_status'] || auth('customer')->check())
        <a class="navbar-tool-icon-box dropdown-toggle" href="{{ route('shop-cart') }}">
            <span class="navbar-tool-label">
                @php($cart = \App\Utils\CartManager::get_cart())
                {{ $cart->count() }}
            </span>
            <i class="navbar-tool-icon czi-cart"></i>
        </a>
        {{-- <a class="navbar-tool-text ms-2"
           href="{{route('shop-cart')}}"><small>{{translate('my_cart')}}</small>
            {{ webCurrencyConverter(amount: \App\Utils\CartManager::cart_total_applied_discount(\App\Utils\CartManager::get_cart()))}}
        </a> --}}
    @else
        <a class="navbar-tool-icon-box dropdown-toggle" href="{{ route('customer.auth.login') }}">
            <span class="navbar-tool-label">
                @php($cart = \App\Utils\CartManager::get_cart())
                {{ $cart->count() }}
            </span>
            <i class="navbar-tool-icon czi-cart"></i>
        </a>
        <!-- Button trigger modal -->

        {{-- <a class="navbar-tool-text ms-2"
           href="{{ route('customer.auth.login') }}">
            <small>{{translate('my_cart')}}</small>
            {{ webCurrencyConverter(amount: \App\Utils\CartManager::cart_total_applied_discount(\App\Utils\CartManager::get_cart()))}}
        </a> --}}
    @endif

    <div class="dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} cart-dropdown"
        style="height: 94vh; top: 0; width: 495px !important; right: -125px; border-radius: 30px;">
        <div class="widget-cart-2 d-none" style="background: white; width: 490px; height: 100%; border-right: 1px solid black; border-radius: 30px 0px 0px 30px;">
            <h4 style="margin-bottom: 20px; font-weight: 600;margin-left:15px;margin-top:10px">You May Also Like</h4>
            <div class="list px-2">
                <div class="product-item item py-3 px-2 d-flex align-items-center justify-content-between gap-3 border-b" data-item="1">
                    <div class="infor d-flex align-items-center" style="gap: 1rem">
                        <div class="bg-img">
                            <img src="https://anvogue-html.vercel.app/assets/images/product/fashion/1-2.png" style="width:100px" alt="img" class=" aspect-square flex-shrink-0 rounded-lg">
                        </div>
                        <div class="">
                            <div class="name text-button">Faux-leather trousers</div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div class="product-price text-title">$15.00</div>
                                <div class="product-origin-price text-title text-secondary2">
                                    <del>$25.00</del>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="quick-view-btns bg-dark button-main py-2 px-4 bg-black hover:bg-green text-white rounded-full whitespace-nowrap">QUICK VIEW</div>
                </div>
            </div>

        </div>
        <div class="widget widget-cart" style="">
            <div class="right-cart-top" style="width: 490px; position: absolute; right: 0; top: 0; padding: 13px 23px 0px;">
                <h4 style="margin-bottom: 20px; font-weight: 600;">Shopping Cart</h4>
                <div class="widget-cart-top rounded px-4 py-3 d-flex gap-3"
                    style="background-color: #D2EF9A !important; justify-content: left;">
                    <p style="font-size: 34px; margin-bottom: 0px;">🔥</p>
                    <div class="d-flex flex-column">
                        <p style="font-size: 14px; margin-bottom: 0px;">Your cart will expire in <strong
                                style="color: red">00:00</strong> minutes! <br>Please checkout now before your items
                            sell
                            out!</p>
                    </div>
                </div>
                {{-- <span>Buy <strong>$0.00</strong> More to get <strong>FreeShip</strong></span> --}}
                {{-- @php($free_delivery_status = \App\Utils\OrderManager::free_delivery_order_amount($cart[0]->cart_group_id)) --}}

                {{-- @if ($free_delivery_status['status'] && (session()->missing('coupon_type') || session('coupon_type') != 'free_delivery'))
                    <div class="pt-2">
                        <div class="progress __progress bg-DFEDFF" style="border-radius: 0px; height: 3px;">
                            <div class="progress-bar"
                                style="width: {{ $free_delivery_status['percentage'] }}%; background:var(--primary-clr); border-radius: 0px; height: 3px;">
                            </div>
                        </div>
                    </div>
                @endif --}}
            </div>
            @if ($cart->count() > 0)
                <?php
                $total_discount = 0;
                foreach ($cart as $cartItem) {
                    $total_discount += $cartItem->discount * $cartItem->quantity;
                }
                ?>
                <div
                    class="dropdown-saved-amount text-center  align-items-center justify-content-center text-accent mb-3 {{ $total_discount <= 0 ? 'd-none' : 'd-flex' }}">
                    <img src="{{ asset('/public/assets/front-end/img/party-popper.svg') }}" class="mr-2"
                        alt="">
                    <small>{{ translate('you_have_saved') }} <span
                            class="total_discount">{{ webCurrencyConverter(amount: $total_discount) }}</span>!</small>
                </div>
                <div class=""
                    style="height: 220px; position: absolute; bottom: 260px; right: 0; padding: 20px 0px 0px 23px; width: 490px;"
                    data-simplebar data-simplebar-auto-hide="false">
                    @php($sub_total = 0)
                    @php($total_tax = 0)
                    @foreach ($cart as $cartItem)
                        @php($product = \App\Models\Product::find($cartItem['product_id']))
                        <div class="widget-cart-item">
                            <div class="media">
                                <a class="d-block me-2 position-relative overflow-hidden"
                                    style="width: 100px; height: 100px;"
                                    href="{{ route('product', $cartItem['slug']) }}">
                                    <img width="64" class="{{ $product->status == 0 ? 'blur-section' : '' }}"
                                        src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $cartItem['thumbnail'], type: 'backend-product') }}"
                                        alt="{{ translate('product') }}"
                                        style="background: radial-gradient(circle, rgba(166, 166, 167, 1) 0%, rgba(114, 119, 126, 1) 100%); width: 100px; height: 100px;" />
                                    @if ($product->status == 0)
                                        <span class="temporary-closed position-absolute text-center p-2">
                                            <span>{{ translate('N/A') }}</span>
                                        </span>
                                    @endif
                                </a>
                                <div
                                    class="media-body min-height-0 d-flex align-items-center {{ $product->status == 0 ? 'blur-section' : '' }}">
                                    <div class="w-0 flex-grow-1">
                                        <h6 class="widget-product-title mb-2 d-flex justify-content-between"
                                            style="font-size: 18px;">
                                            <a href="{{ route('product', $cartItem['slug']) }}"
                                                style="width: calc(100% - 80px);" class="line--limit-1">
                                                {{ $cartItem['name'] }}
                                            </a>
                                            <a href="#" class="line--limit-1"
                                                style="text-align: end; width: 80px; font-size: 16px; text-decoration: underline; color: red;">
                                                Remove
                                            </a>
                                        </h6>
                                        @if (!empty($cartItem['variant']))
                                            <div class="d-flex justify-content-between" style="font-size: 15px">
                                                <span class="">{{ translate('variant') }} :
                                                    {{ $cartItem['variant'] }}</span>
                                                <span class="text-dark {{ $cartItem['id'] }}"
                                                    style="color: #000 !important;">{{Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*(int)$cartItem['quantity'])}}</span>
                                            </div>
                                        @endif
                                        {{-- <div class="widget-product-meta">
                                            <span class="text-muted me-2"> x <span
                                                    class="cart_quantity_multiply{{ $cartItem['id'] }}">{{ $cartItem['quantity'] }}</span></span>
                                            <span class="text-accent me-2 discount_price_of_{{ $cartItem['id'] }}">
                                                {{ webCurrencyConverter(amount: ($cartItem['price'] - $cartItem['discount']) * $cartItem['quantity']) }}
                                            </span>
                                        </div> --}}
                                        <div class="d-flex flex-column gap-1 {{ $product->status == 0?'blur-section':'' }}">
                                            <div class="fs-12"><span
                                                    class="cart_quantity_{{ $cartItem['id'] }}">{{$cartItem['quantity']}}</span>
                                                {{'×'.Helpers::currency_converter(($cartItem['price']-$cartItem['discount']))}}
                                            </div>
                                            <div class="product__price d-flex flex-wrap gap-2">
                                                @if($cartItem['discount'] >0)
                                                    <del class="product_old-price quantity_price_of{{ $cartItem['id'] }}">{{Helpers::currency_converter($cartItem['price']*$cartItem['quantity'])}}</del>
                                                @endif
                                                {{-- <ins class="product_new-price discount_price_of{{ $cartItem['id'] }}">{{Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*(int)$cartItem['quantity'])}}</ins> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($product->status) && $product->status == 1)
                                        <div class="__quantity">
                                            <div class="quantity__minus cart-qty-btn action-update-cart-quantity"
                                                data-cart-id="{{ $cartItem['id'] }}"
                                                data-product-id="{{ $cartItem['product_id'] }}" data-action="-1"
                                                data-event="minus">
                                                <i
                                                    class="{{ $cartItem['quantity'] == (isset($product->minimum_order_qty) ? $product->minimum_order_qty : 1) ? 'tio-delete-outlined text-danger fs-10' : 'tio-remove fs-10' }}"></i>
                                            </div>
                                            <input type="text"
                                                class="quantity__qty cart-qty-input form-control p-0 text-center cartQuantity{{ $cartItem['id'] }} action-update-cart-quantity"
                                                value="{{ $cartItem['quantity'] }}" name="quantity"
                                                id="cartQuantity{{ $cartItem['id'] }}"
                                                data-cart-id="{{ $cartItem['id'] }}"
                                                data-product-id="{{ $cartItem['product_id'] }}" data-action="0"
                                                data-event=""
                                                data-min="{{ isset($product->minimum_order_qty) ? $product->minimum_order_qty : 1 }}"
                                                autocomplete="off" required
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <div class="quantity__plus cart-qty-btn action-update-cart-quantity"
                                                data-cart-id="{{ $cartItem['id'] }}"
                                                data-product-id="{{ $cartItem['product_id'] }}" data-action="1"
                                                data-event="">
                                                <i class="tio-add"></i>
                                            </div>
                                        </div>
                                    @else
                                        <div class="__quantity mr-29 mb-4">
                                            <div class="quantity__minus cart-qty-btn form-control action-update-cart-quantity"
                                                data-cart-id="{{ $cartItem['id'] }}"
                                                data-product-id="{{ $cartItem['product_id'] }}" data-action="-1"
                                                data-event="minus">
                                                <i class="tio-delete-outlined text-danger fs-10"></i>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php($sub_total += ($cartItem['price'] - $cartItem['discount']) * $cartItem['quantity'])
                        @php($total_tax += $cartItem['tax'] * $cartItem['quantity'])
                    @endforeach
                </div>

                <div class="bottom-fix-check-out-model"
                    style="border-bottom-left-radius:25px;border-bottom-right-radius:25px;position: absolute; right: 0px; bottom: 0px; box-shadow: 0px 5px 18px 5px rgba(64, 72, 87, 0.15); width: 490px;">
                    <div class="d-flex align-items-center justify-content-between px-5" style="padding: 18px;">
                        <div class="note-btn item flex items-center gap-3 cursor-pointer">
                            <i class="ph ph-note-pencil text-xl"></i>
                            <div class="caption1">Note</div>
                        </div>
                        <div class="shipping-btn item flex items-center gap-3 cursor-pointer">
                            <i class="ph ph-truck text-xl"></i>
                            <div class="caption1">Shipping</div>
                        </div>
                        <div class="coupon-btn item flex items-center gap-3 cursor-pointer">
                            <i class="ph ph-tag text-xl"></i>
                            <div class="caption1">Coupon</div>
                        </div>
                    </div>
                    {{-- <div class="d-flex flex-wrap justify-content-between align-items-center pb-2">
                        <div class="font-size-sm {{ Session::get('direction') === 'rtl' ? 'ml-2 float-left' : 'mr-2 float-right' }} py-2 ">
                            <h4 style="font-weight: 600;">{{ translate('subtotal') }} :</h4>
                        </div>
                        <div class="font-size-sm {{ Session::get('direction') === 'rtl' ? 'ml-2 float-left' : 'mr-2 float-right' }} py-2 ">
                            <h4 style="font-weight: 600;">$340.00</h4>
                        </div>
                    </div> --}}
                    <div class="d-flex align-items-center justify-content-between"
                        style="padding: 23px; border-top: 1px solid #f4f4f4;">
                        <div class="heading5">Subtotal</div>
                        <div class="heading5 total-cart">{{ webCurrencyConverter(amount: $sub_total) }}</div>
                    </div>
                    <div class="block-button text-center pb-0">
                        <div class="d-flex align-items-center gap-3" style="padding: 0px 23px 14px;">
                            <a href="#"
                                class="button-main bg-white border border-black text-black text-center dropdown-view-btn">
                                VIEW CART </a>
                                @if ($web_config['guest_checkout_status'] || auth('customer')->check())
                            <a href="{{ route('checkout-details') }}" class="button-main text-center dropdown-check-btn"> CHECK OUT </a>
                            @else
                            <a href="{{ route('customer.auth.login') }}" class="button-main text-center dropdown-check-btn"> CHECK OUT </a>
                            @endif
                        </div>
                        <div class="text-center dropdown-continue-btn"
                            style="margin-bottom: 28px; font-size: 15px; font-weight: 500;">
                            <a href="#">OR CONTINUE SHOPPING</a>
                        </div>
                    </div>

                    {{-- @if ($web_config['guest_checkout_status'] || auth('customer')->check())
                        <a class="btn btn--primary btn-sm btn-block font-bold rounded text-capitalize"
                            href="{{ route('checkout-details') }}">
                            {{ translate('proceed_to_checkout') }}
                        </a>
                    @else
                        <a class="btn btn--primary btn-sm btn-block font-bold rounded text-capitalize"
                            href="{{ route('customer.auth.login') }}">
                            {{ translate('proceed_to_checkout') }}
                        </a>
                    @endif --}}

                </div>
            @else
                <div class="widget-cart-item">
                    <div class="text-center text-capitalize">
                        <img class="mb-3 mw-100"
                            src="{{ asset('public/assets/front-end/img/icons/empty-cart.svg') }}"
                            alt="{{ translate('cart') }}">
                        <p class="text-capitalize">{{ translate('Your_Cart_is_Empty') }}!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
