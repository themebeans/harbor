<?php
/**
 * Template Name: Team Members
 * The template for displaying the team template.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header();

// META
$content             = $post->post_content;
$hero_area           = get_post_meta( $post->ID, '_bean_hero_area', true );
$page_content_layout = get_post_meta( $post->ID, '_bean_page_content_layout', true ); ?>

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

<div id="projects" class="team-grid med-grid">

	<div class="grid-sizer"></div>

	<?php
	if ( is_tax() ) {

		global $query_string;
		query_posts( "{$query_string}&posts_per_page=-1" );

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				get_template_part( 'loop-team' );

		endwhile;
endif;
		wp_reset_postdata();

	} else {

		// LOAD PORTFOLIO QUERY
		$args = array(
			'post_type'      => 'team',
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'posts_per_page' => '-1',
		);

		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();

				get_template_part( 'loop-team' );

			endwhile;
	endif;
		wp_reset_postdata();

	} //END else is_tax()
	?>

</div>

<?php
get_footer();
