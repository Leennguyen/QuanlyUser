<div class="home_newpost">

    <ul class="news">
        <?php $postquery = new WP_Query(array('posts_per_page' => '6'));
		if ($postquery->have_posts()) {
			while ($postquery->have_posts()) : $postquery->the_post();
				$do_not_duplicate = $post->ID;
		?>
        <div class="post_format">
            <?php get_template_part('teamplate-content/content-post/lefImage_rightContent','' )?>
        </div>
        <?php endwhile;
			?>
        <?php


		} ?>


</div>