<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

$wp_customize->add_section( 'legit_news_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','legit-news' ),
	'description'       => esc_html__( 'Breadcrumb section options.', 'legit-news' ),
	'panel'             => 'legit_news_theme_options_panel',
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[breadcrumb_enable]', array(
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
	'default'          	=> $options['breadcrumb_enable'],
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'legit-news' ),
	'section'          	=> 'legit_news_breadcrumb',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[breadcrumb_separator]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['breadcrumb_separator'],
) );

$wp_customize->add_control( 'legit_news_theme_options[breadcrumb_separator]', array(
	'label'            	=> esc_html__( 'Separator', 'legit-news' ),
	'active_callback' 	=> 'legit_news_is_breadcrumb_enable',
	'section'          	=> 'legit_news_breadcrumb',
) );
