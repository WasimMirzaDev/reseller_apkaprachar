@php($overallRating = getOverallRating($product->reviews))
<div class="product-single-hover shadow-none rtl">
    <div class="overflow-hidden position-relative">
        <div class="inline_product clickable"  style="background: radial-gradient(circle, rgba(166, 166, 167, 1) 0%, rgba(114, 119, 126, 1) 100%); overflow: hidden !important;">
            @if($product->discount > 0)
                <span class="for-discount-value p-1 pl-2 pr-2">
                @if ($product->discount_type == 'percent')
                        {{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
                    @elseif($product->discount_type =='flat')
                        {{ webCurrencyConverter(amount: $product->discount) }}
                    @endif
                    {{translate('off')}}
                </span>
            @else
                <span class="for-discount-value-null d-none"></span>
            @endif
            <a href="{{route('product',$product->slug)}}">
                <img src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/'.$product['thumbnail'], type: 'product') }}" alt="">
            </a>

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
                <a class="action-product-quick-view quick-view-btn-a" href="javascript:" data-product-id="{{ $product->id }}">Add To Cart</a>
                <a style="cursor: pointer" class="action-product-quick-view quick-view-btn-a" data-product-id="{{ $product->id }}">QUICK SHOP</a>
            </div>
            @if($product->product_type == 'physical' && $product->current_stock <= 0)
                <span class="out_fo_stock">{{translate('out_of_stock')}}</span>
            @endif
        </div>
        <div class="single-product-details">
            @if($overallRating[0] != 0 )
                <div class="rating-show justify-content-between">
                    <span class="d-inline-block font-size-sm text-body">
                        @for($inc=1;$inc<=5;$inc++)
                            @if ($inc <= (int)$overallRating[0])
                                <i class="tio-star text-warning"></i>
                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                <i class="tio-star-half text-warning"></i>
                            @else
                                <i class="tio-star-outlined text-warning"></i>
                            @endif
                        @endfor
                        <label class="badge-style">({{$product->reviews_count}})</label>
                    </span>
                </div>
            @endif
            <div>
                <a href="{{route('product',$product->slug)}}" class="text-capitalize fw-semibold">
                    {{ Str::limit($product['name'], 23) }}
                </a>
            </div>
            <div class="justify-content-between">
                <div class="product-price">
                    @if($product->discount > 0)
                        <del class="category-single-product-price">
                            {{ webCurrencyConverter(amount: $product->unit_price) }}
                        </del>
                    @endif
                    <span class="text-accent text-dark">
                        {{ webCurrencyConverter(amount:
                            $product->unit_price-(getProductDiscount(product: $product, price: $product->unit_price))
                        ) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

