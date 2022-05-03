@extends('admin.index')

@section('pageTitle', 'Thêm mới hãng sản xuất')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Hãng sản xuất</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')

    <form enctype="multipart/form-data" method="POST" action="{{route('admin.line.add.post')}}">
        <div class="col-12">
            <div class="row">
                <div class="card col-6">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="productName">Hãng sản xuất</label>
                                    <select class="form-control" name="company_id">
                                        @foreach($company as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <input type="text" name="lineName" class="form-control" id="lineName"
                                           placeholder="Nhập dòng sản phẩm...">
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
                    </div>

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
                                    @foreach($post as $value)
                                        <div class="custom-control custom-checkbox">
                                            <input name="section4[]" class="custom-control-input"
                                                   type="checkbox"
                                                   id="section4{{$value->id}}"
                                                   value="{{$value->id}}" >
                                            <label for="section4{{$value->id}}"
                                                   class="custom-control-label">{{$value->title}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
@endsection



