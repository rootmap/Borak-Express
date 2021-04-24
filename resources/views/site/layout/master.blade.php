<!DOCTYPE html>
<html lang="en">
<head>
	@include('site.extra.header')
	@yield('css')
</head>
	<body>
	   
		<div class="page-wrapper">
			<!-- menu dropdown start-->
			@include('site.extra.mobile-nav')
			<!-- menu dropdown end-->
			<!-- header start-->
			@include('site.extra.nav')
			<!-- header end-->
			<main class="main">
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
                    page_id="103841834772883"
              theme_color="#d696bb">
                  </div>
				<!-- promo start-->
				@yield('content')
				<!-- section end-->
			</main>
			<!-- footer start-->
			@include('site.extra.fotter')
			<!-- footer end-->
		</div>
		<!-- libs-->
		@include('site.extra.fotter-script')
		
	</body>

</html>