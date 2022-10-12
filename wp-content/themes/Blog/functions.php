<?php

//    Thiết lập các hằng dữ liệu quan trọng
//    THEME_URL = get_stylesheet_directory() – đường dẫn tới thư mục theme
//    CORE = thư mục /core của theme, chứa các file nguồn quan trọng.
define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . '/core');
// Load file /core/init.php
// Đây là file cấu hình ban đầu của theme mà sẽ không nên được thay đổi sau này.
require_once(CORE . '/init.php');
// Thiết lập $content_width để khai báo kích thước chiều rộng của nội dung
if (!isset($content_width)) {
  // Nếu biến $content_width chưa có dữ liệu thì gán giá trị cho nó
  $content_width = 620;
}
// Thiết lập các chức năng sẽ được theme hỗ trợ
if (!function_exists('congbio_theme_setup')) {
  // Nếu chưa có hàm congbio_theme_setup() thì sẽ tạo mới hàm đó
  function congbio_theme_setup()
  {
    // Thiết lập theme có thể dịch được
    $language_folder = THEME_URL . '/languages';
    load_theme_textdomain('congbio', $language_folder);
    // Tự chèn RSS Feed links trong <head> 
    add_theme_support('automatic-feed-links');
    // Thêm chức năng post thumbnail
    add_theme_support('post-thumbnails');
    // Thêm chức năng title-tag để tự thêm <title>
    add_theme_support('title-tag');
    // Thêm chức năng post format
    add_theme_support(
      'post-formats',
      array(
        'video',
        'image',
        'audio',
        'gallery'
      )
    );

    // Thêm chức năng custom background
    $default_background = array(
      'default-color' => '#e8e8e8',
    );
    add_theme_support('custom-background', $default_background);
    // Tạo menu cho theme
    register_nav_menu('primary-menu', __('Primary Menu', 'congbio'));
    // Tạo sidebar cho theme
    $sidebar = array(
      'name' => __('Main Sidebar', 'congbio'),
      'id' => 'main-sidebar',
      'description' => 'Main sidebar for congbio theme',
      'class' => 'main-sidebar',
      'before_title' => '<h3 class="widgettitle">',
      'after_sidebar' => '</h3>'
    );
    register_sidebar($sidebar);
  }
  add_action('init', 'congbio_theme_setup');
}


//   thiết lập teamplate------------------------------------------------

// Thiết lập hàm hiển thị logo
// congbio_logo()

if (!function_exists('congbio_logo')) {
  function congbio_logo()
  { ?>
    <div class="logo">
      <div class="site-name">
        <?php if (is_home()) {
          printf(
            '<h1 id = logoimage ><a href="%1$s" title="%2$s">%3$s</a></h1>',
            get_bloginfo('url'),
            get_bloginfo('description'),
            get_bloginfo('sitename')
          );
        } else {
          printf(
            '</p id = logoimage ><a href="%1$s" title="%2$s">%3$s</a></p>',
            get_bloginfo('url'),
            get_bloginfo('description'),
            get_bloginfo('sitename')
          );
        } // endif 
        ?>
      </div>
      <!-- <div class="site-description"><?php bloginfo('description'); ?></div> -->
    </div>
  <?php }
}



// Thiết lập hàm hiển thị menu
// congbio_menu( $slug )

if (!function_exists('congbio_menu')) {
  function congbio_menu($slug)
  {
    $menu = array(
      'theme_location' => $slug,
      'container' => 'nav',
      'container_class' => $slug,
    );
    wp_nav_menu($menu);
  }
}
 

 
/**
 *@ Tạo hàm phân trang cho index, archive.
 *@ Hàm này sẽ hiển thị liên kết phân trang theo dạng chữ: Newer Posts & Older Posts
 *@ cong_pagination()
 **/
