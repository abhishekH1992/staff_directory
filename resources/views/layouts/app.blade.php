<!DOCTYPE html>
<html lang="en">

<head>

	<title>Staff Directory | @yield('title')</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/fonts.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/custom.css"/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="{{url('/')}}/assets/js/jquery.min.js"></script>
    <script src="{{url('/')}}/assets/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/assets/js/custom.js"></script>

</head>

@yield('content')

</html>
