<?php
/**
 * Custom Theme widgets.
 *
 * @package Arsha
 */

if ( ! function_exists( 'arsha_whychoose_section_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function arsha_whychoose_section_widgets() {

		// About Us widget.
		register_widget( 'Aarsha_whychoose_section_Widget' );

	}

endif;

add_action( 'widgets_init', 'arsha_whychoose_section_widgets' );

if ( ! class_exists( 'Aarsha_whychoose_section_Widget' ) ) :

	class Aarsha_whychoose_section_Widget extends WP_Widget
	{
		
		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'arsha-whychoose-section',
				'description'                 => esc_html__( 'Arsha Why Choose Section Widget', 'arsha' ),
				'customize_selective_refresh' => true,
				);
			parent::__construct( 'arsha-whychoose-section', esc_html__( 'Arsha Why Choose Section', 'arsha' ), $opts );
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

			$whychoose_section_page = ! empty( $instance['whychoose_section_page'] ) ? $instance['whychoose_section_page'] : 0;
			$content_post = get_post($whychoose_section_page);
			$cat_id = ! empty( $instance['whychoose_select_page'] ) ? $instance['whychoose_select_page'] : 0; 
			// var_dump($content_post);
			echo $args['before_widget'];

			// Render Button Name
			// if ( ! empty( $btn_txt ) ) {
			// 	echo $args['before_title'] . $btn_txt . $args['after_title'];
			// }
			?>

		    <!-- ======= Why Us Section ======= -->
		    <section id="why-us" class="why-us section-bg">
		      <div class="container-fluid" data-aos="fade-up">
		        <div class="row">

		          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

		            <div class="content">
		              <h3><?php echo $content_post->post_title; ?></h3>
		              <p><?php echo $content_post->post_content; ?></p>
		            </div>

		            <div class="accordion-list">
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
				        		$count = 1;
      							while ( $loop->have_posts() ) : $loop->the_post(); 
        						$show = $count == 1 ? 'show' : '';  ?>
					          <li>
			                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-<?php echo $count; ?>"><span>01</span> <?php the_title(); ?><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
			                  <div id="accordion-list-<?php echo $count; ?>" class="collapse <?php echo $show; ?>" data-bs-parent=".accordion-list">
			                    <?php the_content(); ?>
			                  </div>
			                </li>
						      <?php 
						      $count++; 
						  	endwhile;
				        	wp_reset_postdata();
					  	  endif;
					      ?>
		              </ul>
		            </div>

		          </div>

		          <?php if (has_post_thumbnail( $whychoose_section_page ) ): ?>
		        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $whychoose_section_page ), 'full' ); ?>
		       <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("<?php echo $image[0]; ?>");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
		        </div>
		        <?php endif; ?>

		      </div>
		    </section><!-- End Why Us Section -->

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
			$instance['whychoose_section_page'] = absint( $new_instance['whychoose_section_page'] );
			$instance['whychoose_select_page'] = absint( $new_instance['whychoose_select_page'] );

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
				'whychoose_section_page' =>'',
				'whychoose_select_page'	 =>'',
				) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'whychoose_section_page' ) ); ?>"><?php esc_html_e( 'Select Page:', 'arsha' ); ?></label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'whychoose_section_page' ),
					'name'             => $this->get_field_name( 'whychoose_section_page' ),
					'selected'         => $instance['whychoose_section_page'],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'arsha' ),
					)
				);
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'whychoose_select_page' ) ); ?>"><?php esc_html_e( 'Select Category:', 'arsha' ); ?></label>
				<?php
				$cat_args = array(
					'orderby'         => 'name',
					'hide_empty'      => false,
					'taxonomy'        => 'service_category',
					'name'            => $this->get_field_name( 'whychoose_select_page' ),
					'id'              => $this->get_field_id( 'whychoose_select_page' ),
					'selected'        => $instance['whychoose_select_page'],
					'show_option_all' => esc_html__( 'All Categories','arsha' ),
				);
				wp_dropdown_categories( $cat_args );
				?>
			</p>
			<?php
		}
	}
endif;