<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Legit News
* @since Legit News 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'legit_news_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content'],
) );

$wp_customize->add_control( 'legit_news_theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'legit-news' ),
	'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'legit-news' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
) );