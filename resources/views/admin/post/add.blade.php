@extends('admin.index')

@section('pageTitle', 'THÊM MỚI')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Quản lý trang</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection


@section('content')

    <div class="card col-12">

        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.post.add.post')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-sm-2 col-xs-12">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control col-sm-9" value="" placeholder="Nhập tiêu đề bài viết..." required>
                        </div>
                        <div class="form-group row">
                            <label for="seo-url" class="col-md-2 col-sm-2 col-xs-12">Đường dẫn</label>
                            <input type="text" name="seo-url" id="seo-url" class="form-control col-sm-9"
                                   value=""
                                   placeholder="Nhập đường dẫn..." required>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-sm-2 col-xs-12">Chuyên mục</label>
                            <select name="category[]" class="form-control js-example-tags col-sm-9" multiple="multiple" required>
                                @foreach($category as $value)
                                    <option value="{{ $value->id }}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-sm-2 col-xs-12">Tag</label>
                            <select name="tag[]" class="form-control js-example-tags col-sm-9" multiple="multiple">
                                @foreach($tag as $value)
                                    <option>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            <label for="ckfinder-popup-1" class="col-md-2 col-sm-2 col-xs-12">Ảnh đại diện</label>

                            <div id="show-img-avatar col-sm-9">
                                <button type="button" id="ckfinder-popup-1" class="btn btn-sm btn-success">
                                    Chọn ảnh
                                </button>
                                <div class="img-avt">
                                    <img id="img-avatar" src="" alt="">
                                </div>
                                <input type="hidden" id="img_avatar_path" name="img_avatar_path" value="">
                            </div>
                        </div>
                    </div>
                    <div class="card card-info col-8">
                        <div class="card-header">
                            <h3 class="card-title">
                                NỘI DUNG
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <textarea name="content" id="text" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group row" id="productFeature" style="margin-left: 0">
                                    <div class="custom-control custom-checkbox col-4">
                                        <input name="status" class="custom-control-input" type="checkbox" id="status"
                                         >
                                        <label for="status" class="custom-control-label">KÍCH HOẠT</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                    </div>
                    <div class="card">
                        <div class="card card-info col-8">
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
                                            <p class="preview_snippet_link">{{collect(request()->server)['HTTP_REFERER']}}</p>
                                            <p class="preview_snippet_des"></p>
                                            <input type="hidden" id="url_seo" value="{{collect(request()->server)['HTTP_REFERER'].'/'}}">
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
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin.js')
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        CKEDITOR.replace( 'text', {
            filebrowserBrowseUrl: '{{ asset(route('ckfinder_browser')) }}',
            filebrowserImageBrowseUrl: '{{ asset(route('ckfinder_browser')) }}?type=Images',
            filebrowserFlashBrowseUrl: '{{ asset(route('ckfinder_browser')) }}?type=Flash',
            filebrowserUploadUrl: '{{ asset(route('ckfinder_connector')) }}?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '{{ asset(route('ckfinder_connector')) }}?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: '{{ asset(route('ckfinder_connector')) }}?command=QuickUpload&type=Flash'
        });
        $(".js-example-tags").select2({
            tags: true
        });
    </script>
    @include('ckfinder::setup')
@endsection
