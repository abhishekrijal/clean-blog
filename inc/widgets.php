<?php 
/**
 * Register theme widgets.
 */


class Clean_Blog_About_Me_Widget extends WP_Widget {

    /**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'clean_blog_about_me_widget',
			'description' => __( 'About Me info widget', 'clean-blog' ),
		);
		parent::__construct( 'clean_blog_about_me_widget', esc_html__( 'Clean Blog : About Me', 'clean-blog' ), $widget_ops );
    }
    
      /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {

            $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';

            $bio = isset( $instance['bio_text'] ) ? $instance['bio_text'] : '';
            
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('widget_title') ); ?>"><?php esc_html_e( 'Title', 'clean-blog' ) ?></label>
            <input class="widefat" type="text" id="<?php  echo esc_attr( $this->get_field_id('widget_title') );  ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' )); ?>" value="<?php echo esc_attr( $widget_title ); ?>" >
        </p>

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('bio_text') ); ?>"><?php esc_html_e( 'Bio Text', 'clean-blog' ) ?></label>
            <textarea class="widefat" name="<?php echo esc_attr( $this->get_field_name('bio_text') ); ?>" id="<?php echo esc_attr( $this->get_field_id('bio_text') ); ?>" cols="30" rows="10"><?php echo esc_html( $bio ) ?></textarea>
            
        </p>

        <?php
        }


        public function widget( $args, $instance ) {

            $title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';

            $bio = isset( $instance['bio_text'] ) ? $instance['bio_text'] : '';

            echo $args['before_widget'];

            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

            ?>

                <div class="widget-bio">

                    <p class="bio-content">
                        <?php echo esc_html( $bio ); ?>
                    </p>

                </div>




            <?php 

            echo $args['after_widget'];


        }


    /**
     * Save data 
     */


     public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['widget_title'] = isset( $new_instance['widget_title'] ) ? sanitize_text_field( $new_instance['widget_title'] ) : '';

        $instance['bio_text'] = isset( $new_instance['bio_text'] ) ? sanitize_textarea_field( $new_instance['bio_text'] ) : '';


        return $instance;
     }


}


class Clean_Blog_Latest_Posts extends WP_Widget {

    /**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'clean_blog_latest_posts',
			'description' => __( 'Latest Posts widget', 'clean-blog' ),
		);
		parent::__construct( 'clean_blog_latest_posts', esc_html__( 'Clean Blog : Latest Posts', 'clean-blog' ), $widget_ops );
    }
    
      /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {

            $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';

            $cat = isset( $instance['cat'] ) ? $instance['cat'] : 0;
            
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('widget_title') ); ?>"><?php esc_html_e( 'Title', 'clean-blog' ) ?></label>
            <input class="widefat" type="text" id="<?php  echo esc_attr( $this->get_field_id('widget_title') );  ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' )); ?>" value="<?php echo esc_attr( $widget_title ); ?>" >
        </p>

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('cat') ); ?>"><?php esc_html_e( 'Category :', 'clean-blog' ) ?></label>
            <?php 
            
            $args = array(
                'show_option_all'    => __('All Categories', 'clean-blog'),
                'option_none_value'  => '-1',
                'orderby'            => 'ID',
                'order'              => 'ASC',
                'show_count'         => 1,
                'hide_empty'         => 1,
                'child_of'           => 0,
                'exclude'            => '',
                'include'            => '',
                'echo'               => 1,
                'selected'           => $cat,
                'hierarchical'       => 1,
                'name'               => $this->get_field_name('cat'),
                'id'                 => $this->get_field_id('cat'),
                'class'              => 'widefat',
                'depth'              => 0,
                'tab_index'          => 0,
                'taxonomy'           => 'category',
                'hide_if_empty'      => false,
                'value_field'	     => 'term_id',
            );
            
            wp_dropdown_categories( $args ); ?>
            
        </p>

        <?php
        }


        public function widget( $args, $instance ) {

            $title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';

            $cat = isset( $instance['cat'] ) ? $instance['cat'] : '';

            echo $args['before_widget'];

            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

            ?>

                




            <?php 

            echo $args['after_widget'];


        }


    /**
     * Save data 
     */


     public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['widget_title'] = isset( $new_instance['widget_title'] ) ? sanitize_text_field( $new_instance['widget_title'] ) : '';

        $instance['cat'] = isset( $new_instance['cat'] ) ? absint( $new_instance['cat'] ) : '';


        return $instance;
     }


}

function clean_blog_init_widgets() {


    register_widget( 'Clean_Blog_About_Me_Widget' );

    register_widget( 'Clean_Blog_Latest_Posts' );

}

add_action( 'widgets_init', 'clean_blog_init_widgets' );


