<div class="menu-fullscreen">

	<div class="menu-fullscreen-wrap">

		<nav class="nav primary">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'secondary-menu',
					'container'      => '',
					'depth'          => '2',
					'menu_id'        => 'fullscreen-menu',
					'menu_class'     => 'main-menu',
				)
			);
			?>
		</nav><!-- END .nav -->

	</div><!-- END .menu-fullscreen-wrap -->

</div>
