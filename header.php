<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<a class="screen-reader-text  skip-link" href="#content">Skip to main content</a>

	<div class="site">
		<div class="site__top">
			<header class="header" itemscope itemtype="http://schema.org/WPHeader">
				<div class="container">

					<div class="grid">
						<div class="grid__column  grid__column--7  grid__column--m-4  grid__column--l-3">
							<a href="<?php echo home_url(); ?>" title="Return to homepage">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.svg" class="logo">
							</a>
						</div>

						<div class="grid__column  grid__column--5  grid__column--m-8  grid__column--l-9  u-text-right">


							<?php if ( is_user_logged_in() ) : ?>
								<a href="<?php echo home_url() ?>/your-profile" class="button__membership"><span class="fa fa-user"></span><span class="button__membership--text"> View Profile</span></a>	
								<a href="<?php echo wp_logout_url( get_home_url() ); ?>" class="button  button--alt  button--login button__login  button--wide">Log out</a>
							<?php else : ?>
								<a href="<?php echo get_theme_mod( 'login_url' ) ?: wp_login_url( get_home_url() ); ?>" class="button  button--alt  button--login  button--wide">Log in</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</header>

			<?php get_template_part( 'template-parts/algolia/searchform' ); ?>

			<nav id="navigation" class="navigation">
				<div class="container">
					<button class="menu-toggle  js-cascade-toggle" aria-controls="navbar" data-label-close="Close">Menu</button>

					<div id="navbar" class="navbar  js-cascade-navbar" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'topmenu',
							'fallback_cb'    => false,
							'container'      => false,
							'items_wrap'     => '<ul class="navbar__list">%3$s</ul>',
							'walker'         => new Cascade_Navbar_Walker,
						) );
						?>
					</div>

					<?php if ( is_user_logged_in() ) : ?>
						<button class="search-toggle  js-search-open" aria-controls="search-form" style="display: none;"><span class="screen-reader-text">Search</span></button>
					<?php endif; ?>
				</div>
			</nav>
		</div>

		<div class="site__middle">