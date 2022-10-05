<?php
/**
 * Photography  section
 *
 * This is the template for the content of photography section
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */
if ( ! function_exists( 'legit_news_add_photography_section' ) ) :
    /**
    * Add photography section
    *
    *@since Legit News 1.0.0
    */
    function legit_news_add_photography_section() {
        $options = legit_news_get_theme_options();
        // Check if photography is enabled on frontpage
        $photography_enable = apply_filters( 'legit_news_section_status', false, 'photography_section_enable' );

        if ( true !== $photography_enable ) {
            return false;
        }
        // Get photography section details
        $section_details = array();
        $section_details = apply_filters( 'legit_news_filter_photography_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render photography section now.
        legit_news_render_photography_section( $section_details );
    }
endif;

if ( ! function_exists( 'legit_news_get_photography_section_details' ) ) :
    /**
    * photography section details.
    *
    * @since Legit News 1.0.0
    * @param array $input photography section details.
    */
    function legit_news_get_photography_section_details( $input ) {
        $options = legit_news_get_theme_options();        
        $content = array();

        $cat_id = ! empty( $options['photography_content_category'] ) ? $options['photography_content_category'] : '';
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 5,
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
// photography section content details.
add_filter( 'legit_news_filter_photography_section_details', 'legit_news_get_photography_section_details' );


if ( ! function_exists( 'legit_news_render_photography_section' ) ) :
  /**
   * Start photography section
   *
   * @return string photography content
   * @since Legit News 1.0.0
   *
   */
   function legit_news_render_photography_section( $content_details = array() ) {
        $options = legit_news_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } 
        $main_post = array_shift($content_details);
        ?>
        <div id="reading" class="relative">
            <?php if ( !empty( $options['photography_title'] ) ): ?>
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html($options['photography_title']); ?></h2>
                </div><!-- .section-header -->
            <?php endif ?>
           

            <div class="reading-wrapper">
                <article class="has-post-thumbnail">
                    <div class="featured-image" style="background-image: url('<?php echo esc_url($main_post['image']); ?>');">
                        <div class="entry-container">
                            <div class="entry-meta">
                                <span class="cat-links">
                                    <ul class="post-categories">
                                        <?php the_category( '', '', $main_post['id'] ); ?>
                                    </ul>
                                </span><!-- .cat-links -->      
                            </div><!-- .entry-meta -->

                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php echo esc_url($main_post['url']); ?>"><?php echo esc_html($main_post['title']); ?></a></h2>
                            </header>

                            <div class="footer-meta">
                            <?php 
                                legit_news_posted_on( $main_post['id'] );
                                echo legit_news_author($main_post['id']); ?>
                            </div><!-- .footer-meta -->
                        </div><!-- .entry-container -->
                    </div><!-- .featured-image -->
                </article>
            </div>

            <div class="widget_recent_news col-2 clear">
                <ul>
                <?php foreach($content_details as $post): ?>
                    <li>
                    <?php 
                    echo sprintf( '<a href="%s"><img src="%s" alt="%s"></a>', esc_url($post['url']), esc_url($post['image']), esc_html($post['title']) ); ?>

                        <div class="entry-container">
                            <?php legit_news_posted_on( $post['id'] ); ?>
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php echo esc_url($post['url']); ?>"><?php echo esc_html($post['title']); ?></a></h2>
                            </header>
                        </div><!-- .entry-container -->
                    </li>
                <?php endforeach; ?>
                </ul>
            </div><!-- .widget_recent_news -->
        </div><!-- #reading -->
    <?php }
endif;
