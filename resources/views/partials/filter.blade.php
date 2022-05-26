<div class="content-main-filter">
    <input type="hidden" name="category_id" value="1">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#price"
                        aria-expanded="false" aria-controls="price">
                    PHẠM VI GIÁ
                </button>
            </h2>
            <div id="price" class="accordion-collapse collapse"
                 aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    @if(!empty($productPrice))
                        @foreach($productPrice as $value)
                            <input id="price{{$value->id}}" type="checkbox" name="price[]"
                                   value="{{$value->id}}"
                                   onChange="this.form.submit()" {{ is_array(request()->input('price')) && in_array($value->id, request()->input('price')) ? 'checked' : ''}}>
                            <label style="cursor: pointer" for="price{{$value->id}}">
                                {{$value->name}}&nbsp;</label><br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#company"
                        aria-expanded="false" aria-controls="company">
                    HÃNG SẢN XUẤT
                </button>
            </h2>
            <div id="company" class="accordion-collapse collapse"
                 aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    @if(!empty($company))
                        @foreach($company as $value)
                            <input id="company{{$value->id}}" type="checkbox" name="company[]"
                                   value="{{$value->id}}"
                                   onChange="this.form.submit()" {{ is_array(request()->input('company')) && in_array($value->id, request()->input('company')) ? 'checked' : ''}}>
                            <label style="cursor: pointer" for="company{{$value->id}}">
                                {{$value->name}}&nbsp;</label><br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#color"
                        aria-expanded="false" aria-controls="color">
                    MÀU SẮC
                </button>
            </h2>
            <div id="color" class="accordion-collapse collapse"
                 aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    @if(!empty($color))
                        @foreach($color as $key => $value)
                            <input id="color{{$key}}" type="checkbox" name="color[]"
                                   value="{{$key}}"
                                   onChange="this.form.submit()" {{ is_array(request()->input('color')) && in_array($key, request()->input('color')) ? 'checked' : ''}}>
                            <label style="cursor: pointer" for="color{{$key}}">
                                {{$value}}&nbsp;</label><br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        @foreach($featureData as $featureItem)
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#customFeature{{$featureItem->id}}"
                            aria-expanded="false"
                            aria-controls="customFeature{{$featureItem->id}}"
                            style="text-transform: uppercase"
                    >
                        {{$featureItem->name}}
                    </button>
                </h2>
                <div id="customFeature{{$featureItem->id}}"
                     class="accordion-collapse collapse"
                     aria-labelledby="flush-headingOne"
                     data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @foreach($featureItem->sub as $value)
                            <input id="feature{{$value->id}}" type="checkbox"
                                   name="feature[]" value="{{$value->id}}"
                                   onChange="this.form.submit()" {{ is_array(request()->input('feature')) && in_array($value->id, request()->input('feature')) ? 'checked' : ''}}>
                            <label style="cursor: pointer" for="feature{{$value->id}}">
                                {{$value->name}}&nbsp;</label><br>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
