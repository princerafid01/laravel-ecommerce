@extends('master')
@section('main_content')

    <div class="modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Don't Wait, Login now!</h4>
				</div>
				<div class="modal-body modal-body-sub">
					@if (Session::has('err'))
					<div class="alert alert-danger">
						{{ Session::get('err') }}
					</div>
					@endif
					<?php $intended_url = Session::get('url.intended'); ?>
					@if($intended_url)
					<div class="alert alert-warning">
						<h2>You must login first!</h2>
					</div>

					@endif
					<div class="row">
						<div class="col-md-8 modal_body_left modal_body_left1" style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
							<div class="sap_tabs">	
								<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
									<ul>
										<li class="resp-tab-item tab1" aria-controls="tab_item-0"><span>Sign in</span></li>
										<li class="resp-tab-item tab2" aria-controls="tab_item-1"><span>Sign up</span></li>
									</ul>		
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="facts">
											<div class="register">
												<form action="{{ route('sign_in') }}" method="post">		
												{{ csrf_field() }}	
												@if ($errors->has('email'))
													<div class="alert alert-danger">
														{{ $errors->first('email') }}
													</div>
												@endif
													<input name="email" placeholder="Email Address" value="{{ old('email') }}" type="text" required="">						
													<input name="password" placeholder="Password" type="password" required="">										
													<div class="sign-up">
														<input type="submit" value="Sign in"/>
													</div>
												</form>
											</div>
										</div> 
									</div>	 
									<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
										<div class="facts">
											<div class="register">
												<form action="{{ route('user.register') }}" method="post">		
												{{ csrf_field() }}	
			@if ($errors->any())

												<ul class="alert alert-danger err">
				
												@foreach($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
												</ul>												
			@endif
													<input placeholder="Name" name="name" type="text" value="{{ old('name') }}" required="">
													<input placeholder="Email Address" name="email" type="email" value="{{ old('email') }}" required="">	
													<input placeholder="Mobile Number" name="mobile_number" value="{{ old('mobile_number') }}" type="text" required="">	
													<input placeholder="Password" name="password" type="password" required="">	
													<input placeholder="Confirm Password" name="password_confirmation" type="password" required="">
													<div class="sign-up">
														<input type="submit" value="Create Account"/>
													</div>
												</form>
											</div>
										</div>
									</div> 			        					            	      
								</div>	
							</div>
							<script src="{{ asset('js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
							<script type="text/javascript">
								$(document).ready(function () {
									$('#horizontalTab').easyResponsiveTabs({
										type: 'default', //Types: default, vertical, accordion           
										width: 'auto', //auto or any width like 600px
										fit: true   // 100% fit in a container
									});
						if ($('.err')[0]) {
								
								$('.tab2').addClass('resp-tab-active');
								$('.tab-2').addClass('resp-tab-content-active').css('display','block');
								$('li.tab1').attr('class','resp-tab-item');
								$('.tab-1').removeClass('resp-tab-content-active').css('display','none');
								$('h2[aria-controls="tab_item-0"]').removeClass('resp-tab-active');
								$('h2[aria-controls="tab_item-1"]').addClass('resp-tab-active');
									
						}
								});

								
		$('.modal').show();
							</script>
							<div id="OR" class="hidden-xs">OR</div>
						</div>
						<div class="col-md-4 modal_body_right modal_body_right1">
							<div class="row text-center sign-with">
								<div class="col-md-12">
									<h3 class="other-nw">Sign in with</h3>
								</div>
								<div class="col-md-12">
									<ul class="social">
										<li class="social_facebook"><a href="#" class="entypo-facebook"></a></li>
										<li class="social_dribbble"><a href="#" class="entypo-dribbble"></a></li>
										<li class="social_twitter"><a href="#" class="entypo-twitter"></a></li>
										<li class="social_behance"><a href="#" class="entypo-behance"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<style>
.modal {
    position: static;
    /* top: 0; */
    /* right: 0; */
    /* bottom: 0; */
    /* left: 0; */
    z-index: 1050;
    overflow: hidden;
    -webkit-overflow-scrolling: touch;
    outline: 0;
    margin-bottom: 61px;
}

.modal-content {
    position: static; */
    /* background-color: #fff; */
    /* -webkit-background-clip: padding-box; */
    /* background-clip: padding-box; */
    border: none;
    border: none;
    border-radius: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}
	</style>
    
    @endsection