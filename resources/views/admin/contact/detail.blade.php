@extends('admin.index')

@section('pageTitle', 'Chi tiết liên hệ')

@section('breadcrumbContent')
<li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
<li class="breadcrumb-item active">Danh sách sản phẩm</li>
@endsection

@section('content')
<div class="col-12">
    <div class="col-sm-12 row">
        <div class="col-sm-12 card p-4 pr-3">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Thông tin khách hàng
                    </h2>
                </div>
                <hr>
                <div class="panel-container show">
                    <div class="panel-content">
                        <p><strong>Họ tên: </strong>{{ $contact->name }}</p>
                        <hr>
                        <p><strong>Email: </strong>{{ $contact->email }}</p>
                        <hr>
                        <p><strong>Phone: </strong>{{ $contact->phone }}</p>
                        <hr>
                        <p><strong>Ngành nghề: </strong>{{ $contact->career }}</p>
                        <hr>
                        <p><strong>Nội dung:</strong>{{ $contact->feedback }}</p>
                        <p></p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection