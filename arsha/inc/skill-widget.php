<?php
/**
 * Custom Theme widgets.
 *
 * @package Arsha
 */

if ( ! function_exists( 'arsha_skill_section_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function arsha_skill_section_widgets() {

		// About Us widget.
		register_widget( 'Aarsha_skill_section_Widget' );

	}

endif;

add_action( 'widgets_init', 'arsha_skill_section_widgets' );

if ( ! class_exists( 'Aarsha_skill_section_Widget' ) ) :

	class Aarsha_skill_section_Widget extends WP_Widget
	{
		
		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'arsha-skill-section',
				'description'                 => esc_html__( 'Arsha Skill Section Widget', 'arsha' ),
				'customize_selective_refresh' => true,
				);
			parent::__construct( 'arsha-skill-section', esc_html__( 'Arsha Skill Section', 'arsha' ), $opts );
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

			$html_number = apply_filters( 'widget_title', empty( $instance['html_number'] ) ? '' : $instance['html_number'], $instance, $this->id_base );

			$css_number = apply_filters( 'widget_title', empty( $instance['css_number'] ) ? '' : $instance['css_number'], $instance, $this->id_base );

			$javascript_number = apply_filters( 'widget_title', empty( $instance['javascript_number'] ) ? '' : $instance['javascript_number'], $instance, $this->id_base );

			$photoshop_number = apply_filters( 'widget_title', empty( $instance['photoshop_number'] ) ? '' : $instance['photoshop_number'], $instance, $this->id_base );
			$skill_section_page = ! empty( $instance['skill_section_page'] ) ? $instance['skill_section_page'] : 0;
			$content_post = get_post($skill_section_page);
			// var_dump($content_post);
			echo $args['before_widget'];

			// Render Button Name
			// if ( ! empty( $html_number ) ) {
			// 	echo $args['before_title'] . $html_number . $args['after_title'];
			// }
			?>

		    <div class="container">
		      <div class="row">
		        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
		          <h1><?php echo $content_post->post_title; ?></h1>
		          <h2><?php echo $content_post->post_content; ?></h2>
		          <div class="d-flex justify-content-center justify-content-lg-start">
		            <a href="<?php echo $css_number; ?>" class="btn-get-started scrollto"><?php echo $html_number; ?></a>
		            <a href="<?php echo $photoshop_number; ?>" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span><?php echo $javascript_number; ?></span></a>
		          </div>
		        </div>
		        <?php if (has_post_thumbnail( $skill_section_page ) ): ?>
		        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $skill_section_page ), 'full' ); ?>
		        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
		          <img src="<?php echo $image[0]; ?>" class="img-fluid animated" alt="">
		        </div>
		        <?php endif; ?>
		      </div>
		    </div>

		    <!-- ======= Skills Section ======= -->
		    <section id="skills" class="skills">
		      <div class="container" data-aos="fade-up">

		        <div class="row">
		        	<?php if (has_post_thumbnail( $skill_section_page ) ): ?>
		        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $skill_section_page ), 'full' ); ?>

		        <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
		        <img src="<?php echo $image[0]; ?>" class="img-fluid" alt="">
		          </div>
		        <?php endif; ?>

		          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
		            <h3><?php echo $content_post->post_title; ?></h3>
		            <p class="fst-italic">
		              <?php echo $content_post->post_content; ?>
		            </p>

		            <div class="skills-content">

		              <div class="progress">
		                <span class="skill">HTML <i class="val"><?php echo $html_number; ?>%</i></span>
		                <div class="progress-bar-wrap">
		                  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $html_number; ?>" aria-valuemin="0" aria-valuemax="100"></div>
		                </div>
		              </div>

		              <div class="progress">
		                <span class="skill">CSS <i class="val"><?php echo $css_number; ?>%</i></span>
		                <div class="progress-bar-wrap">
		                  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $css_number; ?>" aria-valuemin="0" aria-valuemax="100"></div>
		                </div>
		              </div>

		              <div class="progress">
		                <span class="skill">JavaScript <i class="val"><?php echo $javascript_number; ?>%</i></span>
		                <div class="progress-bar-wrap">
		                  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $javascript_number; ?>" aria-valuemin="0" aria-valuemax="100"></div>
		                </div>
		              </div>

		              <div class="progress">
		                <span class="skill">Photoshop <i class="val"><?php echo $photoshop_number; ?>%</i></span>
		                <div class="progress-bar-wrap">
		                  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $photoshop_number; ?>" aria-valuemin="0" aria-valuemax="100"></div>
		                </div>
		              </div>

		            </div>

		          </div>
		        </div>

		      </div>
		    </section><!-- End Skills Section -->

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

			$instance['html_number'] = absint( $new_instance['html_number'] );
			$instance['css_number'] = absint( $new_instance['css_number'] );
			$instance['javascript_number'] = absint( $new_instance['javascript_number'] );
			$instance['photoshop_number'] = absint( $new_instance['photoshop_number'] );
			$instance['skill_section_page']            = absint( $new_instance['skill_section_page'] );

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
				'html_number' => '',
				'css_number' =>'',
				'javascript_number' =>'',
				'photoshop_number' =>'',
				'skill_section_page' =>'',
				) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'html_number' ) ); ?>"><?php esc_html_e( 'Html Number', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'html_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'html_number' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['html_number'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'css_number' ) ); ?>"><?php esc_html_e( 'Css Number', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'css_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'css_number' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['css_number'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'javascript_number' ) ); ?>"><?php esc_html_e( 'Javascript Number', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'javascript_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'javascript_number' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['javascript_number'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'photoshop_number' ) ); ?>"><?php esc_html_e( 'Photoshop Number', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'photoshop_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'photoshop_number' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['photoshop_number'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'skill_section_page' ) ); ?>"><?php esc_html_e( 'Select Page:', 'arsha' ); ?></label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'skill_section_page' ),
					'name'             => $this->get_field_name( 'skill_section_page' ),
					'selected'         => $instance['skill_section_page'],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'arsha' ),
					)
				);
				?>
			</p>
			<?php
		}
	}
endif;