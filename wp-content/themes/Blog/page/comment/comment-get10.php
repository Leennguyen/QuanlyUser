<?php
$cmt = get_comments(array( 
'status' => 'approve',
'number'=> 10,
));
?>
<div class="content-w content-news">
<ul>
<?php foreach ($cmt as $value) { ?>
<li>
<a href="<?php the_permalink($value->comment_post_ID);?>#comment-<?php echo $value->comment_ID; ?>"><?php echo get_avatar($value->comment_author_email, 150 ); ?></a> 
<a href="<?php the_permalink($value->comment_post_ID); ?>#comment-<?php echo $value->comment_ID; ?>"><?php echo $value->comment_author; ?></a> - <span style="color: #cd8a35;font-size: 12px;"><?php echo $value->comment_date; ?></span>
<p style="font-size: 13px;"><?php echo ($value->comment_content); ?></p>
<div class="clear"></div>
</li>
<?php } ?>
</ul>
</div>