@extends('admin.index')

@section('pageTitle', '')

@section('breadcrumbContent')
    <li class="breadcrumb-item"><a href="#">Quản lý trang</a></li>
    <li class="breadcrumb-item active">Danh sách</li>
@endsection

@section('content')
    <div class="col-3">
        <button style="margin-bottom: 10px" type="button" class="btn btn-success">
            <a style="color: #FFFFFF;" href="{{route('admin.page.add')}}">
                Thêm mới
            </a>
        </button>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 19px; font-weight: 700">DANH SÁCH</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.page.list')}}">
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
                        <th>TÊN</th>
                        <th>NGÀY TẠO</th>
                        <th>NGÀY SỬA</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($page as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td><a href="{{ route('admin.page.edit', ['id' => $value->id]) }}">
                                    {{$value->name}}
                                </a></td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->updated_at}}</td>
                            <td>
                                <button class="btn btn-info">
                                    <a target="_blank" style="color: #FFFFFF"
                                       href="{{ $value->name === 'Trang chủ' ? '/' : route('page.show.custom', ['slug' => $value->slug]) }}">
                                        Xem Trang
                                    </a>
                                </button>
                                @if($value->name !== 'Trang chủ')
                                    <button class="btn btn-danger">
                                        <a style="color: #FFFFFF"
                                           href="{{ route('admin.page.del', ['id' => $value->id]) }}">
                                            Xoá
                                        </a>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @include('admin.partials.pagination', ['itemPaginate' => $page])
        </div>
    </div>
@endsection
