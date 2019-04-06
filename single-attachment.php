<?php
/**
 * The template for displaying the portfolio singular page.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header(); ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-media">
		<?php $image_info = getimagesize( $post->guid ); ?>
		<img src="<?php echo esc_html( $post->guid ); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" <?php echo esc_html( $image_info[3] ); ?> />
	</div><!-- END .entry-media-->

	<div class="entry-content">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<p><?php _e( 'Uploaded ', 'harbor' ); ?><?php the_time( get_option( 'date_format' ) ); ?></p>
	</div><!-- END .entry-content-->

</section><!-- END #post-<?php the_ID(); ?> -->

<?php
get_footer();
