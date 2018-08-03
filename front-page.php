<?php
/**
 * Front Page Template.
 * @package Clean_Blog
 */
get_header(); ?>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
            <?php
                do_action( 'clean_blog_front_page_sections' );
            ?>
            </div>
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