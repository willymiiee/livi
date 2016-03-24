<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>@yield('header') | LIVI</title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="{{ asset('fonts/fonts.googleapis.com.css') }}" />

	<!-- ace styles -->
	<link rel="stylesheet" href="{{ asset('css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

	<!--[if lte IE 9]>
		<link rel="stylesheet" href="{{ asset('css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
	<![endif]-->

	<!--[if lte IE 9]>
	  <link rel="stylesheet" href="{{ asset('css/ace-ie.min.css') }}" />
	<![endif]-->

	<!-- inline styles related to this page -->

	<!-- ace settings handler -->
	<script src="{{ asset('js/ace-extra.min.js') }}"></script>

	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
	<script src="{{ asset('js/html5shiv.min.js') }}"></script>
	<script src="{{ asset('js/respond.min.js') }}"></script>
	<![endif]-->
</head>
<body class="no-skin">

	<div id="navbar" class="navbar navbar-default">
		<script type="text/javascript">
			try{ace.settings.check('navbar' , 'fixed')}catch(e){}
		</script>

		<div class="navbar-container" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>
			</button>

			<div class="navbar-header pull-left">
				<a href="#" class="navbar-brand">
					<small>
						<img src="{{ asset('images/logo-white.png') }}" height="22px">
					</small>
				</a>
			</div>

			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="light-blue">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<span class="user-info">
								<small>Welcome,</small>
								{{ Auth::user()->name }}
							</span>

							<i class="ace-icon fa fa-caret-down"></i>
						</a>

						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li>
								<a href="profile.html">
									<i class="ace-icon fa fa-user"></i>
									Profile
								</a>
							</li>

							<li class="divider"></li>

							<li>
								<a href="{{ url('/logout') }}">
									<i class="ace-icon fa fa-power-off"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.navbar-container -->
	</div>

	<div class="main-container" id="main-container">
		<script type="text/javascript">
			try{ace.settings.check('main-container' , 'fixed')}catch(e){}
		</script>

		<div id="sidebar" class="sidebar responsive">
			<script type="text/javascript">
				try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
			</script>

			<ul class="nav nav-list">
				<li class="{{ Request::segment(1) == 'home' ? 'active' : '' }}">
					<a href="{{ url('/home') }}">
						<i class="menu-icon fa fa-tachometer"></i>
						<span class="menu-text"> Dashboard </span>
					</a>

					<b class="arrow"></b>
				</li>

				@foreach ($menu as $head)
				<li class="{{ ucfirst(Request::segment(1)) == $head['name'] ? 'active open' : '' }}">
					<a href="{{ url($head['url']) }}" class="{{ $head['url'] == '#' ? 'dropdown-toggle' : '' }}">
						<i class="menu-icon fa {{ $head['icon'] }}"></i>
						<span class="menu-text"> {{ $head['name'] }} </span>

						@if ($head['url'] == '#')
						<b class="arrow fa fa-angle-down"></b>
						@endif
					</a>

					<b class="arrow"></b>

					@if (!empty($head['child']))
					<ul class="submenu">
						@foreach ($head['child'] as $child)
						<li class="{{ ucfirst(Request::segment(2)) == $child['name'] ? 'active' : '' }}">
							<a href="{{ url($child['url']) }}">
								<i class="menu-icon fa fa-caret-right"></i>
								{{ $child['name'] }}
							</a>

							<b class="arrow"></b>
						</li>
						@endforeach
					</ul>
					@endif
				</li>
				@endforeach
			</ul><!-- /.nav-list -->

			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
				<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>

			<script type="text/javascript">
				try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
			</script>
		</div>

		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-content">
					<div class="page-header">
						<h1>@yield('header')</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							@yield('content')
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

		<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<span class="bigger-120">
						<span class="blue bolder">Livi</span>
						&copy; 2015-{{ date('Y') }}
					</span>
				</div>
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

	<!-- basic scripts -->

	<!--[if !IE]> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<!-- <![endif]-->

	<!--[if IE]>
	<script src="{{ asset('js/jquery.1.11.1.min.js') }}"></script>
	<![endif]-->

	<!--[if !IE]> -->
	<script type="text/javascript">
		window.jQuery || document.write("<script src='{{ asset('js/jquery.min.js') }}'>"+"<"+"/script>");
	</script>

	<!-- <![endif]-->

	<!--[if IE]>
	<script type="text/javascript">
	 window.jQuery || document.write("<script src='{{ asset('js/jquery1x.min.js') }}'>"+"<"+"/script>");
	</script>
	<![endif]-->

	<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
	</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<!-- page specific plugin scripts -->

	<!--[if lte IE 8]>
	  <script src="{{ asset('js/excanvas.min.js') }}"></script>
	<![endif]-->
	<script src="{{ asset('js/jquery-ui.custom.min.js') }}"></script>
	<script src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- ace scripts -->
	<script src="{{ asset('js/ace-elements.min.js') }}"></script>
	<script src="{{ asset('js/ace.min.js') }}"></script>

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
	</script>
</body>
</html>