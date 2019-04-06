<?php
/**
 * Template Name: Testimonials
 * The template for displaying the testimonials layout.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header();

// META
$content             = $post->post_content;
$hero_area           = get_post_meta( $post->ID, '_bean_hero_area', true );
$page_content_layout = get_post_meta( $post->ID, '_bean_page_content_layout', true );

// PULL PAGINATION FROM CUSTOMIZATION
$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );

// PULL PAGINATION FROM READING SETTINGS
$paged = 1;
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
}
if ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} ?>

<?php
while ( have_posts() ) :
	the_post();
?>

	<?php if ( $content ) { ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( $page_content_layout ); ?>>

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
wp_reset_postdata();  // THE LOOP
?>

<div id="projects" class="testimonials-grid">

	<div class="grid-sizer"></div>

	<?php
	if ( is_tax() ) {

		global $query_string;
		query_posts( "{$query_string}&posts_per_page=-1" );

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				get_template_part( 'loop-testimonial-grid' );

		endwhile;
endif;
		wp_reset_postdata();

	} else {

		// LOAD PORTFOLIO QUERY
		$args = array(
			'post_type'      => 'testimonial',
			'order'          => 'DSC',
			'orderby'        => 'date',
			'paged'          => $paged,
			'posts_per_page' => $portfolio_posts_count,
		);

		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();

				get_template_part( 'loop-testimonial-grid' );

			endwhile;
	endif;
		wp_reset_postdata();

	} //END else is_tax()
	?>

</div>

<div id="page_nav" class="hide">
	<?php next_posts_link(); ?>
</div>

<?php
get_footer();
