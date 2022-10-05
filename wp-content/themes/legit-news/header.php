<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage Legit News
	 * @since Legit News 1.0.0
	 */

	/**
	 * legit_news_doctype hook
	 *
	 * @hooked legit_news_doctype -  10
	 *
	 */
	do_action( 'legit_news_doctype' );

?>
<head>
<?php
	/**
	 * legit_news_before_wp_head hook
	 *
	 * @hooked legit_news_head -  10
	 *
	 */
	do_action( 'legit_news_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<?php
	/**
	 * legit_news_page_start_action hook
	 *
	 * @hooked legit_news_page_start -  10
	 *
	 */
	do_action( 'legit_news_page_start_action' ); 

	/**
	 * legit_news_loader_action hook
	 *
	 * @hooked legit_news_loader -  10
	 *
	 */
	do_action( 'legit_news_before_header' );

	/**
	 * legit_news_header_action hook
	 *
	 * @hooked legit_news_header_start -  10
	 * @hooked legit_news_site_branding -  20
	 * @hooked legit_news_site_navigation -  30
	 * @hooked legit_news_header_end -  50
	 *
	 */
	do_action( 'legit_news_header_action' );

	/**
	 * legit_news_content_start_action hook
	 *
	 * @hooked legit_news_content_start -  10
	 *
	 */
	do_action( 'legit_news_content_start_action' );

	/**
	 * legit_news_header_image_action hook
	 *
	 * @hooked legit_news_header_image -  10
	 *
	 */
	if(! is_single() && ! is_page()) do_action( 'legit_news_header_image_action' );

    if ( legit_news_is_frontpage() ) {
    	$options = legit_news_get_theme_options();
    	$sorted = array();
    	if ( ! empty( $options['sortable'] ) ) {
			$sorted = explode( ',' , $options['sortable'] );
		}

		foreach ( $sorted as $section ) {
			add_action( 'legit_news_primary_content', 'legit_news_add_'. $section .'_section' );
		}
		do_action( 'legit_news_primary_content' );
	}