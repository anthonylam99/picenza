@extends('admin.index')

@section('pageTitle', 'Cập nhật trạm bảo hành')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Trạm bảo hành</a></li>
    <li class="breadcrumb-item active">Cập nhật</li>
@endsection

@section('content')
    <div class="col-12">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
    </div>
    <div class="card col-6">
        <form enctype="multipart/form-data" id="warranty" method="POST"
              action="{{route('admin.warranty.update', ['id' => $warranty->id])}}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Tên trạm bảo hành</label>
                            <input type="text" value="{{json_decode($warranty->name)}}" name="name" class="form-control"
                                   id="nameWarranty" placeholder="Tên trạm bảo hành..." required>
                        </div>
                        <div class="form-group">
                            <label for="productName">Số điện thoại</label>
                            <input type="text" value="{{$warranty->phone}}" name="phone" class="form-control"
                                   id="phoneWarranty" placeholder="Nhập số điện thoại..." required>
                        </div>
                        <div class="form-group ">
                            <label for="ckfinder-popup-1" class="">Ảnh đại diện</label>

                            <div id="show-img-avatar ">
                                <button type="button" id="ckfinder-popup-1" class="btn btn-sm btn-success">
                                    Chọn ảnh
                                </button>
                                <div class="img-avt">
                                    <img id="img-avatar" width="200" src="{{asset($warranty->avatar)}}" alt="{{asset($warranty->avatar)}}">
                                </div>
                                <input type="hidden" id="img_avatar_path" name="img_avatar_path"
                                       value="{{asset($warranty->avatar)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="city"></label>
                                    <select class="form-control" id="city" name="city" required>
                                        <option value="">-- Chọn thành phố ---</option>
                                        @foreach($city as $value)
                                            <option
                                                value="{{$value->id}}" {{($warranty->city === $value->id) ? 'selected' : ''}}>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="district"></label>
                                    <select class="form-control" id="district" name="district" required>
                                        <option value="">-- Chọn quận ---</option>
                                        @foreach($district as $value)
                                            <option
                                                value="{{$value->id}}" {{($warranty->district === $value->id) ? 'selected' : ''}}>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ chi tiết</label>
                            <input type="text" name="address" value="{{json_decode($warranty->address)}}"
                                   class="form-control" id="address" placeholder="Số nhà, ngõ..." required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="button" class="btn btn-warning" onclick="checkSubmit()">Cập nhật</button>
                        <button type="button" class="btn btn-default float-right">
                            <a style="color: #000000" href="{{route('admin.price.list')}}">Hủy</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


