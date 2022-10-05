<?php

if ( ! function_exists( 'next_legit_news_add_hero_post_section' ) ) :
 
    function next_legit_news_add_hero_post_section() {
        $options = legit_news_get_theme_options();

        $hero_post_enable = apply_filters( 'legit_news_section_status', false, 'hero_post_section_enable' );

        if ( true !== $hero_post_enable ) {
            return false;
        }

        $section_details = array();
        $section_details = apply_filters( 'next_legit_news_filter_hero_post_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        next_legit_news_render_hero_post_section( $section_details );

    }
endif;

if ( ! function_exists( 'next_legit_news_get_hero_post_section_details' ) ) :

    function next_legit_news_get_hero_post_section_details( $input ) {
        $options = legit_news_get_theme_options();
        $content = array();
        $cat_id = ! empty( $options['hero_post_content_category'] ) ? $options['hero_post_content_category'] : '';
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 3,
            'cat'               => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
            );                    


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

add_filter( 'next_legit_news_filter_hero_post_section_details', 'next_legit_news_get_hero_post_section_details' );


if ( ! function_exists( 'next_legit_news_render_hero_post_section' ) ) :

   function next_legit_news_render_hero_post_section( $content_details = array() ) {
        $options = legit_news_get_theme_options();
        $btn_label = $options['hero_post_btn_title'];

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="hero-posts">
            <div class="wrapper">
                <div class="hero-wrapper col-2">
                    <div class="hentry">

                        <div class="mid-posts">
                        <?php foreach($content_details['mid_post'] as $post): ?>
                            <article>
                                <div class="mid-wrapper">
                                    <div class="featured-image" style="background-image: url('<?php echo esc_url($post['image']); ?>');">
                                        <a href="<?php echo esc_url( $post['url'] ); ?>" class="post-thumbnail-link" title="<?php echo esc_attr( $post['title'] ); ?>"> </a>
                                        <div class="entry-meta">
                                            <span class="cat-links">
                                                <?php the_category( '', '', $post['id'] ); ?>
                                            </span>
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
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                            <?php endforeach ;?>
                        </div>
                        
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
                                                </span>
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

                        </div>

                    </div>

                    <?php if( is_active_sidebar('hero-post-sidebar') ) : ?>
                        <div class="hentry">
                            <div class="right-post">
                                <?php dynamic_sidebar('hero-post-sidebar');?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php }
endif;
