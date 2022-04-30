@extends('admin.index')

@section('pageTitle', 'Cập nhật')

@section('admin.css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Danh mục</a></li>
    <li class="breadcrumb-item active">Cập nhật</li>
@endsection

@section('content')
    <div class="card col-6">
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.line.add.post')}}">
            @csrf
            <input type="hidden" name="id" value="{{$line->id}}">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Hãng sản xuất</label>
                            <select class="form-control" name="company_id">
                                @foreach($company as $value)
                                    <option value="{{$value->id}}" {{($line->company_id === $value->id) ? 'selected' : ''}}>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <input type="text" name="lineName" class="form-control" id="lineName" value="{{$line->name}}" placeholder="Nhập dòng sản phẩm...">
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
            </div>
        </form>
    </div>
@endsection


@section('admin.js')
    <script src="{{asset('js/admin.js')}}"></script>
@endsection
