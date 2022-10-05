<?php
/**
 * Must Read Section options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add Must Read section
$wp_customize->add_section( 'legit_news_must_read_section', array(
	'title'             => esc_html__( 'Must Read','legit-news' ),
	'description'       => esc_html__( 'Must Read Section options.', 'legit-news' ),
	'panel'             => 'legit_news_front_page_panel',
	'priority'			=> 40,
) );

// Must Read content enable control and setting
$wp_customize->add_setting( 'legit_news_theme_options[must_read_section_enable]', array(
	'default'			=> 	$options['must_read_section_enable'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[must_read_section_enable]', array(
	'label'             => esc_html__( 'Must Read Section Enable', 'legit-news' ),
	'section'           => 'legit_news_must_read_section',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );

// must_read title setting and control
$wp_customize->add_setting( 'legit_news_theme_options[must_read_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['must_read_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'legit_news_theme_options[must_read_title]', array(
	'label'           	=> esc_html__( 'Title', 'legit-news' ),
	'section'        	=> 'legit_news_must_read_section',
	'active_callback' 	=> 'legit_news_is_must_read_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'legit_news_theme_options[must_read_title]', array(
		'selector'            => '#must-read .section-header h2.section-title',
		'settings'            => 'legit_news_theme_options[must_read_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'legit_news_must_read_title_partial',
    ) );
}

for ( $i = 1; $i <= 4; $i++ ) :
	// must_read pages drop down chooser control and setting
	$wp_customize->add_setting( 'legit_news_theme_options[must_read_content_post_' . $i . ']', array(
		'sanitize_callback' => 'legit_news_sanitize_page',
	) );

	$wp_customize->add_control( new Light_News_Dropdown_Chooser( $wp_customize, 'legit_news_theme_options[must_read_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'legit-news' ), $i ),
		'section'           => 'legit_news_must_read_section',
		'choices'			=> legit_news_post_choices(),
		'active_callback'	=> 'legit_news_is_must_read_section_enable',
	) ) );

endfor;