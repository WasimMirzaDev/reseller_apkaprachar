<section class="container rtl pb-4 px-max-sm-0">
    <div class="">
        <div class="__p-20px rounded  overflow-hidden" style="background: #fff;">
            <div class="d-flex __gap-6px flex-between px-sm-3">
                <div class="category-product-view-title">
                    <span class="for-feature-title font-bold __text-20px text-uppercase">
                        {{ $category['name'] }}
                    </span>
                </div>
                <div class="category-product-view-all" style="margin-right: -12px !important;">
                    <a class="text-capitalize text-dark text-nowrap"
                        href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                        {{ translate('view_all') }}
                        <i
                            class="text-dark czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>
                    </a>
                </div>
            </div>

            <div class="mt-2">
                <div class="carousel-wrap-2 d-none d-sm-block ">
                    <div class="owl-carousel owl-theme category-wise-product-slider-new {{ $category['name'] }}">
                        @foreach ($category['products'] as $key => $product)
                            @include('web-views.partials._category-single-product', [
                                'product' => $product,
                                'decimal_point_settings' => $decimal_point_settings,
                            ])
                        @endforeach
                    </div>
                </div>
                <div class="d-sm-none">
                    <div class="row g-2">
                        @foreach ($category['products'] as $key => $product)
                            @if ($key < 4)
                                <div class="col-6">
                                    @include('web-views.partials._category-single-product', [
                                        'product' => $product,
                                        'decimal_point_settings' => $decimal_point_settings
                                    ])
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
