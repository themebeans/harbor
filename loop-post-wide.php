<?php
/**
 * The template for displaying the wide post loop.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// READING TIME CALCULATIONS
$mycontent    = $post->post_content;
$words        = str_word_count( strip_tags( $mycontent ) );
$reading_time = floor( $words / 100 );

// IF LESS THAN A MINUTE - DISPLAY 1 MINUTE
if ( $reading_time == 0 ) {
	$reading_time = '1'; }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-project' ); ?>>

	<?php
	$format = get_post_format();
	if ( false === $format ) {
		$format = 'standard'; }
	if ( $format != 'aside' ) {
		get_template_part( 'inc/post-formats/content', $format );
	}
	?>

	<div class="post-inner">

		<div class="content-left">
			<span class="published">
				<p><?php echo _e( 'Posted:', 'harbor' ); ?></p>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'harbor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php the_time( get_option( 'date_format' ) ); ?>
				</a>
			</span>
		</div><!-- END .content-left -->

		<div class="content-right">

				<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'harbor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2><!-- END .entry-title -->

			<?php if ( ! post_password_required() ) { ?>

				<p class="entry-excerpt">
					<?php
					if ( $format == 'aside' ) {
						// If this is an aside post, we want to show all the content - since it's short anyway.
						echo get_the_content();
					} else {
						// If not, then trim the words to 25 words.
						echo wp_trim_words( get_the_content(), 25 );
					}
					?>
				</p><!-- END .entry-excerpt -->

			<?php } else { ?>

				<?php echo get_the_content(); ?>

			<?php } ?>

			<?php if ( $format != 'aside' ) { ?>
				<p><a class="continue-reading" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'harbor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Continue Reading', 'harbor' ); ?> &rarr; </a></p>
			<?php } ?>

		</div><!-- END .content-right -->

	</div><!-- END .post-inner -->

</article>

