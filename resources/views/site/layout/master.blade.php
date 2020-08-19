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