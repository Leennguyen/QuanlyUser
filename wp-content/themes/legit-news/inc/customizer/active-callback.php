<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

if ( ! function_exists( 'legit_news_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since Legit News 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function legit_news_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'legit_news_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'legit_news_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Legit News 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function legit_news_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'legit_news_theme_options[pagination_enable]' )->value();
	}
endif;

/**
 * Front Page Active Callbacks
 */

/**
 * Check if topbar section is enabled.
 *
 * @since Legit News 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function legit_news_is_topbar_section_enable( $control ) {
	return ( $control->manager->get_setting( 'legit_news_theme_options[topbar_section_enable]' )->value() );
}

/****************************Ads****************************************** */
/**
 * Check if Ads section is enabled.
 *
 * @since Legit News 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function legit_news_is_ads_section_enable( $control ) {
	return ( $control->manager->get_setting( 'legit_news_theme_options[ads_section_enable]' )->value() );
}

/****************************Breaking News****************************************** */
/**
 * Check if Breaking News section is enabled.
 *
 * @since Legit News 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function legit_news_is_breaking_news_section_enable( $control ) {
	return ( $control->manager->get_setting( 'legit_news_theme_options[breaking_news_section_enable]' )->value() );
}


/****************************Hero Post****************************************** */

/**
 * Check if hero_post section is enabled.
 *
 * @since Legit News 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function legit_news_is_hero_post_section_enable( $control ) {
	return ( $control->manager->get_setting( 'legit_news_theme_options[hero_post_section_enable]' )->value() );
}


/**
 * Check if must_read section is enabled.
 *
 * @since Legit News 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function legit_news_is_must_read_section_enable( $control ) {
	return ( $control->manager->get_setting( 'legit_news_theme_options[must_read_section_enable]' )->value() );
}

/**
 * Check if photography section is enabled.
 *
 * @since Legit News 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function legit_news_is_photography_section_enable( $control ) {
	return ( $control->manager->get_setting( 'legit_news_theme_options[photography_section_enable]' )->value() );
}

/**
 * Check if single_column section is enabled.
 *
 * @since Legit News 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function legit_news_is_single_column_section_enable( $control ) {
	return ( $control->manager->get_setting( 'legit_news_theme_options[single_column_section_enable]' )->value() );
}


/**
 * Check if related_post section is enabled.
 *
 * @since Legit News 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function legit_news_is_related_post_section_enable( $control ) {
	return ( $control->manager->get_setting( 'legit_news_theme_options[related_post_section_enable]' )->value() );
}

/**
 * Check if weather section is enabled.
 *
 * @since Legit News 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function legit_news_is_weather_section_enable( $control ) {
	return ( $control->manager->get_setting( 'legit_news_theme_options[weather_section_enable]' )->value() );
}
