<!-- header start -->
<header>
	<!-- Wrapper Nav -->
	<div class="header-top-furniture wrapper-padding-2 res-header-sm">
		<div class="container-fluid">
			<!-- Desktop Display -->
			<div class="header-bottom-wrapper">
				<div class="logo-2 furniture-logo">
					<a href="/">
						<img style="width: 100px;" src="{{ asset('essence/img/core-img/logo-hatishop.jpg') }}" alt="Logo">
					</a>
				</div>
				<div class="menu-style-2 furniture-menu menu-hover">
					<nav>
						<ul>
							<li><a href="/">Home</a> </li>
							<li><a href="{{ url('products') }}">Shop</a></li>
							<li><a href="{{ url('about') }}">About</a></li>
							<li><a href="{{ url('contact') }}">Contact</a></li>
						</ul>
					</nav>
				</div>
				@include('themes.ezone.partials.mini_cart')
			</div>
			<!-- End Desktop Display -->

			<!-- Mobile display -->
			<div class="row">
				<div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
					<div class="mobile-menu">
						<nav id="mobile-menu-active">
							<ul class="menu-overflow">
								<li><a href="/">Home</a> </li>
								<li><a href="{{ url('products') }}">Shop</a></li>
								<li><a href="{{ url('about') }}">About</a></li>
								<li><a href="{{ url('contact') }}">Contact</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<!-- End Mobile Display -->
		</div>
	</div>
	<!-- End Wrapper Nav -->

	<div class="header-bottom-furniture wrapper-padding-2 border-top-3">
		<div class="container-fluid">
			<div class="furniture-bottom-wrapper">
				<div class="furniture-login">
					<ul>
						@guest
						<li>Get Access: <a href="{{ url('login') }}">Login</a></li>
						<li><a href="{{ url('register') }}">Register</a></li>
						@else
						<li>Hello: <a href="{{ url('profile') }}">{{ Auth::user()->first_name }}</a></li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
						@endguest
					</ul>
				</div>
				<div class="furniture-search">
					<form action="{{ url('products') }}" method="GET">
						<input placeholder="I am Searching for . . ." type="text" name="q" value="{{ isset($q) ? $q : null }}">
						<button>
							<i class="ti-search"></i>
						</button>
					</form>
				</div>
				<div class="furniture-wishlist">
					<ul>
						<li><a href="{{ url('favorites') }}"><i class="ti-heart"></i> Favorites</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- header end -->