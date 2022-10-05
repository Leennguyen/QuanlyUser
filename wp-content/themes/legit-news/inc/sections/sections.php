<?php
/**
 * Home Page sections
 *
 * This is the template that includes all the other files for home page sections
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

// Beaking News section
require get_template_directory() . '/inc/sections/breaking-news.php';

// Hero post section
require get_template_directory() . '/inc/sections/hero-post.php';

// must-read section
require get_template_directory() . '/inc/sections/must-read.php';

// Fashion
require get_template_directory().'/inc/sections/photography.php';

// Singel Column
require get_template_directory().'/inc/sections/single-column.php';

// main post section
require get_template_directory() . '/inc/sections/main-post.php';

// related-post section
require get_template_directory() . '/inc/sections/related-post.php';
