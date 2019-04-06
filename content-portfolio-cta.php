<?php
/**
 *  The template for displaying single portfolio call to action. Enabled via the Theme Customizer.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */
?>

<div class="call-to-action">

	<?php if ( get_theme_mod( 'portfolio_cta_text' ) ) { ?>
		<blockquote><?php echo get_theme_mod( 'portfolio_cta_text' ); ?><br/><a href="<?php echo esc_url( get_theme_mod( 'portfolio_cta_btn_url' ) ); ?>" class="clickme"><?php echo get_theme_mod( 'portfolio_cta_btn_text' ); ?></a></blockquote>
	<?php } ?>

</div><!-- END .call-to-action -->
