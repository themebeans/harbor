<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

$quote        = get_post_meta( $post->ID, '_bean_quote', true );
$quote_source = get_post_meta( $post->ID, '_bean_quote_source', true );
$feat_image   = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

if ( true === $feat_image ) {
	$style = 'background-image: url(' . esc_url( $feat_image ) . ');';
} else {
	$style = 'background-color: #181818;';
}?>

<div class="entry-media">

	<?php if ( ! is_singular() ) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'harbor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
	<?php } ?>

	<div class="vert-align">
		<h2 class="entry-title"><?php echo stripslashes( esc_html( $quote ) ); ?></h2>
		<span><?php echo stripslashes( esc_html( $quote_source ) ); ?></span>
	</div><!-- END .vert-align -->

	<div class="post-cover post-cover-<?php the_ID(); ?>" style="<?php echo esc_html( $style ); ?>"></div>

	<div class="overlay"></div>

	 <div class="center-vertical">

		  <div class="overlay-title">

			   <h3><span><?php _e( 'Continue Reading', 'harbor' ); ?></span></h3>

		  </div>

	 </div>

	<?php
	if ( ! is_singular() ) {
		echo '</a>'; }
?>

</div>
