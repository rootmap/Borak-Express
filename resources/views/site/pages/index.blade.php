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
		<img class="img--bg slider_image" src="{{asset('upload/slidersetting/'.$slider->slider_image)}}" alt="img"/>
	</picture>
	<div class="align-container">
		<div class="align-container__item">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-xl-10 offset-xl-1 text-center">
						<h2 class="front-promo__title ">{{$slider->heading}}<span class="front-promo__overlay">{{$slider->water_mark}}</span></h2>
						<p class="front-promo__subtitle d-none">{{$slider->detail}}</p>
						<div class="text-left">
							<p class="text_normal"><span class="text_bold">একমাত্র</span> Borak Express এর মাধ্যমে ২৪ ঘণ্টায় <span class="text_bold">ঢাকার ভিতরে ডেলিভারী</span> </p>

							<a class="button button--promo btn_custom" style="border-radius:20px 0 0px 0;" href="{{url('login')}}"><span>Merchant Login</span>
								<i class="fa fa-unlock"></i>
							</a>
							<a class="button button--promo btn_custom" href="#signup"><span>Merchant Signup</span>
								<i class="fa fa-arrow-down"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="promo-tabs tabs horizontal-tabs" style="border-radius: 10px;padding: 10px">
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
							<button class="button button--green borak-search btn_custom" type="button"><span>Search</span>
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
							<button class="button button--green  borak-search btn_custom" type="button"><span>Search</span>
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
<section class="section pb-0" id="services">
	<div class="container">
		<div class="row bottom-70">
			<div class="col-12">
				<div class="heading heading--center "><span class="heading__pre-title d-none">What we do</span>
					<h3 class="heading__title">Our Services</h3><span class="heading__layout d-none">Services</span>
				</div>
			</div>
		</div>
		<div class="row offset-70">
			<div class="col-lg-4">
				<div class="card service_card">
					<div class="service_card__img text-center"><img src="{{asset('site/img/pack_4/vaadin_package.svg')}}" alt="icon"/></div>
					<h2 class="service_card__title text-center">Packaging Service</h2>
					<p class="service_card__text text-center">Under this service we provide Carton Packaging Booking Services: Items that are booked vide cartons are procured from SETS. The items are specific to delivery</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card service_card">
					<div class="service_card__img text-center"><img src="{{asset('site/img/pack_4/carbon_delivery-parcel.svg')}}" alt="icon"/></div>
					<h2 class="service_card__title text-center">Parcel service</h2>
					<p class="service_card__text text-center">Due to its presence in every remote pocket throughout this country many have found it to be very convenient to send and receive with ease and harmony and this has tempted all to use Sundarban against many competitors who are in the similar trade.</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card service_card">
					<div class="service_card__img text-center"><img src="{{asset('site/img/pack_4/mdi_truck-delivery.svg')}}" alt="icon"/></div>
					<h2 class="service_card__title text-center">E-Commerce Service</h2>
					<p class="service_card__text text-center">Single point of contact for the many services. It is catering to multiple services from a one point and that also includes its own logistics fleet.</p>
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
{{--	<div class="quote-section__bg">--}}
{{--		<img class="img--bg" src="{{asset('site/img/registrtion_bg.png')}}" alt="bg"/>--}}
{{--	</div>--}}
	<div class="signup_section">
	<div class="container">
		<h4 class="signup_section_heading">মার্চেন্ট <span class="color_pink">তথ্য</span></h4>
		<p class="signup_section_text">মার্চেন্টের তথ্য দিয়ে হয়ে যান আমাদের মার্চেন্ট এজেন্ট</p>
		<div class="row">
{{--			<div class="col-lg-5 d-flex flex-column justify-content-between">--}}
{{--				<div class="heading heading--white"><span class="heading__pre-title">Merchant Singup</span>--}}
{{--					<h3 class="heading__title">Provide your merchant info</h3>--}}
{{--					<p class="heading__text color--white">Borak  is a household name to all in Bangladesh for having been the pioneer of Courier and Parcel Services in this country. From the Corporate Clients to the average person all the persons have been availing the services of borak.</p><span class="heading__layout layout--white">Signup</span>--}}
{{--				</div>--}}
{{--				--}}{{-- <div class="contact-trigger top-50 top-lg-0"><img class="contact-trigger__img" src="{{asset('site/img/contact_background.png')}}" alt="img"/>--}}
{{--					<h4 class="contact-trigger__title">How we can help you!</h4><a class="button button--white" href="#"><span>Contact us</span> --}}
{{--						<svg class="icon">--}}
{{--							<use xlink:href="#arrow"></use>--}}
{{--						</svg></a>--}}
{{--				</div> --}}
{{--			</div>--}}
			<div class="col-lg-5 top-50 top-lg-0">
				<div class="form-wrapper is--bordered" style="border-radius: 17px;">
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
								<button class="quote-form__submit complete-merchant btn_custom" style="margin-top: 6px;" type="button">Signup</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
