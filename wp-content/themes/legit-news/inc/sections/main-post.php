<?php
/**
 * Must Read  section
 *
 * This is the template for the content of main_post section
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */
if ( ! function_exists( 'legit_news_add_main_post_section' ) ) :
    /**
    * Add main_post section
    *
    *@since Legit News 1.0.0
    */
    function legit_news_add_main_post_section() { ?>
        <div id="main-post-wrapper" class="wrapper margin-top">
            <?php if( is_active_sidebar('main-left-sidebar') ) : ?>
                <aside id="left-sidebar" class="widget-area" role="complementary">
                    <?php dynamic_sidebar('main-left-sidebar'); ?>
                </aside><!-- #left-sidebar -->
            <?php endif; ?>

            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                <?php 
                add_action('legit_news_main_post','legit_news_add_photography_section');
                add_action('legit_news_main_post','legit_news_add_single_column_section'); 
                do_action('legit_news_main_post');?>

                
                </main><!-- #main -->
            </div><!-- #primary -->

            <?php if( is_active_sidebar('main-right-sidebar') ) : ?>
            <aside id="secondary" class="widget-area right-sidebar" role="complementary">
                <?php dynamic_sidebar('main-right-sidebar');?>
            </aside><!-- #secondary -->
            <?php endif; ?>
        </div><!-- #main-post-wrapper -->
    <?php }

endif;
