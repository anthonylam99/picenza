@php
    $provinces = \App\Models\Provinces::get();

@endphp
<option value="">Chọn Tỉnh Thành phố</option>
@foreach ($provinces as $item)
<option value="{{ $item->id }}" @if(!empty($provinceId) && $item->id == $provinceId) selected @endif>{{ $item->name }}</option>
@endforeach
