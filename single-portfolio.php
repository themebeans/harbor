<?php
/**
 * The template for displaying the portfolio singular page.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header();

wp_reset_postdata();

designer_set_post_views( get_the_ID() );

$portfolio_layout           = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
$tc_single_portfolio_layout = get_theme_mod( 'single_portfolio_layout' );

if ( 'customizer_option' === $portfolio_layout ) {
	switch ( $tc_single_portfolio_layout ) {
		case 'single_portfolio_stacked':
		case 'single_portfolio_stacked_no_hero':
			include locate_template( 'template-parts/single-portfolio-stacked.php' );
			break;
		case 'single_portfolio_fullscreen':
		case 'single_portfolio_fullscreen_no_hero':
		case 'single_portfolio_fullscreen_no_content':
			include locate_template( 'template-parts/single-portfolio-fullscreen.php' );
			break;

		case 'single_portfolio_masonry':
		case 'single_portfolio_masonry_no_hero':
			include locate_template( 'template-parts/single-portfolio-masonry.php' );
			break;

		case 'single_portfolio_carousel':
		case 'single_portfolio_carousel_no_hero':
			include locate_template( 'template-parts/single-portfolio-carousel.php' );
			break;
	}
} else {
	switch ( $portfolio_layout ) {
		case 'single_portfolio_stacked':
			include locate_template( 'template-parts/single-portfolio-stacked.php' );
			break;

		case 'single_portfolio_fullscreen':
			include locate_template( 'template-parts/single-portfolio-fullscreen.php' );
			break;

		case 'single_portfolio_masonry':
			include locate_template( 'template-parts/single-portfolio-masonry.php' );
			break;

		case 'single_portfolio_carousel':
		case 'single_portfolio_carousel_no_hero':
			include locate_template( 'template-parts/single-portfolio-carousel.php' );
			break;
	}
}

if ( true === get_theme_mod( 'show_portfolio_sharing' ) ) {
	get_template_part( 'content-post-sharing' );
}

get_footer();
