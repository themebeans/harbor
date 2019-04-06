<?php
/**
 * The template for displaying posts in the standard post format.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

$grid_image = get_post_meta( $post->ID, '_bean_grid_feat_img', true );

if ( has_post_thumbnail() || $grid_image ) { ?>

	<div class="entry-media">

		<?php
		if ( is_singular() ) {

			the_post_thumbnail( 'port-full' );

		} else {
			?>

			<a title="<?php printf( __( 'Permanent Link to %s', 'harbor' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>" class="entry-link">

			<?php
			if ( $grid_image ) {
				echo '<img src="' . esc_url( $grid_image ) . '"/>';
			} else {
				the_post_thumbnail( 'port-full' );
			}
			?>

				<div class="overlay"></div>

				<div class="center-vertical">

					<div class="overlay-title">

						<h3><span><?php _e( 'Continue Reading', 'harbor' ); ?></span></h3>

					</div>

				</div>
			</a>

		<?php } ?>

	</div>

<?php
}