<!-- section end-->

<!-- section start-->
<section class="section pb-5" id="partners">
	<div class="container">
		<div class="row bottom-60">
			<div class="col-12">
				<div class="heading heading--center">
					<h3 class="partners_section_heading__title"><span class="color_pink">সুপারফাস্ট </span> ডেলিভারিতে আমরা আছি আপনাদের পাশে </h3>
					<p class="partners_section_heading__text">গুরুত্বপূর্ণ যেকোনো পণ্য সবচেয়ে নিরাপদে ও স্বল্প সময়ে আপনাদের দোড়গোড়ায় পৌঁছে দিতে আমরা সর্বদা প্রস্তুত</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="card partners_section_card">
					<div class="partners_section_card_img text-center">
						<img src="{{asset('site/img/Delivery care.svg')}}" alt="img"/>
					</div>
					<p class="partners_section_card_text text-center">
						ক্যাশ অন ডেলিভারি<br>
						সম্পূর্ণ চার্জ ফ্রি
					</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card partners_section_card">
					<div class="partners_section_card_img text-center">
						<img src="{{asset('site/img/Parcel address.svg')}}" alt="logo"/>
					</div>
					<p class="partners_section_card_text text-center">
						ঢাকার মধ্যে ডেলিভারি<br>
						চার্জ মাত্র ৬০ টাকা
					</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card partners_section_card">
					<div class="partners_section_card_img text-center">
						<img src="{{asset('site/img/Delivery on foot.svg')}}" alt="logo"/>
					</div>
					<p class="partners_section_card_text text-center">
						পণ্য সংগ্রহের দিনই<br>
						ঢাকায় ডেলিভারি
					</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card partners_section_card">
					<div class="partners_section_card_img text-center">
						<img src="{{asset('site/img/Assembly instructions.svg')}}" alt="logo"/>
					</div>
					<p class="partners_section_card_text text-center">
						সময় মতো<br>
						পেমেন্টের সুবিধা
					</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card partners_section_card">
					<div class="partners_section_card_img text-center">
						<img src="{{asset('site/img/Loader.svg')}}" alt="logo"/>
					</div>
					<p class="partners_section_card_text text-center">
						বেশি পার্সেল থাকলে<br>
						অগ্রিম পেমেন্ট করা হয়
					</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card partners_section_card">
					<div class="partners_section_card_img text-center">
						<img src="{{asset('site/img/Movers.svg')}}" alt="logo"/>
					</div>
					<p class="partners_section_card_text text-center">
						প্রতিদিনই এক্সচেঞ্জ<br>
						এর ব্যবস্থা আছে
					</p>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- section end-->
<!-- section start-->
<section class="section  pb-5" id="package">
	<div class="container">
		<div class="row ">
			<div class="col-12">
				<div class="heading heading--center">
					<h3 class="partners_section_heading__title"><span class="color_pink">বোরাকের </span> প্যাকেজসমূহ </h3>

				</div>
			</div>
		</div>
		<img src="{{asset('site/img/Borak-package.png')}}" class="img-fluid" alt="package"/>
	</div>
</section>
<!-- section end-->


<style>
	.slider_image{
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		 object-fit: fill !important;
		z-index: 0;
	}
	.btn_custom{
		background-color: #9e2074;
		color: #ffffff;
	}
