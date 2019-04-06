<?php
/**
 * Additional features to allow styling of the templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function harbor_body_classes( $classes ) {
	global $post;

	$body_extra_classes = '';

	if ( ! is_404() ) {
		$hero_area                  = get_post_meta( $post->ID, '_bean_hero_area', true );
		$menu_layout                = get_theme_mod( 'menu_layout', 'menu_sidebar' );
		$header_position            = 'layout_' . get_theme_mod( 'header_position' );
		$portfolio_layout           = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
		$overlay_title_color        = get_post_meta( $post->ID, '_bean_overlay_title_color', true );
		$hero_area                  = get_post_meta( $post->ID, '_bean_hero_area', true );
		$page_fullscreen_header     = get_post_meta( $post->ID, '_bean_page_fullscreen_header', true );
		$page_tagline               = get_post_meta( $post->ID, '_bean_page_tagline', true );
		$feat_image                 = 'background-image: url(' . wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) . ');';
		$tc_single_portfolio_layout = '';

		if ( is_singular( 'portfolio' ) ) {

			if ( 'customizer_option' === $portfolio_layout ) {

				$tc_single_portfolio_layout = get_theme_mod( 'single_portfolio_layout' );

				if ( $tc_single_portfolio_layout == 'single_portfolio_stacked_no_hero' or $tc_single_portfolio_layout == 'single_portfolio_carousel_no_hero' or $tc_single_portfolio_layout == 'single_portfolio_fullscreen_no_hero' or $tc_single_portfolio_layout == 'single_portfolio_masonry_no_hero' ) {
					$hero_area = 'off';
				}

				if ( $tc_single_portfolio_layout == 'single_portfolio_stacked' or $tc_single_portfolio_layout == 'single_portfolio_carousel' or $tc_single_portfolio_layout == 'single_portfolio_fullscreen' or $tc_single_portfolio_layout == 'single_portfolio_fullscreen_no_content' or $tc_single_portfolio_layout == 'single_portfolio_masonry' ) {
					$hero_area = 'on';
				}

				// Add the class back to body_extra_classes
				if ( $tc_single_portfolio_layout == 'single_portfolio_fullscreen_no_hero' or $tc_single_portfolio_layout == 'single_portfolio_fullscreen_no_content' ) {
					$tc_single_portfolio_layout = 'single_portfolio_fullscreen';
				}
			}
		}

		$body_extra_classes = $menu_layout . ' ' . $portfolio_layout . ' ' . $header_position . ' ' . $tc_single_portfolio_layout;
	}

	$classes[] = $body_extra_classes;

	return $classes;
}
add_filter( 'body_class', 'harbor_body_classes' );
