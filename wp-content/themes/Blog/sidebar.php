<?php global $hk_options; ?>
<div class="sidebar-about">
    <h2 class="widget-title">
        Giới thiệu
    </h2>
    <div class="widget-content">
        <?php $getposts = new WP_query();
        $getposts->query('post_status=publish&p=2&post_type=page'); ?>
        <?php global $wp_query;
        $wp_query->in_the_loop = true; ?>
        <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
            <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="<?php the_title(); ?>" />
            <h2 class="title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <p class="ntp-description">
                <?php echo teaser(30); ?>
            </p>
            <div class="ntp-button">
                <a href="<?php the_permalink(); ?>">Xem thêm</a>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>
</div>
<div class="sidebar-about">
    <h2 class="widget-title">
        Danh Mục
    </h2>
    <div class="widget-content">
    <?php
// categories
// retrieve all list of categories

$categories = get_categories(array(
    "post_type"=>'post',
    "orderedby"=> "name",
    "parent" => 0
));

forEach($categories as $category){
  printf ('<h2 class="category-name" >') ;
    printf('<a href="%1$s" class="button"><span>%2$s</span> </a>',
    esc_url(get_category_link($category->term_id)),
    esc_html($category->name));
    printf('</h2>');
}
?>
 
</div>
<div class="widget ntp-latest-posts">
    <h2 class="widget-title">Bài viết mới</h2>
    <div class="widget-list">
        <?php $getposts = new WP_query();
        $getposts->query('post_status=publish&showposts=6'); ?>
        <?php global $wp_query;
        $wp_query->in_the_loop = true; ?>
        <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
            <div class="item-clearfix">

                <?php congbio_thumbnail("small") ?>

                <div class="widget-item-content">
                    <h3 class="item-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <a class="item-meta"><span><?php echo get_the_date('d - m - Y'); ?></span></a>
                    <a class="item-comment"><?php the_author(); ?></a>
                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>
</div>
<div class="widget ntp-popular-post">
    <h2 class="widget-title">Xem nhiều nhất</h2>
    <div class="widget-list">
        <?php $args = array('posts_per_page' => 6, 'meta_key' => 'views', 'orderby' => 'meta_value_num',); ?>
        <?php $the_query = new WP_Query($args); ?>
        <?php if ($the_query->have_posts()) : ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="item-clearfix">
                    <?php congbio_thumbnail("small") ?>
                    <div class="widget-item-content">
                        <h3 class="item-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <a class="item-meta"><span><?php echo get_the_date('d - m - Y'); ?></span></a>
                        <a class="item-comment"><?php echo getpostviews(get_the_id()); ?> Lượt xem</a>
                    </div>
                </div>
        <?php endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</div>


<div class="widget widget_product_cloud">
    <h2 class="widget-title"> Sách mới</h2>
    <div class="tagcloud">
        <?php $args = array('posts_per_page' => 8, 'post_type' => 'product');?>
        <?php $the_query = new WP_Query($args); ?>
       <?php if ($the_query->have_posts()) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="item-clearfix">

                <?php congbio_thumbnail("small") ?>

                <div class="widget-item-content">
                    <h3 class="item-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                </div>
            </div>
            <?php endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</div>
<div class="widget widget_tag_cloud">
    <h2 class="widget-title">Tags</h2>
    <div class="tagcloud">
        <?php $args = array('hide_empty' => 0, 'taxonomy' => 'post_tag', 'orderby' => 'count', 'order' => 'DESC', 'number' => 20,);
        $categories = get_categories($args);
        foreach ($categories as $category) {  ?>
            <a href="<?php echo get_term_link($category->slug, 'post_tag'); ?>">
                <?php echo $category->name; ?>
            </a>
        <?php } ?>
    </div>
</div>