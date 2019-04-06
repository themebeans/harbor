<?php
/**
 * Template Name: Site Map
 * The template for displaying the site map template.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header();

// META
$content             = $post->post_content;
$hero_area           = get_post_meta( $post->ID, '_bean_hero_area', true );
$page_content_layout = get_post_meta( $post->ID, '_bean_page_content_layout', true ); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class( $page_content_layout ); ?>>

	<article class="entry-content clearfix">

		<?php if ( $hero_area == 'off' ) { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } ?>

		<?php
		while ( have_posts() ) :
			the_post();
endwhile; // THE LOOP
?>

		<div class="archives-list">

			<ul><?php wp_list_pages( 'title_li=' ); ?></ul>

		</div><!-- END .archives-list -->

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-link"><span>' . __( 'Pages:', 'harbor' ) . '</span>',
				'after'  => '</div>',
			)
		);
		wp_reset_postdata();
?>

	</article>

</div>

<?php
get_footer();
