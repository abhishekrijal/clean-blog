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
            <?php if ( is_active_sidebar( 'clean-blog-primary-sidebar' ) ) : ?>
                <div class="col-lg-4">
                
                    <?php dynamic_sidebar( 'clean-blog-primary-sidebar' ) ?>
                
                </div>
            <?php endif; ?>
        </div>
    </div>

    <hr>

<?php
get_footer();
