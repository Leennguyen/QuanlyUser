<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'legit_news_excerpt_section', array(
	'title'             => esc_html__( 'Excerpt','legit-news' ),
	'description'       => esc_html__( 'Excerpt section options.', 'legit-news' ),
	'panel'             => 'legit_news_theme_options_panel',
) );


// long Excerpt length setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[long_excerpt_length]', array(
	'sanitize_callback' => 'legit_news_sanitize_number_range',
	'validate_callback' => 'legit_news_validate_long_excerpt',
	'default'			=> $options['long_excerpt_length'],
) );

$wp_customize->add_control( 'legit_news_theme_options[long_excerpt_length]', array(
	'label'       		=> esc_html__( 'Blog Page Excerpt Length', 'legit-news' ),
	'description' 		=> esc_html__( 'Note: Min 5 & Max 100. Total words to be displayed in archive page/search page.', 'legit-news' ),
	'section'     		=> 'legit_news_excerpt_section',
	'type'        		=> 'number',
	'input_attrs' 		=> array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
	),
) );
