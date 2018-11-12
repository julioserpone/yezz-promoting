{{-- Content Header (Page header) --}}

	<!--breadcrumbs start-->
	<div id="breadcrumbs-wrapper">
		<!-- Search for small screen -->
		<!--<div class="header-search-wrapper grey hide-on-large-only">
			<i class="mdi-action-search active"></i>
			<input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore">
		</div>-->
		<div class="container">
			<div class="row">
				<div class="col s12 m12 l12">
					<h5 class="breadcrumbs-title">
						@yield('contentheader_title', trans('globals.contentheader_title'))
					</h5>
					<ol class="breadcrumbs">
						<li><a href="/home"><i class="fa fa-home"></i>&nbsp;{{ trans('globals.sections.home') }}</a></li>
						@section('breadcrumb_li')
							<!-- Example <li class="active">Blank Page</li> -->
	        			@show
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!--breadcrumbs end-->


