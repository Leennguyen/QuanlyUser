<?php get_header(); ?>
<main>
<div class="content">
	<div class="single-page">
		<div class="content-single">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php get_template_part('teamplate-content/content-post/content') ?>
					<?php get_template_part('page/single/Showrelated', 'posts'); ?>
					<?php get_template_part('teamplate-content/author', 'bio'); ?>
					<?php if (comments_open() || get_comments_number()) :
						comments_template();
					endif;   ?>
				<?php endwhile ?>
			<?php else : ?>
				<?php get_template_part('teamplate-content/content-post/content', 'none'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<!--<div class="sidebar">-->
<!--	--><?php //get_sidebar(); ?>
<!--</div>-->
<!--			</main>-->
<!--	</div>-->
<!--	--><?php //get_footer(); ?>