<?php
/**
 * Breaking News section
 *
 * This is the template for the content of Breaking News section
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */
if ( ! function_exists( 'legit_news_add_breaking_news_section' ) ) :
    /**
    * Add Breaking News section
    *
    *@since Legit News 1.0.0
    */
    function legit_news_add_breaking_news_section() {
    	$options = legit_news_get_theme_options();
        // Check if Breaking News is enabled on frontpage
        $breaking_news_enable = apply_filters( 'legit_news_section_status', false, 'breaking_news_section_enable' );

        if ( true !== $breaking_news_enable ) {
            return false;
        }
        // Get Breaking News section details
        $section_details = array();
        $section_details = apply_filters( 'legit_news_filter_breaking_news_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Breaking News section now.
        legit_news_render_breaking_news_section( $section_details );
    }
endif;

if ( ! function_exists( 'legit_news_get_breaking_news_section_details' ) ) :
    /**
    * Breaking News section details.
    *
    * @since Legit News 1.0.0
    * @param array $input Breaking News section details.
    */
    function legit_news_get_breaking_news_section_details( $input ) {
        $options = legit_news_get_theme_options();
        $content = array();

        $page_ids = array();

        for ( $i = 1; $i <= 4; $i++ ) {
            if ( ! empty( $options['breaking_news_content_post_' . $i] ) )
                $page_ids[] = $options['breaking_news_content_post_' . $i];
        }
        
        $args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 4,
            'orderby'           => 'post__in',
            );          


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();
            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;

// Breaking News section content details.
add_filter( 'legit_news_filter_breaking_news_section_details', 'legit_news_get_breaking_news_section_details' );

if ( ! function_exists( 'legit_news_render_breaking_news_section' ) ) :
  /**
   * Start Breaking News section
   *
   * @return string Breaking News content
   * @since Legit News 1.0.0
   *
   */
   function legit_news_render_breaking_news_section( $content_details = array() ) {
        $options = legit_news_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="breaking-news" class="relative wrapper">
            <div class="breaking-news-wrapper">
            <h2 class="news-title"><?php echo esc_html($options['breaking_news_title']); ?></h2>
                <div class="breaking-news-slider" data-slick='{"slidesToShow": 2, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": false, "arrows":true, "autoplay": true, "draggable": true, "fade": false }'>
                    <?php foreach($content_details as $post):?>
                    <article>
                        <div class="breaking-news-item-wrapper">
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php echo esc_url($post['url']); ?>"><?php echo esc_html($post['title']); ?></a></h2>
                            </header>
                        </div><!-- .breaking-news-item-wrapper -->
                    </article>
                    <?php endforeach; ?>
                </div><!-- .breaking-news-slider -->
            </div><!-- .breaking-news-wrapper -->
        </div><!-- #breaking-news -->
    <?php }
endif;