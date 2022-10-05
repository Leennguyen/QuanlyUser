<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'legit_news_pagination', array(
	'title'               => esc_html__('Pagination','legit-news'),
	'description'         => esc_html__( 'Pagination section options.', 'legit-news' ),
	'panel'               => 'legit_news_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[pagination_enable]', array(
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
	'default'             => $options['pagination_enable'],
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'legit-news' ),
	'section'             => 'legit_news_pagination',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );

// Site layout setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'legit_news_sanitize_select',
	'default'             => $options['pagination_type'],
) );

$wp_customize->add_control( 'legit_news_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'legit-news' ),
	'section'             => 'legit_news_pagination',
	'type'                => 'select',
	'choices'			  => legit_news_pagination_options(),
	'active_callback'	  => 'legit_news_is_pagination_enable',
) );
