@extends('master')
@section('main_content')
	<!-- banner -->
	<div class="banner">
		<div class="container">
			<h3>Electronic Store, <span>Special Offers</span></h3>
		</div>
	</div>
	<!-- //banner --> 
	<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<div class="col-md-5 wthree_banner_bottom_left">
				<div class="video-img">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
						<span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
					</a>
				</div> 
					<!-- pop-up-box -->     
					<script src="{{ asset('js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
					<!--//pop-up-box -->
					<div id="small-dialog" class="mfp-hide">
						<iframe src="https://www.youtube.com/embed/ZQa6GUVnbNM"></iframe>
					</div>
					<script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
					</script>
			</div>
			<div class="col-md-7 wthree_banner_bottom_right">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
<?php 
$i = 1;	
$k = 1;	
?>
@foreach($categories as $category)
						<li role="presentation" class="tabi-{{ $i++ }}"><a href="#{{ $category->category_name}}" id="{{ $category->category_name}}-tab" role="tab" data-toggle="tab" aria-controls="{{ $category->category_name}}">{{ $category->category_name }}</a></li>
@endforeach

					</ul>
					<div id="myTabContent" class="tab-content">




@foreach($categories as $category)


<div role="tabpanel" class="tab-pane fade mTabi-{{ $k++ }}" id="{{ $category->category_name }}" aria-labelledby="{{ $category->category_name }}-tab">
			<div class="agile_ecommerce_tabs">


@foreach($category->products->take(3) as $product)

				<div class="col-md-4 agile_ecommerce_tab_left">
					<div class="hs-wrapper">

			<img src="{{ asset('storage/'.$product->img_one) }}" alt=" " class="img-responsive" />
			@if ($product->img_two != '')
			<img src="{{ asset('storage/'.$product->img_two) }}" alt=" " class="img-responsive" />
			@endif
			@if ($product->img_three != '')
			<img src="{{ asset('storage/'.$product->img_three) }}" alt=" " class="img-responsive" />
			@endif

						<div class="w3_hs_bottom">
							<ul>
								<li>
									<a href="#{{ $product->id }}" data-toggle="modal" data-target="#{{ $product->id }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
								</li>
								
							</ul>
						</div>
					</div> 
					<h5><a href="{{ route('products' , $product->id) }}">{{ $product->title }}</a></h5>
					<div class="simpleCart_shelfItem">
		@if ($product->discounted_price != NULL)
			<p><span>$ {{ $product->price }}</span> <i class="item_price">$ {{  $product->discounted_price }}</i></p>
		@else
		<p><i class="item_price">$ {{ $product->price }}</i></p>			
		@endif
						<form action="{{ route('cart') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="cmd" value="_cart" />
							<input type="hidden" name="id" value="{{ $product->id }}">		
							<input type="hidden" name="qty" value="1" /> 
							<input type="hidden" name="name" value="{{ $product->title }}"> 
							<input type="hidden" name="amount" value="{{ ($product->discounted_price != NULL) ? $product->discounted_price : $product->price }}">      
							<button type="submit" class="r-cart">Add to cart</button>
						</form>  
					</div>
				</div>




				{{-- Hide  --}}
	<div class="modal video-modal fade" id="{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $product->id }}">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
				<section>
					<div class="modal-body">
						<div class="col-md-5 modal_body_left">
							<img src="{{ asset('storage/'.$product->img_one) }}" alt="product " class="img-responsive" />
						</div>
						<div class="col-md-7 modal_body_right">
							<h4>{{ $product->title }}</h4>
							<p>{{ $product->description }}</p>
							<div class="rating">
								<div class="rating-left">
									<img src="images/star-.png" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="images/star-.png" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="images/star-.png" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="images/star.png" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="images/star.png" alt=" " class="img-responsive" />
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="modal_body_right_cart simpleCart_shelfItem">
						@if ($product->discounted_price != NULL)
							<p><span>$ {{ $product->price }}</span> <i class="item_price">$ {{  $product->discounted_price }}</i></p>
						@else
						<p><i class="item_price">$ {{ $product->price }}</i></p>			
						@endif
								<form action="{{ route('cart') }}" method="post">
									{{ csrf_field() }}
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="qty" value="1">
									<input type="hidden" name="id" value="{{ $product->id }}">
									<input type="hidden" name="name" value="{{ $product->title }}"> 
									<input type="hidden" name="amount" value="{{ ($product->discounted_price != NULL) ? $product->discounted_price : $product->price }}">     
									<button type="submit" class="r-cart">Add to cart</button>
								</form>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</section>
			</div>
		</div>
	</div>


