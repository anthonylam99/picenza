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
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.product.add.post')}}">
            @csrf

            <input type="hidden" name="id" value="{{$product['id']}}">
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control m-r-10 input-sm" id="productName"
                                   value="{{$product['name']}}" placeholder="Nhập tên sản phẩm..." required>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Giá</label>
                            <input type="text" name="price" class="form-control m-r-10 input-sm" id="productPrice"
                                   value="{{$product['price']}}" placeholder="Nhập giá sản phẩm...." required>
                        </div>
                        <div class="form-group">
                            <label for="salePrice">Giá giảm giá</label>
                            <input type="text" name="sale_price" class="form-control m-r-10 input-sm" id="salePrice"
                                   value="{{$product['sale_price']}}" placeholder="Nhập giá giảm giá...." >
                        </div>
                        <div class="form-group">
                            <label for="pricePercent">Giảm giá (%)</label>
                            <input type="number" max="100" min="0" name="sale_percent" class="form-control m-r-10 input-sm"
                                   value="{{$product['sale_percent']}}" id="pricePercent"
                                   placeholder="Nhập phần trăm giảm giá....">
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="company">Loại sản phẩm</label>--}}
{{--                            <select name="product_type" id="productTypeList" class="form-control m-r-10 input-sm" required>--}}
{{--                                <option value="">-- Vui lòng chọn --</option>--}}
{{--                                @foreach($productType as $value)--}}
{{--                                    @if(isset($product['product_type']) && $product['product_type']['id'] === $value->id)--}}
{{--                                        <option value="{{$value->id}}" selected>{{$value->name}}</option>--}}
{{--                                    @else--}}
{{--                                        <option value="{{$value->id}}">{{$value->name}}</option>--}}

{{--                                    @endif--}}

{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="company">Hãng sản xuất</label>
                            <select name="company" id="companyList" class="form-control m-r-10 input-sm" required>
                                @foreach($company as $value)
                                    @if(isset($product['company']) && $product['company']['id'] === $value->id)
                                        <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Danh mục</label>
                            <select name="product_line" id="productLineList" class="form-control m-r-10 input-sm" required>

                                <option value="">-- Vui lòng chọn --</option>
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
                            <label for="company">Tính năng</label>
                            <div class="form-group">
                                <div class="accordion row" id="accordionExample">
                                    @foreach($feature as $item)
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-header" id="headingOne{{$item->id}}">
                                                    <h2 class="mb-0">
                                                        <button type="button" class="btn btn-link"
                                                                data-toggle="collapse"
                                                                data-target="#collapseOne{{$item->id}}">
                                                            <i class="fa fa-plus"></i>
                                                            {{$item->name}}
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseOne{{$item->id}}" class="collapse"
                                                     aria-labelledby="headingOne{{$item->id}}"
                                                     data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        @if(!empty($item['sub']))

                                                            @foreach($item['sub'] as $sub)
                                                                <div class="custom-control custom-checkbox">
                                                                    <input name="feature[]" class="custom-control-input" type="checkbox"
                                                                           id="customCheckbox{{$sub->id}}" value="{{$sub->id}}" {{in_array($sub->id, $featureList) ? 'checked' : '' }}>
                                                                    <label for="customCheckbox{{$sub->id}}" class="custom-control-label">{{$sub->name}}</label>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="productFeature" style="margin-left: 0">
                            <div class="custom-control custom-checkbox col-4">
                                <input name="is_bestseller" class="custom-control-input" type="checkbox" value="1"
                                       id="status" {{ $product['is_bestseller'] == 1 ? 'checked' : ''}}
                                >
                                <label for="status" class="custom-control-label">Sản phẩm bán chạy</label>
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
                        <div class="form-group row">
                            <label for="ckfinder-popup-1" class="col-md-2 col-sm-2 col-xs-12">Ảnh đại diện</label>

                            <div id="show-img-avatar col-sm-9">
                                <button type="button" id="ckfinder-popup-1" class="btn btn-sm btn-success">
                                    Chọn ảnh
                                </button>
                                <div class="img-avt">
                                    <img id="img-avatar" src="{{$product['avatar_path'] ?? ''}}" alt="">
                                </div>
                                <input type="hidden" id="img_avatar_path" name="img_avatar_path" value="{{$product['avatar_path']}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image-and-color"><b>Ảnh sản phẩm</b></label>
                            <div class="body-card-image row" id="card-image">
                                <?php $i = 0; ?>
                                @foreach($product['product_image'] as $value)
                                    <?php $i++; ?>
                                    <div class="col-3 img-box" id="label-image{{$i}}" data-photo="{{$i}}">
                                        <div style="height: 100px; border: 2px dashed #cccccc; margin-bottom: 10px;"
                                             id="image-preview1" class="show-img">
                                            <img id="image-preview-src" src="{{asset($value['image_path'])}}" alt="">
                                        </div>
                                        <label for="color-choose<?php echo $i; ?>">Màu sắc:</label>
                                        <input onchange="setColor({{$i}})" type="color"
                                               id="color-picker<?php echo $i; ?>" value="{{$value['color']['hex']}}">
                                        <input type="hidden" id="color-choose<?php echo $i; ?>"
                                               name="hex<?php echo $i; ?>" value="{{$value['color']['hex']}}">
                                        <input class="form-control m-r-10 input-sm" type="text" name="price<?php echo $i; ?>"
                                               value="{{$value['price']}}" placeholder="Nhập giá...."
                                               required="">
                                        <input class="form-control m-r-10 input-sm" type="text" name="color<?php echo $i; ?>"
                                               value="{{$value['color']['color']}}" placeholder="Nhập tên màu...."
                                               required="">
                                        <label for="image-input<?php echo $i; ?>" class="image-upload"><i
                                                class="fas fa-upload"></i>Chọn ảnh</label>
                                        <input style="display: none" onclick="selectImageGalery({{$i}})"
                                               id="image-input<?php echo $i; ?>"
                                               type="text" name="image<?php echo $i; ?>" data-photo="<?php echo $i; ?>" value="{{$value['image_path']}}">
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
@endsection
