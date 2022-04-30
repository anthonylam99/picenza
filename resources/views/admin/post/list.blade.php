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
                <h2 class="card-title" style="font-size: 19px; font-weight: 700">DANH SÁCH</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.post.list')}}">
{{--                        <input class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm ....">--}}
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
                        <th>Thông tin</th>
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
                            <td>{{$value->category}}</td>
                            <td>{{$value->tag}}</td>
                            <td>
                                <strong>Thêm lúc:</strong>{{$value->created_at}} <br>
                                <strong>Cập nhật:</strong>{{$value->updated_at}}
                            </td>
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
            <div class="card-footer">
                <div class="card-tools align-middle">
                    <ul class="pagination pagination-sm float-right" style="margin-bottom: 0">
                        @if ($post->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $post->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                            </li>
                        @endif

                        <?php
                        $start = $post->currentPage() - 2; // show 3 pagination links before current
                        $end = $post->currentPage() + 2; // show 3 pagination links after current
                        if($start < 1) {
                            $start = 1; // reset start to 1
                            $end += 1;
                        }
                        if($end >= $post->lastPage() ) $end = $post->lastPage(); // reset end to last page
                        ?>

                        @if($start > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $post->url(1) }}">{{1}}</a>
                            </li>
                            @if($post->currentPage() != 4)
                                {{-- "Three Dots" Separator --}}
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                            @endif
                        @endif
                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ ($post->currentPage() == $i) ? ' active' : '' }}">
                                <a class="page-link" href="{{ $post->url($i) }}">{{$i}}</a>
                            </li>
                        @endfor
                        @if($end < $post->lastPage())
                            @if($post->currentPage() + 3 != $post->lastPage())
                                {{-- "Three Dots" Separator --}}
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item">
                                <a class="page-link" href="{{ $post->url($post->lastPage()) }}">{{$post->lastPage()}}</a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($post->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $post->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
