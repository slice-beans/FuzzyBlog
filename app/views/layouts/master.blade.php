<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	@yield('meta')
	<title> @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="/css/main.min.css">
	@yield('styles')
</head>
<body class=" @yield('bodyclass') ">
@yield('main')
<script src="/js/main.min.js"></script>
@yield('scripts')
</body>
</html>