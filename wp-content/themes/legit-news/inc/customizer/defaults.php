<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 * @return array An array of default values
 */

function legit_news_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$legit_news_default_options = array(
		// Color Options
		'header_title_color'			=> '#212121',
		'header_tagline_color'			=> '#212121',
		'header_txt_logo_extra'			=> 'show-all',


		// breadcrumb
		'breadcrumb_enable'				=> true,
		'breadcrumb_separator'			=> '/',
		
		// layout 
		'site_layout'         			=> 'wide',
		'sidebar_position'         		=> 'right-sidebar',
		'post_sidebar_position' 		=> 'right-sidebar',
		'page_sidebar_position' 		=> 'right-sidebar',
		'nav_search_enable'				=> true,
		'topbar_section_enable'			=> false,

		// excerpt options
		'long_excerpt_length'           => 25,
		
		// pagination options
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',

		// homepage sections sortable
		'sortable' 						=> 'breaking_news,hero_post,must_read,main_post,related_post',

		// footer options
		'copyright_text'           		=> sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s. ', '1: Year, 2: Site Title with home URL', 'legit-news' ), '[the-year]', '[site-link]' ) . esc_html__( 'All Rights Reserved | ', 'legit-news' ) . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'legit-news' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>',
		'scroll_top_visible'        	=> true,

		// reset options
		'reset_options'      			=> false,
		
		// homepage options
		'enable_frontpage_content' 		=> true,

		// blog/archive options
		'your_latest_posts_title' 		=> esc_html__( 'Blogs', 'legit-news' ),
		'hide_category'					=> false,
		'hide_author'					=> false,
		'hide_date'						=> false,
		
		// single post theme options
		'single_post_hide_date' 			=> false,
		'single_post_hide_author'			=> false,
		'single_post_hide_category'			=> false,
		'single_post_hide_tags'				=> false,
		'single_post_hide_featured_image'	=> true,
		
		/* Front Page */
		
		//Ads
		'ads_section_enable'	=> false,
		
		//Breaking News
		'breaking_news_section_enable'	=> false,
		'breaking_news_title'			=> esc_html__('Breaking News', 'legit-news'),
		
		//Hero Post
		'hero_post_section_enable'		=> false,
		'hero_post_btn_title' 			=> esc_html__( 'Read more', 'legit-news' ),

		// Hero
		'popular_section_enable'		=> false,
		'popular_content_type'			=> 'category',
		'popular_count'					=> 5,
		
		// Must Read
		'must_read_section_enable'		=> false,
		'must_read_title'				=> esc_html__( 'Must Read Articles', 'legit-news' ),

		// Photography
		'photography_section_enable'		=> false,
		'photography_title'					=> esc_html__( 'Photography', 'legit-news' ),

		// Single Column
		'single_column_section_enable'		=> false,
		'single_column_title'				=> esc_html__( 'Tours & Travel', 'legit-news' ),

		// Related_post
		'related_post_section_enable'		=> false,
		'related_post_title'				=> esc_html__( 'Related News', 'legit-news' ),
		'related_post_btn_title' 			=> esc_html__( 'Read more', 'legit-news' ),

		//weather
		'weather_section_enable'			=> false,
		'weather_option'					=> 'custom',


	);

	$output = apply_filters( 'legit_news_default_theme_options', $legit_news_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}