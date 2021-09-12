<?php
/**
 * Custom Theme widgets.
 *
 * @package Arsha
 */

if ( ! function_exists( 'arsha_register_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function arsha_register_widgets() {

		// Service widget.
		register_widget( 'Aarsha_Service_Section_Widget' );

	}

endif;

add_action( 'widgets_init', 'arsha_register_widgets' );

if ( ! class_exists( 'Aarsha_Service_Section_Widget' ) ) :

	class Aarsha_Service_Section_Widget extends WP_Widget
	{
		
		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'arsha-service-section',
				'description'                 => esc_html__( 'Arsha Service Section Widget', 'arsha' ),
				'customize_selective_refresh' => true,
				);
			parent::__construct( 'arsha-service-section', esc_html__( 'Arsha Service Section', 'arsha' ), $opts );
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

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$description = apply_filters( 'widget_title', empty( $instance['description'] ) ? '' : $instance['description'], $instance, $this->id_base );

			echo $args['before_widget'];

			// Render widget title.
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			// Render widget title.
			if ( ! empty( $description ) ) {
				echo $description;
			}


			echo $args['after_widget'];

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

			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['description'] = sanitize_text_field( $new_instance['description'] );

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
				'title' => '',
				) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['description'] ); ?>" />
			</p>
			<?php
		}
	}
endif;