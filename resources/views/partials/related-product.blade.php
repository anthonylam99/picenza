<div class="product-relate-to">
    <div class="title-main">
        <div class="title">
            <h6>SẢN PHẨM LIÊN QUAN</h6>
        </div>
    </div>
    <div class="content w-100 pb-2">
        <div class="owl-carousel product-relate owl-theme row">
            @foreach ($aryRelatedProd as $relatedProd)
            <div class="product-relate-item-main">
                <div class="product-relate-item">
                    <div class="image">
                        <a href="">
                            <img src="{{ !empty($relatedProd->avatar_path) ? $relatedProd->avatar_path : 'images/product/product_demo_2.png' }}" alt="tag">
                        </a>
                    </div>
                    <div class="name">
                        <h6>
                            <a href="{{ route('product.detail', $relatedProd->slug) }}">{{ $relatedProd->name }}</a>
                        </h6>
                    </div>
                    <div class="price">
                        <div class="content-price">
                            <h6 class="sale-price">{{(!empty($relatedProd->sale_price)) ? number_format($relatedProd->sale_price).'đ' : 'Liên hệ'}}</h6>
                            <h6 class="unsale-price">{{(!empty($relatedProd->price)) ? number_format($relatedProd->price).'đ' : 'Liên hệ'}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
