@php($overallRating = getOverallRating($product->reviews))
<div class="product-single-hover style--category shadow-none">
    <div class="overflow-hidden position-relative">
        <div class=" inline_product clickable d-flex justify-content-center">
            @if($product->discount > 0)
                <div class="d-flex">
                    <span class="for-discount-value p-1 pl-2 pr-2">
                    @if ($product->discount_type == 'percent')
                            {{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}
                            %
                        @elseif($product->discount_type =='flat')
                            {{ webCurrencyConverter(amount: $product->discount) }}
                        @endif
                        {{translate('off')}}
                    </span>
                </div>
            @else
                <div class="d-none justify-content-end">
                    <span class="for-discount-value-null"></span>
                </div>
            @endif
            <div class="d-block pb-0">
                <a href="{{route('product',$product->slug)}}" class="d-block">
                    <img alt=""
                         src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/'.$product['thumbnail'], type: 'product') }}">
                </a>
            </div>

            {{-- <div class="quick-view">
                <a class="btn-circle stopPropagation action-product-quick-view" href="javascript:" data-product-id="{{ $product->id }}">
                    <i class="czi-eye align-middle"></i>
                </a>
            </div> --}}
            @if($product->product_type == 'physical' && $product->current_stock <= 0)
                <span class="out_fo_stock">{{translate('out_of_stock')}}</span>
            @endif
            <div class="quick-right-btn">
                <a href="#" class="quick-right-btn-a">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="" viewBox="0 0 256 256"><path fill="#000" d="M178 40c-20.65 0-38.73 8.88-50 23.89C116.73 48.88 98.65 40 78 40a62.07 62.07 0 0 0-62 62c0 70 103.79 126.66 108.21 129a8 8 0 0 0 7.58 0C136.21 228.66 240 172 240 102a62.07 62.07 0 0 0-62-62m-50 174.8c-18.26-10.64-96-59.11-96-112.8a46.06 46.06 0 0 1 46-46c19.45 0 35.78 10.36 42.6 27a8 8 0 0 0 14.8 0c6.82-16.67 23.15-27 42.6-27a46.06 46.06 0 0 1 46 46c0 53.61-77.76 102.15-96 112.8"></path></svg>
                </a>
                <a href="#" class="quick-right-btn-a">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="" viewBox="0 0 16 16"><path fill="#000" fill-rule="evenodd" d="M5.905.28A8 8 0 0 1 14.5 3.335V1.75a.75.75 0 0 1 1.5 0V6h-4.25a.75.75 0 0 1 0-1.5h1.727a6.5 6.5 0 1 0 .526 5.994a.75.75 0 1 1 1.385.575A8 8 0 1 1 5.905.279Z" clip-rule="evenodd"></path></svg>
                </a>
            </div>
            <div class="quick-view-btn">
                <a class="action-product-quick-view quick-view-btn-a" href="javascript:" data-product-id="{{ $product->id}}"> Add To Cart</a>
                <a class="action-product-quick-view quick-view-btn-a" style="cursor: pointer" data-product-id="{{ $product->id}}">QUICK SHOP</a>
            </div>
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
            <div class="">
                <a href="{{route('product',$product->slug)}}" class="text-capitalize fw-semibold">
                    {{ Str::limit($product['name'], 18) }}
                </a>
            </div>
            <div class="justify-content-between ">
                <div class="product-price d-flex flex-wrap gap-8 align-items-center row-gap-0">
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


