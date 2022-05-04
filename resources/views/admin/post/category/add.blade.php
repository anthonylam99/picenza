@extends('admin.index')

@section('pageTitle', '')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Chuyên mục</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
    <form enctype="multipart/form-data" method="POST" action="{{route('admin.post.category.add.post')}}">
        <div class="card col-12">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Tên chuyên mục</label>
                            <input type="text" name="name" class="form-control" id="productName"
                                   placeholder="Nhập tên chuyên mục...">
                        </div>
                        <div class="form-group">
                            <label for="seo-url" class="">Đường dẫn</label>
                            <input type="text" name="seo_url" id="seo-url" class="form-control"
                                   value=""
                                   placeholder="Nhập đường dẫn..." required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="button" class="btn btn-default float-right">
                            <a style="color: #000000" href="{{route('admin.tag.list')}}">Hủy</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-12">
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
                                <p class="preview_snippet_link">{{config('app.url').'/tin-tuc/'}}</p>
                                <p class="preview_snippet_des"></p>
                                <input type="hidden" id="url_seo"
                                       value="{{config('app.url').'/tin-tuc/'}}">
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
@endsection



