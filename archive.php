<?php 
/**
 * Main index file of the theme.
 * 
 */

 get_header();

?>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          
          <?php 

            if ( have_posts() ) :

              while( have_posts() ) : the_post();

                get_template_part( 'templates/content', get_post_format() );

              endwhile;

            endif;

          ?>

          <!-- Pager -->
          <div class="clearfix">
          <?php the_posts_navigation( array( 'prev_text' => __( 'Older Posts &rarr;', 'clean-blog' ), 'next_text' => __( 'Newer Posts', 'clean-blog' ), 'screen_reader_text' => __('Navigation', 'clean-blog' ) ) ); ?>
          </div>
        </div>
      </div>
    </div>

    <hr>

 <?php 
 get_footer();
 