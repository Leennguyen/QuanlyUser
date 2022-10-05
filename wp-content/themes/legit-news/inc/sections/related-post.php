<?php
/**
 * Related Post section
 *
 * This is the template for the content of related_post section
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */
if ( ! function_exists( 'legit_news_add_related_post_section' ) ) :
    /**
    * Add related_post section
    *
    *@since Legit News 1.0.0
    */
    function legit_news_add_related_post_section() {
        $options = legit_news_get_theme_options();

        // Check if related_post is enabled on frontpage
        $related_post_enable = apply_filters( 'legit_news_section_status', false, 'related_post_section_enable' );

        if ( true !== $related_post_enable ) {
            return false;
        }
        // Get related_post section details
        $section_details = array();
        $section_details = apply_filters( 'legit_news_filter_related_post_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render related_post section now.
        legit_news_render_related_post_section( $section_details );
    }
endif;

if ( ! function_exists( 'legit_news_get_related_post_section_details' ) ) :
    /**
    * related_post section details.
    *
    * @since Legit News 1.0.0
    * @param array $input related_post section details.
    */
    function legit_news_get_related_post_section_details( $input ) {
        $options = legit_news_get_theme_options();
        $content = array();
        $post_ids = array();

        for ( $i = 1; $i <= 4; $i++ ) {
            if ( ! empty( $options['related_post_content_post_' . $i] ) )
                $post_ids[] = $options['related_post_content_post_' . $i];
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
// related_post section content details.
add_filter( 'legit_news_filter_related_post_section_details', 'legit_news_get_related_post_section_details' );


if ( ! function_exists( 'legit_news_render_related_post_section' ) ) :
  /**
   * Start related_post section
   *
   * @return string related_post content
   * @since Legit News 1.0.0
   *
   */
   function legit_news_render_related_post_section( $content_details = array() ) {
        $options = legit_news_get_theme_options();
        $btn_label = $options['related_post_btn_title'];

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="related-posts" class="grid-layout">
            <div class="wrapper">
                <?php if ( !empty( $options['related_post_title'] ) ): ?>
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html($options['related_post_title'])?></h2>
                    </div><!-- .section-header -->
                <?php endif ?>
                

                <div class="section-content col-4 clear">
                    <?php foreach($content_details as $post): ?>
                    <article class="has-post-thumbnail">
                        <div class="related-wrapper clear">
                            <div class="featured-wrapper">
                                <div class="featured-image" style="background-image: url('<?php echo esc_url($post['image']); ?>');">
                                    <a href="<?php echo esc_url($post['url']); ?>" class="post-thumbnail-link" title="<?php echo esc_html($post['title']); ?>"></a>
                                    <div class="entry-meta">
                                        <span class="cat-links">
                                            <?php the_category( '', '', $post['id'] ); ?>
                                        </span><!-- .cat-links -->      
                                    </div>
                                </div><!-- .featured-image -->

                            </div>
                            
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php echo esc_url( $post['url'] ); ?>"><?php echo esc_html($post['title']); ?></a></h2>
                                <?php legit_news_posted_on( $post['id'] ); ?>
                            </header>

                        </div><!-- .related-wrapper -->

                        <div class="entry-container">

                            <div class="entry-content">
                                <p><?php echo wp_kses_post($post['excerpt']); ?></p>
                            </div>

                            <?php if(!empty($btn_label)): ?>
                                <div class="view-all">
                                    <a href="<?php echo esc_url( $post['url'] ); ?>" class="more-link"><?php echo esc_html($btn_label);
                                        echo legit_news_get_svg( array( 'icon' => 'arrow-right' ) );?>
                                    </a>
                                </div><!-- .view-all -->
                            <?php endif; ?>

                        </div><!-- .entry-container -->
                    </article>
                    <?php endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #most-viewed-posts -->
    <?php }
endif;
