
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">   

        <title>@yield('title')-{{ config('app.name', 'Laravel') }}</title>
		<!-- favicon section-->
		<link rel="SHORTCUT ICON" href="{{ asset('storage/about/'.$about->favicon) }}" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ asset('myfile/backend/assets/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('myfile/backend/assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

		<!-- page specific plugin styles -->
		<!--select2 section-->
		<link rel="stylesheet" href="{{ asset('myfile/backend/assets/css/select2.min.css') }}" />
		
		<!-- text fonts -->
		<link rel="stylesheet" href="{{ asset('myfile/backend/assets/css/fonts.googleapis.com.css') }}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('myfile/backend/assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('myfile/backend/assets/css/ace-skins.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('myfile/backend/assets/css/ace-rtl.min.css') }}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{ asset('myfile/backend/assets/js/ace-extra.min.js') }}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
		<style>
			.error-sms{
				color:red;
				/*font-weight:bold;*/
			}
			.required{
				color:red;
				font-weight:bold;
			}
			.row.search-section {
				margin-bottom: 15px;
			}
			/*.select2-container--default .select2-selection--single {
				background-color: #fff;
				border: 1px solid #aaa;
				/* border-radius: 4px; */
			}*/
			.fa {
				color: #337AB8!important;
			}
			.alert-success {
				background-color: #aeda9c;
				border-color: #aeda9c;
				color: #3c763d;
			}
			.alert {
				padding: 7px;
				border: 1px solid transparent;
				/*border-radius: 4px;*/
				margin-bottom:10px;
			}
		</style>
		@stack('css')
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="{{route('home')}}" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							{{$about->english_name}}
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					@include('layouts.backend.header')
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				@include('layouts.backend.sidebar')
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<!--<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<!--<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div>-->
						<!-- /.nav-search -->
					<!--</div>-->

					<div class="page-content">
					@if($message = Session::get('success'))
						<div class="alert alert-block alert-success">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							<p><i class="ace-icon fa fa-check green"></i>
							{{$message}}</p>
						</div>
					@endif
					@if($message = Session::get('warning'))
						<div class="alert alert-block alert-warning">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							<p><i class="ace-icon fa fa-check green"></i>
							{{$message}}</p>
						</div>
					@endif
					@if($message = Session::get('error'))
						<div class="alert alert-block alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							<p><i class="ace-icon fa fa-check green"></i>
							{{$message}}</p>
						</div>
					@endif		
					
						<!-- content section-->
						@yield('content')
						<!-- content section-->
						
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('layouts.backend.footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{ asset('myfile/backend/assets/js/jquery-2.1.4.min.js') }}"></script>
		

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset("assets/js/jquery.mobile.custom.min.js") }}'>"+"<"+"/script>");
		</script>
		<script src="{{ asset('myfile/backend/assets/js/bootstrap.min.js') }}"></script>

		<!-- ace scripts -->
		<script src="{{ asset('myfile/backend/assets/js/ace-elements.min.js') }}"></script>
		<script src="{{ asset('myfile/backend/assets/js/ace.min.js') }}"></script>

		<!-- select2 section-->
		<script src="{{ asset('myfile/backend/assets/js/select2.min.js') }}"></script>
		<script>
			$(document).ready(function() {
				$(".alert").delay(8000).slideUp(1000, function() {
					$(this).alert('close');
				});
			});
		</script>
		@stack('js')
	
	</body>
</html>
