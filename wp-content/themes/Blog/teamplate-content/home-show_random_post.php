<?php
$args = array(
	'posts_per_page' => 1,  //Số lượng bài viết muốn lấy
	'orderby' => 'rand',
	'post_type' => 'post'
);
$featured = new WP_Query($args);
?>
<div class="random-post">
    <?php $myposts=get_posts( $args ); foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
    <div class="entry-thumbnail">
        <?php congbio_thumbnail('large') ?>
    </div>
    <div class="entry-header lmn">
        <?php congbio_entry_header(); ?>
    </div>
<!--    <div class="entry-content">-->
<!--        --><?php //congbio_entry_content(); ?>
<!--        --><?php //(is_single() ? congbio_entry_tag() : ''); ?>
<!--    </div>-->
    <?php endforeach;
wp_reset_postdata();?>

</div>