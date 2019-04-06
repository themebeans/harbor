<?php
/**
 * The template for displaying posts in the audio post format.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// Check for the grid image, fallback to featured image.
$grid_image = get_post_meta( $post->ID, '_bean_grid_feat_img', true );
$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

if ( $grid_image ) {
	$image = $grid_image;
} else {
	$image = $feat_image;
}

if ( has_post_thumbnail() or $grid_image ) { ?>

	<div class="entry-media">
		<?php echo '<img src=' . esc_url( $image ) . '>'; ?>
		<?php bean_audio( $post->ID ); ?>
	</div><!-- END .entry-content-media -->

<?php } else {
	bean_audio( $post->ID );
} ?>
