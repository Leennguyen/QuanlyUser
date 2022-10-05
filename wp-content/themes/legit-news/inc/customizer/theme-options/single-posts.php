<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'legit_news_single_post_section', array(
	'title'             => esc_html__( 'Single Post','legit-news' ),
	'description'       => esc_html__( 'Options to change the single posts globally.', 'legit-news' ),
	'panel'             => 'legit_news_theme_options_panel',
) );

$wp_customize->add_setting( 'legit_news_theme_options[single_post_hide_featured_image]', array(
	'default'           => $options['single_post_hide_featured_image'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[single_post_hide_featured_image]', array(
	'label'             => esc_html__( 'Hide Featured Image', 'legit-news' ),
	'section'           => 'legit_news_single_post_section',
	'on_off_label' 		=> legit_news_hide_options(),
) ) );


// Archive date meta setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[single_post_hide_date]', array(
	'default'           => $options['single_post_hide_date'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[single_post_hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'legit-news' ),
	'section'           => 'legit_news_single_post_section',
	'on_off_label' 		=> legit_news_hide_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[single_post_hide_author]', array(
	'default'           => $options['single_post_hide_author'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[single_post_hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'legit-news' ),
	'section'           => 'legit_news_single_post_section',
	'on_off_label' 		=> legit_news_hide_options(),
) ) );

// Archive author category setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[single_post_hide_category]', array(
	'default'           => $options['single_post_hide_category'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[single_post_hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'legit-news' ),
	'section'           => 'legit_news_single_post_section',
	'on_off_label' 		=> legit_news_hide_options(),
) ) );

// Archive tag category setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[single_post_hide_tags]', array(
	'default'           => $options['single_post_hide_tags'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[single_post_hide_tags]', array(
	'label'             => esc_html__( 'Hide Tag', 'legit-news' ),
	'section'           => 'legit_news_single_post_section',
	'on_off_label' 		=> legit_news_hide_options(),
) ) );
