@extends('admin.index')

@section('pageTitle', '')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Dự án</a></li>
    <li class="breadcrumb-item active">Danh sách</li>
@endsection

@section('content')
    <div class="col-3">
        <button style="margin-bottom: 10px" type="button" class="btn btn-success">
            <a style="color: #FFFFFF;" href="{{route('admin.project.add')}}">
                Thêm mới
            </a>
        </button>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 19px; font-weight: 700">DANH SÁCH</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.project.list')}}">
                       <input class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm ....">
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-bordered table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Chuyên mục</th>
                        <th>Tag</th>
                        <th>Trạng thái</th>
                        <th>Thông tin</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($post as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td><a href="{{ route('admin.project.edit', ['id' => $value->id]) }}">
                                    {{$value->title}}
                                </a></td>
                            <td>{{implode(',', $value->category)}}</td>
                            <td>{{$value->tag}}</td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status{{$value->id}}" {{ $value->status == 1 ? 'checked' : '' }} name="status" onclick="changeStatusPost({{$value->id}})">
                                    <label name="status{{$value->id}}" class="custom-control-label status{{$value->id}}" for="status{{$value->id}}">{{ $value->status ? 'Bật' : 'Tắt' }}</label>
                                </div>
                            </td>
                            <td>
                                <strong>Thêm lúc:</strong>{{$value->created_at}} <br>
                                <strong>Cập nhật:</strong>{{$value->updated_at}}
                            </td>
                            <td>
                                <button class="btn btn-info">
                                    <a target="_blank" style="color: #FFFFFF"
                                       href="{{ route('page.show.project', ['slug' => $value->slug]) }}">
                                        Xem Trang
                                    </a>
                                </button>
                                <button class="btn btn-danger">
                                    <a style="color: #FFFFFF"
                                       href="{{ route('admin.project.del', ['id' => $value->id]) }}">
                                        Xoá
                                    </a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('admin.partials.pagination', ['itemPaginate' => $post])

        </div>
    </div>
@endsection
