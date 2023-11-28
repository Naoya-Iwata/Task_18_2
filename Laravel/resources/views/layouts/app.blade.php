<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title') | {{ config('app.name') }}</title>
	<meta name="robots" content="noindex">

	@if(Request::routeIs('login'))

	<meta name="description" content="{{ config('app.description') }}のログインページ">

	@elseif(Request::routeIs('register'))

	<meta name="description" content="{{ config('app.description') }}のユーザー登録ページ">

	@elseif(Request::routeIs('index'))

	<meta name="description" content="{{ config('app.description') }}の投稿楽曲一覧">

	@elseif(Request::routeIs('search.index'))

	<meta name="description" content="{{ config('app.description') }}の楽曲検索結果">

	@elseif(Request::routeIs('updateForm'))

	<meta name="description" content="{{ config('app.description') }}の楽曲更新ページ">

	@elseif(Request::routeIs('createForm'))

	<meta name="description" content="{{ config('app.description') }}の楽曲投稿ページ">

	@endif

	<!-- Favicon -->
	<link rel="icon alternate" href="{{ asset ('img/materials/fav_dog.ico')}}">
	<link rel="apple-touch-icon" href="{{ asset ('img/materials/fav_dog.png')}}" type="image/png">

	<!-- Scripts -->
	<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

	<!-- Fonts -->
	<!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">

	<!-- Styles -->
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- スワイパーCSS読み込み -->
	@if(Request::routeIs('index') || Request::routeIs('search.index'))

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.1.5/swiper-bundle.min.css">

	@endif

	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

	<header class="header wrapper">

		<a href="{{ route('index') }}">
			<img class="header-logo" src="{{ asset('img/materials/logo_fix.png')}}" alt="ヘッダーロゴ"></a>
		<button class="hbg-btn" aria-label="メニューを開きます">
			<span></span>
			<p id="hbg-text" class="hbg-text">MENU</p>
		</button>

		<nav class="gnav">
			<ul>
				<li class="nav-item"><a href="{{ route('index') }}">
						<img class="header-logo" src="{{ asset('img/materials/logo_fix.png')}}" alt="ヘッダーロゴ">
					</a></li>
				<li class="nav-item"><a href="ranking.php">
						<p>ランキング</p>
						<p>ranking</p>
					</a></li>
				<li class="nav-item"><a href="music.php">
						<p>アーカイブ</p>
						<p>music archive</p>
					</a></li>
				<li class="nav-item"><a href="donation.php">
						<p>楽曲提供</p>
						<p>music donation</p>
					</a></li>

				<!-- Authentication Links -->
				@guest
				@if (Route::has('login'))
				<li class="nav-item"><a href="{{ route('login') }}">
						<p><i class="fa-solid fa-user"></i>{{ __('Login')}}</p>
						<p>login</p>
					</a></li>
				@endif

				@else
				<li class="nav-item">

					<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
							<p><i class="fa-solid fa-user"></i>{{ __('Logout') }}</p>
							<p>logout</p>
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
				</li>
				@endguest

			</ul>
		</nav>

	</header>

	<div id="app">
		<!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
			<div class="container">
				<a class="navbar-brand" href="{{ 'index' }}">
					{{ config('app.name') }}
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
		<!-- Left Side Of Navbar -->
		<!-- <ul class="navbar-nav me-auto">

					</ul>-->
		<!-- Right Side Of Navbar -->
		<!-- <ul class="navbar-nav ms-auto"> -->
		<!-- Authentication Links -->
		<!-- @guest
						@if (Route::has('login'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@endif

						@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
						</li>
						@endif
						@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }}
							</a>

							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav> -->


		@yield('content')


	</div>

	<button type="button" class="page-top hide" aria-label="ページトップへスクロールします"></button>

	<footer class="footer">

		@if(Request::routeIs('register'))
		@else
		<p class="contact-us"><a href="{{ route('register') }}">問い合わせ / ユーザー登録はこちら</a></p>
		@endif

		<div class="icon-bg">
			<div class="icon">
				<p><a href="#"><i class="fa-brands fa-square-twitter" style="color: #27b6d3;"></i></a></p>
				<p><a href="#"><i class="fa-brands fa-line" style="color: #18ec42;"></i></a></p>
				<p><a href="#"><i class="fa-brands fa-square-facebook" style="color: #155ad1;"></i></a></p>
			</div>
		</div>
		<div class="copy">
			<p>&copy;2023 MArc Project</p>
		</div>
	</footer>


	<!-- jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.1.5/swiper-bundle.min.js"></script>
	<script src="{{ asset('js/script.js') }}"></script>

	@if(Request::routeIs('index') || Request::routeIs('search.index'))

	<!-- 削除確認用モーダル -->

	<script type="text/javascript">
		function check(post_id) {
			console.log(post_id);
			let delConf = document.getElementById('overflow' + post_id);
			console.log(delConf);
			delConf.style.opacity = "1";
			delConf.style.visibility = "visible";
		}

		function cansel(post_id) {
			let delConf = document.getElementById('overflow' + post_id);
			delConf.style.opacity = "0";
			delConf.style.visibility = "hidden";
			return false;
		}

		function next(post_id) {
			let delConf = document.getElementById('overflow' + post_id);
			delConf.style.opacity = "0";
			delConf.style.visibility = "hidden";
			// ok後の処理
			return true;
		}
	</script>

	@if(Request::routeIs('index'))

	<!-- スワイパー設定 基本ループ-->
	<script>
		const swiper = new Swiper('.swiper', {

			// ページネーションが必要なら追加
			// pagination: {
			// 	el: ".swiper-pagination"
			// },
			// ナビボタンが必要なら追加
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev"
			},

			// スライドをループモードに
			loop: true,

			effect: "coverflow",
			grabCursor: true,
			centeredSlides: true,
			slidesPerView: "1.4",

			coverflowEffect: {
				rotate: 360,
				stretch: 0,
				depth: 0,
				modifier: 1,
				slideShadows: false
			},

			// レスポンシブ対応
			breakpoints: {
				900: {
					slidesPerView: 3,
					autoplay: false,
					effect: "slide",

				},
				1120: {
					slidesPerView: 4,
					autoplay: false,
					effect: "slide",
				},
				1340: {
					slidesPerView: 5,
					autoplay: false,
					effect: "slide",
				},
				1560: {
					slidesPerView: 6,
					autoplay: false,
					effect: "slide",
				},
				1780: {
					slidesPerView: 7,
					autoplay: false,
					effect: "slide",
				},
			},
			// オートプレイ
			// autoplay: {
			// 	delay: 3000
			// },
			speed: 800
		});
	</script>

	@elseif(Request::routeIs('search.index'))

	<!-- スワイパー設定 検索したらループやめます-->
	<script>
		const swiper = new Swiper('.swiper', {

			// ページネーションが必要なら追加
			// pagination: {
			// 	el: ".swiper-pagination"
			// },
			// ナビボタンが必要なら追加
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev"
			},

			// スライドをループモードに
			// loop: true,

			effect: "coverflow",
			grabCursor: true,
			centeredSlides: true,
			slidesPerView: "1.4",
			initialSlide: 1, // スライドの開始位置

			coverflowEffect: {
				rotate: 360,
				stretch: 0,
				depth: 0,
				modifier: 1,
				slideShadows: false
			},

			// レスポンシブ対応
			breakpoints: {
				900: {
					slidesPerView: 3,
					autoplay: false,
					effect: "slide",

				},
				1120: {
					slidesPerView: 4,
					autoplay: false,
					effect: "slide",
				},
				1340: {
					slidesPerView: 5,
					autoplay: false,
					effect: "slide",
				},
				1560: {
					slidesPerView: 6,
					autoplay: false,
					effect: "slide",
				},
				1780: {
					slidesPerView: 7,
					autoplay: false,
					effect: "slide",
				},
			},
			// オートプレイ
			// autoplay: {
			// 	delay: 3000
			// },
			speed: 800
		});
	</script>

	@endif
	@endif

	<!-- updateFormページの時だけ下記スクリプトを有効化 -->

	@if(Request::routeIs('updateForm'))

	<!-- 更新確認用モーダル -->
	<script type="text/javascript">
		let confirm = document.getElementsByClassName('overflow')[0];

		function check() {
			confirm.style.opacity = "1";
			confirm.style.visibility = "visible";
		}

		function cansel() {
			confirm.style.opacity = "0";
			confirm.style.visibility = "hidden";
		}

		function next() {
			confirm.style.opacity = "0";
			confirm.style.visibility = "hidden";
			// ok後の処理
			return true;
		}
	</script>

	@endif

</body>

</html>
