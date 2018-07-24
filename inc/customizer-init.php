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


}
add_action( 'customize_register', 'clean_blog_customizer_settings' );
