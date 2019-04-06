<?php
/**
 * The file is for displaying the blog post meta.
 * This has it's own content file because we call it among various post formats.
 * If you edit this file, its output will be edited on all post formats.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

$terms = get_the_terms( $post->ID, 'category' );
?>

<footer class="entry-footer">

	<div class="author-meta">

		<div class="author-avatar">
			<span class="author-count"><?php the_author_posts(); ?></span>
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), '80', '' ); ?>
		</div><!-- END .author-avatar -->

	</div><!-- END .author-meta -->

	<div class="entry-meta">

		<span class="author"><?php _e( 'Written by ', 'harbor' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
		<span class="entry-categories"><?php the_terms( $post->ID, 'category', _e( 'in ', 'harbor' ), ' & ', '' ); ?></span>
		<span class="entry-date"><?php _e( ' on ', 'harbor' ); ?><?php the_time( get_option( 'date_format' ) ); ?></span>

	</div><!-- END .entry-meta.subtext -->

	<?php
	if ( has_tag() ) {
		_e( 'Tagged ', 'harbor' );
		echo the_tags( '', ', ', '' ); }
?>

</footer><!-- END .entry-footer -->
