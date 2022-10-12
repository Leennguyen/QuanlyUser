 <div class="related-post">
<?php
    $categories = get_the_category($post->ID);
    if ($categories) 
    {
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
        $args=array(
        'category__in' => $category_ids,
        'post__not_in' => array($post->ID),
        'showposts'=>5, // Số bài viết bạn muốn hiển thị.
        'caller_get_posts'=>1
        );
        $my_query = new wp_query($args);
        if( $my_query->have_posts() ) 
        {
            echo '<h3>Bài viết liên quan</h3><ul class="list-news">';
            while ($my_query->have_posts())
            {
                $my_query->the_post();
                ?>
                 <div class="post_format">
					<?php get_template_part('teamplate-content/content-post/content','' )?>
				</div>
                <?php
            }
            echo '</ul>';
        }
    }
?>
</div>