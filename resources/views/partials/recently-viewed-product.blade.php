<div class="product-recent">
    <div class="title-main">
        <div class="title">
            <h6>SẢN PHẨM ĐÃ XEM GẦN ĐÂY</h6>
        </div>
    </div>
    <div class="content w-100">
        <div class="owl-carousel product-recent owl-theme">
            @foreach ($aryRecentProd as $prod)
            <div class="product-relate-item-main">
                <div class="product-relate-item">
                    <div class="image">
                        <a href="">
                            <img src="{{ $prod->productMedias }}" alt="tag">
                        </a>
                    </div>
                    <div class="name">
                        <h6>
                            <a href="{{ route('product.detail', $prod->id) }}">{{ $prod->name }}</a>
                        </h6>
                    </div>
                    <div class="price">
                        <div class="content-price">
                            <h6 class="sale-price">@money($prod->sale_price)</h6>
                            <h6 class="unsale-price">@money($prod->price)</h6>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
