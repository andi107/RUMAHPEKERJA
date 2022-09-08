<!DOCTYPE html>
<html lang="en">
<head>
	{{-- <title>Home 01</title> --}}
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png')}}"/>
    <x-corecss-component />
    {{ $titleSlot }}
</head>
<body class="animsition">
	<!-- Header -->
	<x-header-page-component />
	<!-- Content -->
	{{ $slot }}
	<!-- Footer -->
	<x-footer-page-component />
	{{ $cssPage ?? '' }}
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>
    <x-corejs-component />
	{{ $jsPage ?? '' }}
</body>
</html>