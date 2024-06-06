@php use App\Utils\Helpers;use App\Utils\ProductManager;use Illuminate\Support\Str; @endphp
@php($overallRating = $product->reviews ? getOverallRating($product->reviews) : 0)
<div class="product text-center ov-hidden cursor-pointer get-view-by-onclick  col-12 col-sm-6 col-md-4 col-lg-3 product-card-large"
    style="background-color: #fff0;" data-link="{{route('product', $product->slug)}}">
    <div class="product__top width--100 aspect-1 "
        style="background-color: #e0dcda; display: flex; justify-content: center; margin: 0 auto; padding: 25px;">
        @if($product->discount > 0)
            <span class="product__discount-badge">
                <span>
                    @if ($product->discount_type == 'percent')
                        {{'-' . ' ' . round($product->discount, $web_config['decimal_point_settings'])}}%
                    @elseif($product->discount_type == 'flat')
                        {{'-' . ' ' . Helpers::currency_converter($product->discount)}}
                    @endif
                </span>
            </span>
        @endif

        <div class="product__thumbnail align-items-center d-flex justify-content-center">
            <div class="view">
                <a href="" class="text-center align-items-center"><i class="bi bi-eye"></i></a>
                <a href="" class="text-center align-items-center"><i class="bi bi-heart"></i></a>
            </div>
            <div class="buyNowBtn">
                <a href="#" class="btn bg-dark text-light w-100">Add To Cart</a>
            </div>
            <img class="dark-support img-fluid" alt="{{$product['name']}}"
                src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $product['thumbnail'], type: 'product') }}">
        </div>
        @if(($product['product_type'] == 'physical') && ($product['current_stock'] < 1))
            <div class="product__notify">
                {{ translate('sorry_this_item_is_currently_sold_out') }}
            </div>
        @endif

    </div>
    <div class="product__summary d-flex flex-column align-items-center gap-1 py-3 cursor-pointer">


        <!-- <div class="text-muted fs-12">
            @if($product->added_by=='seller')
                {{ isset($product->seller->shop->name) ? Str::limit($product->seller->shop->name, 20) : '' }}
            @elseif($product->added_by=='admin')
                {{$web_config['name']->value}}
            @endif
        </div> -->

        <h6 class="product__title text-truncate">
            {{ Str::limit($product['name'], 25) }}
        </h6>

        <div class="product__price d-flex justify-content-center flex-wrap column-gap-2">
            @if($product->discount > 0)
                <del class="product__old-price">{{Helpers::currency_converter($product->unit_price)}}</del>
            @endif
            <ins class="product__new-price">
                {{Helpers::currency_converter($product->unit_price - Helpers::get_product_discount($product, $product->unit_price))}}
            </ins>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <div class="star-rating text-gold fs-12">
                @for ($index = 1; $index <= 5; $index++)
                    @if ($index <= (int) $overallRating[0])
                        <i class="bi bi-star-fill"></i>
                    @elseif ($overallRating[0] != 0 && $index <= (int) $overallRating[0] + 1.1 && $overallRating[0] > ((int) $overallRating[0]))
                        <i class="bi bi-star-half"></i>
                    @else
                        <i class="bi bi-star"></i>
                    @endif
                @endfor
            </div>
            <span>( {{count($product->reviews)}} )</span>
        </div>
    </div>
</div>