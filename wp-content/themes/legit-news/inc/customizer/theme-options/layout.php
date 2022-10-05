<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'legit_news_layout', array(
	'title'               => esc_html__('Layout','legit-news'),
	'description'         => esc_html__( 'Layout section options.', 'legit-news' ),
	'panel'               => 'legit_news_theme_options_panel',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[site_layout]', array(
	'sanitize_callback'   => 'legit_news_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control(  new Light_News_Custom_Radio_Image_Control ( $wp_customize, 'legit_news_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'legit-news' ),
	'section'             => 'legit_news_layout',
	'choices'			  => legit_news_site_layout(),
) ) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'legit_news_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control(  new Light_News_Custom_Radio_Image_Control ( $wp_customize, 'legit_news_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Global Sidebar Position', 'legit-news' ),
	'section'             => 'legit_news_layout',
	'choices'			  => legit_news_global_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[post_sidebar_position]', array(
	'sanitize_callback'   => 'legit_news_sanitize_select',
	'default'             => $options['post_sidebar_position'],
) );

$wp_customize->add_control(  new Light_News_Custom_Radio_Image_Control ( $wp_customize, 'legit_news_theme_options[post_sidebar_position]', array(
	'label'               => esc_html__( 'Posts Sidebar Position', 'legit-news' ),
	'section'             => 'legit_news_layout',
	'choices'			  => legit_news_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[page_sidebar_position]', array(
	'sanitize_callback'   => 'legit_news_sanitize_select',
	'default'             => $options['page_sidebar_position'],
) );

$wp_customize->add_control( new Light_News_Custom_Radio_Image_Control( $wp_customize, 'legit_news_theme_options[page_sidebar_position]', array(
	'label'               => esc_html__( 'Pages Sidebar Position', 'legit-news' ),
	'section'             => 'legit_news_layout',
	'choices'			  => legit_news_sidebar_position(),
) ) );