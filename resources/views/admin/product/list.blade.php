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
                Thêm mới
            </a>
        </button>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 26px; font-weight: 700">DANH SÁCH SẢN PHẨM</h2>

                <div class="form-search float-right">
                    <form style="margin-bottom: 0" class="form-group" action="{{route('admin.product.list')}}">
                        <input  class="form-control" type="text" name="s" value="" placeholder="Tìm kiếm sản phẩm....">
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Loại sản phẩm</th>
                        <th>Hãng sản xuất</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{number_format($value->price)}}</td>
                            <td>{{$value->productType['name']}}</td>
                            <td>{{$value->companyName['name']}}
                            <td>
                                <button class="btn btn-info">
                                    <a style="color: #FFFFFF" href="{{ route('admin.product.edit', ['id' => $value->id]) }}">
                                        Chi tiết
                                    </a>
                                </button>
                                <button class="btn btn-danger">
                                    <a style="color: #FFFFFF" href="{{ route('admin.product.del', ['id' => $value->id]) }}">
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
                        @if ($product->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $product->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                            </li>
                        @endif

                        <?php
                        $start = $product->currentPage() - 2; // show 3 pagination links before current
                        $end = $product->currentPage() + 2; // show 3 pagination links after current
                        if($start < 1) {
                            $start = 1; // reset start to 1
                            $end += 1;
                        }
                        if($end >= $product->lastPage() ) $end = $product->lastPage(); // reset end to last page
                        ?>

                        @if($start > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $product->url(1) }}">{{1}}</a>
                            </li>
                            @if($product->currentPage() != 4)
                                {{-- "Three Dots" Separator --}}
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                            @endif
                        @endif
                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ ($product->currentPage() == $i) ? ' active' : '' }}">
                                <a class="page-link" href="{{ $product->url($i) }}">{{$i}}</a>
                            </li>
                        @endfor
                        @if($end < $product->lastPage())
                            @if($product->currentPage() + 3 != $product->lastPage())
                                {{-- "Three Dots" Separator --}}
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item">
                                <a class="page-link" href="{{ $product->url($product->lastPage()) }}">{{$product->lastPage()}}</a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($product->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $product->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
