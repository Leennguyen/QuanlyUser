<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'legit_news_archive_section', array(
	'title'             => esc_html__( 'Blog/Archive','legit-news' ),
	'description'       => esc_html__( 'Archive section options.', 'legit-news' ),
	'panel'             => 'legit_news_theme_options_panel',
) );

// Archive category setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[hide_category]', array(
	'default'           => $options['hide_category'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'legit-news' ),
	'section'           => 'legit_news_archive_section',
	'on_off_label' 		=> legit_news_hide_options(),
) ) );
