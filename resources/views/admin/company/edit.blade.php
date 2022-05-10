@extends('admin.index')

@section('pageTitle', 'Cập nhật hãng sản xuất')

@section('admin.css')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
<li class="breadcrumb-item"><a href="#">Hãng sản xuất</a></li>
<li class="breadcrumb-item active">Cập nhật</li>
@endsection

@section('content')
<div class="card col-6">
    <form enctype="multipart/form-data" method="POST" action="{{route('admin.company.add.post')}}">
        @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="form-group">
                        <label for="productName">Tên hãng sản xuất</label>
                        <input type="text" name="company" class="form-control" id="productName" value="{{ $data['name'] }}" placeholder="Nhập tên hãng sản xuất..." required>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Cập nhật</button>
                    <button type="button" class="btn btn-default float-right">
                        <a style="color: #000000" href="{{route('admin.company.list')}}">Hủy</a>
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
