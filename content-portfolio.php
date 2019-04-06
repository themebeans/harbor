<?php
/**
 * The file for displaying the portfolio template's primary content.
 * It is pulled by the portfolio template files and is setup to reflect both templates.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// PULL OPTIONAL HERO AREA FROM PAGE META
$hero_area = get_post_meta( $post->ID, '_bean_hero_area', true );

// PULL PAGINATION FROM CUSTOMIZATION
$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );

// PULL PAGINATION FROM READING SETTINGS
$paged = 1;
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
}
if ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
}

if ( is_page_template( 'template-portfolio-relative-grid.php' ) ) {
	$loop = 'loop-portfolio-relative';
} elseif ( is_page_template( 'template-portfolio-squared-grid.php' ) ) {
	$loop = 'loop-portfolio-squared';
} else {
	$loop = 'loop-portfolio';
} ?>

<div id="projects" class="projects
<?php
if ( get_theme_mod( 'portfolio_filter' ) == true ) {
	echo 'filtered'; }
?>
	<?php
	if ( $hero_area == 'on' ) {
		echo 'hero'; }
?>
	<?php
	if ( $loop == 'loop-portfolio-relative' or $loop == 'loop-portfolio-squared' ) {
		echo 'med-grid'; }
?>
">

	<div class="grid-sizer"></div>

	<?php
	if ( is_tax() ) {

		global $query_string;
		query_posts( "{$query_string}&posts_per_page=-1" );

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				get_template_part( 'loop-portfolio' );

		endwhile;
endif;
		wp_reset_postdata();

	} else {

		// LOAD PORTFOLIO QUERY
		$args = array(
			'post_type'      => 'portfolio',
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'paged'          => $paged,
			'posts_per_page' => $portfolio_posts_count,
		);

		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();

				get_template_part( $loop );

			endwhile;
	endif;
		wp_reset_postdata();

	} //END else is_tax()
	?>

</div>

<div id="page_nav" class="hide">
	<?php next_posts_link(); ?>
</div>
