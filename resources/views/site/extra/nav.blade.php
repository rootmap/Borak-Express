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
                </div><a class="button button--filled btn_custom" href="{{url('login')}}">Merchant Login</a>
                <!-- menu-trigger start-->
                <div class="hamburger d-inline-block d-md-none hamburger--white">
                    <div class="hamburger-inner"></div>
                </div>
                <!-- menu-trigger end-->
            </div>
        </div>
    </div>
    <style>
        .btn_custom{
            background-color: #9e2074;
            color: #ffffff;
            border: none;
        }.btn_custom:focus{
            outline: none !important;
            border: transparent !important;
        }.btn_custom:hover{
            background-color: #bf1e89;
        }
         .text_bold{
             font-family: Hind Siliguri;
             font-style: normal;
             font-weight: 500;
             font-size: 35px;
             display: block;
         }
         .text_normal{
             font-family: Hind Siliguri;
             font-style: normal;
             font-size: 22px;
             margin-top: 80px;
         }
         .service_card{
             background: #FFFFFF;
             box-shadow: 0px 2px 23px rgba(0, 0, 0, 0.130507);
             border-radius: 12px;
             padding: 25px 15px;
             height: 250px;
             margin-bottom: 15px;
         }
        .service_card:hover .service_card__img{
            -webkit-transform: scale(1.3);
            transform: scale(1.3);
         }
        .service_card__img{
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transition: .3s ease-in-out;
            transition: .3s ease-in-out;
        }
        .service_card__title{
            font-family: Montserrat;
            font-style: normal;
            font-weight: bold;
            font-size: 20px;
            line-height: 26px;
            text-align: center;
            color: #000619;
        }
        .service_card__text{
            font-family: Hind Siliguri;
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 18px;
            text-align: center;
            color: #727272;
        }
        .partners_section_heading__title{
            font-family: Hind Siliguri;
            font-style: normal;
            font-weight: bold;
            font-size: 34px;
            line-height: 38px;
            text-align: center;
            color: #000000;
        }
        .color_pink{
            color: #9D2374 !important;
        }
        .partners_section_heading__text{
            font-family: Hind Siliguri;
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 18px;
            text-align: center;
            color: #000000;
            margin-top: 10px;
        }
        .partners_section_card{
            background: #FFFFFF;
            box-shadow: 0px 2px 23px rgba(0, 0, 0, 0.130507);
            border-radius: 12px;
            padding: 20px 15px;
            margin-bottom: 15px;
        }
        .partners_section_card:hover .partners_section_card_img{
            -webkit-transform: scale(1.3);
            transform: scale(1.3);
        }
        .partners_section_card_img{
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transition: .3s ease-in-out;
            transition: .3s ease-in-out;
            margin-bottom: 10px;
        }
        .partners_section_card_text{
            font-family: Hind Siliguri;
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 20px;
            text-align: center;
            color: #000000;
        }
        .signup_section{
            background-image: url("{{asset('site/img/registrtion_bg.png')}}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-position: center center;
            padding: 50px 0;
        }
        .signup_section_heading{
            font-family: Hind Siliguri;
            font-style: normal;
            font-weight: 600;
            font-size: 35px;
            color: #000000;
            margin-bottom: 2px;
        }
        .signup_section_text{
            font-family: Hind Siliguri;
            font-style: normal;
            font-weight: normal;
            font-size: 25px;
            color: #000000;
        }
        .form-wrapper {
            background: #fff;
            padding: 34px 20px 50px 20px !important;
        }
        @media (max-width: 768px) {
            .text_bold{
                font-size: 25px;
            }
            .text_normal{
                font-size: 15px;
            }
            .partners_section_heading__title{
                font-size: 20px;
            }
        }
        </style>
</header>