<?php
/**
 * The template for displaying posts in the Video post format.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

$embed           = get_post_meta( $post->ID, '_bean_video_embed', true );
$video_embed_url = get_post_meta( $post->ID, '_bean_video_embed_url', true );
$grid_image      = get_post_meta( $post->ID, '_bean_grid_feat_img', true );
$feat_image      = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

if ( $grid_image ) {
	$image = $grid_image;
} else {
	$image = $feat_image;
}

if ( ! empty( $embed ) ) {

	// If there's an embedded code entered, stop and pull that iFrame.
	if ( is_singular() ) {
		echo "<div class='background-video embedded'>";
			echo stripslashes( htmlspecialchars_decode( $embed ) );
		echo '</div>';
	} else {
		echo "<div class='entry-media'>";
			echo "<div class='video-frame'>";
				echo stripslashes( htmlspecialchars_decode( $embed ) );
			echo '</div>';
		echo '</div>';
	}
} else {

	// If there's no embedded code, check to make sure a featured image or grid image is uploaded.
	if ( has_post_thumbnail() || $grid_image ) {

		// If there is one, output the following:
		echo '<div class="entry-media lb">';
			echo '<a class="lightbox fancybox.iframe" href="' . esc_url( $video_embed_url ) . '">';
				echo '<span class="lightbox-play"></span>';
				echo '<img src="' . esc_url( $image ) . '"/>';
			echo '</a>';
		echo '</div>';

	}
}
