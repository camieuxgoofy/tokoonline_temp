<!-- header start -->
<header class="header_area">
	<div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
		<!-- Classy Menu -->
		<nav class="classy-navbar" id="essenceNav">
			<!-- Logo -->
			<a class="nav-brand" href="/"><img src="essence/img/core-img/logo-hatishop.jpg" style="width: 80px;" alt=""></a>
			<!-- Navbar Toggler -->
			<div class="classy-navbar-toggler">
				<span class="navbarToggler"><span></span><span></span><span></span></span>
			</div>
			<!-- Menu -->
			<div class="classy-menu">
				<!-- close btn -->
				<div class="classycloseIcon">
					<div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
				</div>
				<!-- Nav Start -->
				<div class="classynav">
					<ul>
						<li><a href="/">Home</a>
						<li><a href="{{ url('products') }}">Shop</a>
							<div class="megamenu">
								<ul class="single-mega cn-col-4">
									<li class="title">Women's Collection</li>
									<li><a href="shop.html">Dresses</a></li>
									<li><a href="shop.html">Blouses &amp; Shirts</a></li>
									<li><a href="shop.html">T-shirts</a></li>
									<li><a href="shop.html">Rompers</a></li>
									<li><a href="shop.html">Bras &amp; Panties</a></li>
								</ul>
								<ul class="single-mega cn-col-4">
									<li class="title">Men's Collection</li>
									<li><a href="shop.html">T-Shirts</a></li>
									<li><a href="shop.html">Polo</a></li>
									<li><a href="shop.html">Shirts</a></li>
									<li><a href="shop.html">Jackets</a></li>
									<li><a href="shop.html">Trench</a></li>
								</ul>
								<ul class="single-mega cn-col-4">
									<li class="title">Kid's Collection</li>
									<li><a href="shop.html">Dresses</a></li>
									<li><a href="shop.html">Shirts</a></li>
									<li><a href="shop.html">T-shirts</a></li>
									<li><a href="shop.html">Jackets</a></li>
									<li><a href="shop.html">Trench</a></li>
								</ul>
								<div class="single-mega cn-col-4">
									<img src="essence/img/bg-img/bg-6.jpg" alt="">
								</div>
							</div>
						</li>
						<!-- <li><a href="#">Pages</a>
							<ul class="dropdown">
								<li><a href="index.html">Home</a></li>
								<li><a href="shop.html">Shop</a></li>
								<li><a href="single-product-details.html">Product Details</a></li>
								<li><a href="checkout.html">Checkout</a></li>
								<li><a href="blog.html">Blog</a></li>
								<li><a href="single-blog.html">Single Blog</a></li>
								<li><a href="regular-page.html">Regular Page</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
						</li> -->
						<li><a href="{{ url('about') }}">About</a></li>
						<li><a href="{{ url('contact') }}">Contact</a></li>
					</ul>
				</div>
				<!-- Nav End -->
			</div>
		</nav>

		<!-- Header Meta Data -->
		<div class="header-meta d-flex clearfix justify-content-end">
			<!-- Search Area -->
			<div class="search-area">
				<form action="#" method="post">
					<input type="search" name="search" id="headerSearch" placeholder="Type for search">
					<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
				</form>
			</div>
			<!-- Favourite Area -->
			<div class="favourite-area">
				<a href="#"><img src="essence/img/core-img/heart.svg" alt=""></a>
			</div>
			<!-- User Login Info -->
			@guest
			<div class="user-login-info">
				<a href="{{ url('login') }}">Login</a>
			</div>
			<div class="user-login-info">
				<a href="{{ url('register') }}">Registrasi</a>
			</div>
			@else
			<div class="user-login-info">
				<a href="{{ url('profile') }}"><img src="essence/img/core-img/user.svg" alt=""></a>
			</div>
			<div class="user-login-info">
				<a href="{{ route('logout') }}" onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
					{{ __('Logout') }}
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
				@endguest
			</div>
			<!-- Cart Area -->
			<div class="cart-area">
				<a href="{{ url('carts') }}" id="essenceCartBtn"><img src="essence/img/core-img/bag.svg" alt="">
					<span class="shop-count-furniture green">{{ \Cart::getTotalQuantity() }}</span>
				</a>
				@include('themes.ezone.partials.mini_cart')
			</div>
		</div>

	</div>
</header>
<!-- header end -->