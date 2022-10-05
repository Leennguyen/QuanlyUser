<?php
/**
 * Related Post Section options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Add Related Post section
$wp_customize->add_section( 'legit_news_related_post_section', array(
	'title'             => esc_html__( 'Related Post','legit-news' ),
	'description'       => esc_html__( 'Related Post Section options.', 'legit-news' ),
	'panel'             => 'legit_news_front_page_panel',
	'priority'			=> 70,
) );

// Related Post content enable control and setting
$wp_customize->add_setting( 'legit_news_theme_options[related_post_section_enable]', array(
	'default'			=> 	$options['related_post_section_enable'],
	'sanitize_callback' => 'legit_news_sanitize_switch_control',
) );

$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[related_post_section_enable]', array(
	'label'             => esc_html__( 'Related Post Section Enable', 'legit-news' ),
	'section'           => 'legit_news_related_post_section',
	'on_off_label' 		=> legit_news_switch_options(),
) ) );

// related_post title setting and control
$wp_customize->add_setting( 'legit_news_theme_options[related_post_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['related_post_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'legit_news_theme_options[related_post_title]', array(
	'label'           	=> esc_html__( 'Title', 'legit-news' ),
	'section'        	=> 'legit_news_related_post_section',
	'active_callback' 	=> 'legit_news_is_related_post_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'legit_news_theme_options[related_post_title]', array(
		'selector'            => '#related-posts div.section-header h2.section-title',
		'settings'            => 'legit_news_theme_options[related_post_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'legit_news_related_post_title_partial',
    ) );
}

for ( $i = 1; $i <= 4; $i++ ) :
	// related_post pages drop down chooser control and setting
	$wp_customize->add_setting( 'legit_news_theme_options[related_post_content_post_' . $i . ']', array(
		'sanitize_callback' => 'legit_news_sanitize_page',
	) );

	$wp_customize->add_control( new Light_News_Dropdown_Chooser( $wp_customize, 'legit_news_theme_options[related_post_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'legit-news' ), $i ),
		'section'           => 'legit_news_related_post_section',
		'choices'			=> legit_news_post_choices(),
		'active_callback'	=> 'legit_news_is_related_post_section_enable',
	) ) );
endfor;

$wp_customize->add_control( 'legit_news_theme_options[related_post_btn_title]', array(
	'label'           	=> esc_html__( 'Button Label', 'legit-news' ),
	'section'        	=> 'legit_news_related_post_section',
	'active_callback' 	=> 'legit_news_is_related_post_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'legit_news_theme_options[related_post_btn_title]', array(
		'selector'            => '#related-posts div.view-all a.more-link',
		'settings'            => 'legit_news_theme_options[related_post_btn_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'legit_news_related_post_btn_title_partial',
    ) );
}
