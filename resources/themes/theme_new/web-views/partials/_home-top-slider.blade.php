<style>
    .main-banner .owl-stage-outer {
        width: 100% !important;
        height: auto;
    }
    .single-product-details a {
        color: #000;
    }
</style>
<div class="no-gutters position-relative rtl">
    @if ($categories->count() > 0 )  @endif

    <div class="">
    <!-- {{Session::get('direction') === "rtl" ? 'pr-xl-2' : 'pl-xl-2'}} -->
        <div class="">
            <div class="w-100 owl-theme owl-carousel hero-slider d-inline-flex main-banner">
                @foreach($main_banner as $key=>$banner)
                <a href="{{$banner['url']}}" class="d-block" target="_blank">
                    <img class="w-100" alt=""
                         src="{{ getValidImage(path: 'storage/app/public/banner/'.$banner['photo'], type: 'banner') }}">
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

