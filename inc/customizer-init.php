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

    require get_template_directory() . '/inc/customizer-controls.php';

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


    $wp_customize->add_setting( 'clean_blog_front_page_slider_data', array(
        'capability' => 'edit_theme_options',
        'default' => 'custom',
    ) );
    $wp_customize->add_control( 'clean_blog_front_page_slider_data', array(
        'type' => 'radio',
        'section' => 'clean_blog_front_page_slider_section', // Add a default or your own section
        'label' => __( 'Slider Data From :' ),
        'description' => __( 'This is a custom radio input.' ),
        'choices' => array(
            'post' => __( 'Posts', 'clean-blog' ),
            'custom' => __( 'Custom', 'clean-blog' ),
        ),
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
                'active_callback' => 'clean_blog_slider_is_custom_selected',
            )
        ) );

        $wp_customize->add_setting( 'clean_blog_front_page_slider_caption_'.$i, array(
            'capability'     => 'edit_theme_options',
            'default'        => '',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
    
        $wp_customize->add_control( 'clean_blog_front_page_slider_caption_'.$i, array(
            'type'         => 'text',
            'settings'     => 'clean_blog_front_page_slider_caption_'.$i,
            'section'      => 'clean_blog_front_page_slider_section',
            'label'        => sprintf(__( 'Slide %1$s Caption', 'clean-blog' ), $i),
            'active_callback' => 'clean_blog_slider_is_custom_selected',
    
        ) );

        $wp_customize->add_setting( 'clean_blog_front_page_slider_desc_'.$i, array(
            'capability'     => 'edit_theme_options',
            'default'        => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
    
        $wp_customize->add_control( 'clean_blog_front_page_slider_desc_'.$i, array(
            'type'         => 'textarea',
            'settings'     => 'clean_blog_front_page_slider_desc_'.$i,
            'section'      => 'clean_blog_front_page_slider_section',
            'label'        => sprintf(__( 'Slide %1$s Description', 'clean-blog' ), $i),
            'active_callback' => 'clean_blog_slider_is_custom_selected',
    
        ) );
    
    }

    $wp_customize->add_setting( 'clean_blog_front_page_slider_category', array(
        'capability'     => 'edit_theme_options',
        'default'        => '',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new Clean_Blog_Dropdown_Taxonomies_Control(
        $wp_customize,
        'clean_blog_front_page_slider_category',
        array(
            'label'      => __( 'Slider Category', 'clean-blog' ),
            'section'    => 'clean_blog_front_page_slider_section',
            'settings'   => 'clean_blog_front_page_slider_category',
            'active_callback' => 'clean_blog_slider_is_posts_selected',
        )
    ) );
    

    /**
     * About Section
     */

    $wp_customize->add_section( 'clean_blog_front_page_about_section', array(
        'priority'       => 10,
        'panel'          => 'clean_blog_theme_options',
        'capability'     => 'edit_theme_options',
        'title'          => __( 'Front Page About Section', 'clean-blog' ),
        'description'    => __( 'Manage Options for front page About Us', 'clean-blog' ),
    ) );

    $wp_customize->add_setting( 'clean_blog_about_section_page_id', array(
        'capability'     => 'edit_theme_options',
        'default'        => 3,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'clean_blog_about_section_page_id', array(
        'type'         => 'dropdown-pages',
        'settings'     => 'clean_blog_about_section_page_id',
        'section'      => 'clean_blog_front_page_about_section',
        'label'        => __( 'About Section page', 'clean-blog' ),

    ) );

}
add_action( 'customize_register', 'clean_blog_customizer_settings' );
