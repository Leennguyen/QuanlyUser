<?php
/**
 * Menu options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'legit_news_menu', array(
	'title'             => esc_html__('Header Menu','legit-news'),
	'description'       => esc_html__( 'Header Menu options.', 'legit-news' ),
	'panel'             => 'nav_menus',
) );

// search enable setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[nav_search_enable]', array(
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
	'default'           => $options['nav_search_enable'],
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[nav_search_enable]', array(
	'label'             => esc_html__( 'Enable search', 'legit-news' ),
	'section'           => 'legit_news_menu',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );

// Topbar content enable control and setting
$wp_customize->add_setting( 'legit_news_theme_options[topbar_section_enable]', array(
	'default'			=> 	$options['topbar_section_enable'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[topbar_section_enable]', array(
	'label'             => esc_html__( 'Topbar Section Enable', 'legit-news' ),
	'section'           => 'legit_news_menu',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );