<?php
/**
 * The file for displaying the $portfolio_layout, which is called by single-portfolio.php.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */
	?>

<div class="project-assets clearfix">
	<?php bean_gallery( $post->ID, 'port-full', 'stacked', '', true ); ?>
</div><!-- END .project-assets -->

<?php if ( post_password_required() ) { ?>
	<div class="entry-entry password-protected">
		<?php echo the_content(); ?>
	</div><!-- END .entry-entry -->
<?php } ?>

<?php if ( get_theme_mod( 'portfolio_cta' ) == true ) {
	get_template_part( 'content', 'portfolio-cta' );
}

if ( get_theme_mod( 'display_pagination' ) ) {
	get_template_part( 'content', 'portfolio-pager' );
} ?>
