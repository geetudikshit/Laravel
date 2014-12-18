<!doctype html>
<html lang="en">
<head>
	@include('includes.admin_head')
</head>
<body class="login-page login-form-fall" data-url="http://neon.dev">
<div class="login-container">
	@include('includes.admin_login_header')
	
	@yield('content')
	
</div>
	@include('includes.admin_login_footer')
</body>
</html>