@extends('site.layout.master')
@section('title','Home')
@section('css')
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
<!-- promo start-->
<div class="front-promo promo--f5" id="home">
	<div class="front-promo__layout"></div>
	<picture>
		<source srcset="{{asset('upload/slidersetting/'.$slider->slider_image)}}" media="(min-width: 992px)"/>
		<img class="img--bg" src="{{asset('upload/slidersetting/'.$slider->slider_image)}}" alt="img"/>
	</picture>
	<div class="align-container">
		<div class="align-container__item">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-xl-10 offset-xl-1 text-center">
						<h2 class="front-promo__title">{{$slider->heading}}<span class="front-promo__overlay">{{$slider->water_mark}}</span></h2>
						<p class="front-promo__subtitle">{{$slider->detail}}</p>
							<a class="button button--promo" style="border-radius:20px 0 0px 0;" href="{{url('login')}}"><span>Merchant Login</span> 
								<i class="fa fa-unlock"></i>
							</a>
							<a class="button button--promo" href="#signup"><span>Merchant Signup</span> 
								<i class="fa fa-arrow-down"></i>
							</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="promo-tabs tabs horizontal-tabs">
		<ul class="horizontal-tabs__header">
			<li><a href="#horizontal-tabs__item-1"><span><i class="fa fa-barcode" aria-hidden="true"></i> Borak Tracking No</span></a></li>
			<li><a href="#horizontal-tabs__item-2"><span><i class="fa fa-barcode" aria-hidden="true"></i> Merchant Product ID Tracking</span></a></li>
		</ul>
		<div class="horizontal-tabs__content">
			<div class="horizontal-tabs__item" id="horizontal-tabs__item-1">
				<form class="form promo-form promo-form--f5" action="javascript:void(0);" autocomplete="off">
					<div class="row offset-20">
						<div class="col-sm-6 col-md-9">
							<label>
								<input class="form__field" type="text" name="borak_track_id" placeholder="Enter Borak Tracking No."/>
							</label>
						</div>
						<div class="col-sm-6 col-md-3">
							<button class="button button--green borak-search" type="button"><span>Search</span> 
								<svg class="icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</svg>
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="horizontal-tabs__item" id="horizontal-tabs__item-2">
				<form class="form promo-form promo-form--f5" action="javascript:void(0);" autocomplete="off">
					<div class="row offset-20">
						<div class="col-sm-6 col-md-9">
							<label>
								<input class="form__field" type="text" name="borak_track_id" placeholder="Enter Merchant Product ID No."/>
							</label>
						</div>
						<div class="col-sm-6 col-md-3">
							<button class="button button--green  borak-search" type="button"><span>Search</span> 
								<svg class="icon">
									<i class="fa fa-search" aria-hidden="true"></i>
								</svg>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- promo end-->
<!-- section start-->
<section class="section" id="services">
	<div class="container">
		<div class="row bottom-70">
			<div class="col-12">
				<div class="heading heading--center"><span class="heading__pre-title">What we do</span>
					<h3 class="heading__title">Our Services</h3><span class="heading__layout">Services</span>
				</div>
			</div>
		</div>
		<div class="row offset-70">
			<div class="col-lg-4">
				<div class="advantages-item text-center">
					<div class="advantages-item__img"><img src="{{asset('site/img/pack_4/i8.svg')}}" alt="icon"/></div>
					<h2 class="advantages-item__title">Packaging Service</h2>
					<p class="advantages-item__text">Under this service we provide Carton Packaging Booking Services: Items that are booked vide cartons are procured from SETS. The items are specific to delivery</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="advantages-item text-center">
					<div class="advantages-item__img"><img src="{{asset('site/img/pack_4/i15.svg')}}" alt="icon"/></div>
					<h2 class="advantages-item__title">Parcel service</h2>
					<p class="advantages-item__text">Due to its presence in every remote pocket throughout this country many have found it to be very convenient to send and receive with ease and harmony and this has tempted all to use Sundarban against many competitors who are in the similar trade.</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="advantages-item text-center">
					<div class="advantages-item__img"><img src="{{asset('site/img/pack_4/i12.svg')}}" alt="icon"/></div>
					<h2 class="advantages-item__title">E-Commerce Service</h2>
					<p class="advantages-item__text">Single point of contact for the many services. It is catering to multiple services from a one point and that also includes its own logistics fleet.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- section end-->

