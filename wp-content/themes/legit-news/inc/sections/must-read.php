<?php
/**
 * Must Read  section
 *
 * This is the template for the content of must_read section
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */
if ( ! function_exists( 'legit_news_add_must_read_section' ) ) :
    /**
    * Add must_read section
    *
    *@since Legit News 1.0.0
    */
    function legit_news_add_must_read_section() {
        $options = legit_news_get_theme_options();
        // Check if must_read is enabled on frontpage
        $must_read_enable = apply_filters( 'legit_news_section_status', false, 'must_read_section_enable' );

        if ( true !== $must_read_enable ) {
            return false;
        }
        // Get must_read section details
        $section_details = array();
        $section_details = apply_filters( 'legit_news_filter_must_read_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render must_read section now.
        legit_news_render_must_read_section( $section_details );
    }
endif;

if ( ! function_exists( 'legit_news_get_must_read_section_details' ) ) :
    /**
    * must_read section details.
    *
    * @since Legit News 1.0.0
    * @param array $input must_read section details.
    */
    function legit_news_get_must_read_section_details( $input ) {
        $options = legit_news_get_theme_options(); 
        $content = array();
        $post_ids = array();

        for ( $i = 1; $i <= 4; $i++ ) {
            if ( ! empty( $options['must_read_content_post_' . $i] ) )
                $post_ids[] = $options['must_read_content_post_' . $i];
        }
        
        $args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $post_ids,
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
// must_read section content details.
add_filter( 'legit_news_filter_must_read_section_details', 'legit_news_get_must_read_section_details' );


if ( ! function_exists( 'legit_news_render_must_read_section' ) ) :
  /**
   * Start must_read section
   *
   * @return string must_read content
   * @since Legit News 1.0.0
   *
   */
   function legit_news_render_must_read_section( $content_details = array() ) {
        $options = legit_news_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
         <div id="must-read">
                <div class="wrapper">
                    <?php if ( !empty( $options['must_read_title'] ) ): ?>
                        <div class="section-header">
                            <h2 class="section-title"><?php echo esc_html($options['must_read_title']); ?></h2>
                        </div><!-- .section-header -->
                    <?php endif ?>
                    

                    <div class="section-content col-4 clear">
                        <?php foreach($content_details as $post): ?>
                        <article class="hentry">
                            <div class="featured-image" style="background-image: url('<?php echo esc_url($post['image']); ?>');">
                                <a href="<?php echo esc_url( $post['url'] ); ?>" class="post-thumbnail-link" title="<?php echo esc_attr( $post['title'] ); ?>"></a>
                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <?php the_category( '', '', $post['id'] ); ?>
                                    </span><!-- .cat-links -->      
                                </div>
                            </div><!-- .featured-image -->

                            <div class="entry-container">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $post['url'] ); ?>"><?php echo esc_html($post['title']); ?></a></h2>
                                </header>

                                <div class="footer-meta">
                                <?php 
                                legit_news_posted_on( $post['id'] );
                                echo legit_news_author($post['id']); ?>
                                 
                                </div><!-- .entry-meta -->
                            </div><!-- .entry-container -->
                        </article>
                        <?php endforeach; ?>
                    </div><!-- .section-content -->
                </div><!-- .wrapper -->
            </div><!-- #must-read -->
    <?php }
endif;
