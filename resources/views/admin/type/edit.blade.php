@extends('admin.index')

@section('pageTitle', 'Cập nhật loại sản phẩm')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Loại sản phẩm</a></li>
    <li class="breadcrumb-item active">Cập nhật</li>
@endsection

@section('content')
    <div class="card col-6">
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.type.add.post')}}">
            @csrf
            <input type="hidden" name="id" value="{{ $type->id }}">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Hãng sản xuất</label>
                            <select class="form-control" id="companyList" name="company_id" required>
                                <option>-- Vui lòng chọn ---</option>
                                @foreach($company as $value)
                                    <option value="{{$value->id}}" {{($type->company_id === $value->id) ? 'selected' : ''}}>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productName">Danh mục</label>
                            <select class="form-control" id="productLineList" name="product_line_id" required>
                                <option>-- Vui lòng chọn ---</option>
                                @foreach($productLine as $value)
                                    <option value="{{$value->id}}" {{($type->product_line_id === $value->id) ? 'selected' : ''}}>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại sản phẩm</label>
                            <input type="text" name="productTypeName" class="form-control" id="lineName" value="{{$type->name}}" placeholder="Nhập loại sản phẩm..." required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                        <button type="button" class="btn btn-default float-right">
                            <a style="color: #000000" href="{{route('admin.type.list')}}">Hủy</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('admin.js')
    <script src="{{asset('js/admin.js')}}"></script>
@endsection
