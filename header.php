<?php
/**
 * The header for our theme.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<?php
$hero_area              = get_post_meta( $post->ID, '_bean_hero_area', true );
$menu_layout            = get_theme_mod( 'menu_layout', 'menu_sidebar' );
$header_position        = 'layout_' . get_theme_mod( 'header_position' );
$portfolio_layout       = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
$overlay_title_color    = get_post_meta( $post->ID, '_bean_overlay_title_color', true );
$hero_area              = get_post_meta( $post->ID, '_bean_hero_area', true );
$page_fullscreen_header = get_post_meta( $post->ID, '_bean_page_fullscreen_header', true );
$page_tagline           = get_post_meta( $post->ID, '_bean_page_tagline', true );
?>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>

	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section"></div>
	</div>

	<?php if ( ! is_404() && ! is_page_template( 'template-underconstruction.php' ) ) { ?>

		<?php
		if ( '' !== $menu_layout ) {
			switch ( $menu_layout ) {
				case 'menu_standard':
					include locate_template( 'template-parts/menu-fullscreen.php' );
					break;

				case 'menu_sidebar':
					include locate_template( 'template-parts/menu-sidebar.php' );
					break;

				case 'menu_fullscreen':
					include locate_template( 'template-parts/menu-fullscreen.php' );
					break;
			}
		}
		?>

		<header id="header" class="header <?php echo esc_attr( get_theme_mod( 'header_position' ) ); ?>">

			<div class="site-title">
				<?php harbor_site_logo(); ?>
			</div>

			<nav class="nav primary">

				<a id="nav-toggle" class="hamburger-icon <?php echo esc_attr( get_theme_mod( 'menu_layout' ) ); ?>" href="javascript:void(0);"><span></span></a>

				<?php if ( get_theme_mod( 'menu_visible_nav' ) || get_theme_mod( 'menu_layout' ) == 'menu_standard' ) { ?>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary-menu',
							'container'      => '',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'sf-menu main-menu',
						)
					);
					?>

				<?php } ?>

			</nav>

		</header>

		<?php
		if ( is_tax( 'portfolio_category' ) || is_search() || is_tax() || is_archive() ) {
			/* Check if this is an archivial page. If so, get the the filter - which has a archivial title if statement. */
			get_template_part( 'content-sub-header' );
		}

		if ( 'off' === $hero_area ) {
			if ( is_page_template( 'template-portfolio.php' ) || is_page_template( 'template-portfolio-relative-grid.php' ) || is_page_template( 'template-portfolio-squared-grid.php' ) ) {
				if ( true === get_theme_mod( 'portfolio_filter' ) ) {
					get_template_part( 'content-portfolio-filter' );
				}
			}
		}
		?>

		<section id="page-container" class="hfeed
		<?php
		if ( $hero_area != 'on' and is_page_template( 'template-portfolio-fullpage.php' ) ) {
			echo 'has-hero'; }
			?>
			">

			<?php $portfolio_layout = get_post_meta( $post->ID, '_bean_portfolio_layout', true ); ?>

			<?php
			if ( $hero_area == 'on' && ! is_home() && ! is_archive() && ! is_search() && $portfolio_layout != 'single_portfolio_fullscreen' ) {
				get_template_part( 'content-hero-area' );
			}
			?>

			<div id="page-inner" class="page-inner">

				<?php
				if ( 'on' === $hero_area ) {

					if ( is_page_template( 'template-portfolio.php' ) || is_page_template( 'template-portfolio-relative-grid.php' ) || is_page_template( 'template-portfolio-squared-grid.php' ) ) {

						$content = $post->post_content;

						if ( $content ) {
						?>
							<div class="portfolio-tagline clearfix">
								<?php echo do_shortcode( $content ); ?>
							</div>
						<?php
						}

						if ( true === get_theme_mod( 'portfolio_filter' ) ) {
							get_template_part( 'content-portfolio-filter' );
						}
					}
				}
				?>
	<?php
}
