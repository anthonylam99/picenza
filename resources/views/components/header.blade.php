<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('css/boostrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="@yield('font-awsomes')">
    <script src="{{ asset('js/boostrap.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="header">
        <div class="header-1">
            <div class="header-1__content container middle">
                <div class="lang">
                    <img width="15" height="15" src="{{ asset('images/vietnam.png') }}" alt="tag">
                    <h5>Việt Nam</h5>
                </div>
                <div class="contact">
                    <div class="contact__content">
                        <img  width="15" height="15" src="{{ asset('images/pin.svg') }}"
                            alt="tag">
                        <a href="">Địa chỉ mua hàng</a> |
                        <img class="align-middle" width="15" height="15"
                            src="{{ asset('images/email.svg') }}" alt="tag">
                        <a href="">Liên hệ</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-2">
            <div class="header-2__content w-100">
                <h6 class="text-center">Free Shipping on Parcel Orders $49+ <a href="">Chi tiết</a></h6>
            </div>
        </div>
        <div class="header-3 middle menu-web container">
            <div class="logo">
                <a href="">
                    <img width="208" height="62" src="{{ asset('images/logo.png') }}" alt="tag">
                </a>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <a href="">BÌNH NÓNG</a>
                    </li>
                    <li>
                        <a href="">CHẬU RỬA</a>
                    </li>
                    <li>
                        <a href="">VÒI XỊT</a>
                    </li>
                    <li>
                        <a href="">NĂNG LƯỢNG MẶT TRỜI</a>
                    </li>
                    <li>
                        <a href="">TIN TỨC</a>
                    </li>
                    <li>
                        <a href="">LIÊN HỆ</a>
                    </li>
                </ul>
            </div>
            <div class="search">
                <div class="form-search">
                    <input type="text" placeholder="Tìm kiếm" name="search">
                    <button type="submit">
                        <img src="{{ asset('images/search-icon.svg') }}" alt="tag">
                    </button>
                </div>
                <button class="cart">
                    <a href="" class="text-center">
                        <img src="{{ asset('images/cart.png') }}" alt="tag">
                    </a>
                </button>
            </div>
        </div>
        @yield('breadcrumb')
    </div>
</body>
