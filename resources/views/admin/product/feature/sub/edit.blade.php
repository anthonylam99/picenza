@extends('admin.index')

@section('pageTitle', 'Cập nhật tính năng')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Tính năng</a></li>
    <li class="breadcrumb-item active">Cập nhật</li>
@endsection

@section('content')
    <div class="col-6">
        <div class="card">
            <form enctype="multipart/form-data" method="POST" action="{{route('admin.sub.category.edit', ['id' => $sub->id])}}">
                @csrf
                <input type="hidden" id="token" value="{{csrf_token()}}">
                <input type="hidden" name="id" id="id_category" value="{{$sub->id}}">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên tính năng</label>
                                <input type="text" name="name" class="form-control" id="nameFeature"
                                       placeholder="Nhập tên tính năng..." value="{{$sub->name}}" required>
                            </div>
                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <input type="text" name="url" class="form-control" id="url"
                                       placeholder="Nhập tên tính năng..." value="{{$sub->slug}}" required>
                            </div>
                            <div class="form-group">
                                <label for="ckfinder-popup-1" class="col-md-2 col-sm-2 col-xs-12">Ảnh đại diện</label>

                                <div id="show-img-avatar">
                                    <button type="button" id="ckfinder-popup-1" class="btn btn-sm btn-success">
                                        Chọn ảnh
                                    </button>
                                    <div class="img-avt">
                                        <img id="img-avatar" src="{{$sub->avatar}}" alt="">
                                    </div>
                                    <input type="hidden" id="img_avatar_path" name="img_avatar_path" value="{{$sub->avatar}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Nhập mô tả ...">{{$sub->description}}</textarea>
                            </div>
                            <div class="custom-control custom-checkbox col-4">
                                <input name="favourite" class="custom-control-input" type="checkbox"
                                       id="favourite" {{$sub->favourite === 1 ? 'checked' : ''}}
                                >
                                <label for="favourite" class="custom-control-label">TÍNH NĂNG YÊU THÍCH</label>
                            </div>
                            <div class="custom-control custom-checkbox col-4">
                                <input name="status" class="custom-control-input" type="checkbox"
                                       id="status" {{$sub->status === 1 ? 'checked' : ''}}
                                >
                                <label for="status" class="custom-control-label">KÍCH HOẠT</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Cập nhật</button>
                            <button type="button" class="btn btn-default float-right">
                                <a style="color: #000000" href="{{route('admin.product.feature.list')}}">Hủy</a>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

