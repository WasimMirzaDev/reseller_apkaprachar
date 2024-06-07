<section class="">
    <div class="container">
        <div class="">
            <div class="py-4">
                <span class="py-2 ps-2" style="border-left: 12px solid #db4444; color: #db4444; font-weight: 700;">This Month</span>
                <div class="d-flex flex-wrap justify-content-between gap-3 my-4">
                    <h2 class="text-capitalize">{{ translate('best_selling_products') }}</h2>
                    <div class="swiper-nav d-flex gap-2 align-items-center">
                        <buttton class="btn btn-danger" style="padding: 10px 32px;">View All</buttton>
                        <!-- <div class="swiper-button-prev top-rated-nav-prev position-static rounded-10"></div>
                        <div class="swiper-button-next top-rated-nav-next position-static rounded-10"></div> -->
                    </div>
                </div>
                <div class="">
                    <div class="row">
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