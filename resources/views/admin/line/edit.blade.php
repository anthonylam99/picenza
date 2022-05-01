@extends('admin.index')

@section('pageTitle', 'Cập nhật')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Danh mục</a></li>
    <li class="breadcrumb-item active">Cập nhật</li>
@endsection

@section('content')
    <div class="card col-6">
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.line.add.post')}}">
            @csrf
            <input type="hidden" name="id" value="{{$line->id}}">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="lineName" class="col-md-2 col-sm-2 col-xs-12">Danh mục</label>
                            <input type="text" name="lineName" id="lineName" class="form-control col-sm-9"
                                   value="{{$line->name}}"
                                   placeholder="Nhập tên danh mục..." required>
                        </div>
                        <div class="form-group row">
                            <label for="seo-url" class="col-md-2 col-sm-2 col-xs-12">Đường dẫn</label>
                            <input type="text" name="seo-url" id="seo-url" class="form-control col-sm-9"
                                   value="{{$line->seo_url}}"
                                   placeholder="Nhập đường dẫn..." required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-sm-2 col-xs-12" for="">Mô tả</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" name="description"
                                          placeholder="Nhập mô tả ...">{{$line->description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="ckfinder-popup-1" class="col-md-2 col-sm-2 col-xs-12">Ảnh đại diện</label>

                            <div id="show-img-avatar col-sm-9">
                                <button type="button" id="ckfinder-popup-1" class="btn btn-sm btn-success">
                                    Chọn ảnh
                                </button>
                                <div class="img-avt">
                                    <img id="img-avatar" width="200" src="{{$line->avatar}}" alt="">
                                </div>
                                <input type="hidden" id="img_avatar_path" name="img_avatar_path"
                                       value="{{$line->avatar}}">
                            </div>
                        </div>
                        <div class="form-group row" id="productFeature" style="margin-left: 0">
                            <div class="custom-control custom-checkbox col-4">
                                <input name="status" class="custom-control-input" type="checkbox"
                                       id="status" {{$line->status === 1 ? 'checked' : ''}}
                                >
                                <label for="status" class="custom-control-label">KÍCH HOẠT</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                        <button type="button" class="btn btn-default float-right">
                            <a style="color: #000000" href="{{route('admin.line.list')}}">Hủy</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


