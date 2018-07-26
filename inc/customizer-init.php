<?php
/**
 * Theme Customizer Settings.
 * @package Clean_Blog\inc
 */

 /**
  * Registers customizer settings for our theme.
  *
  * @param obj $wp_customize Customizer object
  * @return void
  */
function clean_blog_customizer_settings( $wp_customize ) {

    $wp_customize->add_panel( 'clean_blog_theme_options', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'title'          => __( 'Clean Blog Theme Options', 'clean-blog' ),
        'description'    => __( 'Manage Options for clean blog theme', 'clean-blog' ),
    ) );

    $wp_customize->add_section( 'clean_blog_front_page_settings_section', array(
        'priority'       => 10,
        'panel'          => 'clean_blog_theme_options',
        'capability'     => 'edit_theme_options',
        'title'          => __( 'Front Page Options', 'clean-blog' ),
        'description'    => __( 'Manage Options for front page', 'clean-blog' ),
    ) );

    $wp_customize->add_setting( 'clean_blog_footer_copyright_text', array(
        'capability'     => 'edit_theme_options',
        'default'        => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'clean_blog_footer_copyright_text', array(
        'type'         => 'textarea',
        'settings'     => 'clean_blog_footer_copyright_text',
        'section'      => 'clean_blog_front_page_settings_section',
        'label'        => __( 'Footer Copyright Text', 'clean-blog' ),

    ) );

    $wp_customize->add_section( 'clean_blog_front_page_slider_section', array(
        'priority'       => 10,
        'panel'          => 'clean_blog_theme_options',
        'capability'     => 'edit_theme_options',
        'title'          => __( 'Front Page Slider', 'clean-blog' ),
        'description'    => __( 'Manage Options for front page Slider', 'clean-blog' ),
    ) );

    $wp_customize->add_setting( 'clean_blog_front_page_no_of_slides', array(
        'capability'     => 'edit_theme_options',
        'default'        => 3,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'clean_blog_front_page_no_of_slides', array(
        'type'         => 'text',
        'settings'     => 'clean_blog_front_page_no_of_slides',
        'section'      => 'clean_blog_front_page_slider_section',
        'label'        => __( 'No, of Slides', 'clean-blog' ),

    ) );

    $slides = get_theme_mod( 'clean_blog_front_page_no_of_slides', 3 );

    for ( $i=1; $i <= $slides; $i++ ) {

        $wp_customize->add_setting( 'clean_blog_front_page_slider_image_'.$i, array(
            'capability'     => 'edit_theme_options',
            'default'        => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'clean_blog_front_page_slider_image_'.$i,
            array(
                'label'      => __( 'Slider Image ', 'clean-blog' ).$i,
                'section'    => 'clean_blog_front_page_slider_section',
                'settings'   => 'clean_blog_front_page_slider_image_'.$i,
            )
        ) );
    
    }


}
add_action( 'customize_register', 'clean_blog_customizer_settings' );
