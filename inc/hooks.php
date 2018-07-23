<?php 
/**
 * Template hooks for our theme.
 *
 * @package Clean_Blog
 */

if ( ! function_exists( 'clean_blog_header' ) ) :

    function clean_blog_header() {

        $title = '';
        $desc = '';
        $bg_image = get_header_image();

      
        if ( is_singular() || is_page() ) {

            global $post;

            $post_id = $post->ID;

            $title = get_the_title();
            $desc = '';
            $bg_image = has_post_thumbnail( $post_id ) ? get_the_post_thumbnail_url( $post_id, 'full' ) : get_header_image();

        } elseif ( is_archive() ) {

            $title = get_the_archive_title();
            $desc = get_the_archive_description();

        } elseif ( is_search() ) {

            $title = sprintf( __( 'Search results for : %s', 'clean-blog' ) , get_search_query() );
            $desc = '';

        } elseif ( is_404() ) {

            $title = __( '404', 'clean-blog' );
            $desc = '';

        } elseif ( is_home() ) {
            $title =  __( 'Blog', 'clean-blog' );
            $desc = '';
        }



        ?> 

            <header class="masthead" style="background-image: url('<?php echo esc_url( $bg_image ); ?>')">
                <div class="overlay"></div>
                <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1><?php echo wp_kses_post( $title ); ?></h1>
                        <span class="subheading"><?php echo wp_kses_post( $desc ); ?></span>
                    </div>
                    </div>
                </div>
                </div>
            </header>

        <?php
    }

    add_action( 'clean_blog_header_part', 'clean_blog_header' );

endif;