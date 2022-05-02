@extends('admin.index')

@section('pageTitle', '')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Quản lý trang</a></li>
    <li class="breadcrumb-item active">Sửa</li>
@endsection


@section('content')

    <div class="card col-12">

        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.page.add.post')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Tên Trang</label>
                            <input type="text" name="name" id="title" class="form-control" value="{{$page->name}}"
                                   placeholder="Nhập tên trang...">
                            <input type="hidden" name="page_id" value="{{$page->id}}">
                        </div>
                    </div>
                    @if($page->name == 'Trang chủ')

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Ảnh banner
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image-and-color">Ảnh banner</label>
                                    <div class="body-card-imagebanner row" id="card-imagebanner">
                                        <?php $i = 0; ?>
                                        @foreach($arrImg as $key => $tag)
                                            @if($key === 'banner')
                                                @foreach($tag as $value)
                                                    <?php $i++; ?>
                                                    <div class="col-3 img-boxbanner" id="label-imagebanner{{$i}}"
                                                         data-photo="{{$i}}">
                                                        <div
                                                            style="height: 100px; border: 2px dashed #cccccc; margin-bottom: 10px;"
                                                            id="image-previewbanner{{$i}}" class="show-img">
                                                            <img src="{{asset($value->image_path)}}">
                                                        </div>
                                                        <label for="image-inputbanner{{$i}}" class="image-upload"><i
                                                                class="fas fa-upload"></i>Chọn ảnh</label><input
                                                            style="display: none"
                                                            onclick="selectImageGaleryCustom({{$i}},  'banner' )"
                                                            id="image-inputbanner{{$i}}" type="text" value="{{$value->image_path}}"
                                                            name="imagebanner{{$i}}"
                                                            data-photo="1">
                                                        <button type="button" class="btn-danger btn-deleteimg"
                                                                onclick="removeImageCustom({{$i}},  'banner', {{$value->id}} )">
                                                            Xóa ảnh
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    <button onclick="addImageBox('banner')" type="button" class="btn-add-custom"
                                            id="btn-add-banner"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-info col-4">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Mô tả
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="body-card-imagedes" id="card-imagedes">
                                        @foreach($post as $value)
                                            <div class="custom-control custom-checkbox">
                                                <input name="postDes[]" class="custom-control-input" type="checkbox"
                                                       id="customCheckbox{{$value->id}}" value="{{$value->id}}">
                                                <label for="customCheckbox{{$value->id}}" class="custom-control-label">{{$value->title}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        @foreach($arrImg as $key => $tag)
                            @if($key === 'discovery')
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Khung khám phá các khả năng
                                        </h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="image-and-color">Ảnh mô tả</label>
                                            <div class="body-card-imagediscovery row" id="card-imagediscovery">
                                                <?php $i = 0; ?>
                                                @foreach($tag as $value)

                                                    <?php $i++; ?>
                                                    <div class="col-3 img-boxdiscovery" id="label-imagediscovery{{$i}}"
                                                         data-photo="1">
                                                        <div
                                                            style="height: 100px; border: 2px dashed #cccccc; margin-bottom: 10px;"
                                                            id="image-previewdiscovery{{$i}}" class="show-img">
                                                            <img src="{{asset($value->image_path)}}">
                                                        </div>
                                                        <label for="image-inputdiscovery{{$i}}" class="image-upload"><i
                                                                class="fas fa-upload"></i>Chọn ảnh</label>
                                                        <input
                                                            style="margin-bottom: 3px" class="form-control" type="text"
                                                            name="titlediscovery{{$i}}" value="{{$value->title}}"
                                                            placeholder="Nhập tiêu đề..">
                                                        <input
                                                            style="margin-bottom: 3px" class="form-control" type="text"
                                                            name="urldiscovery{{$i}}" value="{{$value->url}}"
                                                            placeholder="Nhập đường dẫn bài viết..">
                                                        <input
                                                            style="margin-bottom: 3px" class="form-control" type="text"
                                                            name="contentdiscovery{{$i}}" value="{{$value->content}}"
                                                            placeholder="Nhập nội dung mô tả..">
                                                        <input style="display: none"

                                                               onchange="previewImageCustom({{$i}},  'discovery' )"
                                                               id="image-inputdiscovery{{$i}}"
                                                               type="file"
                                                               name="imagediscovery{{$i}}"
                                                               data-photo="{{$i}}">
                                                        <button type="button" class="btn-danger btn-deleteimg"
                                                                onclick="removeImageCustom({{$i}},  'discovery', {{$value->id}} )">
                                                            Xóa ảnh
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button onclick="addImageBox('discovery')" type="button"
                                                    class="btn-add-custom"
                                                    id="btn-add-discovery"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            @endif
                        @endforeach
                        @foreach($arrImg as $key => $tag)
                            @if($key === 'brand')
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Ảnh mô tả
                                        </h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="image-and-color">Ảnh mô tả</label>
                                            <div class="body-card-imagebrand row" id="card-imagebrand">

                                                <?php $i = 0; ?>
                                                @foreach($tag as $value)
                                                    <?php $i++; ?>
                                                    <div class="col-3 img-boxbrand" id="label-imagebrand{{$i}}"
                                                         data-photo="{{$i}}">
                                                        <div
                                                            style="height: 100px; border: 2px dashed #cccccc; margin-bottom: 10px;"
                                                            id="image-previewbrand{{$i}}" class="show-img">
                                                            <img src="{{asset($value->image_path)}}">
                                                        </div>
                                                        <label for="image-inputbrand{{$i}}" class="image-upload"><i
                                                                class="fas fa-upload"></i>Chọn ảnh</label><input
                                                            style="display: none"
                                                            onchange="previewImageCustom({{$i}},  'banner' )"
                                                            id="image-inputbrand{{$i}}" type="file"
                                                            name="imagebrand{{$i}}"
                                                            data-photo="1">
                                                        <button type="button" class="btn-danger btn-deleteimg"
                                                                onclick="removeImageCustom({{$i}},  'brand', {{$value->id}} )">
                                                            Xóa ảnh
                                                        </button>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <button onclick="addImageBox('des')" type="button" class="btn-add-custom"
                                                    id="btn-add-des"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            @endif
                        @endforeach

                    @endif
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                NỘI DUNG TRANG
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <textarea name="content" id="text" cols="30" rows="10">{{$page->content}}</textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Sửa</button>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin.js')

@endsection
