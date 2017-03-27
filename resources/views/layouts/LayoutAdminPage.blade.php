<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menahouse: admin page</title>
	<meta name="keywords" content="house,дом, объевления" />
	<meta name="author" content="Codrops" />
	<link rel="shortcut icon" href="favicon.ico">

	{{-- <link rel="stylesheet" href="{{ elixir('css/all.css') }}"> --}}

  {{-- <link rel="stylesheet" href="{{ elixir('css/all.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('css/vendor/organicfoodicons.css') }}">

	<link rel="stylesheet" href="{{ asset('css/vendor/metro-responsive.css') }}">

	<link rel="stylesheet" href="{{ asset('css/vendor/demo.css') }}">
	<link rel="stylesheet" href="{{ asset('css/vendor/component.css') }}">

		{{-- <link rel="stylesheet" href="{{ asset('css/vendor/metro.css') }}"> --}}


  <script src="{{ asset('js/vendor/modernizr-custom.js') }}"></script>

</head>

<body>
	<!-- Main container -->
	<div class="container">
		<!-- Blueprint header -->
		<header class="bp-header cf">
			<div class="dummy-logo">
				<div class="dummy-icon foodicon foodicon--coconut"> </div>
				<h2 class="dummy-heading">Fooganic</h2>
			</div>
			<div class="bp-header__main">
					<span class="bp-header__present">Menahouse</span>
				<!-- <span class="bp-header__present">Menahouse <span class="bp-tooltip bp-icon bp-icon--about" data-content="The Blueprints are a collection of basic."></span></span> -->
				<!-- <h1 class="bp-header__title">Multi-Level Menu</h1>
				<nav class="bp-nav">
					<a class="bp-nav__item bp-icon bp-icon--prev" href="http://tympanus.net/Blueprints/PageStackNavigation/" data-info="previous Blueprint"><span>Previous Blueprint</span></a>
					<a class="bp-nav__item bp-icon bp-icon--next" href="" data-info="next Blueprint"><span>Next Blueprint</span></a>
					<a class="bp-nav__item bp-icon bp-icon--drop" href="http://tympanus.net/codrops/?p=25521" data-info="back to the Codrops article"><span>back to the Codrops article</span></a>
					<a class="bp-nav__item bp-icon bp-icon--archive" href="http://tympanus.net/codrops/category/blueprints/" data-info="Blueprints archive"><span>Go to the archive</span></a>
				</nav> -->
			</div>
		</header>
		<button class="action action--open" aria-label="Open Menu"><span class="icon icon--menu"></span></button>
		<nav id="ml-menu" class="menu">
			<button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
			<div class="menu__wrap">
				<ul  class="menu__level">
					<li class="menu__item"><a class="menu__link" data-submenu="submenu-3" href="#">Объявления </a></li>
					<li class="menu__item"><a class="menu__link" data-submenu="submenu-1" href="#">Мой Профиль</a></li>
					<!-- <li class="menu__item"><a class="menu__link" data-submenu="submenu-1" href="#"> Сообщения</a></li> -->
					<li class="menu__item"><a class="menu__link" data-submenu="submenu-2" href="#">Почта </a></li>
					<li class="menu__item"><a class="menu__link" data-submenu="submenu-4" href="#">Платеж</a></li>
					<li class="menu__item menu_item__logout"><a class="menu__link" href="#">Выход</a></li>
				</ul>

				<!-- Submenu 1 -->
				<ul data-menu="submenu-1" class="menu__level">
					<li class="menu__item"><a class="menu__link" href="#">Stalk Vegetables</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Roots &amp; Seeds</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Cabbages</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Salad Greens</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Mushrooms</a></li>
					<li class="menu__item"><a class="menu__link" data-submenu="submenu-1-1" href="#">Sale %</a></li>
				</ul>

				<!-- Submenu 1-1 -->
				<ul data-menu="submenu-1-1" class="menu__level">
					<li class="menu__item"><a class="menu__link" href="#">Fair Trade Roots</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Dried Veggies</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Our Brand</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Homemade</a></li>
				</ul>

				<!-- Submenu 2 -->
				<ul data-menu="submenu-2" class="menu__level">
					<li class="menu__item"><a class="menu__link menu__link--current" href="#">Входящие</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Избранное</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Отправленные</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Удалённые</a></li>
					<li class="menu__item menu_item__logout"><a class="menu__link" href="#">Выход</a></li>
					<!-- <li class="menu__item"><a class="menu__link" href="#">Спам</a></li> -->

					<!-- <li class="menu__item"><a class="menu__link" href="#">Citrus Fruits</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Berries</a></li>
					<li class="menu__item"><a class="menu__link" data-submenu="submenu-2-1" href="#">Special Selection</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Tropical Fruits</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Melons</a></li> -->
				</ul>
				<!-- Submenu 2-1 -->
				<ul data-menu="submenu-2-1" class="menu__level">
					<li class="menu__item"><a class="menu__link" href="#">Exotic Mixes</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Wild Pick</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Vitamin Boosters</a></li>
				</ul>

				<!-- Submenu 3 -->
				<ul data-menu="submenu-3" class="menu__level">
					<li class="menu__item"><a class="menu__link menu__link--current" href="#">Мои объявления</a></li>
					<li class="menu__item"><a class="menu__link" href="{{ url('/dashboard/nedvizhimosts/add') }}">Разместить</a></li>
					<!-- <li class="menu__item"><a class="menu__link" href="#">Quinoa</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Wild Rice</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Durum Wheat</a></li>
					<li class="menu__item"><a class="menu__link" data-submenu="submenu-3-1" href="#">Promo Packs</a></li> -->
				</ul>
				<!-- Submenu 3-1 -->
				<ul data-menu="submenu-3-1" class="menu__level">
					<li class="menu__item"><a class="menu__link" href="#">Starter Kit</a></li>
					<li class="menu__item"><a class="menu__link" href="#">The Essential 8</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Bolivian Secrets</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Flour Packs</a></li>
				</ul>

				<!-- Submenu 4 -->
				<ul data-menu="submenu-4" class="menu__level">
					<li class="menu__item"><a class="menu__link" href="#">Grain Mylks</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Seed Mylks</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Nut Mylks</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Nutri Drinks</a></li>
					<li class="menu__item"><a class="menu__link" data-submenu="submenu-4-1" href="#">Selection</a></li>
				</ul>
				<!-- Submenu 4-1 -->
				<ul data-menu="submenu-4-1" class="menu__level">
					<li class="menu__item"><a class="menu__link" href="#">Nut Mylk Packs</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Amino Acid Heaven</a></li>
					<li class="menu__item"><a class="menu__link" href="#">Allergy Free</a></li>
				</ul>
			</div>
		</nav>
		<div class="content">
			 @yield('content')
			<!-- <p class="info">Please choose a category</p>
			<!-- Ajax loaded content here -->
		</div>

	</div>

	<!-- /view -->
	<script src="{{ asset('js/vendor/classie.js') }}"></script>
  <script src="{{ asset('js/vendor/dummydata.js') }}"></script>
  <script src="{{ asset('js/vendor/main.js') }}"></script>
  <!-- <script src="{{ elixir('js/all.js') }}"></script> -->
	<script>
	(function() {
		var menuEl = document.getElementById('ml-menu'),
			mlmenu = new MLMenu(menuEl, {
				// breadcrumbsCtrl : true, // show breadcrumbs
				// initialBreadcrumb : 'all', // initial breadcrumb text
				backCtrl : false, // show back button
				// itemsDelayInterval : 60, // delay between each menu item sliding animation
				onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
			});

		// mobile menu toggle
		var openMenuCtrl = document.querySelector('.action--open'),
			closeMenuCtrl = document.querySelector('.action--close');

		openMenuCtrl.addEventListener('click', openMenu);
		closeMenuCtrl.addEventListener('click', closeMenu);

		function openMenu() {
			classie.add(menuEl, 'menu--open');
		}

		function closeMenu() {
			classie.remove(menuEl, 'menu--open');
		}

		// simulate grid content loading
		var gridWrapper = document.querySelector('.content');

		function loadDummyData(ev, itemName) {
			ev.preventDefault();

			closeMenu();
			gridWrapper.innerHTML = '';
			classie.add(gridWrapper, 'content--loading');
			setTimeout(function() {
				classie.remove(gridWrapper, 'content--loading');
				gridWrapper.innerHTML = '<ul class="products">' + dummyData[itemName] + '<ul>';
			}, 700);
		}
	})();
	</script>
</body>

</html>
