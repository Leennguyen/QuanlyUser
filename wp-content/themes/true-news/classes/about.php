<?php

/**
 * True News About Page
 * @package True_News
 *
*/

if( !class_exists('True_News_About_page') ):

	class True_News_About_page{

		function __construct(){

			add_action('admin_menu', array($this, 'true_news_backend_menu'),999);

		}

		// Add Backend Menu
        function true_news_backend_menu(){

            add_theme_page(esc_html__( 'True News Options','true-news' ), esc_html__( 'True News Options','true-news' ), 'activate_plugins', 'true-news-about', array($this, 'true_news_main_page'));

        }

        // Settings Form
        function true_news_main_page(){

            require get_template_directory() . '/classes/about-render.php';

        }

	}

	new True_News_About_page();

endif;