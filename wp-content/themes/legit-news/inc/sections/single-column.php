<?php
/**
 * Single Column  section
 *
 * This is the template for the content of single_column section
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */
if ( ! function_exists( 'legit_news_add_single_column_section' ) ) :
    /**
    * Add single_column section
    *
    *@since Legit News 1.0.0
    */
    function legit_news_add_single_column_section() {
        $options = legit_news_get_theme_options();
        // Check if single_column is enabled on frontpage
        $single_column_enable = apply_filters( 'legit_news_section_status', false, 'single_column_section_enable' );

        if ( true !== $single_column_enable ) {
            return false;
        }
        // Get single_column section details
        $section_details = array();
        $section_details = apply_filters( 'legit_news_filter_single_column_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render single_column section now.
        legit_news_render_single_column_section( $section_details );
    }
endif;

if ( ! function_exists( 'legit_news_get_single_column_section_details' ) ) :
    /**
    * single_column section details.
    *
    * @since Legit News 1.0.0
    * @param array $input single_column section details.
    */
    function legit_news_get_single_column_section_details( $input ) {
        $options = legit_news_get_theme_options();
        $content = array();
       
        $cat_id = ! empty( $options['single_column_content_category'] ) ? $options['single_column_content_category'] : '';
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 3,
            'cat'               => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
            );                    

            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['id']        = get_the_id();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['excerpt']   = legit_news_trim_content( 25 );
                    $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() .'/assets/uploads/no-featured-image-590x650.jpg';

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
// single_column section content details.
add_filter( 'legit_news_filter_single_column_section_details', 'legit_news_get_single_column_section_details' );


if ( ! function_exists( 'legit_news_render_single_column_section' ) ) :
  /**
   * Start single_column section
   *
   * @return string single_column content
   * @since Legit News 1.0.0
   *
   */
   function legit_news_render_single_column_section( $content_details = array() ) {
        $options = legit_news_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="single-column-news" class="grid-layout">
            <?php if ( !empty( $options['single_column_title'] ) ): ?>
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html($options['single_column_title']); ?></h2>
                </div><!-- .section-header -->
            <?php endif ?>
            

            <div class="section-content col-2 clear">
                <?php foreach($content_details as $post): ?>

                <article class="has-post-thumbnail">
                    <div class="featured-image" style="background-image: url('<?php echo esc_url($post['image']); ?>');">
                        <a href="<?php echo esc_url($post['url']); ?>" class="post-thumbnail-link" title="<?php echo esc_attr( $post['title'] ); ?>"></a>

                        <div class="entry-meta">
                            <span class="cat-links">
                                <ul class="post-categories">
                                <?php the_category( '', '', $post['id'] ); ?>
                                </ul>
                            </span><!-- .cat-links -->
                        </div><!-- .entry-meta -->

                    </div><!-- .featured-image -->

                    <div class="entry-container">
                        <div class="footer-meta">
                        <?php 
                            legit_news_posted_on( $post['id'] );
                            echo legit_news_author($post['id']); ?>
                        </div><!-- .footer-meta -->

                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php echo esc_url( $post['url'] ); ?>"><?php echo esc_html($post['title']); ?></a></h2>
                        </header><!-- .entry-header -->
                        
                        <div class="entry-content">
                            <p><?php echo wp_kses_post($post['excerpt']); ?></p>
                        </div><!-- .entry-content -->
                    </div><!-- .entry-container -->
                </article>

                <?php endforeach; ?>
            </div><!-- .section-content -->
        </div><!-- #single-column-news -->
    <?php }
endif;
