<?php
/**
 * Custom Theme widgets.
 *
 * @package Arsha
 */

if ( ! function_exists( 'arsha_hero_section_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function arsha_hero_section_widgets() {

		// About Us widget.
		register_widget( 'Aarsha_hero_section_Widget' );

	}

endif;

add_action( 'widgets_init', 'arsha_hero_section_widgets' );

if ( ! class_exists( 'Aarsha_hero_section_Widget' ) ) :

	class Aarsha_hero_section_Widget extends WP_Widget
	{
		
		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'arsha-hero-section',
				'description'                 => esc_html__( 'Arsha Hero Section Widget', 'arsha' ),
				'customize_selective_refresh' => true,
				);
			parent::__construct( 'arsha-hero-section', esc_html__( 'Arsha Hero Section', 'arsha' ), $opts );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$btn_txt = apply_filters( 'widget_title', empty( $instance['btn_txt'] ) ? '' : $instance['btn_txt'], $instance, $this->id_base );

			$btn_url = apply_filters( 'widget_title', empty( $instance['btn_url'] ) ? '' : $instance['btn_url'], $instance, $this->id_base );

			$video_txt = apply_filters( 'widget_title', empty( $instance['video_txt'] ) ? '' : $instance['video_txt'], $instance, $this->id_base );

			$video_url = apply_filters( 'widget_title', empty( $instance['video_url'] ) ? '' : $instance['video_url'], $instance, $this->id_base );
			$hero_section_page = ! empty( $instance['hero_section_page'] ) ? $instance['hero_section_page'] : 0;
			$content_post = get_post($hero_section_page);
			// var_dump($content_post);
			echo $args['before_widget'];

			// Render Button Name
			// if ( ! empty( $btn_txt ) ) {
			// 	echo $args['before_title'] . $btn_txt . $args['after_title'];
			// }
			?>

		    <div class="container">
		      <div class="row">
		        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
		          <h1><?php echo $content_post->post_title; ?></h1>
		          <h2><?php echo $content_post->post_content; ?></h2>
		          <div class="d-flex justify-content-center justify-content-lg-start">
		            <a href="<?php echo $btn_url; ?>" class="btn-get-started scrollto"><?php echo $btn_txt; ?></a>
		            <a href="<?php echo $video_url; ?>" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span><?php echo $video_txt; ?></span></a>
		          </div>
		        </div>
		        <?php if (has_post_thumbnail( $hero_section_page ) ): ?>
		        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $hero_section_page ), 'full' ); ?>
		        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
		          <img src="<?php echo $image[0]; ?>" class="img-fluid animated" alt="">
		        </div>
		        <?php endif; ?>
		      </div>
		    </div>

			<?php echo $args['after_widget'];

		}

		/**
		 * Update widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance New settings for this instance as input by the user.
		 * @param array $old_instance Old settings for this instance.
		 * @return array Settings to save or bool false to cancel saving.
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['btn_txt'] = sanitize_text_field( $new_instance['btn_txt'] );
			$instance['btn_url'] = esc_url( $new_instance['btn_url'] );
			$instance['video_txt'] = sanitize_text_field( $new_instance['video_txt'] );
			$instance['video_url'] = esc_url( $new_instance['video_url'] );
			$instance['hero_section_page']            = absint( $new_instance['hero_section_page'] );

			return $instance;
		}

		/**
		 * Output the settings update form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance Current settings.
		 */
		function form( $instance ) {

			// Defaults.
			$instance = wp_parse_args( (array) $instance, array(
				'btn_txt' => '',
				'btn_url' =>'',
				'video_txt' =>'',
				'video_url' =>'',
				'hero_section_page' =>'',
				) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'btn_txt' ) ); ?>"><?php esc_html_e( 'Button Name', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_txt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_txt' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['btn_txt'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>"><?php esc_html_e( 'Button Url', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_url' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['btn_url'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'video_txt' ) ); ?>"><?php esc_html_e( 'Video Button Name', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video_txt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video_txt' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['video_txt'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'video_url' ) ); ?>"><?php esc_html_e( 'Video Button Url', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video_url' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['video_url'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'hero_section_page' ) ); ?>"><?php esc_html_e( 'Select Page:', 'arsha' ); ?></label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'hero_section_page' ),
					'name'             => $this->get_field_name( 'hero_section_page' ),
					'selected'         => $instance['hero_section_page'],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'arsha' ),
					)
				);
				?>
			</p>
			<?php
		}
	}
endif;