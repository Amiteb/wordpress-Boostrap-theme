 <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

       
          <?php 
            if ( is_active_sidebar( 'front-page' ) ) { ?>
               <div class="section-title">
              <?php dynamic_sidebar( 'front-page' ); ?>
              </div>
            <?php }
           ?>
        


        <div class="row">
          <?php 

        $args = array(  
        'post_type' => 'service',
        'post_status' => 'publish',
        'posts_per_page' => 4, 
      );

      $loop = new WP_Query( $args ); 
      $i = 100; 
      while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="<?php echo $i; ?>">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href=""><?php the_title(); ?></a></h4>
              <?php the_content(); ?>
            </div>
          </div>

      <?php 
      $i+= 100;
      endwhile;
      wp_reset_postdata(); 

           ?>
          

          <!-- <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Sed ut perspici</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Magni Dolores</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Nemo Enim</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div> -->

        </div>

      </div>
    </section><!-- End Services Section -->