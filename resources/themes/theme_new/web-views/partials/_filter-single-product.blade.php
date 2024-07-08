@php($overallRating = getOverallRating($product->reviews))

<style>
    .product-single-hover {
        box-shadow: none !important;
    }
</style>

<div class="Kids">
    <div class=" product-single-hover">
        <div class="overflow-hidden position-relative">
            <div class=" inline_product clickable d-flex justify-content-center">
                @if ($product->discount > 0)
                    <span class="for-discount-value p-1 pl-2 pr-2">
                        @if ($product->discount_type == 'percent')
                            {{ round($product->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) }}%
                        @elseif($product->discount_type == 'flat')
                            {{ webCurrencyConverter(amount: $product->discount) }}
                        @endif
                        {{ translate('off') }}
                    </span>
                @else
                    <div class="d-none justify-content-end">
                        <span class="for-discount-value-null"></span>
                    </div>
                @endif
                <div class="pb-0">
                    <a href="{{ route('product', $product->slug) }}" class="w-100">
                        <img alt=""
                            src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $product['thumbnail'], type: 'product') }}">
                    </a>
                </div>

                {{-- <div class="quick-view">
                    <a class="btn-circle stopPropagation action-product-quick-view" href="javascript:" data-product-id="{{ $product->id }}">
                        <i class="czi-eye align-middle"></i>
                    </a>
                </div> --}}
                <div class="quick-right-btn">
                    <a href="#" class="quick-right-btn-a"><i class="czi-eye"></i></a>
                    <a href="#" class="quick-right-btn-a"><i class="czi-eye"></i></a>
                </div>
                <div class="quick-view-btn">
                    <a class="action-product-quick-view quick-view-btn-a" href="javascript:"
                        data-product-id="{{ $product->id }}">Add To Cart</a>
                    <a style="cursor: pointer" class="action-product-quick-view quick-view-btn-a"
                        data-product-id="{{ $product->id }}">QUICK SHOP</a>
                </div>
                @if ($product->product_type == 'physical' && $product->current_stock <= 0)
                    <span class="out_fo_stock">{{ translate('out_of_stock') }}</span>
                @endif
            </div>
            <div class="single-product-details">
                <div class="rating-show justify-content-between text-center">
                    <span class="d-inline-block font-size-sm text-body">
                        @for ($inc = 1; $inc <= 5; $inc++)
                            @if ($inc <= (int) $overallRating[0])
                                <i class="tio-star text-warning"></i>
                            @elseif ($overallRating[0] != 0 && $inc <= (int) $overallRating[0] + 1.1 && $overallRating[0] > ((int) $overallRating[0]))
                                <i class="tio-star-half text-warning"></i>
                            @else
                                <i class="tio-star-outlined text-warning"></i>
                            @endif
                        @endfor
                        <label class="badge-style">( {{ $product->reviews_count }} )</label>
                    </span>
                </div>
                <div class="text-center">
                    <a href="{{ route('product', $product->slug) }}">
                        {{ Str::limit($product['name'], 23) }}
                    </a>
                </div>
                <div class="justify-content-between text-center">
                    <div
                        class="product-price text-center d-flex flex-wrap justify-content-center align-items-center gap-8">
                        @if ($product->discount > 0)
                            <del class="category-single-product-price">
                                {{ webCurrencyConverter(amount: $product->unit_price) }}
                            </del>
                            <br>
                        @endif
                        <span class="text-accent text-dark">
                            {{ webCurrencyConverter(
                                amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price),
                            ) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
