<?php
/**
 * Theme Palace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

if ( ! function_exists( 'legit_news_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function legit_news_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'legit-news' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'legit-news' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		add_theme_support( 'register_block_pattern' ); 

		add_theme_support( 'register_block_style' ); 

		add_theme_support( 'responsive-embeds' );

		// Load Footer Widget Support.
		require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/footer-widgets.php' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 600, 550, true );

		// Set the default content width.
		$GLOBALS['content_width'] = 525;
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary', 'legit-news' ),
			'secondary' => esc_html__( 'Secondary', 'legit-news' ),
			'social' 	=> esc_html__( 'Social', 'legit-news' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'legit_news_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( '/assets/css/editor-style' . legit_news_min() . '.css', legit_news_fonts_url() ) );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'legit-news' ),
				'slug' => 'blue',
				'color' => '#2c7dfa',
	       	),
	       	array(
	           	'name' => esc_html__( 'Green', 'legit-news' ),
	           	'slug' => 'green',
	           	'color' => '#07d79c',
	       	),
	       	array(
	           	'name' => esc_html__( 'Orange', 'legit-news' ),
	           	'slug' => 'orange',
	           	'color' => '#ff8737',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'legit-news' ),
	           	'slug' => 'black',
	           	'color' => '#2f3633',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'legit-news' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'legit-news' ),
		       	'shortName' => esc_html__( 'S', 'legit-news' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'legit-news' ),
		       	'shortName' => esc_html__( 'M', 'legit-news' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'legit-news' ),
		       	'shortName' => esc_html__( 'L', 'legit-news' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'legit-news' ),
		       	'shortName' => esc_html__( 'XL', 'legit-news' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'legit_news_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function legit_news_content_width() {

	$content_width = $GLOBALS['content_width'];


	$sidebar_position = legit_news_layout();
	switch ( $sidebar_position ) {

	  case 'no-sidebar':
	    $content_width = 1170;
	    break;

	  case 'left-sidebar':
	  case 'right-sidebar':
	    $content_width = 866;
	    break;

	  default:
	    break;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1170;
	}

	/**
	 * Filter Legit News content width of the theme.
	 *
	 * @since Legit News 1.0.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'legit_news_content_width', $content_width );
}
add_action( 'template_redirect', 'legit_news_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function legit_news_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'legit-news' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'legit-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Recent Sidebar', 'legit-news' ),
		'id'            => 'recent-sidebar',
		'description'   => esc_html__( 'Add widgets for recent post sidebar section here.', 'legit-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="popular-wrapper">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'legit-news' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Add widgets for blog post sidebar section here.', 'legit-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Hero Section Sidebar', 'legit-news' ),
		'id'            => 'hero-post-sidebar',
		'description'   => esc_html__( 'Add widgets for Hero post section right sidebar here.', 'legit-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Main Section Left Sidebar', 'legit-news' ),
		'id'            => 'main-left-sidebar',
		'description'   => esc_html__( 'Add widgets for Main Post section right sidebar here.', 'legit-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Main Section Right Sidebar', 'legit-news' ),
		'id'            => 'main-right-sidebar',
		'description'   => esc_html__( 'Add widgets for Main Post section right sidebar here.', 'legit-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebars( 4, array(
		'name'          => esc_html__( 'Optional Sidebar %d', 'legit-news' ),
		'id'            => 'optional-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'legit-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'legit_news_widgets_init' );


if ( ! function_exists( 'legit_news_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function legit_news_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	
	/* translators: If there are characters in your language that are not supported by Khand, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Khand font: on or off', 'legit-news' ) ) {
		$fonts[] = 'Khand:400,500,600,700|Oxygen:400,700&display=swap';
	}

	/* translators: If there are characters in your language that are not supported by Frank+Ruhl+Libre, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Frank Ruhl Libre : on or off', 'legit-news' ) ) {
		$fonts[] = 'Frank Ruhl Libre:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'legit-news' ) ) {
		$fonts[] = 'Lato:400,700';
	}


	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @since Legit News 1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function legit_news_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'legit-news-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'legit_news_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function legit_news_scripts() {
	$options = legit_news_get_theme_options();
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'legit-news-fonts', wptt_get_webfont_url(legit_news_fonts_url()), array(), '1.0' );

	// font-awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome' . legit_news_min() . '.css' );

	// slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css' );

	// slick theme
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css' );

	// blocks
	wp_enqueue_style( 'legit-news-blocks', get_template_directory_uri() . '/assets/css/blocks' . legit_news_min() . '.css' );

	wp_enqueue_style( 'legit-news-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	wp_enqueue_script( 'legit-news-html5', get_template_directory_uri() . '/assets/js/html5' . legit_news_min() . '.js', array(), '3.7.3' );
	wp_script_add_data( 'legit-news-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'legit-news-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . legit_news_min() . '.js', array(), '20160412', true );

	wp_enqueue_script( 'legit-news-navigation', get_template_directory_uri() . '/assets/js/navigation' . legit_news_min() . '.js', array(), '20151215', true );
	
	$legit_news_l10n = array(
		'quote'          => legit_news_get_svg( array( 'icon' => 'quote-right' ) ),
		'expand'         => esc_html__( 'Expand child menu', 'legit-news' ),
		'collapse'       => esc_html__( 'Collapse child menu', 'legit-news' ),
		'icon'           => legit_news_get_svg( array( 'icon' => 'down', 'fallback' => true ) ),
	);
	
	wp_localize_script( 'legit-news-navigation', 'legit_news_l10n', $legit_news_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick' . legit_news_min() . '.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'theia-sticky', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar' . legit_news_min() . '.js' , array( 'jquery' ), '', true );

	wp_enqueue_script( 'legit-news-custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'legit_news_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Legit News 1.0.0
 */
function legit_news_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'legit-news-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . legit_news_min() . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'legit-news-fonts', wptt_get_webfont_url(legit_news_fonts_url()), array(), '1.0' );
}
add_action( 'enqueue_block_editor_assets', 'legit_news_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';