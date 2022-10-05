<?php

function next_legit_news_customize_register( $wp_customize ) {

	Class Next_Legit_News_Switch_Control extends WP_Customize_Control{

		public $type = 'switch';

		public $on_off_label = array();

		public function __construct( $manager, $id, $args = array() ){
	        $this->on_off_label = $args['on_off_label'];
	        parent::__construct( $manager, $id, $args );
	    }

		public function render_content(){
	    ?>
		    <span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>

			<?php if( $this->description ){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post( $this->description ); ?>
				</span>
			<?php } ?>

			<?php
				$switch_class = ( $this->value() == 'true' ) ? 'switch-on' : '';
				$on_off_label = $this->on_off_label;
			?>
			<div class="onoffswitch <?php echo esc_attr( $switch_class ); ?>">
				<div class="onoffswitch-inner">
					<div class="onoffswitch-active">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['on'] ) ?></div>
					</div>

					<div class="onoffswitch-inactive">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['off'] ) ?></div>
					</div>
				</div>	
			</div>
			<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr( $this->value() ); ?>"/>
			<?php
	    }
	}


	class Next_Light_News_Dropdown_Taxonomies_Control extends WP_Customize_Control {

		public $type = 'dropdown-taxonomies';

		public $taxonomy = '';

		public function __construct( $manager, $id, $args = array() ) {

			$taxonomy = 'category';
			if ( isset( $args['taxonomy'] ) ) {
				$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
				if ( true === $taxonomy_exist ) {
					$taxonomy = esc_attr( $args['taxonomy'] );
				}
			}
			$args['taxonomy'] = $taxonomy;
			$this->taxonomy = esc_attr( $taxonomy );

			parent::__construct( $manager, $id, $args );
		}

		public function render_content() {

			$tax_args = array(
				'hierarchical' => 0,
				'taxonomy'     => $this->taxonomy,
			);
			$taxonomies = get_categories( $tax_args );

		?>
	    <label>
	      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	      <?php if ( ! empty( $this->description ) ) : ?>
	      	<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
	      <?php endif; ?>
	       <select <?php $this->link(); ?>>
				<?php
				printf( '<option value="%s" %s>%s</option>', '', selected( $this->value(), '', false ), esc_html__( '--None--', 'legit-news') );
				?>
				<?php if ( ! empty( $taxonomies ) ) :  ?>
	            <?php foreach ( $taxonomies as $key => $tax ) :  ?>
					<?php
					printf( '<option value="%s" %s>%s</option>', esc_attr( $tax->term_id ), selected( $this->value(), $tax->term_id, false ), esc_html( $tax->name ) );
					?>
	            <?php endforeach ?>
				<?php endif ?>
	       </select>
	    </label>
	    <?php
		}
	}


	$wp_customize->remove_section( 'colors' );

	$wp_customize->add_section( 'legit_news_media_post_section', array(
		'title'             => esc_html__( 'Media Post','next-legit-news' ),
		'description'       => esc_html__( 'Media Post Section options.', 'next-legit-news' ),
		'panel'             => 'legit_news_front_page_panel',
		'priority'			=> 41,
	) );

	// Media Post content enable control and setting
	$wp_customize->add_setting( 'legit_news_media_post_section_enable', array(
		'default'			=> false,
		'sanitize_callback' => 'legit_news_sanitize_switch_control',
	) );

	$wp_customize->add_control( new Next_Legit_News_Switch_Control( $wp_customize, 'legit_news_media_post_section_enable', array(
		'label'             => esc_html__( 'Media Post Section Enable', 'next-legit-news' ),
		'section'           => 'legit_news_media_post_section',
		'on_off_label' 		=> legit_news_switch_options(),
	) ) );

	$wp_customize->add_setting( 'legit_news_media_posts_title', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'legit_news_media_posts_title', array(
		'label'           	=> esc_html__( 'Title', 'legit-news' ),
		'section'        	=> 'legit_news_media_post_section',
		'type'				=> 'text',
	) );


	// Add dropdown category setting and control.
	$wp_customize->add_setting(  'legit_news_media_post_content_category', array(
		'sanitize_callback' => 'legit_news_sanitize_single_category',
	) ) ;

	$wp_customize->add_control( new Next_Light_News_Dropdown_Taxonomies_Control( $wp_customize,'legit_news_media_post_content_category', array(
		'label'             => esc_html__( 'Select Category', 'next-legit-news' ),
		'description'      	=> esc_html__( 'Note: Latest posts will be shown from selected category', 'next-legit-news' ),
		'section'           => 'legit_news_media_post_section',
		'type'              => 'dropdown-taxonomies',
	) ) );

}
add_action( 'customize_register', 'next_legit_news_customize_register' );

