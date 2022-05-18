@extends('admin.index')

@section('pageTitle', 'Cập nhật tag')

@section('admin.css')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('breadcrumbContent')
<li class="breadcrumb-item"><a href="#">Tag</a></li>
<li class="breadcrumb-item active">Cập nhật</li>
@endsection

@section('content')
<div class="card col-6">
    <form enctype="multipart/form-data" method="POST" action="{{route('admin.project.tag.add.post')}}">
        @csrf
        <input type="hidden" name="id" value="{{$tag->id}}">
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="form-group">
                        <label for="productName">Tên tag</label>
                        <input type="text" name="name" class="form-control" id="productName" value="{{ $tag->name }}" placeholder="Nhập tên tag...">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Cập nhật</button>
                    <button type="button" class="btn btn-default float-right">
                        <a style="color: #000000" href="{{route('admin.tag.list')}}">Hủy</a>
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
