<?php
/**
 * The file for displaying the $portfolio_layout, which is called by single-portfolio.php.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

$content          = $post->post_content;
$content_area     = get_post_meta( $post->ID, '_bean_content_area', true );
$portfolio_layout = get_post_meta( $post->ID, '_bean_portfolio_layout', true );

if ( $content_area = 'on' ) {
	// Check for no content TC layout option.
	if ( $portfolio_layout == 'customizer_option' and get_theme_mod( 'single_portfolio_layout' ) == 'single_portfolio_fullscreen_no_content' ) {
	} else { ?>

		<section class="project-content
		<?php
		if ( $content ) {
			echo 'expandable';
		} else {
			echo 'not-expandable';}
?>
	<?php
	if ( post_password_required() ) {
		echo 'password-protected'; }
?>
 clearfix">

			<div class="entry-content fadein">

				<div class="project-description">

					<header><h1 class="entry-title"><?php the_title(); ?></h1></header>

					<?php the_content(); ?>

				</div><!-- END .project-description -->

				<?php if ( ! post_password_required() ) { ?>

				<div class="project-meta">

					<?php get_template_part( 'content', 'portfolio-meta' ); ?>

				</div><!-- END .project-meta -->

			<?php } ?>

			</div><!-- END .entry-content -->

			<?php if ( $content ) { ?>
			<a id="hide-details" class="hide-details active" href="javascript:void(0);"><?php _e( 'Hide Details', 'harbor' ); ?></a>
		<?php } ?>

		</section><!-- END .project-content -->

	<?php
	}
}

if ( ! post_password_required() ) {
	bean_gallery( $post->ID, 'port-full', 'fullpage', '', true );
}
