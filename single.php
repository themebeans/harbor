<?php
/**
 * The template for displaying all single posts.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header();

designer_set_post_views( get_the_ID() );

$format = get_post_format();

if ( false === $format ) {
	$format = 'standard';
} ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article class="entry-content">

				<?php the_content(); ?>

				<?php
				wp_link_pages(
					array(
						'before'         => '<p><strong>' . __( 'Pages:', 'harbor' ) . '</strong> ',
						'after'          => '</p>',
						'next_or_number' => 'number',
					)
				);
				?>
			</article>
			<?php
	endwhile;
endif;
	wp_reset_postdata();
?>

</div>

<?php
if ( true === get_theme_mod( 'post_meta' ) ) {
	get_template_part( 'content-post-meta' );
}

if ( true === get_theme_mod( 'post_next' ) ) {
	get_template_part( 'content-post-next' );
}

// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) :
	comments_template();
endif;

if ( true === get_theme_mod( 'post_sharing' ) ) {
	get_template_part( 'content-post-sharing' );
}

get_footer();
