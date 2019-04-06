<?php
/**
 *  The template for displaying all pages
 *
 *  This is the template that displays all pages by default.
 *  Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header();

// META
$content             = $post->post_content;
$page_content_layout = get_post_meta( $post->ID, '_bean_page_content_layout', true );
$hero_area           = get_post_meta( $post->ID, '_bean_hero_area', true ); ?>

<?php
while ( have_posts() ) :
	the_post();
?>

	<?php if ( $content ) { ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( $page_content_layout ) ); ?>>

			<article class="entry-content clearfix">

				<?php if ( $hero_area == 'off' ) { ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php } ?>

				<?php the_content(); ?>

			</article>

		</div>
	<?php } ?>

<?php
endwhile;
wp_reset_postdata();
?>

<?php
get_footer();
