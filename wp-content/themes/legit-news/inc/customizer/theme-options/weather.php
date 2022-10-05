<?php
/**
 * Weather Section options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add Weather section
$wp_customize->add_section( 'legit_news_weather_section', array(
	'title'             => esc_html__( 'Weather','legit-news' ),
	'description'       => esc_html__( 'Weather Section options.', 'legit-news' ),
	'panel'             => 'legit_news_theme_options_panel',
) );

// Weather content enable control and setting
$wp_customize->add_setting( 'legit_news_theme_options[weather_section_enable]', array(
	'default'			=> 	$options['weather_section_enable'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[weather_section_enable]', array(
	'label'             => esc_html__( 'Weather Section Enable', 'legit-news' ),
	'section'           => 'legit_news_weather_section',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );


// Column layout control and setting
$wp_customize->add_setting( 'legit_news_theme_options[weather_option]', array(
	'default'          	=> $options['weather_option'],
	'sanitize_callback' => 'legit_news_sanitize_select',
) );

$wp_customize->add_control( 'legit_news_theme_options[weather_option]', array(
	'label'             => esc_html__( 'Display Weather Option', 'legit-news' ),
	'section'           => 'legit_news_weather_section',
	'type'				=> 'select',
	'active_callback' 	=> 'legit_news_is_weather_section_enable',
	'choices'			=> array( 
		'custom' 		=> esc_html__( 'Custom', 'legit-news' ),
		'api' 		    => esc_html__( 'Used API', 'legit-news' ),
	),
) );

// Event social icons number control and setting
$wp_customize->add_setting( 'legit_news_theme_options[weather_temp]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'legit_news_theme_options[weather_temp]', array(
	'label'             => esc_html__( 'Enter Temperature in Celsius', 'legit-news' ),
	'section'           => 'legit_news_weather_section',
	'active_callback'   => 'legit_news_is_weather_section_enable',
	'type'				=> 'text',
	'input_attrs'		=> array(
		'style' => 'width: 100px;'
		),
) ); 

// trending_news title setting and control
$wp_customize->add_setting( 'legit_news_theme_options[weather_location]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'legit_news_theme_options[weather_location]', array(
	'label'           	=> esc_html__( 'Location', 'legit-news' ),
	'section'        	=> 'legit_news_weather_section',
	'active_callback' 	=> 'legit_news_is_weather_section_enable',
	'type'				=> 'text',
) );

$wp_customize->add_setting( 'legit_news_theme_options[weather_icon]', array(
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control('legit_news_theme_options[weather_icon]', array(
    'label'             => esc_html__( 'Select Icon', 'legit-news' ),
    'description'       => sprintf( '%1$s <a href="%2$s" target="_blank">  %3$s </a> </br> %4$s', esc_html__( 'Get the icon name from', 'legit-news' ),esc_url('https://fontawesome.com/v4.7.0/'), esc_html__( 'Font Awesome v4.7.0', 'legit-news' ), esc_html('e.g : fa-bar-chart-o')),
    'section'           => 'legit_news_weather_section',
    'type'              => 'text',
    'active_callback'	=> 'legit_news_is_weather_section_enable',
) );
