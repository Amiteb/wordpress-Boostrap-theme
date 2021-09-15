<?php
/**
 * Custom Theme widgets.
 *
 * @package Arsha
 */

if ( ! function_exists( 'arsha_faq_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function arsha_faq_widgets() {

		// About Us widget.
		register_widget( 'arsha_faq_section_widgets' );

	}

endif;

add_action( 'widgets_init', 'arsha_faq_widgets' );

if ( ! class_exists( 'arsha_faq_section_widgets' ) ) :

	class arsha_faq_section_widgets extends WP_Widget
	{
		
		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'arsha-faq-section',
				'description'                 => esc_html__( 'Arsha FAQ Section Widget', 'arsha' ),
				'customize_selective_refresh' => true,
				);
			parent::__construct( 'arsha-faq-section', esc_html__( 'Arsha FAQ Section Widget', 'arsha' ), $opts );
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

			$faq_title = apply_filters( 'widget_title', empty( $instance['faq_title'] ) ? '' : $instance['faq_title'], $instance, $this->id_base );

			$faq_des = apply_filters( 'widget_title', empty( $instance['faq_des'] ) ? '' : $instance['faq_des'], $instance, $this->id_base );

			$cat_id = ! empty( $instance['faq_select_page'] ) ? $instance['faq_select_page'] : 0; ?>

			<section id="faq" class="faq section-bg">
      			<div class="container" data-aos="fade-up">
      				<div class="section-title">
			          <h2><?php echo $faq_title; ?></h2>
			          <p><?php echo $faq_des; ?></p>
			        </div>
       			<div class="faq-list">
       				<ul>
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
        		 $i = 100; $count = 1;
      			while ( $loop->have_posts() ) : $loop->the_post(); 
        		$show = $count == 1 ? 'show' : '';
      			?>

		        <li data-aos="fade-up" data-aos-delay="<?php echo $i; ?>">
		              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-<?php echo $count; ?>"><?php the_title(); ?><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
		              <div id="faq-list-<?php echo $count; ?>" class="collapse <?php echo $show; ?>" data-bs-parent=".faq-list">
		                <?php the_content(); ?>
		              </div>
		            </li>

	      <?php 
	      $i+=100; $count++;
	      endwhile;
	      wp_reset_postdata(); 
		  	  endif;
		      ?>	
		  		</ul>
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

			$instance['faq_title'] = sanitize_text_field( $new_instance['faq_title'] );
			$instance['faq_des'] = sanitize_text_field( $new_instance['faq_des'] );
			$instance['faq_select_page'] = absint( $new_instance['faq_select_page'] );

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
				'faq_title' => '',
				'faq_des' =>'',
				'faq_select_page' =>'',
				) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'faq_title' ) ); ?>"><?php esc_html_e( 'Title', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'faq_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'faq_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['faq_title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'faq_des' ) ); ?>"><?php esc_html_e( 'Description', 'arsha' ); ?></label><br>
				<textarea class="widefat" rows="5" cols="40" id="<?php echo esc_attr( $this->get_field_id( 'faq_des' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'faq_des' ) ); ?>">
        		<?php echo $instance['faq_des']; ?></textarea>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'faq_select_page' ) ); ?>"><?php esc_html_e( 'Select Category:', 'arsha' ); ?></label>
				<?php
				$cat_args = array(
					'orderby'         => 'name',
					'hide_empty'      => false,
					'taxonomy'        => 'service_category',
					'name'            => $this->get_field_name( 'faq_select_page' ),
					'id'              => $this->get_field_id( 'faq_select_page' ),
					'selected'        => $instance['faq_select_page'],
					'show_option_all' => esc_html__( 'All Categories','arsha' ),
				);
				wp_dropdown_categories( $cat_args );
				?>
			</p>
			<?php
		}
	}
endif;