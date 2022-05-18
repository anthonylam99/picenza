@extends('admin.index')

@section('pageTitle', '')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Thuộc tính</a></li>
    <li class="breadcrumb-item active">Danh sách thuộc tính</li>
@endsection

@section('content')
    <div class="col-3">

    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 19px; font-weight: 700">Danh sách thuộc tính</h2>

                <div class="form-search float-right" style="display:flex">
                    <form style="margin-bottom: 0; margin-right: 10px" class="form-group" action="{{route('admin.product.feature.list')}}">
                        <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm thuộc tính....">
                    </form>
                    <button style="margin-bottom: 10px; margin-right: 10px" type="button" class="btn btn-success">
                        <a style="color: #FFFFFF;" href="{{route('admin.product.feature.add.post')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Thêm mới
                        </a>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-bordered table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Danh mục sản phẩm</th>
                        <th>Thuộc tính</th>
                        <th>Thông tin</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($feature as $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{(!empty($value->line->name) ? $value->line->name : '')}}</td>
                                <td>{{$value->name}}</td>
                                <td>
                                    <strong>Thêm lúc:</strong>{{$value->created_at}} <br>
                                    <strong>Cập nhật:</strong>{{$value->updated_at}}
                                </td>
                                <td>
                                    <button class="btn btn-info">
                                        <a style="color: #FFFFFF" href="{{ route('admin.product.feature.edit', ['id' => $value->id]) }}">
                                            Chi tiết
                                        </a>
                                    </button>
                                    <button class="btn btn-danger">
                                        <a style="color: #FFFFFF" href="{{ route('admin.product.feature.del', ['id' => $value->id]) }}">
                                            Xoá
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('admin.partials.pagination', ['itemPaginate' => $feature])

        </div>
    </div>
@endsection
