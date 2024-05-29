<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />

	<?php wp_head(); ?>

	<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

	<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/_scss/_compiled/theme.css">
	<script src="<?= get_template_directory_uri() ?>/assets/_js/_compiled/theme.js"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Zen+Kurenaido&display=swap" rel="stylesheet">
</head>

<body>
	<!-- <?php /* wp_body_open(); */ ?> -->
	<header id="masterhead">

		<img src="" alt="" class="logo" id="logoHeader">
		<nav>
			<a href="#">Ressourcement</a>
			<a href="#">Funérailles</a>
			<a href="#">Calendrier</a>
			<a href="#">Témoignage</a>
			<a href="#">Histoire</a>
		</nav>
		<button class="orangeBtn contactezNousBtn" id="contactezNousBtnHeader">Contactez Nous</button>
		<button class="burgerMenu">
			<img src="wp-content\themes\maisonressourcementgethsemarie\template-parts\images\menu.svg" alt="menu">
		</button>

	</header>

	<!-- <div class="desktop"><?php /* wp_nav_menu(["menu" => "Header"]) */ ?></div>
		<div class="mobile">
			<ul>
				<li><?php /* wp_nav_menu(["menu" => "Header"]) */ ?></li>
				<li class="menu-burger-container">
					<i class="menu-burger">
						<div class="bars top-bars"></div>
						<div class="bars middle-bars"></div>
						<div class="bars bottom-bars"></div>
					</i>
				</li>
			</ul>
			<?php /* wp_nav_menu(["menu" => "Header"]) */ ?>
		</div> -->