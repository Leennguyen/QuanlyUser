<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'legit_news_reset_section', array(
	'title'             => esc_html__('Reset all settings','legit-news'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'legit-news' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'legit_news_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'legit_news_sanitize_checkbox',
	'transport'			  => 'postMessage',
) );

$wp_customize->add_control( 'legit_news_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'legit-news' ),
	'section'           => 'legit_news_reset_section',
	'type'              => 'checkbox',
) );
