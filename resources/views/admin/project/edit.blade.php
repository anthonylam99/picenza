@extends('admin.index')

@section('pageTitle', '')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Bài viết</a></li>
    <li class="breadcrumb-item active">Cập nhật</li>
@endsection


@section('content')

    <div class="card col-12">

        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.project.add.post')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-sm-2 col-xs-12">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control col-sm-9"
                                   value="{{$post->title}}"
                                   placeholder="Nhập tiêu đề bài viết..." required>
                        </div>
                        <div class="form-group row">
                            <label for="seo-url" class="col-md-2 col-sm-2 col-xs-12">Đường dẫn</label>
                            <input type="text" name="seo-url" id="seo-url" class="form-control col-sm-9"
                                   value="{{$post->seo_url}}"
                                   placeholder="Nhập tiêu đề bài viết..." required>
                        </div>
                        <div class="form-group select2-purple row">
                            <label for="title" class="col-md-2 col-sm-2 col-xs-12">Chuyên mục</label>
                            <select name="category[]" class="select2 form-control col-sm-9" multiple="multiple"
                                    required>
                                @foreach($listCategory as $value)
                                    @if(!empty($listCategory) && !empty($post->category))
                                        <option {{(in_array($value->name, $post->category) ? 'selected' : '')}}>{{$value->name}}</option>
                                    @else
                                        <option >{{$value->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group select2-purple row">
                            <label for="title" class="col-md-2 col-sm-2 col-xs-12">Tag</label>
                            <select name="tag[]" class="form-control select2 col-sm-9" multiple="multiple"
                            >
                                @foreach($listTag as $value)
                                    <option {{(in_array($value->name, $tag) ? 'selected' : '')}}>{{$value->name}}</option>
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
                                    <img id="img-avatar" src="{{$post->avatar}}" alt="">
                                </div>
                                <input type="hidden" id="img_avatar_path" name="img_avatar_path"
                                       value="{{$post->avatar}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group row" id="productFeature" style="margin-left: 0">
                                <div class="custom-control custom-checkbox col-4">
                                    <input name="tagged" class="custom-control-input" type="checkbox" id="tagged"
                                        {{$post->tagged === 1 ? 'checked' : ''}}>
                                    <label for="tagged" class="custom-control-label">DỰ ÁN TIÊU BIỂU</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info col-12">
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
                            <textarea name="content" id="text" cols="50" rows="50"
                                      required>{{$post->content}}</textarea>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group row" id="productFeature" style="margin-left: 0">
                                <div class="custom-control custom-checkbox col-4">
                                    <input name="status" class="custom-control-input" type="checkbox" id="status"
                                        {{$post->status === 1 ? 'checked' : ''}}>
                                    <label for="status" class="custom-control-label">KÍCH HOẠT</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                    </div>

                    <div class="card">
                        <div class="card card-info col-12">
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
                                            <h3 class="preview_snippet_title">{{$post->seo_title}}</h3>
                                            <p class="preview_snippet_link">{{config('app.url').'/du-an/'.$post->seo_url}}</p>
                                            <p class="preview_snippet_des">{{$post->seo_description}}</p>
                                            <input type="hidden" id="url_seo"
                                                   value="{{str_replace($post->seo_url, '', $post->url)}}">
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label for="news_title"
                                                   class="control-label col-md-2 col-sm-2 col-xs-12"><span
                                                    class="form-asterick"></span>Tiêu đề cho thẻ meta title
                                                (SEO)</label>
                                            <div class="controls col-sm-9">
                                                <input type="text" placeholder="Tiêu đề tốt nhất 60 - 70 ký tự"
                                                       class="form-control col-sm-9 in_title" id="news_title"
                                                       value="{{$post->seo_title}}"
                                                       name="seo_title">
                                                <span class="in_title_count">0</span> ký tự. Tiêu đề (title) tốt nhất
                                                khoảng
                                                60 - 70 ký tự
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="news_description"
                                                   class="control-label col-md-2 col-sm-2 col-xs-12"><span
                                                    class="form-asterick"></span>Đoạn mô tả cho thẻ meta description
                                                (SEO)</label>
                                            <div class="controls col-sm-9">
                                            <textarea placeholder="Mô tả khoảng 160 ký tự"
                                                      class="span6 form-control in_des" id="news_description"
                                                      name="seo_description"
                                                      style="width:100%;height:60px">{{$post->seo_description}}</textarea>
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
                                                       id="news_keyword" value="{{$post->seo_keyword}}"
                                                       name="seo_keyword">
                                                <span>Không nên lạm dụng thẻ Meta Keyword để tránh việc bị phản tác dụng.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="news_robots"
                                                   class="control-label col-md-2 col-sm-2 col-xs-12"><span
                                                    class="form-asterick"></span>Điều hướng Robots</label>
                                            <div class="controls col-sm-3">
                                                <select id="news_robots" name="seo_robots" class="form-control">
                                                    <option
                                                        value="index,follow" {{$post->seo_robots === 'index,follow' ? 'selected' : ''}}>
                                                        Index,Follow
                                                    </option>
                                                    <option
                                                        value="noindex,nofollow" {{$post->seo_robots === 'noindex,nofollow' ? 'selected' : ''}}>
                                                        Noindex,Nofollow
                                                    </option>
                                                    <option
                                                        value="index,nofollow" {{$post->seo_robots === 'index,nofollow' ? 'selected' : ''}}>
                                                        Index,Nofollow
                                                    </option>
                                                    <option
                                                        value="noindex,follow" {{$post->seo_robots === 'noindex,follow' ? 'selected' : ''}}>
                                                        Noindex,Follow
                                                    </option>
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

