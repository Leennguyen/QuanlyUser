<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php (!is_single() ? printf('<div class="entry-thumbnail">' .
		congbio_thumbnail('large') . '</div>') : ''); ?>

	<header class="entry-header">
		<?php congbio_entry_header(); ?>
		<?php congbio_entry_meta() ?>
		<?php $category = get_the_category(); ?>

		<?php (is_front_page() ?
			printf('<p class="post_">
			  <li> <p>%2$s</p> </li><div class="view">
			<a href="%1$s ">view</a>
		</div>
		</p>', get_permalink(), $category[0]->name) : '') ?>


	</header>
<!--	<div class="entry-content">-->
<!--		--><?php //congbio_entry_content(); ?>
<!--		--><?php //(is_single() ? congbio_entry_tag() : ''); ?>
<!--	</div>-->
	<div class="post">
		<a class="date"><?php echo get_the_date(); ?></a>
		<a><i class="fa fa-user"></i> <?php the_author(); ?></a>
		<a><i class="fa fa-eye"></i> <?php echo getpostviews(get_the_id()); ?> Lượt xem</a>
	</div>
</article>