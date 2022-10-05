<?php
/**
 * Ads Section options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add Ads section
$wp_customize->add_section( 'legit_news_ads_section', array(
	'title'             => esc_html__( 'Advertisement','legit-news' ),
	'description'       => esc_html__( 'Advertisement Section options.', 'legit-news' ),
	'panel'             => 'legit_news_front_page_panel',
	'priority'			=> 10,
) );

// Ads content enable control and setting
$wp_customize->add_setting( 'legit_news_theme_options[ads_section_enable]', array(
	'default'			=> 	$options['ads_section_enable'],
    'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[ads_section_enable]', array(
	'label'             => esc_html__( 'Ads Section Enable', 'legit-news' ),
	'section'           => 'legit_news_ads_section',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );


// ads image setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[ads_image]', array(
	'sanitize_callback' => 'legit_news_sanitize_image'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'legit_news_theme_options[ads_image]',
		array(
		'label'       		=> esc_html__( 'Ads Image', 'legit-news' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'legit-news' ), 900, 100 ),
		'active_callback' 	=> 'legit_news_is_ads_section_enable',
		'section'     		=> 'legit_news_ads_section',
) ) );

// ads link setting and control
$wp_customize->add_setting( 'legit_news_theme_options[ads_url]', array(
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'legit_news_theme_options[ads_url]', array(
	'label'           	=> esc_html__( 'Ads Url', 'legit-news' ),
	'active_callback' 	=> 'legit_news_is_ads_section_enable',
	'section'        	=> 'legit_news_ads_section',
	'type'				=> 'url',
) );