if (!function_exists('congbio_pagination')) {
  function congbio_pagination()
  {
    
  ?>
    <nav class="pagination" role="navigation">
      <?php if (get_next_post_link()) : ?>
        <div class="prev"><?php next_posts_link(__('OlderPosts', 'congbio')); ?></div>
      <?php endif; ?>


      <?php if (get_previous_post_link()) : ?>
        <div class="next"><?php previous_posts_link(__('NewerPosts', 'congbio')); ?></div>
      <?php endif; ?>


    </nav><?php
        }
      }

      

      //  ---------------------------------------------------------------------------------------------
      // Hàm hiển thị ảnh thumbnail của post.
      // Ảnh thumbnail sẽ không được hiển thị trong trang single
      // Nhưng sẽ hiển thị trong single nếu post đó có format là Image
      // congbio_thumbnail( $size )

      if ( !function_exists('congbio_thumbnail') ) {
        function congbio_thumbnail($size) {
          if( !is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image') ) : ?>
          <a href="<?php the_permalink(); ?>">
          <div class="post-thumbnail"><?php the_post_thumbnail( $size ); ?></div>
          </a>
          <?php else : ?>
            <a href="<?php the_permalink(); ?>">
          <div class="post-thumbnail"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxddtPSxt3mS3QjGibU-bVEPkoBgh_852nNRuU2_CuZ2sEEJJD9VEcGBZ9OGmlv_LmGdg&usqp=CAU" alt="image empaty"></div>
          </a>
        <?php endif;
  }
}

// Rút ngắn tiêu Đề của bài post
// ------------
add_filter( 'the_title', 'shorten_post_title', 10, 2 );
function shorten_post_title( $title, $id ) {
    if (get_post_type( $id ) === 'post' & !is_single() ) {
        return wp_trim_words( $title, 5 ); // thay đổi số từ bạn muốn hiển thị
    } else {
        return $title;
    }
}

// Hàm hiển thị tiêu đề của post trong .entry-header
// Tiêu đề của post sẽ là nằm trong thẻ <h1> ở trang single
// Còn ở trang chủ và trang lưu trữ, nó sẽ là thẻ <h2>
// congbio_entry_header()

if (!function_exists('congbio_entry_header')) {
  function congbio_entry_header()
  {
    if (is_single()) : ?>
      <h1 class="entry-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </h1>
    <?php else : ?>
      <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </h2>
<?php


    endif;
  }
}



// Hàm hiển thị thông tin của post (Post Meta)
// congbio_entry_meta()

if (!function_exists('congbio_entry_meta')) {
  function congbio_entry_meta()
  {
    if (!is_page()) :
      echo '<div class="entry-meta">';


      // Hiển thị tên tác giả, tên category và ngày tháng đăng bài
      printf(
        __('<span class="author">Posted by %1$s</span>', 'congbio'),
        get_the_author()
      );


      printf(
        __('<span class="date-published"> at %1$s</span>', 'congbio'),
        get_the_date()
      );


      printf(
        __('<span class="category"> in %1$s</span>', 'congbio'),
        get_the_category_list(', ')
      );


      // Hiển thị số đếm lượt bình luận
      if (comments_open()) :
        echo ' <span class="meta-reply">';
        comments_popup_link(
          __('Leave a comment', 'congbio'),
          __('One comment', 'congbio'),
          __('% comments', 'congbio'),
          __('Read all comments', 'congbio')
        );
        echo '</span>';
      endif;
      echo '</div>';
    endif;
  }
}


/*
   * Thêm chữ Read More vào excerpt
   */
function congbio_readmore()
{
  return '…<a class="read-more" href="' . get_permalink(get_the_ID()) . '">' . __('Read More', 'congbio') . '</a>';
}
add_filter('excerpt_more', 'congbio_readmore');



// Hàm hiển thị nội dung của post type
// Hàm này sẽ hiển thị đoạn rút gọn của post ngoài trang chủ (the_excerpt)
// Nhưng nó sẽ hiển thị toàn bộ nội dung của post ở trang single (the_content)
// congbio_entry_content()
function new_excerpt_length($length) {
  return 15;
  }
  add_filter('excerpt_length', 'new_excerpt_length');

if (!function_exists('congbio_entry_content')) {
  function congbio_entry_content()
  {
    if (!is_single()) :
      
      the_excerpt(15);
    else :
      the_content();
      /*
           * Code hiển thị phân trang trong post type
           */
      $link_pages = array(
        'before' => __('<p>Page:', 'congbio'),
        'after' => '</p>',
        'nextpagelink'     => __('Next page', 'congbio'),
        'previouspagelink' => __('Previous page', 'congbio')
      );
      wp_link_pages($link_pages);
    endif;
  }
}



// Hàm hiển thị tag của post
// congbio_entry_tag()

if (!function_exists('congbio_entry_tag')) {
  function congbio_entry_tag()
  {
    if (has_tag()) :
      echo '<div class="entry-tag">';
      printf(__('Tagged in %1$s', 'congbio'), get_the_tag_list("", ', '));
      echo '</div>';
    endif;
  }
}

// Tạo mục tùy chỉnh cho tính năng bài viết nổi bật trong trang chỉnh sửa bài viết
// ------------------------------bài viết nổi bật----------------------------------------------
// link hướng dẫ:https://mangbinhdinh.vn/lap-trinh/php-mysql/tuy-chinh-bai-viet-noi-bat-cho-trang-wordpress.html
if (!function_exists('sm_custom_meta')) {
function sm_custom_meta() {
  add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
}
}
if (!function_exists('sm_meta_callback')) {
function sm_meta_callback( $post ) {
  $featured = get_post_meta( $post->ID );
  ?>
<p>
  <div class="sm-row-content">
      <label for="meta-checkbox">
          <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
          <?php _e( 'Featured this post', 'sm-textdomain' )?>
      </label>        
  </div>
</p> 
  <?php
}
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );
 
//  -----------------------------------------------
 
// Lưu dữ liệu cho tùy chỉnh

function sm_meta_save( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}
}
add_action( 'save_post', 'sm_meta_save' );

