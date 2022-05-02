

<option value="">Chọn quận huyện</option>
@if(!empty($provinceId))
    @php
        $districts = \App\Models\Districts::where('province_id','=',$provinceId)->get();
    @endphp
    @foreach ($districts as $item)
    <option value="{{ $item->id }}" @if(!empty($districtId) && $item->id == $districtId) selected @endif>{{ $item->name }}</option>
    @endforeach
@endif 
