<div class="review-detail">
    <div class="review-detail-title">
        <div class="number-review">
            <h6>@if($comments->total() > 3) 1-3 trong @endif {{ $comments->total() }} đánh giá</h6>
        </div>
        <div class=orders>
            <div class="order-by-title">
                Sắp xếp theo:
            </div>
            <div class="order-by-btn">
                <select name="orderby" id="orderby">
                    <option value="1">Liên quan nhất</option>
                </select>
            </div>
        </div>
    </div>
    <div class="review-detail-content">
        @foreach ($comments as $comment)
        <div class="review-item row" id="comment-id-{{ $comment->id }}">
            <div class="customer-info col-sm-3 col-12">
                <div class="name">{{ $comment->user->name }}</div>
                <div class="address">{{ $comment->user->address ?? '' }}</div>
                <div class="comment">Bình luận: 1</div>
                <div class="has-review">Đã đánh giá: 61</div>
                <div class="gender">Giới tính: {{ $comment->user->gender == 0 ? 'Nam' : 'Nữ' }}</div>
                <div class="age">Tuổi: 35-44</div>
            </div>
            <div class="review-content col-sm-6 col-12">
                <div class="rating-star">
                    @for ($i = 1; $i < 6; $i++)
                        <i class="fa fa-star" style="color: {{ $comment->rating < $i ? '#DBDBDB' : '#ED2027' }}; "></i>
                    @endfor
                    <i class="fa fa-circle" style="font-size: 4px; padding: 0 10px; color: #444444;"></i>
                    <div class="dot">
                        <h6 class="timer">15 phút trước</h6>
                    </div>
                </div>
                <div class="review-title">
                    <h6>{{ $comment->title }}</h6>
                </div>
                <div class="review-main-content">
                    <div class="content-1">
                        {{ $comment->body }}
                    </div>
                    <div class="content-2">
                        <div class="review-useful">
                            <h6>Đánh giá sản phẩm này
                                <text>✔ Hữu ích</text>
                            </h6>
                        </div>
                        <div class="review-image row">
                            @forelse ($comment->file as $image)
                                <div class="col-3">
                                    <img src="{{ $image }}" >
                                </div>
                            @empty

                            @endforelse
                        </div>
                        <div class="make-review-useful">
                            <h6>Hữu ích ?</h6>
                            <button class="useful">
                                Có
                                <i class="fa fa-circle"
                                   style="font-size: 4px; padding: 0 4px; color: #444444;"></i>
                                <text>{{ $comment->count_like }}</text>
                            </button>
                            <button class="unuseful">
                                Không
                                <i class="fa fa-circle"
                                   style="font-size: 4px; padding: 0 4px; color: #444444;"></i>
                                <text>{{ $comment->count_dislike }}</text>
                            </button>
                            <button class="report">
                                Báo cáo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-quality col-sm-3 col-12">
                <div class="review-quality-content">
                    <div class="quality">
                        <h6>Chất lượng</h6>
                        <div class="point-group">
                            <div class="point-item">
                                @for ($i = 1; $i < 6; $i++)
                                    <i class="point {{ $comment->count_quality < $i ? 'point-unactive' : 'point-active' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="value">
                        <h6>Giá trị</h6>
                        <div class="point-group">
                            <div class="point-item">
                                @for ($i = 1; $i < 6; $i++)
                                    <i class="point {{ $comment->count_worth < $i ? 'point-unactive' : 'point-active' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(count($comments) > 3)
    <div class="btn-load-more text-center">
        <button class="load-more">
            Xem thêm <i class="fa fa-long-arrow-right"></i>
        </button>
    </div>
    @endif
</div>