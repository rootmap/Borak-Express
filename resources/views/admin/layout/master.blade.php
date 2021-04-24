
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>@yield('title') | 
    @if (Auth::user()->user_type_id==1)
      Admin Panel
    @else 
      Merchant Panel
    @endif
    | www.borakexpressbd.com</title>
  @yield('css')
  @include('admin.include.headerCss')
  @yield('extracss')
  <style>
    body{
      font-size: 0.7rem;
    }
  </style>
     <link rel="shortcut icon" href="{{asset('favicon/favicon.ico')}}"/>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.include.top_nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(Auth::user()->user_type_id==1)
    @include('admin.include.main_menu')
  @endif

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" 
  @if (Auth::user()->user_type_id==2)
    style="margin-left:0px;" 
  @endif 
  >
   <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v8.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="103841834772883">
      </div>
    <!-- Content Header (Page header) -->
    {{-- @include('admin.include.breadcrumb') --}}

    <!-- Main content -->
    
    @yield('content')
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer"
   
@if (Auth::user()->user_type_id==2)
style="margin-left:0px;" 
@endif 
  >
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0
    </div>
    <strong>Copyright &copy; 2020 <a href="http://borakexpressbd.com/" target="_blank" >Borak Express</a>.</strong> All rights
    reserved.
  </footer>

 
</div>
<!-- ./wrapper -->

@include('admin.include.footerJs')
@yield('js')
</body>
</html>
