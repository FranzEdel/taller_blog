<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>{{ config('app.name') }}</title>
	<link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('css/framework.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
</head>
<body>
    
<div class="preload"></div>
	<header class="space-inter">
		<div class="container container-flex space-between">
			<figure class="logo"><img src="{{ asset('img/logo.png') }}" alt=""></figure>
			<nav class="custom-wrapper" id="menu">
				<div class="pure-menu"></div>
				<ul class="container-flex list-unstyled">
					<li><a href="{{ route('blog') }}" class="text-uppercase">Home</a></li>
					<li><a href="#" class="text-uppercase">About</a></li>
					<li><a href="#" class="text-uppercase">Archive</a></li>
					<li><a href="#" class="text-uppercase">Contact</a></li>
					@guest
					<li><a href="{{ route('login') }}" class="text-uppercase">Login</a></li>
					@else
					<li><a href="{{ route('dashboard') }}" class="text-uppercase">Administracion</a></li>
					<li><a href="{{ route('logout') }}" class="text-uppercase">Cerrar Sesion</a></li>
					@endguest 
					
				</ul>
			</nav>
		</div>
	</header>

	@yield('content')

	<div class="pagination">
		<ul class="list-unstyled container-flex space-center">
			<li><a href="#" class="pagination-active">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
		</ul>
	</div>

	<section class="footer">
		<footer>
			<div class="container">
				<figure class="logo"><img src="{{ asset('img/logo.png') }}" alt=""></figure>
				<nav>
					<ul class="container-flex space-center list-unstyled">
						<li><a href="{{ route('blog') }}" class="text-uppercase c-white">home</a></li>
						<li><a href="#" class="text-uppercase c-white">about</a></li>
						<li><a href="#" class="text-uppercase c-white">archive</a></li>
						<li><a href="#" class="text-uppercase c-white">contact</a></li>
						<li><a href="{{ route('login') }}" class="text-uppercase c-white">Login</a></li>
					</ul>
				</nav>
				<div class="divider-2"></div>
				<p>Nunc placerat dolor at lectus hendrerit dignissim. Ut tortor sem, consectetur nec hendrerit ut, ullamcorper ac odio. Donec viverra ligula at quam tincidunt imperdiet. Nulla mattis tincidunt auctor.</p>
				<div class="divider-2" style="width: 80%;"></div>
				<p>© 2017 - Zendero. All Rights Reserved. Designed & Developed by <span class="c-white">Agencia De La Web</span></p>
				<ul class="social-media-footer list-unstyled">
					<li><a href="#" class="fb"></a></li>
					<li><a href="#" class="tw"></a></li>
					<li><a href="#" class="in"></a></li>
					<li><a href="#" class="pn"></a></li>
				</ul>
			</div>
		</footer>
	</section>
</body>
</html>