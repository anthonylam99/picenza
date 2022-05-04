@extends('admin.index')

@section('pageTitle', 'Chi tiết bình luận')

@section('breadcrumbContent')
<li class="breadcrumb-item"><a href="#">Bình luận</a></li>
<li class="breadcrumb-item active">Danh sách bình luận</li>
@endsection

@section('content')
<div class="col-12">
    <div class="panel-container show card p-3">
        <div class="panel-content">
            <div class="col-sm-12 row">
                <div class="col-sm-6 card p-3 pr-3">
                    <div id="panel-1" class="panel">
                        <div class="panel-hdr">
                            <h2>
                                Thông tin bình luận
                            </h2>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <p><strong>Họ tên: </strong>{{ $comment->user->name }}</p>
                                <hr>
                                <p><strong>Email: </strong>{{ $comment->user->email }}</p>
                                <hr>
                                <p><strong>Phone: </strong>{{ $comment->user->phone }}</p>
                                <hr>
                                <p><strong>Tiêu đề: </strong>{{ $comment->title }}</p>
                                <hr>
                                <p><strong>Nội dung: </strong>{{ $comment->body }}</p>
                                <hr>
                                <p>
                                    <div class="rating-star">
                                        <strong>Đánh giá sao: </strong>
                                        @for ($i = 1; $i < 6; $i++)
                                            <i class="fa fa-star" style="color: {{ $comment->rating < $i ? '#DBDBDB' : '#ED2027' }}; "></i>
                                        @endfor
                                    </div>
                                </p>
                                <hr>
                                <p><strong>Số lượt đánh giá hữu ích: </strong><button type="button" class="btn btn-success">Hữu ích <span class="badge">{{ $comment->count_like }}</span></button></p>
                                <hr>
                                <p><strong>Số lượt đánh giá không hữu ích: </strong><button type="button" class="btn btn-danger">Không hữu ích <span class="badge">{{ $comment->count_dislike }}</span></button></p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card p-3 pr-3">
                    <div id="panel-1" class="panel">
                        <div class="panel-hdr">
                            <h2>
                                Thông tin sản phẩm
                            </h2>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%;text-align: center">Ảnh</th>
                                            <th style="text-align: center">Tên sản phẩm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img class="img-fluid" src="{{ asset($comment->product->avatar_path) }}">
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('product.detail', $comment->product->id) }}">
                                                    <p>{{ $comment->product->name }}</p>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @if ($comment->status == 0)
                <div class="col-sm-12" style="padding: 20px 0 0 0">
                    <button type="button" onclick="changeStatusOrderAjax('{{ $comment->id }}', 1)"
                        class="btn btn-success waves-effect waves-themed">Phê duyệt</button>
                </div>
                @else
                <button type="button" onclick="changeStatusOrderAjax('{{ $comment->id }}', 2)"
                    class="btn btn-danger waves-effect waves-themed">Hủy phê duyệt</button>
                @endif --}}
            </div>
            <script>
                function changeStatusOrderAjax(id,type){
                    $.ajax({
                        type:'GET',
                        url:'{{ route('admin.order.update') }}',
                        data:{
                            id:id,
                            type:type
                        },
                        beforeSend:function(){
        
                        },
                        success:function(rest){
                            alert(rest.message);
                            location.reload();
                        }
                    });
            }
            </script>
        </div>
    </div>
</div>
@endsection