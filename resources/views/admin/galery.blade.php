@extends('admin.index')

@section('pageTitle', 'Danh mục hình ảnh')

@section('breadcrumbContent')

@endsection

@section('content')
    <div class="card col-12">

        <div id="ckfinder-widget">

        </div>
    </div>
@endsection
@section('admin.js')
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>

    @include('ckfinder::setup')
    <script>
        CKFinder.widget( 'ckfinder-widget', {
            width: '100%',
            height: 700
        } );
    </script>
@endsection
