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
                                   placeholder="Nhập tên trang..." {{$page->name === 'Trang chủ' ? 'disabled' : ''}}>
                            <input type="hidden" name="name" value="{{$page->name}}">
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
                                                            id="image-inputbanner{{$i}}" type="text"
                                                            value="{{$value->image_path}}"
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

                        <div class="row">
                            <div class="col-4">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Khung thứ 3
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
                                                @foreach($aryCategory as $value)
                                                    <div class="custom-control custom-checkbox">
                                                        <input name="postDes[]" class="custom-control-input"
                                                               type="checkbox"
                                                               id="customCheckbox{{$value->id}}" value="{{$value->id}}" {{ in_array($value->id, $arrPostPage['section3']) ? 'checked' : ''}}>
                                                        <label for="customCheckbox{{$value->id}}"
                                                               class="custom-control-label">{{$value->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="col-4">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Khung thứ 4
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
                                                @foreach($aryCategory as $value)
                                                    <div class="custom-control custom-checkbox">
                                                        <input name="section4[]" class="custom-control-input"
                                                               type="checkbox"
                                                               id="section4{{$value->id}}"  value="{{$value->id}}" {{ in_array($value->id, $arrPostPage['section4']) ? 'checked' : ''}}>
                                                        <label for="section4{{$value->id}}"
                                                               class="custom-control-label">{{$value->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Ảnh thương hiệu
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
                                    <label for="image-and-color">Ảnh thương hiệu</label>
                                    <div class="body-card-imagebrand row" id="card-imagebrand">
                                        <?php $i = 0; ?>
                                        @foreach($arrImg as $key => $tag)
                                            @if($key === 'brand')
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
                                                            onclick="selectImageGaleryCustom({{$i}},  'brand' )"
                                                            id="image-inputbrand{{$i}}" type="text"
                                                            value="{{$value->image_path}}"
                                                            name="imagebrand{{$i}}"
                                                            data-photo="1">
                                                        <button type="button" class="btn-danger btn-deleteimg"
                                                                onclick="removeImageCustom({{$i}},  'brand', {{$value->id}} )">
                                                            Xóa ảnh
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    <button onclick="addImageBox('brand')" type="button" class="btn-add-custom"
                                            id="btn-add-brand"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endif
                    @if($page->name !== 'Trang chủ')
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

                            <!-- /.card-body -->
                        </div>
                    @endif
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Sửa</button>
                        <button type="button" class="btn btn-info">
                            <a target="_blank" style="color: #fff; text-transform: uppercase" href="/trang/{{$page->seo_url}}">
                                Xem trang
                            </a>
                        </button>
                        <button type="button" class="btn btn-default">
                            <a target="_self" style="color: #000; text-transform: uppercase" href="/quan-tri/quan-ly-trang/danh-sach">
                                Quay lại
                            </a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

