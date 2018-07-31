<?php
/**
 * Front page template hooks.
 * @package Clen_Blog
 */

 /**
  * Front page main slider.
  */
function clean_blog_front_page_slider() {

    $no_slides = get_theme_mod( 'clean_blog_front_page_no_of_slides', 3 );

    $data_type = get_theme_mod( 'clean_blog_front_page_slider_data', 'post' );

    $slides = array();

    if ( 'post' === $data_type ) {

        $cat = get_theme_mod( 'clean_blog_front_page_slider_category', false );

        if ( $cat ) {

            $slider_posts = new WP_Query( array( 'cat' => absint( $cat ), 'posts_per_page' => $no_slides ) );

            if ( $slider_posts->have_posts() ) :

                $i = 1;

                while( $slider_posts->have_posts() ) : $slider_posts->the_post();

                    $slides[$i]['image'] = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    $slides[$i]['caption'] = get_the_title( get_the_ID() );
                    $slides[$i]['desc'] = get_the_excerpt( get_the_ID() );
                $i++;
                endwhile;

            endif;
 
        }

    } else {

        for ( $i=1; $i <= $no_slides; $i++) {
            
            $slides[$i]['image'] = get_theme_mod( 'clean_blog_front_page_slider_image_'.$i );
            $slides[$i]['caption'] = get_theme_mod( 'clean_blog_front_page_slider_caption_'.$i );
            $slides[$i]['desc'] = get_theme_mod( 'clean_blog_front_page_slider_desc_'.$i );

        }

    }

    
    if ( is_array( $slides ) && ! empty( $slides ) ) :

        ?>
        <div class="Modern-Slider">
            
        <?php foreach( $slides as $key => $slide ) : ?>
            <!-- Item -->
            <div class="item">
                <div class="img-fill">
                    <img src="<?php echo esc_url( $slide['image'] ); ?>" alt="">
                    <div class="info">
                        <div>
                            <h3><?php echo esc_html( $slide['caption'] ); ?></h3>
                            <h5><?php echo esc_html( $slide['desc'] ); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Item -->
        
        <?php endforeach; ?>
    
        </div>

        <?php

    endif;

}

add_action( 'clean_blog_front_page_slider', 'clean_blog_front_page_slider' );