<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage Legit News
* @since Legit News 1.0.0
*/

if ( ! function_exists( 'legit_news_breaking_news_title_partial' ) ) :
    // Breaking news section partial refresh title
    function legit_news_breaking_news_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['breaking_news_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_hero_post_btn_title_partial' ) ) :
    // Breaking news section partial refresh title
    function legit_news_hero_post_btn_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['hero_post_btn_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_must_read_title_partial' ) ) :
    // must_read title
    function legit_news_must_read_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['must_read_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_trending_news_title_partial' ) ) :
    // trending_news_title
    function legit_news_trending_news_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['trending_news_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_fashion_title_partial' ) ) :
    // fashion_title
    function legit_news_fashion_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['fashion_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_photography_title_partial' ) ) :
    // photography_title
    function legit_news_photography_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['photography_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_culture_title_partial' ) ) :
    // culture title
    function legit_news_culture_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['culture_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_single_column_title_partial' ) ) :
    // single_column_title
    function legit_news_single_column_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['single_column_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_related_post_title_partial' ) ) :
    // must_read title
    function legit_news_related_post_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['related_post_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_related_post_btn_title_partial' ) ) :
    // must_read title
    function legit_news_related_post_btn_title_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['related_post_btn_title'] );
    }
endif;

if ( ! function_exists( 'legit_news_copyright_text_partial' ) ) :
    // copyright text
    function legit_news_copyright_text_partial() {
        $options = legit_news_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;
