@extends('admin.index')

@section('pageTitle', 'Cập nhật thuộc tính')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Thuộc tính</a></li>
    <li class="breadcrumb-item active">Cập nhật</li>
@endsection

@section('content')
    <div class="col-6">
        <div class="card">
            <form enctype="multipart/form-data" method="POST" action="{{route('admin.product.feature.add.post')}}">
                @csrf
                <input type="hidden" id="token" value="{{csrf_token()}}">
                <input type="hidden" name="id" id="id_category" value="{{$feature->id}}">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Danh mục sản phẩm</label>
                                <select class="form-control" name="category_id" required>
                                    <option value="">-- Vui lòng chọn ---</option>
                                    @foreach($category as $value)
                                        <option
                                            value="{{$value->id}}" {{$value->id === $feature->product_line ? 'selected' : ''}}>{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên thuộc tính</label>
                                <input type="text" name="name" class="form-control" id="nameFeature"
                                       placeholder="Nhập tên tính năng..." value="{{$feature->name}}" required>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="ckfinder-popup-1" class="col-md-2 col-sm-2 col-xs-12">Ảnh đại diện</label>--}}

{{--                                <div id="show-img-avatar">--}}
{{--                                    <button type="button" id="ckfinder-popup-1" class="btn btn-sm btn-success">--}}
{{--                                        Chọn ảnh--}}
{{--                                    </button>--}}
{{--                                    <div class="img-avt">--}}
{{--                                        <img id="img-avatar" src="{{$feature->avatar}}" alt="">--}}
{{--                                    </div>--}}
{{--                                    <input type="hidden" id="img_avatar_path" name="img_avatar_path" value="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="">Mô tả</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Nhập mô tả ...">{{$feature->description}}</textarea>
                            </div>
{{--                            <div class="custom-control custom-checkbox col-4">--}}
{{--                                <input name="favourite" class="custom-control-input" type="checkbox" id="favourite" {{$feature->favourite === 1 ? 'checked' : ''}}--}}
{{--                                >--}}
{{--                                <label for="favourite" class="custom-control-label">KÍCH HOẠT</label>--}}
{{--                            </div>--}}
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
    <div class="card col-6">
        <div class="card-header">
            <div class="header">
                <h4 style="font-weight: 700">Danh mục tính năng</h4>
                <button style="margin-bottom: 10px" type="button" class="btn btn-success" id="add-sub-category">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Thêm mới
                </button>
                <button style="margin-bottom: 10px; display: none;" type="button" class="btn btn-danger "
                        id="cancel-sub-category">
                    <i class="fas fa-ban"></i>
                    Hủy
                </button>
            </div>
            <div class="add-form row" id="add-sub-category-form" style=" display: none;">
                <input class="form-control col-10" type="text" name="sub-category-name" id="sub-category-name"
                       placeholder="Nhập tên tính năng...">
                <input type="hidden" name="" id="subNameCate">
                <button style="margin-bottom: 10px;" type="button" class="btn btn-success col-2"
                        id="add-sub-category-btn">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Thêm
                </button>
            </div>
        </div>
        <div class="card-body h-100">
            <div class="table-subcategory">
                <table class="table table-bordered table-striped table-bordered bulk_action" id="sub-cate-tbl">
                    <thead>
                    <tr>
                        <th>Tên tính năng</th>
                        <th>Ngày tạo</th>
                        <th>Ngày sửa</th>
                        <th>Yêu thích</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subCate as $value)
                        <tr>
                            <td>
                                <a href="{{route('admin.sub.category.edit', ['id' => $value->id])}}">
                                    {{$value->name}}
                                </a>
                            </td>
                            <td>{{date('Y-m-d', strtotime($value->created_at))}}</td>
                            <td>{{date('Y-m-d', strtotime($value->updated_at))}}</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input name="favourite{{$value->id}}" class="custom-control-input" type="checkbox"
                                           id="favourite{{$value->id}}" onclick="makeFavourite({{$value->id}})" {{$value->favourite === 1 ? 'checked' : ''}}>
                                    <label for="favourite{{$value->id}}" class="custom-control-label"></label>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteSubCate({{$value->id}})"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

