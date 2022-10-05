<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Legit News
 * @since Legit News 1.0.0
 */

$options = legit_news_get_theme_options();


if ( ! function_exists( 'legit_news_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Legit News 1.0.0
	 */
	function legit_news_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'legit_news_doctype', 'legit_news_doctype', 10 );


if ( ! function_exists( 'legit_news_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'legit_news_before_wp_head', 'legit_news_head', 10 );

if ( ! function_exists( 'legit_news_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'legit-news' ); ?></a>
			<div class="menu-overlay"></div>

		<?php
	}
endif;
add_action( 'legit_news_page_start_action', 'legit_news_page_start', 10 );

if ( ! function_exists( 'legit_news_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'legit_news_page_end_action', 'legit_news_page_end', 10 );

if ( ! function_exists( 'legit_news_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_header_start() { 
		$options = legit_news_get_theme_options();
		
	?>
		<?php if ( $options['topbar_section_enable'] ){ ?>
		 <div id="top-navigation" class="relative">
            <div class="wrapper">
                <button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false">
                    <?php
						echo legit_news_get_svg( array( 'icon' => 'menu' ) );
						echo legit_news_get_svg( array( 'icon' => 'close' ) );
					?>
                    <span class="menu-label"><?php esc_html_e( 'Top Menu', 'legit-news' ); ?></span>
                </button><!-- .menu-toggle -->

                <nav id="secondary-navigation" class="main-navigation" role="navigation" aria-label="Secondary Menu">
                	<?php  
						$social = '';
						if ( has_nav_menu( 'social' ) ) :
							$social .= '<li class="social-menu">';
							$social .= wp_nav_menu( array(
									'theme_location' => 'social',
									'container' => 'div',
									'container_class' => 'social-icons',
									'menu_class' => 'menu',
									'echo' => false,
									'fallback_cb' => 'legit_news_menu_fallback_cb',
									'link_before' => '<span class="screen-reader-text">',
									'link_after' => '</span>',
								) );
							$social .= '</li>';
						endif;
						wp_nav_menu( array(
							'theme_location' => 'secondary',
							'container' => false,
							'menu_class' => 'menu nav-menu',
							'menu_id' => 'secondary-menu',
							'echo' => true,
							'fallback_cb' => 'legit_news_menu_fallback_cb',
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s'.$social.'</ul>',
						) );  ?>

					<div class="icon-wrapper">
					<?php 

						if ( has_nav_menu( 'social' ) ) :
							
							wp_nav_menu( array(
								'theme_location' => 'social',
								'container' => 'div',
								'container_class' => 'social-icons',
								'menu_class' => 'menu',
								'echo' => true,
								'fallback_cb' => 'legit_news_menu_fallback_cb',
								'link_before' => '<span class="screen-reader-text">',
								'link_after' => '</span>',
							) );
						endif; 
					?>
					</div>
                </nav><!-- .main-navigation-->
            </div>
        </div><!-- #top-navigation -->
    	<?php } ?>
		<header id="masthead" class="site-header" role="banner">
		<?php
	}
endif;
add_action( 'legit_news_header_action', 'legit_news_header_start', 10 );

if ( ! function_exists( 'legit_news_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_site_branding() {
		$options  = legit_news_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];	?>

		<div class="wrapper">
			<div class="site-branding-wrapper">
				<div class="site-branding" <?php if(!$options['ads_section_enable']) echo "style='margin:auto'"?>>
					<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) )  ) { ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php } 
					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
						<div id="site-details">
							<?php
							if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
								if ( legit_news_is_latest_posts() || legit_news_is_frontpage() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
								endif;
							} 
							if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
								<?php
								endif; 
							}?>
						</div>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<?php if($options['ads_section_enable']) do_action('legit_news_advertisement'); ?>

			</div><!-- .site-branding-wrapper -->
		</div><!-- .wrapper -->

		<?php
	}
endif;
add_action( 'legit_news_header_action', 'legit_news_site_branding', 20 );

if ( ! function_exists( 'legit_news_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_site_navigation() {
		$options = legit_news_get_theme_options();
		?>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php
			echo legit_news_get_svg( array( 'icon' => 'menu' ) );
			echo legit_news_get_svg( array( 'icon' => 'close' ) );
			?>		
			<span class="menu-label"><?php esc_html_e( 'Primary Menu', 'legit-news' ); ?></span>			
		</button>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
			<div class="wrapper">
				<?php 
					$search = '';
					if ( $options['nav_search_enable'] ) :
						$search .= '<li class="search-menu">';
						$search .= '<a href="#" class=""><span class="screen-reader-text">'. esc_html__('search', 'legit-news').'</span>';
						$search .= legit_news_get_svg( array( 'icon' => 'search' ) );
						$search .= legit_news_get_svg( array( 'icon' => 'close' ) );
						$search .= '</a><div id="search">';
						$search .= get_search_form( $echo = false );
		                $search .= '</div></li>';
	                endif;

	        		      	
	        		wp_nav_menu( array(
	        			'theme_location' => 'primary',
	        			'container' => false,
	        			'menu_class' => 'menu nav-menu',
	        			'menu_id' => 'primary-menu',
	        			'echo' => true,
	        			'fallback_cb' => 'legit_news_menu_fallback_cb',
	        			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $search . '</ul>',
	        		) );
	        	?>
        	</div><!-- .wrapper -->
		</nav><!-- #site-navigation -->
		<?php
	}
endif;
add_action( 'legit_news_header_action', 'legit_news_site_navigation', 30 );


if ( ! function_exists( 'legit_news_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'legit_news_header_action', 'legit_news_header_end', 50 );

if ( ! function_exists( 'legit_news_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'legit_news_content_start_action', 'legit_news_content_start', 10 );

if ( ! function_exists( 'legit_news_header_image' ) ) :
	/**
	 * Header Image codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_header_image() {
		if ( legit_news_is_frontpage() )
			return;
		$header_image = get_header_image();
		if ( is_singular() ) :
			$header_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : $header_image;
		endif;
		?>
		<div class="wrapper">	
			<div id="page-site-header" class="relative" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
	            <div class="overlay"></div>
	            <div class="wrapper">
	                <header class="page-header">
	                    <?php echo legit_news_custom_header_banner_title(); ?>
	                </header>

	                <?php legit_news_add_breadcrumb(); ?>
	            </div><!-- .wrapper -->
	        </div><!-- #page-site-header -->
		</div>
		
		<?php
	}
endif;
add_action( 'legit_news_header_image_action', 'legit_news_header_image', 10 );

if ( ! function_exists( 'legit_news_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since Legit News 1.0.0
	 */
	function legit_news_add_breadcrumb() {
		$options = legit_news_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( legit_news_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list">';
				/**
				 * legit_news_simple_breadcrumb hook
				 *
				 * @hooked legit_news_simple_breadcrumb -  10
				 *
				 */
				do_action( 'legit_news_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
		return;
	}
endif;

if ( ! function_exists( 'legit_news_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'legit_news_content_end_action', 'legit_news_content_end', 10 );

if ( ! function_exists( 'legit_news_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'legit_news_footer', 'legit_news_footer_start', 10 );

if ( ! function_exists( 'legit_news_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_footer_site_info() {
		$options = legit_news_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text = $options['copyright_text']; 
		?>
		<div class="site-info">
            <div class="wrapper">
                <span>
                	<?php 
                	echo legit_news_santize_allow_tag( $copyright_text ); 
                	if ( function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( ' | ' );
					}
                	?>
            	</span>
            </div><!-- .wrapper -->    
        </div><!-- .site-info -->

		<?php
	}
endif;
add_action( 'legit_news_footer', 'legit_news_footer_site_info', 40 );

if ( ! function_exists( 'legit_news_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_footer_scroll_to_top() {
		$options  = legit_news_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo legit_news_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'legit_news_footer', 'legit_news_footer_scroll_to_top', 40 );

if ( ! function_exists( 'legit_news_footer_end' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Legit News 1.0.0
	 *
	 */
	function legit_news_footer_end() {
		?>
		</footer>
		<?php
	}
endif;
add_action( 'legit_news_footer', 'legit_news_footer_end', 100 );
