<div class="nav-overlay"></div>

<div id="menu-sidebar" class="menu-sidebar option_<?php echo esc_attr( get_theme_mod( 'header_position' ) ); ?>">

	<a href="" class="sidebar-close" title="<?php esc_html_e( 'Close Sidebar', 'harbor' ); ?>"></a>

	<div class="menu-sidebar-inner">

		<div class="widget">

			<nav class="nav primary">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'secondary-menu',
						'container'      => '',
						'depth'          => '2',
						'menu_id'        => 'sidebar-menu',
						'menu_class'     => 'main-menu',
					)
				);
				?>
			</nav>

		</div>

		<?php
		if ( is_active_sidebar( 'hidden-sidebar' ) ) {
			dynamic_sidebar( 'hidden-sidebar' ); }
		?>

	</div>

</div>
