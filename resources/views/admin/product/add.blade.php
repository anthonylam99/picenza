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
                            <input type="text" name="product_name" class="form-control" id="productName"
                                   placeholder="Nhập tên sản phẩm..." required>
                        </div>

                        <div class="form-group">
                            <label for="productPrice">Giá</label>
                            <input type="text" name="price" class="form-control" id="productPrice"
                                   placeholder="Nhập giá sản phẩm...." required>
                        </div>
                        <div class="form-group">
                            <label for="salePrice">Giá giảm giá</label>
                            <input type="text" name="sale_price" class="form-control" id="salePrice"
                                   placeholder="Nhập giá giảm giá....">
                        </div>
                        <div class="form-group">
                            <label for="pricePercent">Giảm giá (%)</label>
                            <input type="number" max="100" min="0" name="sale_percent" class="form-control"
                                   id="pricePercent" placeholder="Nhập phần trăm giảm giá....">
                        </div>

                    </div>
                </div>
                <div class="col-6">
                    <div class="card-body">
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

                                <option value="">-- Vui lòng chọn --</option>
                                @foreach($productLine as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mô tả ngắn</label>
                            <br>
                            <textarea name="short_desc" id="" cols="116" rows="2"></textarea>
                          </div>
                        <div class="form-group">
                            <label for="company">Tính năng</label>
                            <div class="form-group">
                                <div class="accordion row" id="accordionExample">

                                </div>
                            </div>
                        </div>
                            <button type="button" class="btn btn-success btn-add-desc"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mô tả</button>
                            <p></p>
                            <div class="list-desc">
                                <div class="row" id="row-desc-0">
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
                                            <textarea name="description[0][content]" id="" cols="60" rows="2"></textarea>
                                          </div>
                                    </div>
                                </div>
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
                <div class=" col-8">
                    <div class="card card-info">
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
                                        <h3 class="preview_snippet_title"></h3>
                                        <p class="preview_snippet_link">{{config('app.url').'/chi-tiet-san-pham/'}}</p>
                                        <p class="preview_snippet_des"></p>
                                        <input type="hidden" id="url_seo" value="{{config('app.url').'/chi-tiet-san-pham/'}}">
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label for="news_title" class="control-label col-md-2 col-sm-2 col-xs-12"><span
                                                class="form-asterick"></span>Tiêu đề cho thẻ meta title (SEO)</label>
                                        <div class="controls col-sm-9">
                                            <input type="text" placeholder="Tiêu đề tốt nhất 60 - 70 ký tự"
                                                   class="form-control col-sm-9 in_title" id="news_title" value=""
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
                                                      name="seo_description" style="width:100%;height:60px"></textarea>
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
                                                   id="news_keyword" value="" name="seo_keyword">
                                            <span>Không nên lạm dụng thẻ Meta Keyword để tránh việc bị phản tác dụng.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="news_robots" class="control-label col-md-2 col-sm-2 col-xs-12"><span
                                                class="form-asterick"></span>Điều hướng Robots</label>
                                        <div class="controls col-sm-3">
                                            <select id="news_robots" name="seo_robots" class="form-control">
                                                <option value="index,follow">Index,Follow</option>
                                                <option value="noindex,nofollow">Noindex,Nofollow</option>
                                                <option value="index,nofollow">Index,Nofollow</option>
                                                <option value="noindex,follow">Noindex,Follow</option>
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
    $('.btn-add-desc').on('click', function(){
        var rowDesc = `<div class="row" id="row-desc-${i}">
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



