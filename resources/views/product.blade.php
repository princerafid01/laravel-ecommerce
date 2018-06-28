@extends('master')
@section('main_content')


	<!-- banner -->
	<div class="banner banner10">
		<div class="container">
			<h2>{{ $product->title }}</h2>
		</div>
	</div>
	<!-- //banner -->   
	<!-- breadcrumbs -->
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<li><a href="{{ route('index') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
				<li>{{ $product->title }}</li>
			</ul>
		</div>
	</div>
	<!-- //breadcrumbs -->  
	<!-- single -->
	<div class="single">
		<div class="container">
			<div class="col-md-4 single-left">
				<div class="flexslider">
					<ul class="slides">
						<li data-thumb="{{ asset('storage/'.$product->img_one) }}">
							<div class="thumb-image"> <img src="{{ asset('storage/'.$product->img_one) }}" data-imagezoom="true" class="img-responsive" alt=""> </div>
						</li>
						@if($product->img_two != '')
						<li data-thumb="{{ asset('storage/'.$product->img_two) }}">
							 <div class="thumb-image"> <img src="{{ asset('storage/'.$product->img_two) }}" data-imagezoom="true" class="img-responsive" alt=""> </div>
						</li>
						@endif
						@if($product->img_three != '')
						<li data-thumb="{{ asset('storage/'.$product->img_three) }}">
						   <div class="thumb-image"> <img src="{{ asset('storage/'.$product->img_three) }}" data-imagezoom="true" class="img-responsive" alt=""> </div>
						</li>
						@endif 
					</ul>
				</div>
				<!-- flexslider -->
					<script defer src="{{ asset('js/jquery.flexslider.js') }}"></script>
					<link rel="stylesheet" href="{{ asset('css/flexslider.css') }}" type="text/css" media="screen" />
					<script>
					// Can also be used with $(document).ready()
					$(window).load(function() {
					  $('.flexslider').flexslider({
						animation: "slide",
						controlNav: "thumbnails"
					  });
					});
					</script>
				<!-- flexslider -->
				<!-- zooming-effect -->
					<script src="{{ asset('js/imagezoom.js') }}"></script>
				<!-- //zooming-effect -->
			</div>
			<div class="col-md-8 single-right">
				<h3>{{ $product->title }}</h3>
				<div class="rating1">
					<span class="starRating">
						<input id="rating5" type="radio" name="rating" value="5">
						<label for="rating5">5</label>
						<input id="rating4" type="radio" name="rating" value="4">
						<label for="rating4">4</label>
						<input id="rating3" type="radio" name="rating" value="3" checked>
						<label for="rating3">3</label>
						<input id="rating2" type="radio" name="rating" value="2">
						<label for="rating2">2</label>
						<input id="rating1" type="radio" name="rating" value="1">
						<label for="rating1">1</label>
					</span>
				</div>
				<div class="description">
					<h5><i>Description</i></h5>
					<p>{{ $product->description }}</p>
					<br>
					<h5>Category : {{ $product->category->category_name }}</h5><br>
					<h5>Brand : {{ $product->brand->name }}</h5>
				</div>
				<div class="color-quality">
					<div class="color-quality-right">
						<h5>Quantity :</h5>
						 <div class="quantity"> 
							<div class="quantity-select">
								<?php $item = Cart::content()->first(); ?>
								@if($item != Null)				
								<form method="POST" action="{{ route('cart.update') }}">
                                    {{ csrf_field() }} 			                      
								
								<a class="cart_quantity_up" href='{{ route('cart.update.decrease', [$item->rowId , $item->qty]) }}'><div class="entry value-minus1">&nbsp;</div></a>
								
                                <input type="hidden" name="rowId" value="{{ $item->rowId}}">								
								<input type="text" name="qty" value='{{ $item->qty }}'>
															
								<a class="cart_quantity_down" href='{{ route('cart.update.increase', [$item->rowId , $item->qty]) }}'>
									<div class="entry value-plus1 active">&nbsp;</div>
								</a>
								<input type="submit" value="Update">
								
								</form>
								@else
								Not yet added to cart
								@endif
							</div>
						</div>
						<!--quantity-->
								<script>
								$('.value-plus1').on('click', function(){
									var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10)+1;
									divUpd.text(newVal);
								});

								$('.value-minus1').on('click', function(){
									var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10)-1;
									if(newVal>=1) divUpd.text(newVal);
								});
								</script>
							<!--quantity-->

					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="occasional">
				
				<div class="simpleCart_shelfItem">
					@if($product->discounted_price != NULL)
					<h3>Price</h3>
					<p><span>$ {{ $product->price }}</span> <i class="item_price">$ {{ $product->discounted_price }}</i></p>
					@else
					<h3>Price</h3>					
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
	</div> 
	<div class="additional_info">
		<div class="container">
			<div class="sap_tabs">	
				<div id="horizontalTab1" style="display: block; width: 100%; margin: 0px;">
					<ul>
						<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Product Information</span></li>
						<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Reviews</span></li>
					</ul>		
					<div class="tab-1 resp-tab-content additional_info_grid" aria-labelledby="tab_item-0">
						<h3>{{ $product->title }}</h3>
						<p>{{ $product->description }}</p>
					</div>	

					<div class="tab-2 resp-tab-content additional_info_grid" aria-labelledby="tab_item-1">
						<h4>(2) Reviews</h4>
						<div class="additional_info_sub_grids">
							<div class="col-xs-2 additional_info_sub_grid_left">
								<img src="images/t1.png" alt=" " class="img-responsive" />
							</div>
							<div class="col-xs-10 additional_info_sub_grid_right">
								<div class="additional_info_sub_grid_rightl">
									<a href="single.html">Laura</a>
									<h5>Oct 06, 2016.</h5>
									<p>Quis autem vel eum iure reprehenderit qui in ea voluptate 
										velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat 
										quo voluptas nulla pariatur.</p>
								</div>
								<div class="additional_info_sub_grid_rightr">
									<div class="rating">
										<div class="rating-left">
											<img src="images/star-.png" alt=" " class="img-responsive">
										</div>
										<div class="rating-left">
											<img src="images/star-.png" alt=" " class="img-responsive">
										</div>
										<div class="rating-left">
											<img src="images/star-.png" alt=" " class="img-responsive">
										</div>
										<div class="rating-left">
											<img src="images/star.png" alt=" " class="img-responsive">
										</div>
										<div class="rating-left">
											<img src="images/star.png" alt=" " class="img-responsive">
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="additional_info_sub_grids">
							<div class="col-xs-2 additional_info_sub_grid_left">
								<img src="images/t2.png" alt=" " class="img-responsive" />
							</div>
							<div class="col-xs-10 additional_info_sub_grid_right">
								<div class="additional_info_sub_grid_rightl">
									<a href="single.html">Michael</a>
									<h5>Oct 04, 2016.</h5>
									<p>Quis autem vel eum iure reprehenderit qui in ea voluptate 
										velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat 
										quo voluptas nulla pariatur.</p>
								</div>
								<div class="additional_info_sub_grid_rightr">
									<div class="rating">
										<div class="rating-left">
											<img src="images/star-.png" alt=" " class="img-responsive">
										</div>
										<div class="rating-left">
											<img src="images/star-.png" alt=" " class="img-responsive">
										</div>
										<div class="rating-left">
											<img src="images/star.png" alt=" " class="img-responsive">
										</div>
										<div class="rating-left">
											<img src="images/star.png" alt=" " class="img-responsive">
										</div>
										<div class="rating-left">
											<img src="images/star.png" alt=" " class="img-responsive">
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="review_grids">
							<h5>Add A Review</h5>
							<form action="#" method="post">
								<input type="text" name="Name" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
								<input type="email" name="Email" placeholder="Email" required="">
								<input type="text" name="Telephone" value="Telephone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Telephone';}" required="">
								<textarea name="Review" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Add Your Review';}" required="">Add Your Review</textarea>
								<input type="submit" value="Submit" >
							</form>
						</div>
					</div> 			        					            	      
				</div>	
			</div>
			<script src="{{ asset('js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
			<script type="text/javascript">
				$(document).ready(function () {
					$('#horizontalTab1').easyResponsiveTabs({
						type: 'default', //Types: default, vertical, accordion           
						width: 'auto', //auto or any width like 600px
						fit: true   // 100% fit in a container
					});
				});
			</script>
		</div>
	</div>
	<!-- Related Products -->
	<div class="w3l_related_products">
		<div class="container">
			<h3>Related Products</h3>
			<ul id="flexiselDemo2">					
			@foreach($category->products as $cat_product)				
			@if($product->category_id == $cat_product->category_id)

				<li>
					<div class="w3l_related_products_grid">
						<div class="agile_ecommerce_tab_left mobiles_grid">
							<div class="hs-wrapper hs-wrapper3">
							<img src="{{ asset('storage/'.$cat_product->img_one) }}" alt=" " class="img-responsive" />
							@if ($cat_product->img_two != '')
							<img src="{{ asset('storage/'.$cat_product->img_two) }}" alt=" " class="img-responsive" />
							@endif
							@if ($cat_product->img_three != '')
							<img src="{{ asset('storage/'.$cat_product->img_three) }}" alt=" " class="img-responsive" />
							@endif
								<div class="w3_hs_bottom">
									<div class="flex_ecommerce">
										<a href="#" data-toggle="modal" data-target="#{{ $cat_product->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
									</div>
								</div>
							</div>
							<h5><a href="{{ route('products' , $cat_product->id) }}">{{ $cat_product->title }}</a></h5>
							<div class="simpleCart_shelfItem"> 
						@if ($cat_product->discounted_price != NULL)
							<p><span>$ {{ $cat_product->price }}</span> <i class="item_price">$ {{  $cat_product->discounted_price }}</i></p>
						@else
						<p><i class="item_price">$ {{ $cat_product->price }}</i></p>			
						@endif
								<form action="{{ route('cart') }}" method="post">
									{{ csrf_field() }}
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="qty" value="1">
									<input type="hidden" name="id" value="{{ $cat_product->id }}">
									<input type="hidden" name="name" value="{{ $cat_product->title }}"> 
									<input type="hidden" name="amount" value="{{ ($cat_product->discounted_price != NULL) ? $cat_product->discounted_price : $cat_product->price }}">     
									<button type="submit" class="r-cart">Add to cart</button>
								</form> 
							</div>
						</div>
					</div>
				</li>
			@endif
			@endforeach
			

			</ul>
			
				<script type="text/javascript">
					$(window).load(function() {
						$("#flexiselDemo2").flexisel({
							visibleItems:3,
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


	<!-- //Related Products -->
@foreach($category->products as $cat_product)				
@if($product->category_id == $cat_product->category_id)

	<div class="modal video-modal fade" id="{{ $cat_product->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $cat_product->id }}">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
				<section>
					<div class="modal-body">
						<div class="col-md-5 modal_body_left">
							<img src="{{ asset('storage/'. $cat_product->img_one) }}" alt=" " class="img-responsive" />
						</div>
						<div class="col-md-7 modal_body_right">
							<h4>{{ $cat_product->title }}</h4>
							<p>{{ $cat_product->description }}</p>
							<div class="rating">
								<div class="rating-left">
									<img src="{{ asset('images/star-.png') }}" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="{{ asset('images/star-.png') }}" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="{{ asset('images/star-.png') }}" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="{{ asset('images/star.png') }}" alt=" " class="img-responsive" />
								</div>
								<div class="rating-left">
									<img src="{{ asset('images/star.png') }}" alt=" " class="img-responsive" />
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
							<input type="hidden" name="cmd" value="_cart" />
							<input type="hidden" name="id" value="{{ $product->id }}">		
							<input type="hidden" name="qty" value="1" /> 
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

@endif
@endforeach

 




@endsection