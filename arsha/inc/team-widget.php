<?php
/**
 * Custom Theme widgets.
 *
 * @package Arsha
 */

if ( ! function_exists( 'arsha_team_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function arsha_team_widgets() {

		// About Us widget.
		register_widget( 'arsha_team_section_widgets' );

	}

endif;

add_action( 'widgets_init', 'arsha_team_widgets' );

if ( ! class_exists( 'arsha_team_section_widgets' ) ) :

	class arsha_team_section_widgets extends WP_Widget
	{
		
		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'arsha-team-section',
				'description'                 => esc_html__( 'Arsha Team Section Widget', 'arsha' ),
				'customize_selective_refresh' => true,
				);
			parent::__construct( 'arsha-team-section', esc_html__( 'Arsha Team Section Widget', 'arsha' ), $opts );
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

			$team_title = apply_filters( 'widget_title', empty( $instance['team_title'] ) ? '' : $instance['team_title'], $instance, $this->id_base );

			$team_des = apply_filters( 'widget_title', empty( $instance['team_des'] ) ? '' : $instance['team_des'], $instance, $this->id_base );

			$cat_id = ! empty( $instance['team_select_page'] ) ? $instance['team_select_page'] : 0; ?>

			<section id="team" class="team section-bg">
      			<div class="container" data-aos="fade-up">
      				<div class="section-title">
			          <h2><?php echo $team_title; ?></h2>
			          <p><?php echo $team_des; ?></p>
			        </div>
       			<div class="row">
          <?php  
          // var_dump($cat_id);
          if($cat_id > 0):

				$datap = array(
					'posts_per_page'	=> 4,
				    'post_type'			=> 'team',
				    'tax_query' => array(
			        array(
			            'taxonomy' => 'team_category',
			            'field' => 'ID', //can be set to ID
			            'terms' => $cat_id //if field is ID you can reference by cat/term number
			        	),
			    	),
				);
				$loop = new WP_Query( $datap ); 
        		$i = 100; 
        		global $post;
        		while ( $loop->have_posts() ) : $loop->the_post();  

	        	  $page_meta   = unserialize(get_post_meta($post->ID, 'team_page_options', true));
		          $position    =isset($page_meta['position']) ? $page_meta['position'] :'';
		          $facebook    =isset($page_meta['facebook']) ? $page_meta['facebook'] :'#';
		          $instagram   =isset($page_meta['instagram']) ? $page_meta['instagram'] :'#';
		          $twitter     =isset($page_meta['twitter']) ? $page_meta['twitter'] :'#';
		          $linkedin    =isset($page_meta['linkedin']) ? $page_meta['linkedin'] :'#';
		        ?>

		          <div class="col-lg-6 mt-4">
		            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="<?php echo $i; ?>">
		              <div class="pic"><?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?></div>
		              <div class="member-info">
		                <h4><?php the_title(); ?></h4>
		                <span><?php echo esc_html($position); ?></span>
		                <p><?php the_content(); ?></p>
		                <div class="social">

		                  <a href="<?php echo esc_url($twitter); ?>"><i class="ri-twitter-fill"></i></a>

		                  <a href="<?php echo esc_url($facebook); ?>"><i class="ri-facebook-fill"></i></a>
		                  <a href="<?php echo esc_url($instagram); ?>"><i class="ri-instagram-fill"></i></a>
		                  <a href="<?php echo esc_url($linkedin); ?>"> <i class="ri-linkedin-box-fill"></i> </a>
		                </div>
		              </div>
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

			$instance['team_title'] = sanitize_text_field( $new_instance['team_title'] );
			$instance['team_des'] = sanitize_text_field( $new_instance['team_des'] );
			$instance['team_select_page'] = absint( $new_instance['team_select_page'] );

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
				'team_title' => '',
				'team_des' =>'',
				'team_select_page' =>'',
				) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'team_title' ) ); ?>"><?php esc_html_e( 'Title', 'arsha' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'team_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'team_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['team_title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'team_des' ) ); ?>"><?php esc_html_e( 'Description', 'arsha' ); ?></label><br>
				<textarea class="widefat" rows="5" cols="40" id="<?php echo esc_attr( $this->get_field_id( 'team_des' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'team_des' ) ); ?>">
        		<?php echo $instance['team_des']; ?></textarea>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'team_select_page' ) ); ?>"><?php esc_html_e( 'Select Category:', 'arsha' ); ?></label>
				<?php
				$cat_args = array(
					'orderby'         => 'name',
					'hide_empty'      => false,
					'taxonomy'        => 'team_category',
					'name'            => $this->get_field_name( 'team_select_page' ),
					'id'              => $this->get_field_id( 'team_select_page' ),
					'selected'        => $instance['team_select_page'],
					'show_option_all' => esc_html__( 'All Categories','arsha' ),
				);
				wp_dropdown_categories( $cat_args );
				?>
			</p>
			<?php
		}
	}
endif;