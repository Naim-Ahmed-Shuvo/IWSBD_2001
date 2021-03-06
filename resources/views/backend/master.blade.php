<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bootstrap Dashboard by Bootstrapious.com</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="{{url('/')}}/backend-assets/vendor/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" href="{{url('/')}}/backend-assets/vendor/font-awesome/css/font-awesome.min.css">
	<!-- Fontastic Custom icon font-->
	<link rel="stylesheet" href="{{url('/')}}/backend-assets/css/fontastic.css">
	<!-- Google fonts - Roboto -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<!-- jQuery Circle-->
	<link rel="stylesheet" href="{{url('/')}}/backend-assets/css/grasp_mobile_progress_circle-1.0.0.min.css">
	<!-- Custom Scrollbar-->
	<link rel="stylesheet" href="{{url('/')}}/backend-assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
	<!-- theme stylesheet-->
	<link rel="stylesheet" href="{{url('/')}}/backend-assets/css/style.default.css" id="theme-stylesheet">
	<!-- Custom stylesheet - for your changes-->
	<link rel="stylesheet" href="{{url('/')}}/backend-assets/css/custom.css">
	<!-- Favicon-->
	<link rel="shortcut icon" href="{{url('/')}}/backend-assets/img/favicon.ico">

	<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


</head>

