<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function legit_news_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'legit-news' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function legit_news_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'legit-news' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}

/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function legit_news_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'category',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'legit-news' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}

if ( ! function_exists( 'legit_news_typography_options' ) ) :
    /**
     * Returns list of typography
     * @return array font styles
     */
    function legit_news_typography_options(){
        $choices = array(
            'default'         => esc_html__( 'Default', 'legit-news' ),
            'header-font-1'   => esc_html__( 'Rajdhani', 'legit-news' ),
            'header-font-2'   => esc_html__( 'Cherry Swash', 'legit-news' ),
            'header-font-3'   => esc_html__( 'Philosopher', 'legit-news' ),
            'header-font-4'   => esc_html__( 'Slabo 27px', 'legit-news' ),
            'header-font-5'   => esc_html__( 'Dosis', 'legit-news' ),
            'header-font-6'   => esc_html__( 'PLayfair Display', 'legit-news' ),
        );

        $output = apply_filters( 'legit_news_typography_options', $choices );
        if ( ! empty( $output ) ) {
            ksort( $output );
        }

        return $output;
    }
endif;


if ( ! function_exists( 'legit_news_body_typography_options' ) ) :
    /**
     * Returns list of typography
     * @return array font styles
     */
    function legit_news_body_typography_options(){
        $choices = array(
            'default'         => esc_html__( 'Default', 'legit-news' ),
            'body-font-1'     => esc_html__( 'News Cycle', 'legit-news' ),
            'body-font-2'     => esc_html__( 'Pontano Sans', 'legit-news' ),
            'body-font-3'     => esc_html__( 'Gudea', 'legit-news' ),
            'body-font-4'     => esc_html__( 'Quattrocento', 'legit-news' ),
            'body-font-5'     => esc_html__( 'Khand', 'legit-news' ),
        );

        $output = apply_filters( 'legit_news_body_typography_options', $choices );
        if ( ! empty( $output ) ) {
            ksort( $output );
        }

        return $output;
    }
endif;


if ( ! function_exists( 'legit_news_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function legit_news_site_layout() {
        $legit_news_site_layout = array(
            'wide'  => get_template_directory_uri() . '/assets/images/full.png',
            'boxed-layout' => get_template_directory_uri() . '/assets/images/boxed.png',
        );

        $output = apply_filters( 'legit_news_site_layout', $legit_news_site_layout );
        return $output;
    }
endif;

if ( ! function_exists( 'legit_news_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function legit_news_selected_sidebar() {
        $legit_news_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'legit-news' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar', 'legit-news' ),
           ); 
        $output = apply_filters( 'legit_news_selected_sidebar', $legit_news_selected_sidebar );

        return $output;
    }
endif;


if ( ! function_exists( 'legit_news_global_sidebar_position' ) ) :
    /**
     * Global Sidebar position
     * @return array Global Sidebar positions
     */
    function legit_news_global_sidebar_position() {
        $legit_news_global_sidebar_position = array(
            'right-sidebar' => get_template_directory_uri() . '/assets/images/right.png',
            'no-sidebar'    => get_template_directory_uri() . '/assets/images/full.png',
        );

        $output = apply_filters( 'legit_news_global_sidebar_position', $legit_news_global_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'legit_news_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function legit_news_sidebar_position() {
        $legit_news_sidebar_position = array(
            'right-sidebar' => get_template_directory_uri() . '/assets/images/right.png',
            'no-sidebar'    => get_template_directory_uri() . '/assets/images/full.png',
        );

        $output = apply_filters( 'legit_news_sidebar_position', $legit_news_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'legit_news_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function legit_news_pagination_options() {
        $legit_news_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'legit-news' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'legit-news' ),
        );

        $output = apply_filters( 'legit_news_pagination_options', $legit_news_pagination_options );

        return $output;
    }
endif;


if ( ! function_exists( 'legit_news_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function legit_news_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'legit-news' ),
            'off'       => esc_html__( 'Disable', 'legit-news' )
        );
        return apply_filters( 'legit_news_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'legit_news_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function legit_news_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'legit-news' ),
            'off'       => esc_html__( 'No', 'legit-news' )
        );
        return apply_filters( 'legit_news_hide_options', $arr );
    }
endif;

