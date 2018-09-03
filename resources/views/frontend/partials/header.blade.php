        <div class="tt-header__content">
            <div class="tt-header__logo">
                <div class="h1 tt-logo tt-logo__curtain">
                    <a href="index.html">
                        <img src="{{asset('f/assets/images/logo.png')}}" style="height: 60px; width: auto;" alt="mogo">
                    </a>
                </div>
            </div>
            <div class="tt-header__nav">
                <div class="tt-header__sidebar">
                    <div class="tt-header__options">
                        <a href="#" class="tt-header__btn tt-header__btn-menu"><i class="icon-menu"></i></a>
                        <div role="search" class="tt-header__search">
                            <form action="#" class="tt-header__search-form">
                                <input type="search" name="q" class="form-control" placeholder="Search...">
                            </form>
                            <div class="tt-header__search-dropdown"></div>
                            <a href="#" class="tt-header__btn tt-header__btn-open-search"><i
                                    class="icon-search"></i></a>
                            <a href="#" class="tt-header__btn tt-header__btn-close-search"><i class="icon-cancel-1"></i></a>
                        </div>
                        <div>
                            <a href="#" class="tt-header__btn tt-header__btn-user"><i class="icon-user-outline"></i></a>
                            <div class="tt-header__user">
                                <ul class="tt-list-toggle">
                                    <li><a href="{{route('account')}}">Akun Saya</a></li>
                                    <li><a href="{{route('frontend.login')}}">Login</a></li>
                                    <li><a href="{{route('frontend.register.index')}}">Daftar</a></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="tt-header__btn tt-header__btn-cart" style="max-width: 300px;">
                                <i class="icon-shop24"></i>
                            </a>
                            <div class="tt-header__cart">
                                <ul class="tt-list-toggle">
                                    <li>
                                        <a href="{{route('frontend.cart.index')}}" class="tt-header__cart-viewcart btn"><i
                                            class="icon-shop24"></i> Lihat Keranjang</a>
                                    </li>
                                    <li>
                                        {{--<a href="{{route('checkout')}}"--}}
                                       {{--class="tt-header__cart-checkout btn colorize-btn2"><i--}}
                                            {{--class="icon-check"></i> Pesan</a>--}}
                                        <a href="{{route('backend.order.form')}}"
                                           class="tt-header__cart-checkout btn colorize-btn2"><i
                                                    class="icon-check"></i> Pesan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>