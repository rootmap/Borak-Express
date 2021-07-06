<footer class="page-footer footer_2" id="contact"><img class="section--bg b0 r0" src="{{asset('site/img/footer-bg.png')}}" alt="bg"/>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="page-footer__logo"><a href="{{url('/')}}"><img src="{{asset('upload/sitesetting/'.$site->fotter_logo)}}" alt="logo"/></a></div>
                <div class="page-footer__details">
                    <p><strong>Location:</strong> <span>{{$site->location}}</span></p>
                    <p><strong>Phone:</strong> <a href="tel:{{$site->phone}}">{{$site->phone}}</a></p>
                    <p><strong>Email:</strong> <a href="mailto:{{$site->email}}">{{$site->email}}</a></p>
                    <p><strong>Openning hours:</strong> <span>{{$site->opening_hour}}</span></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 top-30 top-md-0">
                <h6 class="page-footer__title title--white">Main menu</h6>
                <ul class="page-footer__menu list--reset">
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Pricing plan</a></li>
                    <li><a href="#">Elements</a></li>
                    <li><a href="#">Team</a></li>
                    <li><a href="#">Warehouse</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Calculator</a></li>
                    <li><a href="#">Site map</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-4 top-30 top-lg-0">
                <h6 class="page-footer__title title--white">Newslatter</h6>
                <form class="form newslatter-form" action="javascript:void(0);">
                    <div class="fieldset">
                        <input class="form__field" type="email" name="email" placeholder="Email address"/>
                        <button class="form__submit btn_custom" type="submit">
                                <i style="color: #fff;" class="fa fa-envelope"></i>
                        </button>
                    </div>
                    <p class="color--gray">Stay tuned for our latest news</p>
                </form>
            </div>
        </div>
        <div class="row top-50 flex-column-reverse flex-sm-row">
            <div class="col-sm-6 col-lg-4 top-20 top-sm-0 text-center text-sm-left">
                <div class="page-footer__copyright">© 2020 borakexpress.com. All rights reserved</div>
            </div>
            <div class="col-sm-6 col-lg-8 d-flex justify-content-center justify-content-sm-end justify-content-lg-between">
                <div class="page-footer__privacy d-none d-lg-block"><a href="#">Terms and conditions</a><a href="#">Privacy policy</a><a href="#">Cookies</a></div>
                <ul class="socials list--reset">
                    <li class="socials__item"><a class="socials__link" href="#">
                        <i class="fa fa-youtube"></i>    
                    </a></li>
                    <li class="socials__item"><a class="socials__link" href="#">
                        <i class="fa fa-facebook"></i>    
                    </a></li>
                    <li class="socials__item"><a class="socials__link" href="#">
                        <i class="fa fa-twitter"></i>       
                    </a></li>
                    <li class="socials__item"><a class="socials__link" href="#">
                        <i class="fa fa-linkedin"></i>   
                    </a></li>
                    <li class="socials__item"><a class="socials__link" href="#">
                        
                        <i class="fa fa-instagram"></i>  
                    </a></li>
                </ul>
            </div>
        </div>
    </div>
    <style>
        .btn_custom{
            background-color: #9e2074 !important;
            color: #ffffff;
            border: none !important;
        }.btn_custom:focus{
             outline: none !important;
             border: transparent !important;
         }.btn_custom:hover{
              background-color: #bf1e89 !important;
          }
          .socials__link:hover{
              color: #bf1e89 !important;
          }
    </style>
</footer>