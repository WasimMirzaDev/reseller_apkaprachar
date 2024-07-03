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

    <div class="dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }} __w-20rem cart-dropdown"
        style="height: 94vh; top: 0; width: 490px !important; right: -125px; border-radius: 30px;">
        <div class="widget widget-cart" style="padding: 14px 23px;">
            <h4 style="margin-bottom: 20px; font-weight: 600;">Shopping Cart</h4>
            <div class="widget-cart-top rounded px-4 py-3 d-flex gap-3"
                style="background-color: #D2EF9A !important; justify-content: left;">
                <p style="font-size: 34px; margin-bottom: 0px;">🔥</p>
                <div class="d-flex flex-column">
                    <p style="font-size: 14px; margin-bottom: 0px;">Your cart will expire in <strong
                            style="color: red">00:00</strong> minutes! <br>Please checkout now before your items sell
                        out!</p>
                </div>
            </div>
            <span>Buy <strong>$0.00</strong> More to get <strong>FreeShip</strong></span>
            {{-- @php($free_delivery_status = \App\Utils\OrderManager::free_delivery_order_amount($cart[0]->cart_group_id))
            dd($free_delivery_status)
            @if ($free_delivery_status['status'] && (session()->missing('coupon_type') || session('coupon_type') != 'free_delivery'))
                <div class="pt-2">
                    <div class="progress __progress bg-DFEDFF" style="border-radius: 0px; height: 3px;">
                        <div class="progress-bar"
                            style="width: {{ $free_delivery_status['percentage'] }}%; background:var(--primary-clr); border-radius: 0px; height: 3px;">
                        </div>
                    </div>
                </div>
            @endif --}}
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
                <div class="__h-20rem" data-simplebar data-simplebar-auto-hide="false">
                    @php($sub_total = 0)
                    @php($total_tax = 0)
                    @foreach ($cart as $cartItem)
                        @php($product = \App\Models\Product::find($cartItem['product_id']))
                        <div class="widget-cart-item">
                            <div class="media">
                                <a class="d-block me-2 position-relative overflow-hidden"
                                    href="{{ route('product', $cartItem['slug']) }}">
                                    <img width="64" class="{{ $product->status == 0 ? 'blur-section' : '' }}"
                                        src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $cartItem['thumbnail'], type: 'backend-product') }}"
                                        alt="{{ translate('product') }}" />
                                    @if ($product->status == 0)
                                        <span class="temporary-closed position-absolute text-center p-2">
                                            <span>{{ translate('N/A') }}</span>
                                        </span>
                                    @endif
                                </a>
                                <div
                                    class="media-body min-height-0 d-flex align-items-center {{ $product->status == 0 ? 'blur-section' : '' }}">
                                    <div class="w-0 flex-grow-1">
                                        <h6 class="widget-product-title mb-0 mr-2">
                                            <a href="{{ route('product', $cartItem['slug']) }}" class="line--limit-1">
                                                {{ $cartItem['name'] }}
                                            </a>
                                        </h6>
                                        @if (!empty($cartItem['variant']))
                                            <div>
                                                <span class="__text-12px">{{ translate('variant') }} :
                                                    {{ $cartItem['variant'] }}</span>
                                            </div>
                                        @endif
                                        <div class="widget-product-meta">
                                            <span class="text-muted me-2">x <span
                                                    class="cart_quantity_multiply{{ $cartItem['id'] }}">{{ $cartItem['quantity'] }}</span></span>
                                            <span class="text-accent me-2 discount_price_of_{{ $cartItem['id'] }}">
                                                {{ webCurrencyConverter(amount: ($cartItem['price'] - $cartItem['discount']) * $cartItem['quantity']) }}
                                            </span>
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

                <div class="bottom-fix-check-out-model" style="position: absolute; left: 0; right: 0px; bottom: 0px; border-top: 1px solid red; padding: 14px 23px 24px 23px;">
                    <div class="d-flex flex-wrap justify-content-between align-items-center pb-2">
                        <div class="font-size-sm {{ Session::get('direction') === 'rtl' ? 'ml-2 float-left' : 'mr-2 float-right' }} py-2 ">
                            <h4 style="font-weight: 600;">{{ translate('subtotal') }} :</h4>
                        </div>
                        <div class="font-size-sm {{ Session::get('direction') === 'rtl' ? 'ml-2 float-left' : 'mr-2 float-right' }} py-2 ">
                            <h4 style="font-weight: 600;">$340.00</h4>
                        </div>
                    </div>

                    @if ($web_config['guest_checkout_status'] || auth('customer')->check())
                        <a class="btn btn--primary btn-sm btn-block font-bold rounded text-capitalize"
                            href="{{ route('checkout-details') }}">
                            {{ translate('proceed_to_checkout') }}
                        </a>
                    @else
                        <a class="btn btn--primary btn-sm btn-block font-bold rounded text-capitalize"
                            href="{{ route('customer.auth.login') }}">
                            {{ translate('proceed_to_checkout') }}
                        </a>
                    @endif
                </div>
            @else
                <div class="widget-cart-item">
                    <div class="text-center text-capitalize">
                        <img class="mb-3 mw-100" src="{{ asset('public/assets/front-end/img/icons/empty-cart.svg') }}"
                            alt="{{ translate('cart') }}">
                        <p class="text-capitalize">{{ translate('Your_Cart_is_Empty') }}!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
