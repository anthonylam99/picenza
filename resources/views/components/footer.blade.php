<footer>
    <div class="footer-div">
        <div class="main-footer container">
            <?php
            $location = \App\Models\MenuLocation::where('menu_id', 2)->first('location');

            if(!empty($location->location)){
                $footer = \Harimayco\Menu\Facades\Menu::get($location->location);
            }
            ?>
            <div class="main-footer-content row">
                @if(!empty($footer) && isset($footer))
                    @foreach($footer as $menu)
                        <div class="footer-item col-12 col-sm-6 col-lg-3 col-xl-3">
                            <ul>
                                <li>
                                    <b>{{$menu['label']}}</b>
                                </li>
                                @if($menu['child'])
                                    @foreach($menu['child'] as $child)
                                        <li>
                                            <a href="{{$child['link']}}">{{$child['label']}}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <div class="copyright text-center">
        <h6 style="margin: 0; color: #999999; ">© 2022 Công ty Pacenza</h6>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/main.js')}}"></script>
@yield('scripts')
@stack('scripts')
</html>
