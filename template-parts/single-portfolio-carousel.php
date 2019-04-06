<?php
/**
 * The file for displaying the $portfolio_layout, which is called by single-portfolio.php.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// META
$content          = $post->post_content;
$content_area     = get_post_meta( $post->ID, '_bean_content_area', true );
$portfolio_layout = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
$hero_area        = get_post_meta( $post->ID, '_bean_hero_area', true );

if ( $portfolio_layout == 'customizer_option' and get_theme_mod( 'single_portfolio_layout' ) == 'single_portfolio_carousel' ) {
	$hero_area = 'on';
}

if ( $portfolio_layout == 'customizer_option' and get_theme_mod( 'single_portfolio_layout' ) == 'single_portfolio_carousel_no_hero' ) {
	$hero_area = 'off';
}

if ( $content_area = 'on' ) { ?>

	<section class="project-content carousel-content clearfix 
	<?php
	if ( $hero_area == 'on' ) {
		echo 'has-hero'; }
?>
">

		<div class="entry-content">

			<div class="project-description">

				<?php if ( $hero_area == 'off' ) { ?>

					<header><h1 class="entry-title"><?php the_title(); ?></h1></header>

				<?php } ?>

				<?php the_content(); ?>

			</div><!-- END .project-description -->

			<?php if ( ! post_password_required() ) { ?>

				<div class="project-meta">

					<?php get_template_part( 'content', 'portfolio-meta' ); ?>

				</div><!-- END .project-meta -->

			<?php } ?>

		</div><!-- END .entry-content -->

	</section><!-- END .project-content -->

<?php
}

if ( ! post_password_required() ) {
?>
	<div class="project-carousel clearfix">
		<?php bean_gallery( $post->ID, 'port-full', 'carousel-portfolio-single', '', true ); ?>
	</div><!-- END .project-assets -->
<?php
}

if ( get_theme_mod( 'display_pagination' ) ) {
	get_template_part( 'content', 'portfolio-pager' );
}
