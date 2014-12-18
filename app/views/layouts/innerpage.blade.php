<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"> <![endif]-->
<!--[if lte IE 8 ]><html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="ie9" lang="en"> <!--<![endif]-->
<head>
	@include('includes.head')
</head>
<body>
<div class="container">
	@include('includes.header')
	@yield('content')
    @include('includes.footer')	
</div>
</body>
</html>