@endforeach

				<div class="clearfix"> </div>
			</div>
		</div>



@endforeach








					</div>
				</div> 
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //banner-bottom --> 
	<!-- modal-video -->
	@foreach ($products as $product )
		



	@endforeach
	
	<!-- //modal-video -->
	<!-- banner-bottom1 -->
	<div class="banner-bottom1">
		<div class="agileinfo_banner_bottom1_grids">
			<div class="col-md-7 agileinfo_banner_bottom1_grid_left">
				<h3>Grand Opening Event With flat<span>20% <i>Discount</i></span></h3>
				<a href="products.html">Shop Now</a>
			</div>
			<div class="col-md-5 agileinfo_banner_bottom1_grid_right">
				<h4>hot deal</h4>
				<div class="timer_wrap">
					<div id="counter"> </div>
				</div>
				<script src="{{ asset('js/jquery.countdown.js') }}"></script>
				<script src="{{ asset('js/script.js') }}"></script>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //banner-bottom1 --> 
	<!-- special-deals -->
	<div class="special-deals">
		<div class="container">
			<h2>Special Deals</h2>
			<div class="w3agile_special_deals_grids">
				<div class="col-md-7 w3agile_special_deals_grid_left">
					<div class="w3agile_special_deals_grid_left_grid">
						<img src="images/21.jpg" alt=" " class="img-responsive" />
						<div class="w3agile_special_deals_grid_left_grid_pos1">
							<h5>30%<span>Off/-</span></h5>
						</div>
						<div class="w3agile_special_deals_grid_left_grid_pos">
							<h4>We Offer <span>Best Products</span></h4>
						</div>
					</div>
					<div class="wmuSlider example1">
						<div class="wmuSliderWrapper">
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="w3agile_special_deals_grid_left_grid1">
										<img src="images/t1.png" alt=" " class="img-responsive" />
										<p>Quis autem vel eum iure reprehenderit qui in ea voluptate 
											velit esse quam nihil molestiae consequatur, vel illum qui dolorem 
											eum fugiat quo voluptas nulla pariatur</p>
										<h4>Laura</h4>
									</div>
								</div>
							</article>
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="w3agile_special_deals_grid_left_grid1">
										<img src="images/t2.png" alt=" " class="img-responsive" />
										<p>Quis autem vel eum iure reprehenderit qui in ea voluptate 
											velit esse quam nihil molestiae consequatur, vel illum qui dolorem 
											eum fugiat quo voluptas nulla pariatur</p>
										<h4>Michael</h4>
									</div>
								</div>
							</article>
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="w3agile_special_deals_grid_left_grid1">
										<img src="images/t3.png" alt=" " class="img-responsive" />
										<p>Quis autem vel eum iure reprehenderit qui in ea voluptate 
											velit esse quam nihil molestiae consequatur, vel illum qui dolorem 
											eum fugiat quo voluptas nulla pariatur</p>
										<h4>Rosy</h4>
									</div>
								</div>
							</article>
						</div>
					</div>
						<script src="{{ asset('js/jquery.wmuSlider.js') }}"></script> 
						<script>
							$('.example1').wmuSlider();         
						</script> 
				</div>
				<div class="col-md-5 w3agile_special_deals_grid_right">
					<img src="images/20.jpg" alt=" " class="img-responsive" />
					<div class="w3agile_special_deals_grid_right_pos">
						<h4>Women's <span>Special</span></h4>
						<h5>save up <span>to</span> 30%</h5>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //special-deals -->
	<!-- new-products -->
	<div class="new-products">
		<div class="container">
			<h3>New Products</h3>
			<div class="agileinfo_new_products_grids">
				@foreach($products as $product)
				<div class="col-md-3 agileinfo_new_products_grid">
					<div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
						<div class="hs-wrapper hs-wrapper1">
							<img src="{{ asset('storage/'.$product->img_one) }}" alt=" " class="img-responsive" />
							@if ($product->img_two != '')
							<img src="{{ asset('storage/'.$product->img_two) }}" alt=" " class="img-responsive" />
							@endif
							@if ($product->img_three != '')
							<img src="{{ asset('storage/'.$product->img_three) }}" alt=" " class="img-responsive" />
							@endif
							<div class="w3_hs_bottom w3_hs_bottom_sub">
								<ul>
									<li>
										<a href="#product_{{ $product->id }}" data-toggle="modal" data-target="#product_{{ $product->id }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
									</li>
								</ul>
							</div>
						</div>
						<h5><a href="{{ route('products' , $product->id) }}">{{ $product->title }}</a></h5>
						<div class="simpleCart_shelfItem">
						@if ($product->discounted_price != NULL)
							<p><span>$ {{ $product->price }}</span> <i class="item_price">$ {{  $product->discounted_price }}</i></p>
						@else
						<p><i class="item_price">$ {{ $product->price }}</i></p>			
						@endif
							<form action="{{ route('cart') }}" method="post">
								{{ csrf_field() }}
								<input type="hidden" name="cmd" value="_cart">
								<input type="hidden" name="qty" value="1"> 
								<input type="hidden" name="id" value="{{ $product->id }}">
								<input type="hidden" name="name" value="{{ $product->title }}"> 
								<input type="hidden" name="amount" value="{{ ($product->discounted_price != NULL) ? $product->discounted_price : $product->price }}">     
								<button type="submit" class="r-cart">Add to cart</button>
							</form>
						</div>
					</div>
				</div>

