@extends('admin.index')

@section('pageTitle', '')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Tag</a></li>
    <li class="breadcrumb-item active">Danh sách chuyên mục</li>
@endsection

@section('content')
    <div class="col-3">
        <button style="margin-bottom: 10px" type="button" class="btn btn-success">
            <a style="color: #FFFFFF;" href="{{route('admin.post.category.add')}}">
                Thêm mới
            </a>
        </button>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 19px; font-weight: 700">DANH SÁCH CHUYÊN MỤC</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.post.category.list')}}">
                       <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm sản phẩm....">
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-bordered table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>TÊN</th>
                        <th>Thông tin</th>
                        <th class="text-center">Xem</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                        <th>TRẠNG THÁI</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tag as $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <td>
                                    <strong>Thêm lúc:</strong>{{$value->created_at}} <br>
                                    <strong>Cập nhật:</strong>{{$value->updated_at}}
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-info">
                                        <a target="_blank" style="color: #FFFFFF" href="{{ route('home.news.index.slug', ['slug' => $value->slug]) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </button>
                                </td>
                                <td class=" text-center">
                                    <button class="btn btn-info">
                                        <a style="color: #FFFFFF" href="{{ route('admin.post.category.edit', ['id' => $value->id]) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-danger">
                                        <a style="color: #FFFFFF" href="{{ route('admin.tag.del', ['id' => $value->id]) }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status{{$value->id}}" {{ $value->status == 1 ? 'checked' : '' }} name="status" onclick="changeStatusCategory({{$value->id}})">
                                        <label name="status{{$value->id}}" class="custom-control-label status{{$value->id}}" for="status{{$value->id}}">{{ $value->status ? 'Bật' : 'Tắt' }}</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('admin.partials.pagination', ['itemPaginate' => $tag])
        </div>
    </div>
@endsection
