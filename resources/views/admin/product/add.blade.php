@extends('admin.index')

@section('pageTitle', 'Thêm mới sản phẩm')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
    <div class="card col-12">
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.product.add.post')}}">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="productName" placeholder="Nhập tên sản phẩm..." required>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Giá</label>
                            <input type="text" name="price" class="form-control" id="productPrice" placeholder="Nhập giá sản phẩm...." required>
                        </div>
                        <div class="form-group">
                            <label for="salePrice">Giá giảm giá</label>
                            <input type="text" name="sale_price" class="form-control" id="salePrice" placeholder="Nhập giá giảm giá....">
                        </div>
                        <div class="form-group">
                            <label for="pricePercent">Giảm giá (%)</label>
                            <input type="number" max="100" min="0" name="sale_percent" class="form-control" id="pricePercent" placeholder="Nhập phần trăm giảm giá....">
                        </div>
                        <div class="form-group">
                            <label for="company">Hãng sản xuất</label>
                            <select name="company" id="companyList" class="form-control" required>
                                <option>----- Vui lòng chọn ----</option>
                                @foreach($company as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Danh mục</label>
                            <select name="product_line" id="productLineList" class="form-control" required>
                                @foreach($productLine as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Loại sản phẩm</label>
                            <select name="product_type" id="productTypeList" class="form-control" required>
                                @foreach($productType as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="shape">Hình dáng</label>
                            <select name="shape_type" class="form-control">
                                @foreach($productShape as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="technology">Công nghệ xả</label>
                            <select name="technology_type" class="form-control">
                                @foreach($productTechnology as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="company">Độ bền</label>
                            <select name="reliability_type" class="form-control">
                                @foreach($productReliability as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Tính năng</label>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input name="feature[]" class="custom-control-input" type="checkbox"
                                           id="customCheckbox1" value="option1">
                                    <label for="customCheckbox1" class="custom-control-label">Custom Checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input name="feature[]" class="custom-control-input" type="checkbox"
                                           id="customCheckbox2" value="option1">
                                    <label for="customCheckbox2" class="custom-control-label">Custom Checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input name="feature[]" class="custom-control-input" type="checkbox"
                                           id="customCheckbox3" value="option1">
                                    <label for="customCheckbox3" class="custom-control-label">Custom Checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input name="feature[]" class="custom-control-input" type="checkbox"
                                           id="customCheckbox4" value="option1">
                                    <label for="customCheckbox4" class="custom-control-label">Custom Checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input name="feature[]" class="custom-control-input" type="checkbox"
                                           id="customCheckbox5" value="option1">
                                    <label for="customCheckbox5" class="custom-control-label">Custom Checkbox</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pricePercent">Mô tả</label>
                            <textarea class="w-100" name="description" id=""
                                      value=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="ckfinder-popup-1">Ảnh đại diện</label>
                            <button type="button" id="ckfinder-popup-1" class="btn btn-sm btn-success">
                                Chọn ảnh
                            </button>
                            <div id="show-img-avatar">
                                <img id="img-avatar" src="" alt="">
                                <input type="hidden" id="img_avatar_path" name="img_avatar_path" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image-and-color">Ảnh sản phẩm</label>
                            <div class="body-card-image row">
                            </div>
                            <button type="button" id="btn-add"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="button" class="btn btn-default float-right">
                            <a style="color: #000000" href="{{route('admin.product.list')}}">Hủy</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('admin.js')
    <script src="{{asset('js/admin.js')}}"></script>
    @include('ckfinder::setup')
@endsection
