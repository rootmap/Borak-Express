<div class="menu-dropdown">
    <div class="menu-dropdown__inner" data-value="start">
        <div class="screen screen--start">
            <div class="menu-dropdown__close">
                <svg class="icon">
                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                </svg>
            </div>
            <div class="screen__item item--active">
                <a class="screen__link" href="#home">Home</a>
            </div>
            <div class="screen__item">
                <a class="screen__link" href="#services">Services</a>
            </div>
            <div class="screen__item">
                <a class="screen__link" href="#partners">Partners</a>
            </div>
            <div class="screen__item">
                <a class="screen__link" href="#signup">Merchant Signup</a>
            </div>
            <div class="screen__item">
                <a class="screen__link" href="{{url('login')}}">Merchant Login</a>
            </div>
            <div class="screen__item">
                <a class="screen__link" href="javascript:void(0);">Contact</a>
            </div>
            
            <div class="menu-dropdown__block top-50"><span class="block__title">Email</span>
                <a class="screen__link" href="mailto:{{$site->email}}">{{$site->email}}</a></div>
            <div class="menu-dropdown__block top-20"><span class="block__title">Phone numbers</span>
                <a class="screen__link" href="tel:{{$site->phone}}">{{$site->phone}}</a></div>
            <div class="menu-dropdown__block">
                <ul class="socials list--reset">
                    <li class="socials__item"><a class="socials__link" href="#">
                        <svg class="icon">
                            <use xlink:href="#youtube"></use>
                        </svg></a></li>
                    <li class="socials__item"><a class="socials__link" href="#">
                        <svg class="icon">
                            <use xlink:href="#facebook"></use>
                        </svg></a></li>
                    <li class="socials__item"><a class="socials__link" href="#">
                        <svg class="icon">
                            <use xlink:href="#twitter"></use>
                        </svg></a></li>
                    <li class="socials__item"><a class="socials__link" href="#">
                        <svg class="icon">
                            <use xlink:href="#linkedin"></use>
                        </svg></a></li>
                    <li class="socials__item"><a class="socials__link" href="#">
                        <svg class="icon">
                            <use xlink:href="#inst"></use>
                        </svg></a></li>
                </ul>
            </div>
            <div class="menu-dropdown__block top-50"><a class="button button--filled" href="#signup">Merchant Signup</a>
            </div>
        </div>
    </div>
</div>