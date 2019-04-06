<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// META
$link       = get_post_meta( $post->ID, '_bean_link_url', true );
$link_title = get_post_meta( $post->ID, '_bean_link_title', true );

// USE FEATURED IMAGE OR BACKGROUND COLOR FOR LINK AND QUOTE
$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

if ( $feat_image == true ) {
	$style = 'background-image: url(' . $feat_image . ');';
} else {
	$style = 'background-color: #181818;';
}?>

<div class="entry-media">

	<a target="blank" href="<?php echo esc_url( $link ); ?>">

	<div class="vert-align">
		<h2 class="entry-title"><?php echo stripslashes( esc_html( $link_title ) ); ?></h2>
		<span class="subtext"><?php echo stripslashes( esc_html( $link ) ); ?></span>
	</div><!-- END .vert-align -->

	<div class="post-cover post-cover-<?php the_ID(); ?>" style="<?php echo esc_html( $style ); ?>"></div>

	<?php // if( !is_singular() ) { ?>
		<div class="overlay"></div>

		 <div class="center-vertical">

			  <div class="overlay-title">

				   <h3><span><?php _e( 'Visit Link', 'harbor' ); ?></span></h3>

			  </div>

		 </div>
		<?php // } ?>

	</a>

</div><!-- END .entry-media -->
