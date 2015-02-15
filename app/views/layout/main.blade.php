<!DOCTYPE html>
<html>
	<head>
		<title>Authentication System</title>
		<!--  Dependencies -->
		<!--  CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<!--  CSS -->
		<!-- js -->
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<!-- js -->
		<!--  Dependencies -->

	</head>
	<body>
		<div class="wrap">
			<div class="bar-header">
				<div class="logo-bar"></div>
			</div>
			<div class="container">
			@if (Session::has('global'))
				<p>{{Session::get('global');}}
			@endif

			@yield('content')
			</div>
		</div>
	</body>
</html>	

