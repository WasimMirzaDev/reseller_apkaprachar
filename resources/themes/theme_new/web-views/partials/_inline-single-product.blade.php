@php($overallRating = getOverallRating($product->reviews))

<div class="product-single-hover style--card " style="box-shadow: none;">
    <div class="overflow-hidden position-relative">
        <div class=" inline_product clickable d-flex justify-content-center">
            @if($product->discount > 0)
                <div class="d-flex">
                    <span class="for-discount-value p-1 pl-2 pr-2">
                    @if ($product->discount_type == 'percent')
                            {{round($product->discount,(!empty($decimalPointSettings) ? $decimalPointSettings: 0))}}
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
            <div class="pb-0" style="">
                <a href="{{route('product',$product->slug)}}" class="w-100">
                    <img alt="" style="height: 360px; background: radial-gradient(circle, rgba(166,166,167,1) 0%, rgba(114,119,126,1) 100%);"
                         src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/'.$product['thumbnail'], type: 'product') }}">
                </a>
            </div>

            <div class="quick-top-new-btn">
                <span>NEW</span>
            </div>

            <div class="quick-right-btn">
                <a href="#" class="quick-right-btn-a"><i class="czi-eye"></i></a>
                <a href="#" class="quick-right-btn-a"><i class="czi-eye"></i></a>
            </div>
            <div class="quick-view-btn">
                <a class="quick-view-btn-a" href="javascript:" data-product-id="{{ $product->id }}">QUICK VIEW</a>
                <a class="quick-view-btn-a">QUICK SHOP</a>
            </div>

            {{-- <div class="quick-view">
                <a class="btn-circle stopPropagation action-product-quick-view" href="javascript:" data-product-id="{{ $product->id }}">
                    <i class="czi-eye align-middle"></i>
                </a>
            </div> --}}
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
                        <label class="badge-style text-white">({{$product->reviews_count}})</label>
                    </span>
                </div>
            @endif
            <div class="">
                <a href="{{route('product',$product->slug)}}">
                    {{ Str::limit($product['name'], 23) }}
                </a>
            </div>
            <div class="justify-content-between">
                <div class="product-price d-flex flex-wrap align-items-center gap-8">
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


