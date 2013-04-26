<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */



	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		
		// overall theme js file
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );
		
		// add jquery to theme
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http://code.jquery.com/jquery-1.9.1.min.js", false, null);
		wp_enqueue_script('jquery');
		
		// add fitVid js so video embeds will be responsive
		wp_register_script( 'fitvid', get_template_directory_uri().'/js/jquery.fitvids.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'fitvid' );
		
		/** import theme style.css **/
		wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
		
		/** import scripts required for responsive goodness **/
		wp_enqueue_style( 'responsive',  get_template_directory_uri().'/css/responsive-gs-12col.css', '', '', 'screen' );
		wp_enqueue_style( 'menu',  get_template_directory_uri().'/css/nav.css', '', '', 'screen' );
		
		// add support for child themes without needing to manually import parent theme style.css via @import
		// add after parent theme css and nav css so it can override settings if required
		if ( get_stylesheet_directory_uri() != get_template_directory_uri() ) {
			wp_register_style( 'childcss', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
			wp_enqueue_style( 'childcss' );
		}
		
	}	
	
	// need to manually add html5 shim for IE versions not supporting html5
	add_action( 'wp_head', 'add_ie_fixes' );
	function add_ie_fixes() {
		global $is_IE;
		if ( $is_IE ) {
			echo '<!--[if lt IE 9]>';
			// html5 shim for IE versions not supporting html5
			echo '<script src="'.get_template_directory_uri().'/js/html5shiv.js"></script>';
			// fix so that ie8 supports media queries
			echo '<script src="'.get_template_directory_uri().'/js/respond.min.js"></script>';
			echo '<![endif]-->';
		}
	}

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}
	
	/* ========================================================================================================================

	Sidebars

	======================================================================================================================== */

	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Sidebar 1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));
	}
	
	/* ========================================================================================================================

	Misc.

	======================================================================================================================== */
	
	// Hide annoying frontend toolbar
	add_filter('show_admin_bar', '__return_false'); 