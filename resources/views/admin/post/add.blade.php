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
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" value="" placeholder="Nhập tiêu đề bài viết...">
                        </div>
                        <div class="form-group">
                            <label for="title">Tag</label>
                            <select name="tag[]" class="form-control js-example-tags" multiple="multiple">
                                <option selected="selected">orange</option>
                                <option>white</option>
                                <option selected="selected">purple</option>
                            </select>
                        </div>
                    </div>
                    <div class="card card-info">
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
                            <textarea name="content" id="text" cols="30" rows="10"></textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Thêm mới</button>
                        </div>
                        <!-- /.card-body -->
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
