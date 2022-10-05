<?php

if ( ! function_exists( 'next_legit_news_add_main_post_section' ) ) :

    function next_legit_news_add_main_post_section() { ?>
        <div id="main-post-wrapper" class="wrapper margin-top">
            
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                <?php 
                add_action('legit_news_main_post','next_legit_news_add_media_posts_section');
                add_action('legit_news_main_post','legit_news_add_photography_section');
                add_action('legit_news_main_post','legit_news_add_single_column_section'); 
                do_action('legit_news_main_post');?>

                </main>
            </div>
            <?php if( is_active_sidebar('main-right-sidebar') ) : ?>
            <aside id="secondary" class="widget-area right-sidebar" role="complementary">
                <?php dynamic_sidebar('main-right-sidebar');?>
            </aside>
            <?php endif; ?>
        </div>
    <?php }

endif;
