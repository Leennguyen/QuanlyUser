<?php

if ( ! function_exists( 'next_legit_news_enqueue_styles' ) ) :

	function next_legit_news_enqueue_styles() {
		wp_enqueue_style( 'next-legit-news-style-parent', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'next-legit-news-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'next-legit-news-style-parent' ), '1.0.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'next_legit_news_enqueue_styles', 99 );

function next_legit_news_customize_control_js() {

	wp_enqueue_style( 'next-legit-news-customize-controls-css', get_theme_file_uri() . '/customizer-control.css' );

}
add_action( 'customize_controls_enqueue_scripts', 'next_legit_news_customize_control_js' );




require get_theme_file_path() . '/inc/customizer.php';

require get_theme_file_path() . '/inc/front-sections/main-post.php';
require get_theme_file_path() . '/inc/front-sections/media-posts.php';
require get_theme_file_path() . '/inc/front-sections/hero-post.php';
