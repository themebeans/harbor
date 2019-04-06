<?php
/**
 * The file for displaying the $portfolio_layout, which is called by single-portfolio.php.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// PULL PAGINATION FROM CUSTOMIZATION
$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );
$hero_area             = get_post_meta( $post->ID, '_bean_hero_area', true );

$continuousVertical = false;

if ( $hero_area == 'on' ) {
	$hero_area_class    = 'has-hero';
	$continuousVertical = 'false';
} else {
	$hero_area_class    = '';
	$continuousVertical = 'true';
}

// PULL PAGINATION FROM READING SETTINGS
$paged = 1;
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
}
if ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
}
?>

<div id="projects" <?php post_class( 'projects projects-fullscreen ' . $hero_area_class . '' ); ?>>

	<?php
	// LOAD PORTFOLIO QUERY
	$args = array(
		'post_type'      => 'portfolio',
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'paged'          => $paged,
		'posts_per_page' => $portfolio_posts_count,
		'meta_query'     => array(
			array(
				'key'   => '_bean_portfolio_feature',
				'value' => 'on',
			),
		),
	);

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();

			$hero_text_color = get_post_meta( $post->ID, '_bean_hero_text_color', true );
			$fullscreen_img  = get_post_meta( $post->ID, '_bean_hero_fullscreen_img', true );
			$feat_image      = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			$hero_gradient   = get_post_meta( $post->ID, '_bean_hero_gradient', true );
			$hero_bg_color   = get_post_meta( $post->ID, '_bean_hero_bg_color', true );
			$hero_bg_img     = '';

			if ( $feat_image ) {
				 $hero_bg_img = 'background-image: url(' . $feat_image . ');';
			}

			if ( $fullscreen_img ) {
				 $hero_bg_img = 'background-image: url(' . $fullscreen_img . ');';
			}
				?>

				<div class="section project" style="background-color: <?php echo esc_html( $hero_bg_color ); ?>">

			<a title="" href="<?php the_permalink(); ?>">

				 <div class="slide project-bg imagezoom" style="<?php echo esc_html( $hero_bg_img ); ?>"></div>

				<div class="center-vertical">

						<div class="overlay-title">

							<h2 style="color: <?php echo esc_html( $hero_text_color ); ?>"><?php the_title(); ?></h2>

						 </div>

				   </div>

				<?php if ( $hero_gradient == 'on' ) { ?>
					  <div class="fullscreen-gradient"></div>
					<?php } ?>

			 </a>

		 </div><!-- .section -->

			<?php
	endwhile;
endif;
	wp_reset_postdata();
?>

	<?php if ( $hero_area == 'on' ) { ?>
		<div class="section project last-section"></div>
	<?php } ?>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#projects').fullpage({
				navigation: true,
				autoScrolling: true,
				continuousVertical: <?php echo esc_js( $continuousVertical ); ?>,
				css3: true,
				fixedElements: '#header',
				responsive: 769
			});
		});
	</script>

</div>
