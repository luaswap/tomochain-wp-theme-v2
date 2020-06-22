<div class="site">
	<?php if (!is_404()): ?>
	<header id="masthead" class="site-header">
		<?php do_action('tmc_before_site_content');?>
		<div class="tmc-header">
			<div class="container">
				<div class="navbar-header">
					<div class="site-branding">
						<?php if(has_custom_logo()){
							$logo_id = get_theme_mod( 'custom_logo' );
							$logo = wp_get_attachment_image_src( $logo_id , 'full' );
							// the_custom_logo();
							echo '<a href="' . esc_url($home_url) . '"><img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
						}else{?>
							<h2><a  href="<?php echo esc_url($home_url); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a></h2>
						<?php }?>
					</div><!-- .site-branding -->
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
	<?php endif; ?>