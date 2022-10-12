<?php
$args = array(
	'posts_per_page' => 10,  //Số lượng bài viết muốn lấy
	'orderby' => 'rand',
	'post_type' => 'post'
);
$featured = new WP_Query($args);
?>
<div class="random_title">
    <?php  
		if ($featured->have_posts())
			while ($featured->have_posts()) : $featured->the_post();
				$do_not_duplicate = $post->ID;
		?>
    <h3 class="title">
        <a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>

    </h3>

    <?php
			endwhile;
		?>



</div>