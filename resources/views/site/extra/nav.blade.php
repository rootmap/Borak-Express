<header class="page-header_3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-8 col-md-6 col-lg-3 d-flex align-items-center">
                <div class="hamburger d-none d-md-inline-block hamburger--white">
                    <div class="hamburger-inner"></div>
                </div>
                <div class="page-header__logo logo--white"><a href="{{url('/')}}"><img src="{{asset('upload/sitesetting/'.$site->logo)}}" alt="logo"/></a></div>
                <div class="page-header__logo logo--dark"><a href="{{url('/')}}"><img src="{{asset('upload/sitesetting/'.$site->float_logo)}}" alt="logo"/></a></div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-center">
                <!-- main menu start-->
                <ul class="main-menu main-menu--white">
                    <li class="main-menu__item main-menu__item--active"><a class="main-menu__link" href="#home"><span>Home</span></a>
                    </li>
                    
                    <li class="main-menu__item">
                        <a class="main-menu__link" href="#services"><span>Services</span></a>
                    </li>
                    <li class="main-menu__item"><a class="main-menu__link" href="#partners"><span>Partner</span></a>
                    </li>
                    <li class="main-menu__item"><a class="main-menu__link" href="#signup"><span>Merchant Signup</span></a>
                    </li>
                    <li class="main-menu__item"><a class="main-menu__link" href="#contact"><span>Contact</span></a>
                    </li>
                </ul>
                <!-- main menu end-->
            </div>
            <div class="col-4 col-md-6 col-lg-4 d-flex justify-content-end align-items-center">
                <div class="lang-block">
                    
                    <!-- lang select end-->
                </div><a class="button button--filled" href="{{url('login')}}">Merchant Login</a>
                <!-- menu-trigger start-->
                <div class="hamburger d-inline-block d-md-none hamburger--white">
                    <div class="hamburger-inner"></div>
                </div>
                <!-- menu-trigger end-->
            </div>
        </div>
    </div>
</header>