.progressbar_bg{
	background:#fff;
	width: 100%;
	padding: 20px 30px;
}
    #progressbar {
        overflow: hidden;
        color: #000000;
        padding-left: 0px;
		/* background: #fff;
		padding: 20px 30px;
		width: 100%; */
    }

    #progressbar li {
        list-style-type: none;
        font-size: 13px;
        height: auto;
        position: relative;
        font-weight: 400;
    }
	#progressbar li:last-child hr{
		border-bottom: none;
		display: none;
    }
	#progressbar li hr{
		border-bottom: 1px solid #000;
    }
    #progressbar li:after {
        width: 1px;
        height: 82px;
        border-left: 2px dotted red;
        position: absolute;
        content: '';
        top: 50%;
        left: 14px;
        z-index: 1;
    }
    #progressbar li:last-child:after {
        width: 0 !important;
        border: 0 !important;

    }
	#progressbar li:first-child .step_heading{
        color:#28a745 !important;

    }
    .step0{
        display: flex;
        margin: 15px 0;
    }
	.step_note{
		margin-bottom:5px !important;
	}
    
    .step_heading, .step_note, .step_date_time{
        margin: 0;
		text-align: left;
    }
	.step_image{
		width: 30px !important;
		max-width: 30px !important;
		height: 30px !important;
		z-index: 2;
	}
</style>
@endsection				
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
	var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
	var merchantSignupUrl="{{url('merchant/signup')}}";
	var boraktrackingUrl="{{url('/merchantapi/tracking')}}";
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
				//'_token': csrftLarVe, 
			}

			$.ajax({
				'async': false,
				'type': "GET",
				'global': false,
				'dataType': 'json',
				'url': boraktrackingUrl,
				'data': data,
				'error':function(res){
					SweetError("Something wrong with your internet, Please try again."); return false;
				},
				'success': function(data) {
					console.log("Completing Sales : " + data);

                    var html = "";
					for( var key in data ) {
						console.log(key);
						var image = "";
						if(data[key].parcel_status=='Pending'){
                            image='<img class="step_image" src="{{asset('Order Proces icon/pendig & process.svg')}}">';

						}
						if(data[key].parcel_status=='Accepted'){
                            image='<img class="step_image" src="{{asset('Order Proces icon/Shipped.svg')}}">';

						}
						if(data[key].parcel_status=='Pickup'){
                            image='<img class="step_image" src="{{asset('Order Proces icon/Picked.svg')}}">';

						}
						if(data[key].parcel_status=='On The Way'){
                            image='<img class="step_image" src="{{asset('Order Proces icon/Shipped.svg')}}">';

						}
						if(data[key].parcel_status=='Delivered'){
                            image='<img class="step_image" src="{{asset('Order Proces icon/Delivered.svg')}}">';

						}
						if(data[key].parcel_status=='Cancel'){
                            image='<img class="step_image" src="{{asset('Order Proces icon/Shipped.svg')}}">';

						}
						if(data[key].parcel_status=='Hold'){
                            image='<img class="step_image" src="{{asset('Gray/Shipped.svg')}}">';

						}
						
						html += '<li class="step0">'+
        					'<div style="display: flex; justify-content: start; align-items: center; margin-right: 10px">'+
            				image+
        					'</div>'+
        					'<div>'+
            				'<h6 class="step_heading">' + data[key].parcel_status + '</h6>'+
           					// '<p class="step_note">'+ data[key].remarks +'</p>'+
            				'<p class="step_date_time">'+data[key].created_at+'</p>'+
							'<hr>'+
        					'</div>'+
    						'</li>';
                     
					}
  

                           
						   console.log(html);
						   console.log(data.parcel_status);

					Swal.hideLoading();
					 if(data !='')
					 {
						Swal.fire({
							icon: 'success',
							title: '<h6 class="text-success">Order Id- '+borak_track_id+'</h3>',
							width: '800px',
							background: '#F7F8FA',
							html: '<div class="progressbar_bg">'+
							'<ul id="progressbar" class="text-center">'+

    						html+
							'</ul>'+
							'</div>'
						});
						return false;
						

					}
					else 
					{
						Swal.fire({
							icon: 'warning',
							title: '<h3 class="text-warning">Order Not Found</h3>',
							html: '<h5>Invalid order tracking no.</h5>'
						});
						return false;
						

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
							  setTimeout(() => {
									window.location.href=merchantloginUrl;
							  }, 5000);
								
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