<body>
	<!-- Side Navbar -->
	<nav class="side-navbar">
		<div class="side-navbar-wrapper">
			<!-- Sidebar Header    -->
			<div class="sidenav-header d-flex align-items-center justify-content-center">
				<!-- User Info-->
				<div class="sidenav-header-inner text-center">
                    {{-- <img src="img/avatar-7.jpg"  class="img-fluid rounded-circle"> --}}
					<h2 class="h5">{{Auth::user()->name}}</h2><span>{{Auth::user()->user_type}}</span>
				</div>
				<!-- Small Brand information, appears on minimized sidebar-->
				<div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
			</div>
			<!-- Sidebar Navigation Menus-->
			<div class="main-menu">
                <h5 class="sidenav-heading">Main</h5>

                {{-- menus for admin --}}
                @if (Auth::user()->user_type == 'admin')
                <ul id="side-main-menu" class="side-menu list-unstyled">
					<!-- <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Manage Category </a>
						<ul id="exampledropdownDropdown" class="collapse list-unstyled ">
							<li><a href="#">Niew Category</a></li>
							<li><a href="#">view Category</a></li>

						</ul>
					</li> -->
					<li><a href="{{url('/home')}}"> <i class="icon-form"></i>Dash Board </a></li>
					<li><a href="{{url('category/backend/page')}}"> <i class="icon-home"></i>Manage Category </a>
					<li><a href="{{url('subcategory/backend/page')}}"><i class="fas fa-boxes"></i>Sub Category </a>
					</li>
					<li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i> Product </a>
						<ul id="exampledropdownDropdown" class="collapse list-unstyled ">
							<li><a href="{{url('add/product')}}">Add Product</a></li>
							<li><a href="{{url('view/product')}}">View Product</a></li>

						</ul>
					</li>



					<li><a href="{{url('add/slider')}}"> <i class="icon-form"></i>Add Slider </a></li>
					<li><a href="{{url('view/slider')}}"> <i class="fa fa-bar-chart"></i>View Slider </a></li>

                    <li><a href="{{url('backend/contact/us')}}"> <i class="icon-grid"></i>Contact Us </a></li>

                    <!-- Example split danger button -->

                    <li>
                        <a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"><i class="fas fa-fan"></i> Order Management </a>
						<ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
							<li><a class="dropdown-item" href="{{url('/pending_orders')}}">Pending Orders</a></li>
							<li><a class="dropdown-item" href="{{url('/complete_orders')}}"> Complete Orders</a></li>
							<li> <a class="dropdown-item" href="{{url('/decline_orders')}}"> Decline Orders</a></li>

						</ul>
					</li>
                    <li><a href="#exampledropdownDropdown5" aria-expanded="false" data-toggle="collapse"><i class="fas fa-cog"></i> General Settings </a>
						<ul id="exampledropdownDropdown5" class="collapse list-unstyled ">
							<li><a class="dropdown-item" href="{{url('/shipping_method')}}">Shipping Method</a></li>
							<li><a class="dropdown-item" href="{{url('/packaging')}}"> Packaging</a></li>
							<li> <a class="dropdown-item" href="{{url('/pick_up_location')}}"> Pick Up Location</a></li>

						</ul>
					</li>


					<li><a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse"><i class="fas fa-cog"></i> Home Page Settings </a>
						<ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
							<li><a href="{{url('add/product')}}"><i class="fas fa-circle mr-2"></i> Pending Orders</a></li>
							<li><a href="{{url('view/product')}}"><i class="fas fa-circle mr-2"></i> Processing Orders</a></li>
							<li><a href="{{url('view/product')}}"><i class="fas fa-circle mr-2"></i> Decline Orders</a></li>

						</ul>
					</li>
					<li>
                        <a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"><i class="fas fa-dollar-sign"></i>  Payment Gateways </a>
						<ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
							<li><a href="{{url('add/product')}}"><i class="fas fa-circle mr-2"></i> Stripe</a></li>
							<li><a href="{{url('view/product')}}"><i class="fas fa-circle mr-2"></i> SSL</a></li>
							<li><a href="{{url('view/product')}}"><i class="fas fa-circle mr-2"></i> Bkash</a></li>
							<li><a href="{{url('view/product')}}"><i class="fas fa-circle mr-2"></i> Nagad</a></li>

						</ul>
					</li>
					<li><a href="{{url('/manage_stuff')}}" aria-expanded="false" ><i class="fas fa-users-cog"></i> Manage Stuff </a>

					</li>

                </ul>


                @endif

                {{-- menus for stuff --}}

                @if (Auth::user()->user_type == 'stuff')
                    <ul id="side-main-menu" class="side-menu list-unstyled">
                        <li><a href="{{url('/stuff_profile')}}" aria-expanded="false" ><i class="fas fa-users-cog"></i> Stuff Profile</a>
                        <li>
                            <a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"><i class="fas fa-fan"></i> Order Management </a>
                            <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                                <li><a class="dropdown-item" href="{{url('/pending_orders')}}">Pending Orders</a></li>
                                <li><a class="dropdown-item" href="{{url('/complete_orders')}}"> Complete Orders</a></li>
                                <li> <a class="dropdown-item" href="{{url('/decline_orders')}}"> Decline Orders</a></li>

                            </ul>
                        </li>

                        <li>
                            <a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"><i class="fas fa-dollar-sign"></i>  Payment Gateways </a>
                            <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                                <li><a href="{{url('add/product')}}"><i class="fas fa-circle mr-2"></i> Stripe</a></li>
                                <li><a href="{{url('view/product')}}"><i class="fas fa-circle mr-2"></i> SSL</a></li>
                                <li><a href="{{url('view/product')}}"><i class="fas fa-circle mr-2"></i> Bkash</a></li>
                                <li><a href="{{url('view/product')}}"><i class="fas fa-circle mr-2"></i> Nagad</a></li>

                            </ul>
                        </li>
                    </ul>
                @endif
			</div>

		</div>
	</nav>
	<div class="page">
		<!-- navbar-->
		<header class="header">
			<nav class="navbar">
				<div class="container-fluid">
					<div class="navbar-holder d-flex align-items-center justify-content-between">
						<div class="navbar-header">><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i><a href="{{url('/home')}}" class="navbar-brand">
								<div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Dashboard</strong></div>
							</a></div>
						<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

							<!-- Log out-->
							<li class="nav-item"><a href="login.html" class="nav-link logout">
								 <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}<i class="fas fa-sign-out-alt ml-1"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
							<!--  <span class="d-none d-sm-inline-block">Logout</span> -->
							<!--  <i class="fa fa-sign-out"></i></a></li> -->
						</ul>
					</div>
				</div>
			</nav>
		</header>



                @yield('content')




		<footer class="main-footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<p>Your company &copy; 2017-2019</p>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- JavaScript files-->
	<script src="{{url('/')}}/backend-assets/vendor/jquery/jquery.min.js"></script>
	<script src="{{url('/')}}/backend-assets/vendor/popper.js/umd/popper.min.js"> </script>
	<script src="{{url('/')}}/backend-assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{url('/')}}/backend-assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
	<script src="{{url('/')}}/backend-assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
	<script src="{{url('/')}}/backend-assets/vendor/chart.js/Chart.min.js"></script>
	<script src="{{url('/')}}/backend-assets/vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="{{url('/')}}/backend-assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="{{url('/')}}/backend-assets/js/charts-home.js"></script>
	<!-- Main File-->
	<script src="{{url('/')}}/backend-assets/js/front.js"></script>
	<script src="https://kit.fontawesome.com/c218529370.js"></script>

	  @yield('footer_js')

	<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}

    @stack('js')
</body>

</html>