<!-- section end-->

<!-- section end-->
<!-- section start-->
<section class="section qoute-section pb-0" id="signup">
	<div class="quote-section__bg">
		<img class="img--bg" src="{{asset('site/img/quote-bg.jpg')}}" alt="bg"/>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-5 d-flex flex-column justify-content-between">
				<div class="heading heading--white"><span class="heading__pre-title">Merchant Singup</span>
					<h3 class="heading__title">Provide your merchant info</h3>
					<p class="heading__text color--white">Borak  is a household name to all in Bangladesh for having been the pioneer of Courier and Parcel Services in this country. From the Corporate Clients to the average person all the persons have been availing the services of borak.</p><span class="heading__layout layout--white">Signup</span>
				</div>
				{{-- <div class="contact-trigger top-50 top-lg-0"><img class="contact-trigger__img" src="{{asset('site/img/contact_background.png')}}" alt="img"/>
					<h4 class="contact-trigger__title">How we can help you!</h4><a class="button button--white" href="#"><span>Contact us</span> 
						<svg class="icon">
							<use xlink:href="#arrow"></use>
						</svg></a>
				</div> --}}
			</div>
			<div class="col-lg-7 top-50 top-lg-0">
				<div class="form-wrapper is--bordered">
					<form class="form quote-form" id="merchant" autocomplete="off" action="javascript:void(0);">
						<h6 class="quote-form__title">Merchant Registration</h6>
						<h6 class="quote-form__title" style="margin-bottom: 6px; color:#ccc;"><small>Enter Account Information</small></h6>
						<div class="row">
							<div class="col-sm-6">
								<input class="form__field" type="text" name="name" placeholder="Full name"/>
							</div>
							<div class="col-sm-6">
								<input class="form__field" type="tel"  maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  name="phone-number" placeholder="Phone"/>
							</div>
							<div class="col-sm-6">
								<input class="form__field" autocomplete="off" type="email" name="email" placeholder="Email"/>
							</div>
							<div class="col-sm-6">
								<input class="form__field" autocomplete="off" type="password" name="password" placeholder="Password"/>
							</div>
						</div>
						<h6 class="quote-form__title" style="margin-bottom: 6px; color:#ccc;"><small>Business Information</small></h6>
						<div class="row">
							<div class="col-sm-6">
								<input class="form__field" type="text" name="business_name" placeholder="Enter Business Name"/>
							</div>
							<div class="col-sm-6">
								<input class="form__field" type="text" name="address" placeholder="Business Address"/>
							</div>
							<div class="col-sm-12">
								<input class="form__field" type="text" name="pickup_address" placeholder="Product/Delivery Pickup Address"/>
							</div>
						</div>
						<h6 class="quote-form__title" style="margin-bottom: 6px; color:#ccc;"><small>Payment Information</small></h6>
						<div class="row">
							
							<div class="col-md-3 col-sm-12">
								<label class="form__radio-label bottom-20"><span class="form__label-text">MFS</span>
									<input class="form__input-radio pm" type="radio" name="option-select" value="MFS" id="mfs" /><span class="form__radio-mask pm"></span>
								</label>
							</div>
							<div class="col-md-3 col-sm-12">
								<label class="form__radio-label bottom-20"><span class="form__label-text">Bank</span>
									<input class="form__input-radio pm" type="radio" name="option-select" id="Bank" value="Bank"/><span class="form__radio-mask pm"></span>
								</label>
							</div>
						</div>

						<div class="row mfs" style="display: none;">
							<div class="col-sm-6">
								<select class="form__select" name="wallet_provider">
									<option data-display="Select Wallet Provider" value="">Select Wallet Provider</option>
									@isset($wp)
										@foreach ($wp as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
										@endforeach
									@endisset
								</select>
							</div>
							<div class="col-sm-6">
								<input class="form__field" type="text"  maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  name="wallet_mobile_no" placeholder="Wallet / Mobile No." />
							</div>
						</div>
						<div class="row bank" style="display: none;">
							<div class="col-sm-6">
								<input class="form__field" type="text" name="bank_name" placeholder="Bank Name" />
							</div>
							<div class="col-sm-6">
								<input class="form__field" type="text" name="bank_branch" placeholder="Bank Branch" />
							</div>
							<div class="col-sm-6">
								<select class="form__select" name="account_type">
									<option data-display="Select Account Type" value="">Select Account Type</option>
									@isset($bt)
										@foreach ($bt as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
										@endforeach
									@endisset
								</select>
							</div>
							<div class="col-sm-6">
								<input class="form__field" type="text" name="account_name" placeholder="Account Name" />
							</div>
							<div class="col-sm-6">
								<input class="form__field" type="text" name="account_number" placeholder="Account Number" />
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<button class="quote-form__submit complete-merchant" style="margin-top: 6px;" type="button">Signup</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- section end-->

<!-- section start-->
<section class="section" id="partners">
	<div class="container">
		<div class="row bottom-60">
			<div class="col-12">
				<div class="heading heading--center"><span class="heading__pre-title">Partners</span>
					<h3 class="heading__title">Companies who <span class="color--green">Trust</span> us</h3><span class="heading__layout">Partners</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- logos slider start-->
				<div class="logos-slider logos-slider--style-2">
					<div class="logos-slider__item"><img src="{{asset('site/img/logo_1.png')}}" alt="logo"/></div>
					<div class="logos-slider__item"><img src="{{asset('site/img/logo_2.png')}}" alt="logo"/></div>
					<div class="logos-slider__item"><img src="{{asset('site/img/logo_3.png')}}" alt="logo"/></div>
					<div class="logos-slider__item"><img src="{{asset('site/img/logo_4.png')}}" alt="logo"/></div>
				</div>
				<div class="logos-slider__dots"></div>
				<!-- logos slider end-->
			</div>
		</div>
	</div>
</section>
@endsection				
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
	var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
	var merchantSignupUrl="{{url('merchant/signup')}}";
	var boraktrackingUrl="{{url('borak/tracking')}}";
	var merchantloginUrl="{{url('login')}}";
	function SweetError(msg)
	{
		Swal.fire({
			icon: 'error',
			title: '<h3 class="text-danger">Warning</h3>',
			html: '<h5>'+msg+'!!!</h5>'
		});

		
	}

	$(document).ready(function(e){
		
		$('.borak-search').click(function(){
			var borak_track_id=$('input[name=borak_track_id]').val();
			if(borak_track_id.length==0)
			{
				SweetError("Please input borak tracking id."); 
				return false;
			}

			var data={ 
				'tracking_no': borak_track_id, 
				'_token': csrftLarVe, 
			}

			$.ajax({
				'async': false,
				'type': "POST",
				'global': false,
				'dataType': 'json',
				'url': boraktrackingUrl,
				'data': data,
				'error':function(res){
					SweetError("Something wrong with your internet, Please try again."); return false;
				},
				'success': function(data) {
					console.log("Completing Sales : " + data);
					Swal.hideLoading();
					if(data.status == 1)
					{
						Swal.fire({
							icon: 'success',
							title: '<h3 class="text-success">Order Found</h3>',
							html: '<h5>'+data.message+'</h5>'
						});
			return false;
						

					}
					else if(data.status == 0)
					{
						Swal.fire({
							icon: 'warning',
							title: '<h3 class="text-warning">Order Not Found</h3>',
							html: '<h5>'+data.message+'</h5>'
						});
						return false;
						

					}
					else
					{
						SweetError("Something wrong, Please try again."); return false;
					}
					
				}
			});

		});

		$('.complete-merchant').click(function(e){
			e.preventDefault();
			var name=$('input[name=name]').val(); if(name.length==0){ SweetError("Please enter your fullname."); return false; }
			var phone_number=$('input[name=phone-number]').val(); if(phone_number.length==0){ SweetError("Please enter your phone number."); return false; }
			var email=$('input[name=email]').val(); if(email.length==0){ SweetError("Please enter your email."); return false; }
			var password=$('input[name=password]').val(); if(password.length==0){ SweetError("Please enter your password."); return false; }
			var business_name=$('input[name=business_name]').val(); if(business_name.length==0){ SweetError("Please enter your business name."); return false; }
			var address=$('input[name=address]').val(); if(address.length==0){ SweetError("Please enter your business address."); return false; }
			var pickup_address=$('input[name=pickup_address]').val(); if(pickup_address.length==0){ SweetError("Please enter your pickup address."); return false; }
			var pm=0;
			if(document.getElementById('mfs').checked==true)
			{
				pm=1;
			}
			else if(document.getElementById('Bank').checked==true)
			{
				pm=2;
			}

			if(pm==0)
			{
				SweetError("Please choose payment information."); return false;
			}
			else if(pm==1)
			{
				var wallet_provider=$('select[name=wallet_provider]').val(); 
				if(wallet_provider.length==0){ SweetError("Please choose your wallet provider."); return false; }
				
				var wallet_mobile_no=$('input[name=wallet_mobile_no]').val(); 
				if(wallet_mobile_no.length==0){ SweetError("Please enter your wallet mobile number."); return false; }

				var data={ 
                      'full_name': name, 
                      'mobile':phone_number, 
                      'email': email, 
                      'password': password, 
                      'business_name': business_name, 
                      'business_address': address, 
                      'pickup_address': pickup_address, 
                      'payment_method': pm, 
                      'wallet_provider_id': wallet_provider, 
                      'mobile_number': wallet_mobile_no, 
                      '_token': csrftLarVe, 
                  	}
			}
			else if(pm==2)
			{
				var bank_name=$('input[name=bank_name]').val(); 
				if(bank_name.length==0){ SweetError("Please enter your bank name."); return false; }
				
				var bank_branch=$('input[name=bank_branch]').val(); 
				if(bank_branch.length==0){ SweetError("Please enter your bank branch name."); return false; }
				
				var account_type=$('select[name=account_type]').val(); 
				if(account_type.length==0){ SweetError("Please choose your bank account type."); return false; }

				var account_name=$('input[name=account_name]').val(); 
				if(account_name.length==0){ SweetError("Please enter your bank account full name."); return false; }
				
				var account_number=$('input[name=account_number]').val(); 
				if(account_number.length==0){ SweetError("Please enter your bank account number."); return false; }
				
				var data={ 
                      'full_name': name, 
                      'mobile':phone_number, 
                      'email': email, 
                      'password': password, 
                      'business_name': business_name, 
                      'business_address': address, 
                      'pickup_address': pickup_address, 
                      'payment_method': pm, 
                      'bank_name': bank_name, 
                      'bank_branch': bank_branch, 
                      'account_type': account_type, 
                      'account_name': account_name, 
                      'account_number': account_number, 
                      '_token': csrftLarVe, 
                  	}
			}

			// console.log(data);
			// return false;
			Swal.showLoading();
			
			$.ajax({
                  'async': false,
                  'type': "POST",
                  'global': false,
                  'dataType': 'json',
                  'url': merchantSignupUrl,
                  'data': data,
                  'error':function(res){
					SweetError("Something wrong with your internet, Please try again."); return false;
                  },
                  'success': function(data) {
                      console.log("Completing Sales : " + data);
                      Swal.hideLoading();
                      if(data.success == 1)
                      {
                          Swal.fire({
                              icon: 'success',
                              title: '<h3 class="text-success">Thank You.</h3>',
                              html: '<h5>You have been successfully registered. Please wait you will redirect to dashboard automatically</h5>'
                          });

						  if(data.redirect)
						  {
								window.location.href=merchantloginUrl;
						  }

                      }
                      else if(data.error)
                      {
                          Swal.fire({
                              icon: 'error',
                              title: '<h3 class="text-success">Warning</h3>',
                              html: '<h5>'+data.error+'</h5>'
                          });
                      }
                      else
                      {
							SweetError("Something wrong, Please try again."); return false;
                      }
                      
                  }
              });

			return false;
			//Swal.showLoading();
			
		});

		
	});
</script>
@endsection