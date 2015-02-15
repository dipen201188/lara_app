<nav>
	<ul>
		@if(Auth::check())
			<li><a href="{{ URL::route('home') }}">Home</a></li>
			<li><a href="{{ URL::route('logout-account') }}">Log Out</a></li>
			<li><a href="{{ URL::route('account-change-password') }}">Change Password</a></li>
		@else
			<!--<a href="{{URL::route('login-post')}}">Login</a>
			<a href="{{ URL::route('account-create') }}">sign up</a>-->
		@endif
	</ul>
</nav>