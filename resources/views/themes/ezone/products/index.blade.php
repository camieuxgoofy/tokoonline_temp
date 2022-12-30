@extends('themes.ezone.layout')

@section('content')
<div class="popular-product-area wrapper-padding-3 pt-115 pb-115">
	<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url({{ asset('essence/img/bg-img/blog5.jpg') }})">
		<div class="container-fluid">
			<div class="breadcrumb-content text-center">
				<h2>Products</h2>
				<ul>
					<li><a class="no-content" href="#">Home</a></li>
					<li>Products</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="shop-page-wrapper shop-page-padding ptb-100">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					@include('themes.ezone.products.sidebar')
				</div>
				<div class="col-lg-9">
					<div class="shop-product-wrapper res-xl">
						<div class="shop-bar-area">
							<div class="shop-bar pb-60">
								<div class="shop-found-selector">
									<div class="shop-found">
										<p><span>{{ count($products) }}</span> Product Found of <span>{{ $products->total() }}</span></p>
									</div>
									<div class="shop-selector">
										<label>Sort By : </label>
										{{ Form::select('sort', $sorts , $selectedSort ,array('onChange' => 'this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);')) }}
									</div>
								</div>
								<div class="shop-filter-tab">
									<div class="shop-tab nav" role=tablist>
										<a class="active" href="#grid-sidebar3" data-toggle="tab" role="tab" aria-selected="false">
											<i class="ti-layout-grid4-alt"></i>
										</a>
										<a href="#grid-sidebar4" data-toggle="tab" role="tab" aria-selected="true">
											<i class="ti-menu"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="shop-product-content tab-content">
								<div id="grid-sidebar3" class="tab-pane fade active show">
									@include('themes.ezone.products.grid_view')
								</div>
								<div id="grid-sidebar4" class="tab-pane fade">
									@include('themes.ezone.products.list_view')
								</div>
							</div>
						</div>
					</div>
					<div class="mt-50 text-center">
						{{ $products->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection