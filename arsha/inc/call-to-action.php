<?php
/**
 * Custom Theme widgets.
 *
 * @package Arsha
 */

if ( ! function_exists( 'arsha_call_to_action_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function arsha_call_to_action_widgets() {

		// About Us widget.
		register_widget( 'arsha_call_to_action_widgets' );

	}

endif;

add_action( 'widgets_init', 'arsha_call_to_action_widgets' );

if ( ! class_exists( 'arsha_call_to_action_widgets' ) ) :

	class arsha_call_to_action_widgets extends WP_Widget
	{
		
		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'arsha-cta',
				'description'                 => esc_html__( 'Arsha Call To Action Widget', 'arsha' ),
				'customize_selective_refresh' => true,
				);
			parent::__construct( 'arsha-cta', esc_html__( 'Arsha Call To Action', 'arsha' ), $opts );
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

			$cta_btn_txt = apply_filters( 'widget_title', empty( $instance['cta_btn_txt'] ) ? '' : $instance['cta_btn_txt'], $instance, $this->id_base );

			$cta_btn_url = apply_filters( 'widget_title', empty( $instance['cta_btn_url'] ) ? '' : $instance['cta_btn_url'], $instance, $this->id_base );

			$call_to_action = ! empty( $instance['call_to_action'] ) ? $instance['call_to_action'] : 0;
			$content_post = get_post($call_to_action);
			// var_dump($content_post);
			echo $args['before_widget'];

			// Render Button Name
			// if ( ! empty( $cta_btn_txt ) ) {
			// 	echo $args['before_title'] . $cta_btn_txt . $args['after_title'];
			// }
			?>

		    <!-- ======= Cta Section ======= -->
		     <?php 

		     if (has_post_thumbnail( $call_to_action ) ): 
		        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $call_to_action ), 'full' ); 
		    endif;
		     ?>

		    <section id="cta" class="cta" style="background: linear-gradient(rgba(40, 58, 90, 0.9), rgba(40, 58, 90, 0.9)), url(<?php echo $image[0]; ?>) fixed center center;">
		      <div class="container" data-aos="zoom-in">

		        <div class="row">
		          <div class="col-lg-9 text-center text-lg-start">
		            <h3><?php echo $content_post->post_title; ?></h3>
		            <p> <?php echo $content_post->post_content; ?></p>
		          </div>
		          <div class="col-lg-3 cta-btn-container text-center">
		            <a class="cta-btn align-middle" href="<?php echo $cta_btn_url; ?>"><?php echo $cta_btn_txt; ?></a>
		          </div>
		        </div>

		      </div>
		  </section>
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

			$instance['cta_btn_txt'] = sanitize_text_field( $new_instance['cta_btn_txt'] );
			$instance['cta_btn_url'] = esc_url( $new_instance['cta_btn_url'] );
			$instance['call_to_action']            = absint( $new_instance['call_to_action'] );

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
				'cta_btn_txt' => '',
				'cta_btn_url' =>'',
				'call_to_action' =>'',
				) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cta_btn_txt' ) ); ?>"><?php esc_html_e( 'Button Name', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cta_btn_txt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cta_btn_txt' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['cta_btn_txt'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cta_btn_url' ) ); ?>"><?php esc_html_e( 'Button Url', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cta_btn_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cta_btn_url' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['cta_btn_url'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'call_to_action' ) ); ?>"><?php esc_html_e( 'Select Page:', 'arsha' ); ?></label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'call_to_action' ),
					'name'             => $this->get_field_name( 'call_to_action' ),
					'selected'         => $instance['call_to_action'],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'arsha' ),
					)
				);
				?>
			</p>
			<?php
		}
	}
endif;