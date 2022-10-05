<?php
/**
 * Breaking  News Section options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add Breaking  News section
$wp_customize->add_section( 'legit_news_breaking_news_section', array(
	'title'             => esc_html__( 'Breaking News Section','legit-news' ),
	'description'       => esc_html__( 'Breaking News Section options.', 'legit-news' ),
	'panel'             => 'legit_news_front_page_panel',
	'priority'			=> 20,
) );

// Breaking  News content enable control and setting
$wp_customize->add_setting( 'legit_news_theme_options[breaking_news_section_enable]', array(
	'default'			=> 	$options['breaking_news_section_enable'],
    'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[breaking_news_section_enable]', array(
	'label'             => esc_html__( 'Breaking  News Section Enable', 'legit-news' ),
	'section'           => 'legit_news_breaking_news_section',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );

// Breaking News title setting and control
$wp_customize->add_setting( 'legit_news_theme_options[breaking_news_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['breaking_news_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'legit_news_theme_options[breaking_news_title]', array(
	'label'           	=> esc_html__( 'Breaking News Title', 'legit-news' ),
	'section'        	=> 'legit_news_breaking_news_section',
	'active_callback' 	=> 'legit_news_is_breaking_news_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'legit_news_theme_options[breaking_news_title]', array(
		'selector'            => '#breaking-news div h2.news-title',
		'settings'            => 'legit_news_theme_options[breaking_news_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'legit_news_breaking_news_title_partial',
    ) );
}

for ( $i = 1; $i <= 4; $i++ ) :
	// Breaking News pages drop down chooser control and setting
	$wp_customize->add_setting( 'legit_news_theme_options[breaking_news_content_post_' . $i . ']', array(
		'sanitize_callback' => 'legit_news_sanitize_page',
	) );

	$wp_customize->add_control( new Light_News_Dropdown_Chooser( $wp_customize, 'legit_news_theme_options[breaking_news_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'legit-news' ), $i ),
		'section'           => 'legit_news_breaking_news_section',
		'choices'			=> legit_news_post_choices(),
		'active_callback'	=> 'legit_news_is_breaking_news_section_enable',
	) ) );
endfor;

