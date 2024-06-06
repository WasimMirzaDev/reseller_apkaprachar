<section class="mt-5">
    <div class="container">
        <div class="">
            <div class="py-4">
                <span class="py-2 ps-2"
                    style="border-left: 12px solid #db4444; color: #db4444; font-weight: 700;">Today's</span>
                <div class="d-flex flex-wrap justify-content-between gap-3 my-4">
                    <div class="swiper-nav d-flex gap-2 align-items-center">
                        <h2 class="text-capitalize">{{ translate('Flash_Sales') }}</h2>
                        <div class="countdown-timer d-flex gap-3 flex-wrap justify-content-center text-center ps-5"
                            data-date="{{$flash_deals ? $flash_deals['end_date'] : ''}}">
                            <div class="days d-flex flex-column gap-2 gap-sm-3"></div>
                            <div class="hours d-flex flex-column gap-2 gap-sm-3"></div>
                            <div class="minutes d-flex flex-column gap-2 gap-sm-3"></div>
                            <div class="seconds d-flex flex-column gap-2 gap-sm-3"></div>
                        </div>
                    </div>
                    <div class="swiper-nav d-flex gap-1 align-items-center">
                        <!-- <buttton class="btn btn-danger py-2 px-4">View All</buttton>
                        <div class="swiper-button-prev top-rated-nav-prev position-static rounded-10"></div>
                        <div class="swiper-button-next top-rated-nav-next position-static rounded-10"></div> -->
                        @if($flash_deals->products)
                            <div class="nav-arrows swiper-button-prev--flash-deal"><i class="bi bi-arrow-left"></i></div>
                            <div class="nav-arrows swiper-button-next--flash-deal"><i class="bi bi-arrow-right"></i></div>
                        @endif
                    </div>
                </div>
                <div class="swiper-container">
                    <!-- <div class="mb-2 w-100 px-lg-4">
                        <a href="{{route('flash-deals', [$flash_deals ? $flash_deals['id'] : 0])}}"
                            class="btn-link text-primary text-capitalize float-end">{{ translate('View_all') }}</a>
                    </div> -->
                    <div class="auto-item-width position-relative">
                        <div class="swiper flash-deals-swiper" data-swiper-loop="false" data-swiper-items="auto"
                            data-swiper-margin="20" data-swiper-pagination-el="null"
                            data-swiper-navigation-next=".swiper-button-next--flash-deal"
                            data-swiper-navigation-prev=".swiper-button-prev--flash-deal">
                            <div class="swiper-wrapper">
                                @foreach($flash_deals->products as $key => $deal)
                                    @if($deal->product)
                                        <div class="swiper-slide">
                                            @include('theme-views.partials._product-medium-card', ['product' => $deal->product])
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flash-detail-btn mt-3">
                <a href="" class="btn btn-danger py-2px-4">View All Products</a>
            </div>
        </div>
    </div>
</section>
