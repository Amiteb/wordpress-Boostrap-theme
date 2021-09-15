<?php
/**
 * Custom Theme widgets.
 *
 * @package Arsha
 */

if ( ! function_exists( 'arsha_service_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function arsha_service_widgets() {

		// About Us widget.
		register_widget( 'arsha_service_section_widgets' );

	}

endif;

add_action( 'widgets_init', 'arsha_service_widgets' );

if ( ! class_exists( 'arsha_service_section_widgets' ) ) :

	class arsha_service_section_widgets extends WP_Widget
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
			parent::__construct( 'arsha-service-section', esc_html__( 'Arsha Service Section Widget', 'arsha' ), $opts );
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

			$service_title = apply_filters( 'widget_title', empty( $instance['service_title'] ) ? '' : $instance['service_title'], $instance, $this->id_base );

			$service_des = apply_filters( 'widget_title', empty( $instance['service_des'] ) ? '' : $instance['service_des'], $instance, $this->id_base );

			$cat_id = ! empty( $instance['service_select_page'] ) ? $instance['service_select_page'] : 0; ?>

			<section id="services" class="services section-bg">
      			<div class="container" data-aos="fade-up">
      				<div class="section-title">
			          <h2><?php echo $service_title; ?></h2>
			          <p><?php echo $service_des; ?></p>
			        </div>
       			<div class="row">
          <?php  
          // var_dump($cat_id);
          if($cat_id > 0):

				$datap = array(
					'posts_per_page'	=> 4,
				    'post_type'			=> 'service',
				    'tax_query' => array(
			        array(
			            'taxonomy' => 'service_category',
			            'field' => 'ID', //can be set to ID
			            'terms' => $cat_id //if field is ID you can reference by cat/term number
			        	),
			    	),
				);
				$loop = new WP_Query( $datap ); 
        		$i = 100; 
        		while ( $loop->have_posts() ) : $loop->the_post();  ?>

	        	<div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="<?php echo $i; ?>">
	            <div class="icon-box">
	              <div class="icon"><i class="bx bxl-dribbble"></i></div>
	              <h4><a href="#"><?php the_title(); ?></a></h4>
	              <?php the_content(); ?>
	            </div>
	          </div>
		      <?php 
		      $i+= 100; 
		  	endwhile;
        	wp_reset_postdata();
	  	  endif;
	      ?>
	          </div>
      		</div>
    	</section><!-- End Services Section -->
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

			$instance['service_title'] = sanitize_text_field( $new_instance['service_title'] );
			$instance['service_des'] = sanitize_text_field( $new_instance['service_des'] );
			$instance['service_select_page'] = absint( $new_instance['service_select_page'] );

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
				'service_title' => '',
				'service_des' =>'',
				'service_select_page' =>'',
				) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'service_title' ) ); ?>"><?php esc_html_e( 'Title', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'service_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['service_title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'service_des' ) ); ?>"><?php esc_html_e( 'Description', 'arsha' ); ?></label><br>
				<textarea class="widefat" rows="5" cols="40" id="<?php echo esc_attr( $this->get_field_id( 'service_des' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_des' ) ); ?>">
        		<?php echo $instance['service_des']; ?></textarea>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'service_select_page' ) ); ?>"><?php esc_html_e( 'Select Category:', 'arsha' ); ?></label>
				<?php
				$cat_args = array(
					'orderby'         => 'name',
					'hide_empty'      => false,
					'taxonomy'        => 'service_category',
					'name'            => $this->get_field_name( 'service_select_page' ),
					'id'              => $this->get_field_id( 'service_select_page' ),
					'selected'        => $instance['service_select_page'],
					'show_option_all' => esc_html__( 'All Categories','arsha' ),
				);
				wp_dropdown_categories( $cat_args );
				?>
			</p>
			<?php
		}
	}
endif;