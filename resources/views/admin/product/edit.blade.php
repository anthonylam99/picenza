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
                            <label for="seo-url" class="">Đường dẫn</label>
                            <input type="text" name="seo-url" id="seo-url" class="form-control"
                                   value="{{$product['seo_url']}}"
                                   placeholder="Nhập đường dẫn..." required>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Giá</label>
                            <input type="text" name="price" class="form-control m-r-10 input-sm" id="productPrice"
                                   value="{{number_format($product['price'])}}" placeholder="Nhập giá sản phẩm...." required>
                        </div>
                        <div class="form-group">
                            <label for="salePrice">Giá giảm giá</label>
                            <input type="text" name="sale_price" class="form-control m-r-10 input-sm" id="salePrice"
                                   value="{{number_format($product['sale_price'])}}" placeholder="Nhập giá giảm giá...." >
                        </div>
                        <div class="form-group">
                            <label for="pricePercent">Giảm giá (%)</label>
                            <input type="number" max="100" min="0" name="sale_percent" class="form-control m-r-10 input-sm"
                                   value="{{$product['sale_percent']}}" id="pricePercent"
                                   placeholder="Nhập phần trăm giảm giá....">
                        </div>
                        <div class="form-group">
                            <div class="rating-star">
                                <strong>Đánh giá sao: </strong>
                                @for ($i = 1; $i < 6; $i++)
                                    <i class="fa fa-star" style="color: {{ $product['rating'] < $i ? '#DBDBDB' : '#ED2027' }}; "></i>
                                @endfor
                            </div>
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
                        <div class="form-group select2-purple">
                            <label for="title" class="">Danh mục</label>
                            <select name="product_line[]" class="select2 form-control" multiple="multiple"
                                    required>
                                @foreach($productLine as $value)
                                    @if(isset($product['product_line']))
                                        @if(in_array($value->id, json_decode($product['product_line'], true)))
                                            <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                        @else
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endif
                                    @else
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mô tả ngắn</label>
                            <br>
                            <textarea name="short_desc" id="" cols="116" rows="2">{{  $product['short_desc']}}</textarea>
                          </div>
                        <div class="form-group">
                            <label for="company">Tính năng</label>
                            <div class="form-group">
                                <div class="accordion row" id="accordionExample">
                                    @if(!empty($feature))
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
                                    @endif
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
                        <button type="button" class="btn btn-success btn-add-desc"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mô tả</button>
                        <p></p>
                        <div class="list-desc">
                            @if (!empty($product['description']))
                            @foreach ($product['description'] as $key => $dec)
                            <div class="row desc-item" id="row-desc-{{$key}}">
                                <input type="hidden" class="prod-des" data-des="{{$key}}">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" class="form-control" name="description[{{$key}}][title]" value="{{ $dec['title'] ?? '' }}" placeholder="Tiêu đề mô tả">
                                        </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <br>
                                        <textarea name="description[{{$key}}][content]" id="" cols="60" rows="2">{{ $dec['content'] ?? '' }}</textarea>
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-del-desc" data-index="{{$key}}" style="margin-top: 40px"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
                                </div>
                            </div>
                        @endforeach
                            @else
                            <div class="row desc-item" id="row-desc-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" class="form-control" name="description[0][title]"  placeholder="Tiêu đề mô tả">
                                        </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <br>
                                        <textarea name="desc[0][content]" id="" cols="60" rows="2"></textarea>
                                        </div>
                                </div>
                            </div>
                            @endif
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
                                    <img style="width: 300px !important;" id="img-avatar" src="{{$product['avatar_path'] ?? ''}}" alt="">
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
                                             id="image-preview{{$i}}" class="show-img">
                                            <img id="image-preview-src{{$i}}" src="{{asset($value['image_path'])}}" alt="">
                                        </div>
                                        <input type="hidden" name="idimg{{$i}}" value="{{$value['id']}}">
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

                <div class="col-8">
                    <div class="card card-info ">
                        <div class="card-header" style="margin-top: 10px">
                            <h3 class="card-title">
                                NỘI DUNG CHO SEO
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="seo-content" style="margin: 0 10px;">
                                <div class="preview_snippet">
                                    <h4>Xem trước hiển thị tìm kiếm trên Google</h4>
                                    <div class="preview_snippet_main">
                                        <h3 class="preview_snippet_title">{{$product['seo_title']}}</h3>
                                        <p class="preview_snippet_link">{{config('app.url').'/chi-tiet-san-pham/'.$product['seo_url']}}</p>
                                        <p class="preview_snippet_des">{{$product['seo_description']}}</p>
                                        <input type="hidden" id="url_seo" value="{{config('app.url').'/chi-tiet-san-pham/'}}">
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label for="news_title" class="control-label col-md-2 col-sm-2 col-xs-12"><span
                                                class="form-asterick"></span>Tiêu đề cho thẻ meta title (SEO)</label>
                                        <div class="controls col-sm-9">
                                            <input type="text" placeholder="Tiêu đề tốt nhất 60 - 70 ký tự"
                                                   class="form-control col-sm-9 in_title" id="news_title" value="{{$product['seo_title']}}"
                                                   name="seo_title">
                                            <span class="in_title_count">0</span> ký tự. Tiêu đề (title) tốt nhất khoảng
                                            60 - 70 ký tự
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="news_description" class="control-label col-md-2 col-sm-2 col-xs-12"><span
                                                class="form-asterick"></span>Đoạn mô tả cho thẻ meta description
                                            (SEO)</label>
                                        <div class="controls col-sm-9">
                                            <textarea placeholder="Mô tả khoảng 160 ký tự"
                                                      class="span6 form-control in_des" id="news_description"
                                                      name="seo_description" style="width:100%;height:60px">{{$product['seo_description']}}</textarea>
                                            <span class="in_des_count">0</span> ký tự. Mô tả (description) tốt nhất
                                            khoảng 120 - 160 ký tự
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="news_keyword"
                                               class="control-label col-md-2 col-sm-2 col-xs-12"><span
                                                class="form-asterick"></span>Meta Keyword (SEO)</label>
                                        <div class="controls  col-sm-9">
                                            <input type="text" placeholder="" class="form-control col-sm-9"
                                                   id="news_keyword" value="{{$product['seo_keyword']}}" name="seo_keyword">
                                            <span>Không nên lạm dụng thẻ Meta Keyword để tránh việc bị phản tác dụng.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="news_robots" class="control-label col-md-2 col-sm-2 col-xs-12"><span
                                                class="form-asterick"></span>Điều hướng Robots</label>
                                        <div class="controls col-sm-3">
                                            <select id="news_robots" name="seo_robots" class="form-control">
                                                <option value="index,follow" {{$product['seo_robots'] === 'index,follow' ? 'selected' : ''}}>Index,Follow</option>
                                                <option value="noindex,nofollow" {{$product['seo_robots'] === 'noindex,nofollow' ? 'selected' : ''}}>Noindex,Nofollow</option>
                                                <option value="index,nofollow" {{$product['seo_robots'] === 'index,nofollow' ? 'selected' : ''}}>Index,Nofollow</option>
                                                <option value="noindex,follow" {{$product['seo_robots'] === 'noindex,follow' ? 'selected' : ''}}>Noindex,Follow</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('admin.js')
@endsection
@push('js')
<script>
    $(function (){
        $("#productName").on('input', function (){
            var slug  = slugify($(this).val())
            $('#seo-url').val(slug)
            console.log(slug)
        })
    })

    var i = 1;
    var list = $(".prod-des").map(function () {
        return $(this).attr('data-des');
    }).get();
    if (list.length > 0) {
        i = list.splice(-1)[0]
    }
    $('.btn-add-desc').on('click', function(){
        i++;
        var rowDesc = `<div class="row" id="row-desc-${i}">
                        <input type="hidden" class="prod-des" data-des="${i}">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" class="form-control" name="description[${i}][title]"  placeholder="Tiêu đề mô tả">
                                </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <br>
                                <textarea name="description[${i}][content]" id="" cols="60" rows="2"></textarea>
                                </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-del-desc" data-index="${i}" style="margin-top: 40px"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
                        </div>
                    </div>`;

                    $('.list-desc').append(rowDesc);
                    i++;
    });

    $(document).on('click', 'body .btn-del-desc', function(){
        var index = $(this).data('index');

        $('#row-desc-'+ index).remove();

        i--;
    })
</script>
@endpush

