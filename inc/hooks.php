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

        if ( is_front_page() ) :

            do_action('clean_blog_front_page_slider');

        else :

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

        endif;
    }

    add_action( 'clean_blog_header_part', 'clean_blog_header' );

endif;


if ( ! function_exists( 'clean_blog_front_page_about_section' ) ) :

    /**
     * clean_blog_front_page_about_section add about section in front page.
     *
     * @return void
     */
    function clean_blog_front_page_about_section() {

        $about_page_id = get_theme_mod( 'clean_blog_about_section_page_id', false );

        if ( ! $about_page_id ) {
            return;
        }

        $page = get_posts( array( 'post_type' => 'page',  'p' => $about_page_id ) );

        if ( ! $page ) {
            return;
        }

        $page = $page[0];

        $page_id = $page->ID;

        ?>
            <div class="containter">
            <h1><?php echo esc_html( $page->post_title );  ?></h1>
                <div class="row">

                    <div class="col-xl-6">

                        <img src="<?php get_the_post_thumbnail_url( $page_id, 'full' ); ?>" alt="">

                    </div>
                    <div class="col-xl-6">

                        <p>
                        
                        <?php echo esc_html( wp_trim_words( $page->post_content, 20, '...' ) ) ?>
                        
                        </p>

                    </div>
                </div>
            </div>

            <hr>

        <?php

    }

    add_action( 'clean_blog_front_page_sections', 'clean_blog_front_page_about_section' );

endif;