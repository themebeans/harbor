<?php
/**
 *  The template for displaying the portfolio pagination.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

$prev_post = get_previous_post();

if ( ! empty( $prev_post ) ) {
	$fullscreen_img  = get_post_meta( $prev_post->ID, '_bean_hero_fullscreen_img', true );
	$feat_image      = wp_get_attachment_url( get_post_thumbnail_id( $prev_post->ID ) );
	$hero_gradient   = get_post_meta( $prev_post->ID, '_bean_hero_gradient', true );
	$hero_text_color = get_post_meta( $prev_post->ID, '_bean_hero_text_color', true );
	$hero_bg_img     = '';

	if ( $feat_image ) {
		 $hero_bg_img = 'background-image: url(' . $feat_image . ');';
	}

	if ( $fullscreen_img ) {
		 $hero_bg_img = 'background-image: url(' . $fullscreen_img . ');';
	} ?>

	<div class="next-post">
		<a href="<?php echo get_permalink( $prev_post->ID ); ?>">
		<div class="next-preview">
			<div class="center-vertical">
				<h3 class="title-next" style="color: <?php echo esc_html( $hero_text_color ); ?>;"><?php echo __( 'Next Article', 'harbor' ); ?></h3>
				<h3 class="title-next-post" style="color: <?php echo esc_html( $hero_text_color ); ?>;"><?php echo esc_html( $prev_post->post_title ); ?></h3>
			</div>
			<div class="post-cover post-cover-<?php the_ID(); ?> imagezoom" style="<?php echo esc_html( $hero_bg_img ); ?>"></div>
				<div class="fullscreen-gradient"></div>
		</div>
		</a>
	</div>
<?php
}
