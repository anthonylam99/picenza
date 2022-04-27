@extends('admin.index')

@section('pageTitle', '')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Bài viết</a></li>
    <li class="breadcrumb-item active">Danh sách</li>
@endsection

@section('content')
    <div class="col-3">
        <button style="margin-bottom: 10px" type="button" class="btn btn-success">
            <a style="color: #FFFFFF;" href="{{route('admin.post.add')}}">
                Thêm mới
            </a>
        </button>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 26px; font-weight: 700">DANH SÁCH</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.price.add')}}">
                        <input class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm ....">
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>TÊN</th>
                        <th>NGÀY TẠO</th>
                        <th>NGÀY SỬA</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($post as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td><a href="{{ route('admin.post.edit', ['id' => $value->id]) }}">
                                    {{$value->title}}
                                </a></td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->updated_at}}</td>
                            <td>
                                <button class="btn btn-info">
                                    <a target="_blank" style="color: #FFFFFF"
                                       href="{{ route('page.show.post', ['slug' => $value->slug]) }}">
                                        Xem Trang
                                    </a>
                                </button>
                                <button class="btn btn-danger">
                                    <a style="color: #FFFFFF"
                                       href="{{ route('admin.post.del', ['id' => $value->id]) }}">
                                        Xoá
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
