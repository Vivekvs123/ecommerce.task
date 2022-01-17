<!DOCTYPE html>
<html lang="en">

<head>
	@include('admin.includes.head')
	@yeild('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

@yield('content')

	@include('admin.includes.nav')
	@include('admin.includes.sidebar')
	
	
	
	@yeild('js')
	@include('admin.includes.footer')
	@include('admin.includes.foot')

</body>

</html>