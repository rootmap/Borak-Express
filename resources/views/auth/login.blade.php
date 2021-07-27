<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in | Welcome to Borak Express</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('favicon/favicon.ico')}}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/login.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="row">
    <div class="col-md-12">
        @include("admin.include.msg")
    </div>
</div>
<div class="login_page">
    <div class="login_page_form_section">
        <div class="login_page_form_section_card">
            <div class="text-center">
                <div class="d-flex justify-content-center">
                    <img src="{{asset('Gray/Logo.svg')}}" class="mb-3 display_block">
                </div>
                <p class="login_page_form_section_card_text">
                    <span class="login_page_form_section_card_text_bold">বোরাক এক্সপ্রেস</span>
                    -এ আপনাকে স্বাগতম
                </p>
                <div class="d-flex justify-content-center">
                    <img src="{{asset('site/img/login_page_banner.svg')}}" class="mb-3 display_none" style="width: 80%">
                </div>
            </div>
            <div class="login_form_card">
                <form action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group position-relative">
                        <label for="email" class="login_form_card_label">Your Email</label>
                        <input type="email" class="form-control login_form_card_input" id="email" name="email" placeholder="Email" value="{{ old('email') }}" >
                    </div>
                    <div class="form-group position-relative">
                        <label for="password" class="login_form_card_label">Enter Password</label>
                        <input type="password" class="form-control login_form_card_input" placeholder="Password" name="password" id="password">
                    </div>
                    <div class="form-group form-check ml-1">
                        <label class="form-check-label mb-0">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                Remember Me
                        </label>
                        <span class="float_right">
                            <a href="{{url('reset/password')}}" class="forget_pass_btn">Forgot Password</a>
                        </span>
                    </div>
                    <div class="form-group ">
                        <input type="submit" class="login_form_card_login_btn" value="Login">
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="login_page_banner_section">
        <img src="{{asset('site/img/login_page_banner.svg')}}" style="width: 80%">
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('admin/dist/js/adminlte.min.js')}}"></script>

</body>
</html>