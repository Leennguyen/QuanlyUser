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
		<?php if( has_post_thumbnail() && !$options['single_post_hide_featured_image'] ) : ?>
			<div class="featured-image">
				<img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute( ); ?>">
			</div><!-- .featured-image-->
		<?php endif; ?>

    <div class="entry-container">
		<div class="entry-meta">
            <span class="cat-links">
            <?php echo legit_news_single_categories(); ?>
			</span>				
        </div>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'legit-news' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'legit-news' ),
				'after'  => '</div>',
			) );
		?>
		</div>
    </div><!-- .entry-container -->
    <div class="entry-meta">
    	<?php 		
		if ( ! $options['single_post_hide_author'] ) :
			echo legit_news_author();
		endif; 
		if (! $options['single_post_hide_date']) legit_news_posted_on($post->ID);
		?>
    </div>
	<?php
	legit_news_entry_footer(); 
	?>
</article><!-- #post-## -->
