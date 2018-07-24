<?php 
/**
 * The header for our theme.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?> >

		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
			<div class="container">
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				
				<?php if ( has_custom_logo() ) : 
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>

						<img src="<?php echo esc_url( $logo[0] ); ?>" alt="">

				<?php endif;

						echo esc_html( bloginfo( 'name' ) ); ?>
					
			</a>
				
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<?php esc_html_e( 'Menu', 'clean-blog' ); ?>
					<i class="fa fa-bars"></i>
				</button>
					

					<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'navbar-nav ml-auto', 'container_class' => 'collapse navbar-collapse', 'container_id' => 'navbarResponsive',   ) ); ?>
			</div>
		</nav>

		<!-- Page Header -->
		<?php
		/**
		 * Output theme header part.
		 * @hook : clean_blog_header_part
		 * @hooked : clean_blog_header - 10
		 */
		do_action( 'clean_blog_header_part' );