// ==========================
 















// test
// test
// test
// test
function show_thumb($w,$h,$zc,$cropfrom) {
	global $post;
	$img_customfield = get_post_meta($post->ID, 'thumb', true);
	$img_attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	$img_uploads = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID', 'numberposts' => 1) );
	$img_post = preg_match_all('/\< *[img][^\>]*src *= *[\"\']{0,1}([^\"\'\ >]*)/',get_the_content(),$matches);
	$img_default = get_bloginfo('template_directory').'/images/no-thumb.png';

	$thumbnail = 'thumbnail.php';
	
	// get thumbnail
	if ($img_customfield) {
		print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($img_customfield).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'"/>';
	} elseif ($img_attachment_image) {
		print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($img_attachment_image[0]).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'"/>';
	} elseif ($img_uploads == true) {
		foreach($img_uploads as $id => $attachment) {
			$img = wp_get_attachment_image_src($id, 'full');
			print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($img[0]).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'" />';
		}
	} elseif (count($matches[1]) > 0) {
		print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($matches[1][0]).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'" />';
	} else {
		print '<img src="'.get_bloginfo('template_directory').'/'.$thumbnail.'?src='.urlencode($img_default).'&amp;w='.$w.'&amp;h='.$h.'&amp;zc='.$zc.'&amp;a='.$cropfrom.'" alt="'.get_the_title($post).'" title="'.get_the_title($post).'" />';
	}
}
// ============
function teaser($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'[...]';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt.'...';
}
// ==========
function getpostviews($postID){
  $count_key ='views';
  $count = get_post_meta($postID, $count_key, true);
  if($count == ''){
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
      return "0";
  }
  return $count;
}
// --------------------
function setpostview($postID){
  $count_key ='views';
  $count = get_post_meta($postID, $count_key, true);
  if($count == ''){
      $count = 0;
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
  } else {
      $count++;
      update_post_meta($postID, $count_key, $count);
  }
}













// Nhungws file style.css

//Chèn CSS và Javascript vào theme
//sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end

function congbio_styles()
{
  /*
     * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
     * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
     */

// import reponsive js header
wp_register_script( 'headerResponsive-script', get_template_directory_uri() . "/assets/js/headerResponsive.js", 'header');
wp_enqueue_script('headerResponsive-script');	

wp_register_script( 'slide-script', get_template_directory_uri() . "/assets/js/slide.js", 'slide');
wp_enqueue_script('slide-script');	

  wp_register_style('main-style', get_template_directory_uri() . '/style.css', 'all');
  wp_enqueue_style('main-style');
  wp_register_style('all-css', get_template_directory_uri() . '/assets/css/app.css', 'all');
  wp_enqueue_style('all-css');

}
add_action('wp_enqueue_scripts', 'congbio_styles');