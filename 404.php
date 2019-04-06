<?php
/**
 * The template for displaying the 404 error page
 * This page is set automatically, not through the use of a template
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header(); ?>

<div class="entry-content">

	<div class="error-logo">
		<a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home">
		<?php if ( get_theme_mod( '404-img-upload' ) ) { ?>
			<img src="<?php echo get_theme_mod( '404-img-upload' ); ?>"/>
		<?php } else { ?>
			<img src="
			<?php
			echo get_template_directory_uri();
			echo '/assets/images/404.png';
?>
">
		<?php } ?>
		</a>
	</div><!-- END .error-logo -->

	 <p>
			<?php _e( 'Sorry, this page does not exist', 'harbor' ); ?></br>
		<a href="<?php echo home_url(); ?>"><?php _e( 'Go back to the homepage', 'harbor' ); ?></a>
	</p>

</div><!-- END .entry-content -->

<?php
get_footer();
