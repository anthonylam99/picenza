@extends('admin.index')

@section('pageTitle', 'Cập nhật sản phẩm')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="{{route('admin.product.list')}}">Sản phẩm</a></li>
    <li class="breadcrumb-item active">Cập nhật</li>
@endsection

@section('content')
    <div class="card col-12">
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.product.add.post')}}">
            @csrf
            <input type="hidden" name="id" value="{{$product['id']}}">
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="productName"
                                   value="{{$product['name']}}" placeholder="Nhập tên sản phẩm...">
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Giá</label>
                            <input type="text" name="price" class="form-control" id="productPrice"
                                   value="{{$product['price']}}" placeholder="Nhập giá sản phẩm....">
                        </div>
                        <div class="form-group">
                            <label for="salePrice">Giá giảm giá</label>
                            <input type="text" name="sale_price" class="form-control" id="salePrice"
                                   value="{{$product['sale_price']}}" placeholder="Nhập giá giảm giá....">
                        </div>
                        <div class="form-group">
                            <label for="pricePercent">Giảm giá (%)</label>
                            <input type="number" max="100" min="0" name="sale_percent" class="form-control"
                                   value="{{$product['sale_percent']}}" id="pricePercent"
                                   placeholder="Nhập phần trăm giảm giá....">
                        </div>
                        <div class="form-group">
                            <label for="company">Loại sản phẩm</label>
                            <select name="product_type" class="form-control">
                                @foreach($productType as $value)
                                    @if($product['product_type']['id'] === $value->id)
                                        <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Hãng sản xuất</label>
                            <select name="company" class="form-control">
                                @foreach($company as $value)
                                    @if($product['company']['id'] === $value->id)
                                        <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="shape">Hình dáng</label>
                            <select name="shape_type" class="form-control">
                                @foreach($productShape as $value)
                                    @if($product['shape_type']['id'] === $value->id)
                                        <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif

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
                                    @if($product['technology_type']['id'] === $value->id)
                                        <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Dòng sản phẩm</label>
                            <select name="product_line" class="form-control">
                                @foreach($productLine as $value)
                                    @if($product['product_line']['id'] === $value->id)
                                        <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Độ bền</label>
                            <select name="reliability_type" class="form-control">
                                @foreach($productReliability as $value)
                                    @if($product['reliability_type']['id'] === $value->id)
                                        <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif

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
                                      value="{{$product['description']}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image-and-color">Ảnh sản phẩm</label>
                            <div class="body-card-image row" id="card-image">
                                <?php $i = 0; ?>
                                @foreach($product['product_image'] as $value)
                                    <?php $i++; ?>
                                    <div class="col-3 img-box" id="label-image{{$i}}" data-photo="{{$i}}">
                                        <div style="height: 100px; border: 2px dashed #cccccc; margin-bottom: 10px;"
                                             id="image-preview1" class="show-img">
                                            <img src="{{asset($value['image_path'])}}" alt="">
                                        </div>
                                        <label for="color-choose<?php echo $i; ?>">Màu sắc:</label>
                                        <input onchange="setColor({{$i}})" type="color"
                                               id="color-picker<?php echo $i; ?>" value="{{$value['color']['hex']}}">
                                        <input type="hidden" id="color-choose<?php echo $i; ?>"
                                               name="hex<?php echo $i; ?>" value="{{$value['color']['hex']}}">
                                        <input class="form-control" type="text" name="color<?php echo $i; ?>"
                                               value="{{$value['color']['color']}}" placeholder="Nhập tên màu...."
                                               required="">
                                        <label for="image-input<?php echo $i; ?>" class="image-upload"><i
                                                class="fas fa-upload"></i>Chọn ảnh</label>
                                        <input style="display: none" onchange="previewImage({{$i}})"
                                               value="{{asset($value['image_path'])}}" id="image-input<?php echo $i; ?>"
                                               type="file" name="image<?php echo $i; ?>" data-photo="<?php echo $i; ?>">
                                        <button type="button" class="btn-danger btn-deleteimg btn-delete-img-edit"
                                                onclick="removeImage({{$i}}, '{{$value['color']['id']}}')">Xóa ảnh
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="btn-add"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Cập nhật</button>
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
@endsection
