@extends('main')

@section('title', 'Liên hệ')
@section('font-awsomes' ,'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')

@section('content')
    <div class="contact">
        <div class="main-contact">
            <div class="banner-contact">
                <div class="image">
                    <img src="{{asset('/images/banner/banner_4.png')}}" alt="">
                    <div class="contact-form">
                        <div class="contact-form-content">
                            <div class="title">
                                <h5>CHÀO MỪNG BẠN ĐẾN VỚI PICENZA</h5>
                            </div>
                            <div class="subtitle">
                                <p>Rất hân hạnh được đón quý khách đến với công ty chúng tôi,
                                    nếu có thắc mắc gì hãy liên hệ chúng tôi. Rất vui lòng được phục vụ quý khách.</p>
                            </div>
                            <div class="form-make-contact">
                                <form id="contact-ctn-form" action="">
                                    <div class="name">
                                        <input class="w-100" type="text" name="name" id="" placeholder="Họ và tên"
                                               required>
                                    </div>
                                    <div class="phone-email d-flex">
                                        <div class="phone" style="padding-right: 10px;width: 100%">
                                            <input class="w-100" type="text" name="phone" id=""
                                                   placeholder="Số điện thoại"
                                                   required>
                                        </div>
                                        <div class="email" style="width: 100%">
                                            <input class="w-100" type="text" name="email" id=""
                                                   placeholder="Email của bạn"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="jobs">
                                        <input class="w-100" type="text" name="job" id=""
                                               placeholder="Ngành nghề/lĩnh vực">
                                    </div>
                                    <div class="note">
                                        <textarea class="w-100" name="note" id="" cols="5" rows="5"
                                                  placeholder="Điều bạn cần chúng tôi lưu ý"></textarea>
                                    </div>
                                    <div class="btn-smt">
                                        <button type="submit">
                                            ĐĂNG KÝ NGAY <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="map">
                <div class="map-content container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8254853857256!2d105.82126551476276!3d20.99963148601416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac88ae7cea91%3A0xe01b5f33acd8b1ac!2zMzQgUC4gQ8O5IENow61uaCBMYW4sIEtoxrDGoW5nIE1haSwgVGhhbmggWHXDom4sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1650385719058!5m2!1svi!2s"
                        width="100%" height="391" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
