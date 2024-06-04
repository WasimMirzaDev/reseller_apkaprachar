<section class="">
    <div class="container">
        <div class="">
            <div class="py-4">
                <h5 class="py-2 mb-4 ps-3" style="border-left: 12px solid #db4444; color: #db4444;">This Month</h5>
                <div class="d-flex flex-wrap justify-content-between gap-3 mb-4">
                    <h2 class="text-capitalize">{{ translate('best_selling_products') }}</h2>
                    <div class="swiper-nav d-flex gap-2 align-items-center">
                        <buttton class="btn btn-danger">View All</buttton>
                        <!-- <div class="swiper-button-prev top-rated-nav-prev position-static rounded-10"></div>
                        <div class="swiper-button-next top-rated-nav-next position-static rounded-10"></div> -->
                    </div>
                </div>
                <div class="container">
                    <div class="row gap-3">
                        @foreach($topRated as $key => $product)
                            @if($product->product)
                                <!-- <div class="swiper-slide"> -->
                                @include('theme-views.partials._product-large-card', ['product' => $product->product])
                                <!-- </div> -->
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>