{{-- HIDE --}}
	<div class="modal video-modal fade" id="product_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="product_{{ $product->id }}">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
				<section>
					<div class="modal-body">
						<div class="col-md-5 modal_body_left">
							<img src="{{ asset('storage/'.$product->img_one) }}" alt="product " class="img-responsive" />
						</div>
						<div class="col-md-7 modal_body_right">
							<h4>{{ $product->title }}</h4>
							<p>{{ $product->description }}</p>
							<div class="rating">
								<div class="rating-left">
									<img src="images/star-.png" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="images/star-.png" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="images/star-.png" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="images/star.png" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="images/star.png" alt=" " class="img-responsive" />
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="modal_body_right_cart simpleCart_shelfItem">
						@if ($product->discounted_price != NULL)
							<p><span>$ {{ $product->price }}</span> <i class="item_price">$ {{  $product->discounted_price }}</i></p>
						@else
						<p><i class="item_price">$ {{ $product->price }}</i></p>			
						@endif
								<form action="{{ route('cart') }}" method="post">
									{{ csrf_field() }}
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="id" value="{{ $product->id }}">
									<input type="hidden" name="qty" value="1"> 
									<input type="hidden" name="name" value="{{ $product->title }}"> 
									<input type="hidden" name="amount" value="{{ ($product->discounted_price != NULL) ? $product->discounted_price : $product->price }}">   

									<button type="submit" class="r-cart">Add to cart</button>
								</form>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</section>
			</div>
		</div>
	</div>





				@endforeach
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //new-products -->
	<!-- top-brands -->
	<div class="top-brands">
		<div class="container">
			<h3>Top Brands</h3>
			<div class="sliderfig">
				<ul id="flexiselDemo1">
					@foreach($brands as $brand)
					<li>
						<img src="{{ asset('storage/'. $brand->image_path) }}" alt=" brand" class="img-responsive" />
					</li>
					@endforeach
				</ul>
			</div>
			<script type="text/javascript">
					$(window).load(function() {
						$("#flexiselDemo1").flexisel({
							visibleItems: 5,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: { 
								portrait: { 
									changePoint:480,
									visibleItems: 1
								}, 
								landscape: { 
									changePoint:640,
									visibleItems:2
								},
								tablet: { 
									changePoint:768,
									visibleItems: 3
								}
							}
						});
						
					});
			</script>
			<script type="text/javascript" src="{{ asset('js/jquery.flexisel.js') }}"></script>
		</div>
	</div>
	<!-- //top-brands --> 
@endsection