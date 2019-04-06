<?php
/**
 * Shortcodes.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

function scTeam( $attr, $content ) {
	ob_start();

	echo "<div class='team-shortcode'>";
		get_template_part( 'content', 'team' );
	echo '</div>';

	$ret = ob_get_contents();
	ob_end_clean();
	return $ret;
}
add_shortcode( 'team', 'scTeam' );

function scTestimonials( $attr, $content ) {
	ob_start();

	echo "<div class='testimonials-shortcode'>";
		get_template_part( 'content', 'testimonials' );
	echo '</div>';

	$ret = ob_get_contents();
	ob_end_clean();
	return $ret;
}
add_shortcode( 'testimonials', 'scTestimonials' );
