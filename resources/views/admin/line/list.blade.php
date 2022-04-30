@extends('admin.index')

@section('pageTitle', '')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
    <li class="breadcrumb-item active">Danh sách danh mục</li>
@endsection

@section('content')
    <div class="col-3">

    </div>
    <div class="col-12">
        <div class="card" style="padding: 0 10px;">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 20px; font-weight: 700">Danh sách danh mục</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.line.add')}}">
{{--                        <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm sản phẩm....">--}}
                    </form>
                </div>
            </div>
            <div class="card-header p-0 align-middle">
                <h2 class="card-title" style="font-size: 19px; font-weight: 700"></h2>

                <div class="form-search float-right" style="padding-top: 10px">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.line.add')}}">
                        {{--                        <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm sản phẩm....">--}}
                        <button style="margin-bottom: 10px" type="button" class="btn btn-success btn-sm">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <a style="color: #FFFFFF;" href="{{route('admin.line.add')}}">
                                Thêm mới
                            </a>
                        </button>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-bordered table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên hãng sản xuất</th>
                        <th>Danh mục sản phẩm</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($line as $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->company->name}}</td>
                                <td>{{$value->name}}</td>
                                <td>
                                    <button class="btn btn-info">
                                        <a style="color: #FFFFFF" href="{{ route('admin.line.edit', ['id' => $value->id]) }}">
                                            <i class="far fa-edit"></i>

                                        </a>
                                    </button>
                                    <button class="btn btn-danger">
                                        <a style="color: #FFFFFF" href="{{ route('admin.line.del', ['id' => $value->id]) }}">
                                            <i class="fas fa-trash"></i>

                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
