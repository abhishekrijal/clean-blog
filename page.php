<?php 
/**
 * Page template default for our theme.
 * @package Clean_Blog
 */

 get_header(); ?>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
                while( have_posts() ) : the_post();

                    the_content();

                endwhile; 
            ?>
        </div>
      </div>
    </div>

    <hr>

<?php
 get_footer();
