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
                    @foreach($productPrice as $value)
                        <input id="price{{$value->id}}" type="checkbox" name="price[]"
                               value="{{$value->id}}"
                               onChange="this.form.submit()" {{ is_array(request()->input('price')) && in_array($value->id, request()->input('price')) ? 'checked' : ''}}>
                        <label for="price{{$value->id}}">
                            {{$value->name}}&nbsp;</label><br>
                    @endforeach
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
                    @foreach($company as $value)
                        <input id="company{{$value->id}}" type="checkbox" name="company[]"
                               value="{{$value->id}}"
                               onChange="this.form.submit()" {{ is_array(request()->input('company')) && in_array($value->id, request()->input('company')) ? 'checked' : ''}}>
                        <label for="company{{$value->id}}">
                            {{$value->name}}&nbsp;</label><br>
                    @endforeach
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
                            aria-controls="customFeature{{$featureItem->id}}">
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
                            <label for="feature{{$value->id}}">
                                {{$value->name}}&nbsp;</label><br>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>