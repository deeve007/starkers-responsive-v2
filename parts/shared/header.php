<div class="container"><!-- container for content to center on larger screens -->
	
	<header>
		<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2><?php bloginfo( 'description' ); ?></h2>
		
		<button id="togglebutt">Show/hide menu</button><!-- for mobile menu -->
		<nav id="primarynav" role="navigation">
			<?php wp_nav_menu( array('menu' => 'Primary', 'container' => false, 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', )); ?>
		</nav>
	</header>
	
	<div class="row"><!-- row for responsive columns -->
