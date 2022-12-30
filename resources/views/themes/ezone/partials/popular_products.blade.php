<!-- product area start -->
@if ($products)
<div class="popular-product-area wrapper-padding-3 pt-115 pb-115">
	<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url({{ asset('essence/img/bg-img/home-bg.png') }})">
		<div class="container-fluid">
			<div class="breadcrumb-content text-center">
				<h2>Home</h2>
				<h2>Lorem Ipsum</h2>
				<ul>
					<!-- <li><a href="#">Home</a></li> -->
				</ul>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="section-title-6 text-center pt-80 mb-50">
			<h2 class="">Popular Product</h2>
			<p class="">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
		</div>
		<div class="product-style">
			<div class="popular-product-active owl-carousel">
				@foreach ($products as $product)
				@php
				$product = $product->parent ?: $product;
				@endphp
				<div class="product-wrapper">
					<div class="product-img">
						<a href="{{ url('product/'. $product->slug) }}">
							@if ($product->productImages->first())
							<img src="{{ asset('storage/'.$product->productImages->first()->medium) }}" alt="{{ $product->name }}">
							@else
							<img src="{{ asset('themes/ezone/assets/img/product/fashion-colorful/1.jpg') }}" alt="{{ $product->name }}">
							@endif
						</a>
						<div class="product-action">
							<a class="animate-left add-to-fav" title="Wishlist" product-slug="{{ $product->slug }}" href="">
								<i class="pe-7s-like"></i>
							</a>
							<a class="animate-top add-to-card" title="Add To Cart" href="" product-id="{{ $product->id }}" product-type="{{ $product->type }}" product-slug="{{ $product->slug }}">
								<i class="pe-7s-cart"></i>
							</a>
							<a class="animate-right quick-view" title="Quick View" product-slug="{{ $product->slug }}" href="">
								<i class="pe-7s-look"></i>
							</a>
						</div>
					</div>
					<div class="funiture-product-content text-center">
						<h4><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></h4>
						<span>{{ number_format($product->priceLabel()) }}</span>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<!-- product area end -->
@endif
<style>
	.bg-top {
		background: linear-gradient(rgba(0, 0, 0, 0.7),
				rgba(0, 0, 0, 0.7)), url(essence/img/bg-img/home-bg.png);
		background-repeat: no-repeat;
		background-size: cover;
		min-height: 35vh
			/* filter: brightness(50%); */
	}
</style>