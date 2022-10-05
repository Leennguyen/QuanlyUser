<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of Legit News
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

/*
 * Add Recent Posts widget
 */
require get_template_directory() . '/inc/widgets/recent-posts-widget.php';

/*


/**
 * Register widgets
 */
function legit_news_register_widgets() {

	register_widget( 'Light_News_Recent_Post' );

}
add_action( 'widgets_init', 'legit_news_register_widgets' );