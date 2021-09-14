    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Team</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
        <?php 

          $args = array(  
          'post_type' => 'team',
          'post_status' => 'publish',
          'posts_per_page' => 4, 
        );

        $loop = new WP_Query( $args ); 
        $i = 100; 
        while ( $loop->have_posts() ) : $loop->the_post(); 
          $page_meta = unserialize(get_post_meta($post->ID, 'team_page_options', true));
          $position    =isset($page_meta['position']) ? $page_meta['position'] :'';
          $facebook    =isset($page_meta['facebook']) ? $page_meta['facebook'] :'#';
          $instagram    =isset($page_meta['instagram']) ? $page_meta['instagram'] :'#';
          $twitter    =isset($page_meta['twitter']) ? $page_meta['twitter'] :'#';
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

      ?>
          <!-- <div class="col-lg-6">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="<?php //echo get_template_directory_uri().'/assets/'; ?>img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div> -->

          <!-- <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
              <div class="pic"><img src="<?php //echo get_template_directory_uri().'/assets/'; ?>img/team/team-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="300">
              <div class="pic"><img src="<?php //echo get_template_directory_uri().'/assets/'; ?>img/team/team-3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="400">
              <div class="pic"><img src="<?php //echo get_template_directory_uri().'/assets/'; ?>img/team/team-4.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div> -->

        </div>

      </div>
    </section><!-- End Team Section -->