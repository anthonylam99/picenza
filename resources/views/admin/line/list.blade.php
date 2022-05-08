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
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.line.list')}}">
                       <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm sản phẩm....">
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
                        <th>ID</th>
                        <th>Danh mục sản phẩm</th>
                        <th>Trạng thái</th>
                        <th>Thông tin</th>
                        <th class="text-center">Xem</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($line as $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <th>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status{{$value->id}}" {{ $value->status == 1 ? 'checked' : '' }} name="status" onclick="changeStatus({{$value->id}})">
                                        <label name="status{{$value->id}}" class="custom-control-label status{{$value->id}}" for="status{{$value->id}}">{{ $value->status ? 'Bật' : 'Tắt' }}</label>
                                    </div>
                                </th>
                                <td>
                                    <strong>Thêm lúc:</strong>{{$value->created_at}} <br>
                                    <strong>Cập nhật:</strong>{{$value->updated_at}}
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-info ">
                                        <a target="_blank" style="color: #FFFFFF" href="{{'/san-pham/'.$value->seo_url }}">
                                            <i class="far fa-eye"></i>

                                        </a>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-info ">
                                        <a style="color: #FFFFFF" href="{{ route('admin.line.edit', ['id' => $value->id]) }}">
                                            <i class="far fa-edit"></i>

                                        </a>
                                    </button>
                                </td>
                                <td class="text-center">
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

            @include('admin.partials.pagination', ['itemPaginate' => $line])
        </div>
    </div>
@endsection
