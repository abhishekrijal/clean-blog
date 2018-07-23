<?php
/**
 * The main theme functions.
 * @package Clean_Blog
 */

 /**
  * theme_setup
  *
  * @return void
  */
function clean_blog_setup_theme(){


    load_theme_textdomain( 'clean-blog' );

    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support( 'title-tag' );
    
    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

    $args = array(
        'width'         => 1920,
        'height'        => 450,
        'default-image' => get_template_directory_uri() . '/img/home-bg.jpg',
    );
    add_theme_support( 'custom-header', $args );

    $defaults = array(
        'default-color'          => '',
        'default-image'          => '',
        'default-repeat'         => 'repeat',
        'default-position-x'     => 'left',
            'default-position-y'     => 'top',
            'default-size'           => 'auto',
        'default-attachment'     => 'scroll',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    );
    add_theme_support( 'custom-background', $defaults );
    

    // Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo', array(
			'width'      => 60,
			'height'     => 60,
			'flex-width' => true,
		)
    );
    
    // This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu', 'clean-blog' ),
            'social' => __( 'Social Links Menu', 'clean-blog' ),
		)
    );

}

add_action( 'after_setup_theme', 'clean_blog_setup_theme' );

/**
 * Style and scrips enqueue
 *
 * @return void
 */
function clean_blog_theme_scripts() {

    $min = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

// CSS 

    wp_enqueue_style( 'clean-blog-stylesheet', get_stylesheet_uri() );

    wp_enqueue_style( 'clean-blog-bootstrap-css', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap' . $min . '.css' );
    wp_enqueue_style( 'clean-blog-font-awesome-css', get_template_directory_uri() . '/vendor/font-awesome/css/font-awesome' . $min . '.css' );

    wp_enqueue_style( 'clean-blog-lora-google-font', 'https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' );

    wp_enqueue_style( 'clean-blog-open-sans-google-font', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' );

    wp_enqueue_style( 'clean-blog-main-css', get_template_directory_uri() . '/css/clean-blog' . $min . '.css' );


// JS

    wp_enqueue_script( 'clean-blog-bootstrap-js', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle' . $min . '.js', array( 'jquery' ), '4.1.1', true );

    wp_enqueue_script( 'clean-blog-custom-js', get_template_directory_uri() . '/js/clean-blog' . $min . '.js', array( 'jquery' ), '', true );



}
add_action( 'wp_enqueue_scripts', 'clean_blog_theme_scripts' );


function clean_blog_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'primary-menu' ) {
      $classes[] = 'nav-item';
    }
    return $classes;
  }
add_filter('nav_menu_css_class', 'clean_blog_menu_classes', 1, 3);


add_filter( 'nav_menu_link_attributes', 'clean_blog_menu_add_class', 10, 3 );

function clean_blog_menu_add_class( $atts, $item, $args ) {
    $class = 'nav-link'; // or something based on $item
    $atts['class'] = $class;
    return $atts;
}


if ( ! function_exists( 'clean_blog_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function clean_blog_posted_on() {

        $byline = sprintf( 
            /* translators: %1$s: post author, $2$s: post date */
            __( 'Posted by %1$s on %2$s ', 'clean-blog' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a>', get_the_date()
        );

		// Finally, let's write all of this to the page.
		echo '<p class="post-meta">' . $byline . '</p>';
	}
endif;


require get_template_directory() . '/inc/hooks.php';
