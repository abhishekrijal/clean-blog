<?php
/**
 * Front page template hooks.
 * @package Clen_Blog
 */

 /**
  * Front page main slider.
  */
function clean_blog_front_page_slider() {

    ?>


    <div id="front-page-slider">

        <?php for( $i = 1; $i < 4; $i++ ) { ?>

            <div class="image-wrapper">
                <img src="<?php echo get_template_directory_uri() . '/img/slider.jpg' ?>" alt="">
            </div>

        <?php } ?>
    
    </div>

    <?php

}

add_action( 'clean_blog_front_page_slider', 'clean_blog_front_page_slider' );