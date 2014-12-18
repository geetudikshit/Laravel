<!doctype html>
<html lang="en">
<head>
	@include('includes.admin_head')
</head>
<body class="page-body" data-url="http://neon.dev">
<div class="page-container">
	@include('includes.admin_menu')
	@include('includes.admin_header')
	

	
	@yield('content')

	
	
	@include('includes.admin_footer')
</div>
	@include('includes.admin_footer_extra')
	


</body>
</html>