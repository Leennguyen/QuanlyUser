<?php
/**
 * Photography Section options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add Photography section
$wp_customize->add_section( 'legit_news_photography_section', array(
	'title'             => esc_html__( 'Photography','legit-news' ),
	'description'       => esc_html__( 'Photography Section options.', 'legit-news' ),
	'panel'             => 'legit_news_front_page_panel',
	'priority'			=> 50,
) );

// Photography content enable control and setting
$wp_customize->add_setting( 'legit_news_theme_options[photography_section_enable]', array(
	'default'			=> 	$options['photography_section_enable'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[photography_section_enable]', array(
	'label'             => esc_html__( 'Photography Section Enable', 'legit-news' ),
	'section'           => 'legit_news_photography_section',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );

// photography title setting and control
$wp_customize->add_setting( 'legit_news_theme_options[photography_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['photography_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'legit_news_theme_options[photography_title]', array(
	'label'           	=> esc_html__( 'Title', 'legit-news' ),
	'section'        	=> 'legit_news_photography_section',
	'active_callback' 	=> 'legit_news_is_photography_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'legit_news_theme_options[photography_title]', array(
		'selector'            => '#reading div.section-header h2',
		'settings'            => 'legit_news_theme_options[photography_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'legit_news_photography_title_partial',
    ) );
}

// Add dropdown category setting and control.
$wp_customize->add_setting(  'legit_news_theme_options[photography_content_category]', array(
	'sanitize_callback' => 'legit_news_sanitize_single_category',
) ) ;

$wp_customize->add_control( new Light_News_Dropdown_Taxonomies_Control( $wp_customize,'legit_news_theme_options[photography_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'legit-news' ),
	'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'legit-news' ),
	'section'           => 'legit_news_photography_section',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'legit_news_is_photography_section_enable'
) ) );
