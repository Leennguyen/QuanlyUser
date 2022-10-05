<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'legit_news_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'legit-news' ),
		'priority'   			=> 900,
		'panel'      			=> 'legit_news_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'legit_news_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'legit_news_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'legit_news_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'legit-news' ),
		'section'    			=> 'legit_news_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'legit_news_theme_options[copyright_text]', array(
		'selector'            => '.site-info .copyright span',
		'settings'            => 'legit_news_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'legit_news_copyright_text_partial',
    ) );
}

// scroll top visible
$wp_customize->add_setting( 'legit_news_theme_options[scroll_top_visible]',
	array(
		'default'       	=> $options['scroll_top_visible'],
		'sanitize_callback' => 'legit_news_sanitize_switch_control',
	)
);
$wp_customize->add_control( new Light_News_Switch_Control( $wp_customize, 'legit_news_theme_options[scroll_top_visible]',
    array(
		'label'      		=> esc_html__( 'Display Scroll Top Button', 'legit-news' ),
		'section'    		=> 'legit_news_section_footer',
		'on_off_label' 		=> legit_news_switch_options(),
    )
) );