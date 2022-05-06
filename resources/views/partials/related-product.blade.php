<div class="product-relate-to">
    <div class="title-main">
        <div class="title">
            <h6>SẢN PHẨM LIÊN QUAN</h6>
        </div>
    </div>
    <div class="content w-100 pb-2">
        <div class="owl-carousel product-relate owl-theme">

            @foreach ($aryRelatedProd as $relatedProd)
            <div class="product-relate-item-main">
                <div class="product-relate-item">
                    <div class="image">
                        <a href="">
                            <img src="{{ $detailProduct->avatar_path }}" alt="tag">
                        </a>
                    </div>
                    <div class="name">
                        <h6>
                            <a href="{{ route('product.detail', $relatedProd->id) }}">{{ $relatedProd->name }}</a>
                        </h6>
                    </div>
                    <div class="price">
                        <div class="content-price">
                            <h6 class="sale-price">@money($relatedProd->sale_price)</h6>
                            <h6 class="unsale-price">@money($relatedProd->price)</h6>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
