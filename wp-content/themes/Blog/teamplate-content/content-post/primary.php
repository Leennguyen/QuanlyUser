<div class="post_lefimg_rightcontent">
    <article class="primary__wrapper" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="primary__wrapper">
            <div class="entry-thumbnail xyz">
                <?php congbio_thumbnail('large') ?>
            </div>
            <div class="entry-header">
                <?php congbio_entry_header(); ?>
            </div>
        </div>
<!--        <div class="entry-content">-->
<!--            --><?php //congbio_entry_content(); ?>
<!--            --><?php //(is_single() ? congbio_entry_tag() : ''); ?>
<!--        </div>-->
    </article>
</div>