<?php
/**
 * Legit News Customizer.
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

/**
*
*Upgrade to pro
*
*/

//load upgrade-to-pro section
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function legit_news_customize_register( $wp_customize ) {
	$options = legit_news_get_theme_options();

	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load partial callback functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	// Load validation callback functions.
	require get_template_directory() . '/inc/customizer/validation.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Header title color setting and control.
	$wp_customize->add_setting( 'legit_news_theme_options[header_title_color]', array(
		'default'           => $options['header_title_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'			=> 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'legit_news_theme_options[header_title_color]', array(
		'priority'			=> 5,
		'label'             => esc_html__( 'Header Title Color', 'legit-news' ),
		'section'           => 'colors',
	) ) );

	// Header tagline color setting and control.
	$wp_customize->add_setting( 'legit_news_theme_options[header_tagline_color]', array(
		'default'           => $options['header_tagline_color'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'			=> 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'legit_news_theme_options[header_tagline_color]', array(
		'priority'			=> 6,
		'label'             => esc_html__( 'Header Tagline Color', 'legit-news' ),
		'section'           => 'colors',
	) ) );

	// Site identity extra options.
	$wp_customize->add_setting( 'legit_news_theme_options[header_txt_logo_extra]', array(
		'default'           => $options['header_txt_logo_extra'],
		'sanitize_callback' => 'legit_news_sanitize_select',
		'transport'			=> 'refresh'
	) );

	$wp_customize->add_control( 'legit_news_theme_options[header_txt_logo_extra]', array(
		'priority'			=> 50,
		'type'				=> 'radio',
		'label'             => esc_html__( 'Site Identity Extra Options', 'legit-news' ),
		'section'           => 'title_tagline',
		'choices'				=> array( 
			'hide-all'     => esc_html__( 'Hide All', 'legit-news' ),
			'show-all'     => esc_html__( 'Show All', 'legit-news' ),
			'title-only'   => esc_html__( 'Title Only', 'legit-news' ),
			'tagline-only' => esc_html__( 'Tagline Only', 'legit-news' ),
			'logo-title'   => esc_html__( 'Logo + Title', 'legit-news' ),
			'logo-tagline' => esc_html__( 'Logo + Tagline', 'legit-news' ),
			)
	) );



	/**
	 * Custom colors.
	 */

	// Add panel for common theme options
	$wp_customize->add_panel( 'legit_news_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','legit-news' ),
	    'description'=> esc_html__( 'Legit News Theme Options.', 'legit-news' ),
	    'priority'   => 150,
	) );

	// breadcrumb
	require get_template_directory() . '/inc/customizer/theme-options/breadcrumb.php';

	// load layout
	require get_template_directory() . '/inc/customizer/theme-options/layout.php';

	// load menu
	require get_template_directory() . '/inc/customizer/theme-options/menu.php';

	// load static homepage option
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// load archive option
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// load archive option
	require get_template_directory() . '/inc/customizer/theme-options/archive.php';
	
	// load single post option
	require get_template_directory() . '/inc/customizer/theme-options/single-posts.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load footer option
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// load footer option
	// require get_template_directory() . '/inc/customizer/theme-options/weather.php';

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';

	// Add panel for front page theme options.
	$wp_customize->add_panel( 'legit_news_front_page_panel' , array(
	    'title'      => esc_html__( 'Front Page','legit-news' ),
	    'description'=> esc_html__( 'Front Page Theme Options.', 'legit-news' ),
	    'priority'   => 140,
	) );

	// load Breaking News option
	require get_template_directory() . '/inc/customizer/sections/ads.php';	

	// load Breaking News option
	require get_template_directory() . '/inc/customizer/sections/breaking-news.php';	
	// load Hero Post option
	require get_template_directory() . '/inc/customizer/sections/hero-post.php';	
	
	// load must-read option
	require get_template_directory() . '/inc/customizer/sections/must-read.php';
	
	// load photography option
	require get_template_directory() . '/inc/customizer/sections/photography.php';
	
	// load Single Column option
	require get_template_directory() . '/inc/customizer/sections/single-column.php';
	
	// load related-post option
	require get_template_directory() . '/inc/customizer/sections/related-post.php';

}
add_action( 'customize_register', 'legit_news_customize_register' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function legit_news_customize_preview_js() {
	wp_enqueue_script( 'legit-news-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'legit_news_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function legit_news_customize_control_js() {
	// fontawesome
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . '/assets/css/font-awesome' . legit_news_min() . '.css' );
	
	// Choose from select jquery.
	wp_enqueue_style( 'chosen-css', get_template_directory_uri() . '/assets/css/chosen' . legit_news_min() . '.css' );
	wp_enqueue_script( 'jquery-chosen', get_template_directory_uri() . '/assets/js/chosen.jquery' . legit_news_min() . '.js', array( 'jquery' ), '1.4.2', true );

	wp_enqueue_style( 'legit-news-customize-controls-css', get_template_directory_uri() . '/assets/css/customize-controls' . legit_news_min() . '.css' );

	wp_enqueue_script( 'legit-news-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array(), '1.0', true );
	
	$legit_news_reset_data = array(
		'reset_message' => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'legit-news' )
	);
	// Send list of color variables as object to custom customizer js
	wp_localize_script( 'legit-news-customize-controls', 'legit_news_reset_data', $legit_news_reset_data );
}
add_action( 'customize_controls_enqueue_scripts', 'legit_news_customize_control_js' );

if ( !function_exists( 'legit_news_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since Legit News 1.0.0
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function legit_news_reset_options() {
		$options = legit_news_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'legit_news_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
			remove_theme_mod( 'header_textcolor' );
	    }
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'legit_news_reset_options' );
