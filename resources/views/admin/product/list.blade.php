@extends('admin.index')

@section('pageTitle', 'Trang sản phẩm')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
    <li class="breadcrumb-item active">Danh sách sản phẩm</li>
@endsection

@section('content')
    <div class="col-3">
        <button style="margin-bottom: 10px" type="button" class="btn btn-success">
            <a style="color: #FFFFFF;" href="{{route('admin.product.add')}}">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Thêm mới
            </a>
        </button>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 20px; font-weight: 500">DANH SÁCH SẢN PHẨM</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.product.list')}}">
                        <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm sản phẩm....">
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-bordered table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Ảnh đại diện</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Danh mục</th>
                        <th>Đánh giá sao</th>
                        <th>Hiển thị trang chủ</th>
                        <th>Trạng thái</th>
                        <th>Hãng sản xuất</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>
                                <img src="{{ $value->avatar_path }}" alt="" width="50px">
                            </td>
                            <td>{{$value->name}}</td>
                            <td>{{number_format($value->price)}}</td>
                            <td>{{isset($value->productLine['name']) ? $value->productLine['name'] : ''}}</td>
                            <td>
                                <div class="rating-star">
                                    @for ($i = 1; $i < 6; $i++)
                                        <i class="fa fa-star" style="color: {{ $value->rating < $i ? '#DBDBDB' : '#ED2027' }}; "></i>
                                    @endfor
                                </div>
                            </td>
                            <th>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="show-home{{$value->id}}" {{ $value->show_home == 1 ? 'checked' : '' }} name="show-home" onclick="changeShowHome({{$value->id}})">
                                    <label name="show-home{{$value->id}}" class="custom-control-label show-home{{$value->id}}" for="show-home{{$value->id}}">{{ $value->show_home ? 'Bật' : 'Tắt' }}</label>
                                </div>
                            </th>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status{{$value->id}}" {{ $value->status == 1 ? 'checked' : '' }} name="status" onclick="changeStatusProd({{$value->id}})">
                                    <label name="status{{$value->id}}" class="custom-control-label status{{$value->id}}" for="status{{$value->id}}">{{ $value->status ? 'Bật' : 'Tắt' }}</label>
                                </div>
                            </td>
                            <td>{{isset($value->companyName['name']) ? $value->companyName['name'] : ''}}
                            <td>
                                <button class="btn btn-info">
                                    <a style="color: #FFFFFF" href="{{ route('admin.product.edit', ['id' => $value->id]) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </button>
                                <button class="btn btn-danger">
                                    <a style="color: #FFFFFF" href="{{ route('admin.product.del', ['id' => $value->id]) }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @include('admin.partials.pagination', ['itemPaginate' => $product])
            <!-- /.card-body -->
        </div>
    </div>
@endsection
