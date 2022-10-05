<?php 
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */
$options = legit_news_get_theme_options();
    $class = has_post_thumbnail() ? '' : 'no-post-thumbnail';
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="featured-image" style="background-image:url('<?php the_post_thumbnail_url( 'post-thumbnail' ); ?>');">
            <a href="<?php the_permalink(); ?>" class="post-thumbnail-link" title="<?php the_title_attribute( ); ?>"></a>
            <?php if(! $options['hide_category']): ?>
            <div class="entry-meta">
                <span class="cat-links">
                <?php echo legit_news_article_footer_meta(); ?>
                </span>
            </div>
            <?php endif; ?>
        </div><!-- .featured-image-->
        <?php endif; ?>

        <div class="entry-container">
            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div><!-- .entry-content -->
        </div><!-- .entry-container -->
    </article>

