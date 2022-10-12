<?php get_header(); ?>
    <div class="content">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php setpostview(get_the_id()); ?>

                <div class="post">
                    <div class="post-content">
                        <h2 class="title">
                            <?php the_title(); ?>
                        </h2>
                        <div class="post-detail">
                            <a class="date"><?php echo get_the_date(); ?></a>
                            <a><i class="fa fa-eye"></i> <?php echo getpostviews(get_the_id()); ?> Lượt xem</a>
                        </div>
                        <div class="the-excerpt">
                            <article class="post-content">
                                <?php the_content(); ?>
                            </article>
                        </div>
                    </div>

                </div>

            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <!--    <div class="sidebar ">-->
    <!--        --><?php //get_sidebar(); 
                    ?>
    <!--    </div>-->

<?php //get_footer(); 
?>