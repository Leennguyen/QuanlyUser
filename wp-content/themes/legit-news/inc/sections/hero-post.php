<?php
/**
 * Hero Post section
 *
 * This is the template for the content of Hero Post section
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */
if ( ! function_exists( 'legit_news_add_hero_post_section' ) ) :
    /**
    * Add Hero Post section
    *
    *@since Legit News 1.0.0
    */
    function legit_news_add_hero_post_section() {
        $options = legit_news_get_theme_options();
        // Check if Hero Post is enabled on frontpage
        $hero_post_enable = apply_filters( 'legit_news_section_status', false, 'hero_post_section_enable' );

        if ( true !== $hero_post_enable ) {
            return false;
        }
        // Get Hero Post section details
        $section_details = array();
        $section_details = apply_filters( 'legit_news_filter_hero_post_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        // Render Hero Post section now.
        legit_news_render_hero_post_section( $section_details );

    }
endif;

if ( ! function_exists( 'legit_news_get_hero_post_section_details' ) ) :
    /**
    * Hero Post section details.
    *
    * @since Legit News 1.0.0
    * @param array $input Hero Post section details.
    */
    function legit_news_get_hero_post_section_details( $input ) {
        $options = legit_news_get_theme_options();
        $content = array();
        $cat_id = ! empty( $options['hero_post_content_category'] ) ? $options['hero_post_content_category'] : '';
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 3,
            'cat'               => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
            );                    


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : $i = 1;
            $content['left_post'] = array();
            $content['mid_post'] = array();
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = legit_news_trim_content( 25 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : get_template_directory_uri() .'/assets/uploads/no-featured-image-590x650.jpg';

                // Push to the main array.
                if($i % 3 == 1 || $i % 3 == 0){
                    array_push( $content['left_post'], $page_post );
                }else{
                    array_push( $content['mid_post'], $page_post );
                }
                $i++;
            endwhile;
        endif;
        wp_reset_postdata();
            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;

// Hero Post section content details.
add_filter( 'legit_news_filter_hero_post_section_details', 'legit_news_get_hero_post_section_details' );


if ( ! function_exists( 'legit_news_render_hero_post_section' ) ) :
  /**
   * Start Hero Post section
   *
   * @return string Hero Post content
   * @since Legit News 1.0.0
   *
   */
   function legit_news_render_hero_post_section( $content_details = array() ) {
        $options = legit_news_get_theme_options();
        $btn_label = $options['hero_post_btn_title'];

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="hero-posts">
            <div class="wrapper">
                <div class="hero-wrapper col-2">
                    <div class="hentry">
                        <div class="left-posts">
                            <?php foreach($content_details['left_post'] as $post): ?>
                            <article>
                                <div class="image-wrapper clear">
                                    <div class="featured-wrapper">
                                        <div class="featured-image" style="background-image: url('<?php echo esc_url($post['image']); ?>');">
                                            <a href="<?php echo esc_url( $post['url'] ); ?>" class="post-thumbnail-link" title=<?php echo esc_attr( $post['title'] ); ?>></a>
                                            <div class="entry-meta">
                                                <span class="cat-links">
                                                    <?php the_category( '', '', $post['id'] ); ?>
                                                </span><!-- .cat-links -->      
                                            </div>
                                        </div>
                                    </div>

                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url( $post['url'] ); ?>"><?php echo esc_html($post['title']); ?></a></h2>
                                        
                                        <?php legit_news_posted_on( $post['id'] ); ?>
                                    </header>
                                </div>

                                <div class="entry-container">
                                    <div class="entry-content">
                                        <p><?php echo wp_kses_post($post['excerpt']); ?></p>
                                    </div>

                                    <div class="view-all">
                                        <a href="<?php echo esc_url( $post['url'] ); ?>" class="more-link"><?php echo esc_html($btn_label);
                                        echo legit_news_get_svg( array( 'icon' => 'arrow-right' ) );?>
                                        </a>
                                    </div>
                                </div>
                            </article>

                            <?php endforeach ;?>

                        </div><!-- .left-post -->

                        <div class="mid-posts">
                        <?php foreach($content_details['mid_post'] as $post): ?>
                            <article>
                                <div class="mid-wrapper">
                                    <div class="featured-image" style="background-image: url('<?php echo esc_url($post['image']); ?>');">
                                        <a href="<?php echo esc_url( $post['url'] ); ?>" class="post-thumbnail-link" title="<?php echo esc_attr( $post['title'] ); ?>"> </a>
                                        <div class="entry-meta">
                                            <span class="cat-links">
                                                <?php the_category( '', '', $post['id'] ); ?>
                                            </span><!-- .cat-links -->      
                                        </div>
                                    </div>

                                    <div class="entry-container">
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $post['url'] ); ?>"><?php echo esc_html($post['title']); ?></a></h2>
                                        </header>

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
                                </div><!-- .mid-wrapper -->
                            </article>
                            <?php endforeach ;?>
                        </div><!-- .mid-post -->
                    </div><!-- .hentry -->

            <?php if( is_active_sidebar('hero-post-sidebar') ) : ?>
                    <div class="hentry">
                        <div class="right-post">
                            <?php dynamic_sidebar('hero-post-sidebar');?>
                        </div><!-- .right -post -->
                    </div><!-- .hentry -->
            <?php endif; ?>
                </div><!-- .hero-wrapper -->
            </div><!-- .wrapper -->
        </div><!-- #hero-posts -->   
    <?php }
endif;
