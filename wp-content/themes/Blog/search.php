<?php get_header(); ?>
    <div class="wrapper-content clearfix" data-sidebar="right">
        <div class="wrapper-posts">
            <div class="blog-posts list-layout kira">
                <h1 class="title">
                   Kết quả tìm kiếm
                </h1>
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <div class="post post-list has-post-thumbnail">
                    <div class="post-media">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo get_the_post_thumbnail( $post_id, 'post-thumb' ); ?>
                        </a>
                    </div>
                    <div class="post-content">
                        <div class="post-cat">
                            <ul>
                                <?php the_category(' / ' ); ?>
                            </ul>
                        </div>
                        <h2 class="title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="post-detail">
                            <a class="date"><?php echo get_the_date(); ?></a>
                        </div>

                        <div class="the-excerpt">
                            <p><?php echo teaser(40); ?></p>
                        </div>

                        <div class="post-footer clearfix">
                            <div class="wrap-read-more">
                                <div class="read-more">
                                    <a href="<?php the_permalink(); ?>">Xem thêm</a>
                                </div>
                            </div>
                            <div class="post-share">
                                <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                <a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; else : ?>
                <p>Không tìm thấy bài viết!</p>
                <?php endif; ?>
                <!-- Get post mặt định -->
            </div>
            <div class="pagination-wrap">
                <ul class="pagination clearfix">
                    <?php if(paginate_links()!='') {?>
                    <div class="quatrang">
                        <?php
                        global $wp_query;
                        $big = 999999999;
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'prev_text'    => __('«'),
                            'next_text'    => __('»'),
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages
                            ) );
                        ?>
                    </div>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>