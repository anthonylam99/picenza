@extends('main')

@section('title', 'Trạm bảo hành')

@section('content')
    <div class="warranty">
        <div class="banner">
            <h3>DANH SÁCH TRẠM BẢO HÀNH PICENZA</h3>
            <a class="button red-bg" href="#find-store" >
                Định vị trạm bảo hành gần bạn
            </a>
        </div>
        <div class="form-store" id="find-store">
            <form action="{{route('home.warranty.station')}}" method="GET">
                <div>
                    <select class="city" name="city" id="city">
                        <option value="">Chọn tỉnh / Thành phố</option>
                        @foreach($city as $value)
                            <option
                                value="{{$value->id}}" {{request()->input('city') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select class="select-ditrict" name="district" id="district" {{(empty(collect($district)->toArray())) ? 'disabled' : ''}}>
                        <option value="">Quận / Huyện</option>

                        @if(!empty(collect($district)->toArray()))
                            @foreach($district as $value)
                                <option value="{{$value->id}}" {{request()->input('district') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
                <div>
                    <button class="button" type="submit">Tìm trạm bảo hành</button>
                </div>
            </form>
        </div>
        <h2 class="title-section" id="total-store">Có {{count($warranties)}} trạm bảo hành </h2>
        <div class="store-list container">
            <div class="row">
                @foreach($warranties as $warranty)
                    <div class="store-detail col-sm-6 col-12">
                        <a>
                            <img width="1200" height="800"
                                 src="{{asset($warranty->avatar)}}"
                                 class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                 loading="lazy"

                                 sizes="(max-width: 1200px) 100vw, 1200px">
                        </a>
                        <div class="store-content">
                            <div>
                                <h3 class="entry-title">{{$warranty->name}}</h3>
                                <p>SĐT: <strong>{{$warranty->phone}}</strong></p>
                                <p>
                                    {{json_decode($warranty->address)}}
                                    <a target="_blank"
                                       href="https://www.google.com/maps/place/{{json_decode($warranty->address)}}">Xem
                                        bản đồ </a>
                                </p>
                            </div>

                            <div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
