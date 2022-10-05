<?php

if ( ! function_exists( 'next_legit_news_add_media_posts_section' ) ) :

    function next_legit_news_add_media_posts_section() {

        if ( true !== get_theme_mod('legit_news_media_post_section_enable', false) ) {
            return false;
        }

        $section_details = array();
        $section_details = apply_filters( 'next_legit_news_filter_media_posts_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        next_legit_news_render_media_posts_section( $section_details );
    }
endif;

if ( ! function_exists( 'next_legit_news_get_media_posts_section_details' ) ) :

    function next_legit_news_get_media_posts_section_details( $input ) {
  
        $content = array();

        $cat_id = ! empty( get_theme_mod( 'legit_news_media_post_content_category' ) ) ? get_theme_mod( 'legit_news_media_post_content_category' ) : '';
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 6,
            'cat'               => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
            );                    

            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['id']        = get_the_id();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() .'/assets/uploads/no-featured-image-590x650.jpg';

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

add_filter( 'next_legit_news_filter_media_posts_section_details', 'next_legit_news_get_media_posts_section_details' );


if ( ! function_exists( 'next_legit_news_render_media_posts_section' ) ) :

   function next_legit_news_render_media_posts_section( $content_details = array() ) {
        $options = legit_news_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } 
        $main_post = array_shift($content_details);
        ?>
        <div id="media-posts" class="relative grid-layout">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'legit_news_media_posts_title' ) ); ?></h2>
            </div>

            <div class="media-posts-wrapper col-2 clear">
                <div class="half-width grid-layout">
                    <?php $i=1; foreach ( $content_details as $post ): ?>
                        <?php if ( $i == 1 ): ?>
                            <article class="has-post-thumbnail">
                                <div class="featured-image" style="background-image: url('<?php echo esc_url($post['image']); ?>');">
                                    <a href="<?php echo esc_url( $post['url'] ); ?>" class="post-thumbnail-link" title="<?php echo esc_attr( $post['title'] ); ?>"></a>
                                    <div class="entry-meta">
                                        <span class="cat-links">
                                            <?php the_category( '', '', $post['id'] ); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="footer-meta">
                                <?php 
                                    legit_news_posted_on( $main_post['id'] );
                                    echo legit_news_author($main_post['id']); ?>
                                </div>
                                <div class="entry-container">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url($post['url']); ?>"><?php echo esc_html($post['title']); ?></a></h2>
                                    </header>
                                </div>
                            </article>
                        <?php endif ?>
                    <?php $i++; endforeach ?>
                </div>

                <div class="half-width widget_recent_news">
                    <ul>
                        <?php $i=1; foreach ( $content_details as $post ): ?>
                            <?php if ( $i !== 1 ): ?>
                                <li>
                                    <?php echo sprintf( '<a href="%s"><img src="%s" alt="%s"></a>', esc_url($post['url']), esc_url($post['image']), esc_html($post['title']) ); ?> 
                                    <div class="entry-container">
                                        <?php legit_news_posted_on( $post['id'] ); ?>
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="<?php echo esc_url($post['url']); ?>"><?php echo esc_html($post['title']); ?></a></h2>
                                        </header>
                                    </div>
                                </li>
                            <?php endif ?>
                        <?php $i++; endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php }
endif;
