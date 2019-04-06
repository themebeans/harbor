<?php
/**
 * The template for displaying the portfolio loop.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
$terms     = get_the_terms( $post->ID, 'portfolio_category' );
$term_list = null;
if ( is_array( $terms ) ) {
	foreach ( $terms as $term ) {
		$term_list .= $term->term_id;
		$term_list .= ' '; }
}

// ALTERNATE GRID IMAGE
$grid_feat_img = get_post_meta( $post->ID, '_bean_grid_feat_img', true );
$external_url  = get_post_meta( $post->ID, '_bean_portfolio_external_url', true );
?>

<?php if ( has_post_thumbnail() or $grid_feat_img ) { ?>

	<article id="project-<?php the_ID(); ?>" class="project masonry-project <?php echo esc_html( $term_list ); ?>">

		<?php if ( $external_url ) { ?>
			   <a title="<?php printf( __( 'Permanent Link to %s', 'harbor' ), get_the_title() ); ?>" href="<?php echo esc_url( $external_url ); ?>" target="_blank" class="entry-link">
			<?php } else { ?>
			   <a title="<?php printf( __( 'Permanent Link to %s', 'harbor' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>" class="entry-link">
			<?php } ?>

				<?php
				if ( $grid_feat_img ) {
					echo '<img src="' . $grid_feat_img . '" height="375"  width="500"/>';
				} else {
					the_post_thumbnail( 'grid-feat' );
				}
				?>

			   <div class="overlay"></div>

			   <div class="center-vertical">

					<div class="overlay-title">

						 <h3><span><?php the_title(); ?></span></h3>

							<?php
							if ( get_theme_mod( 'loop_categories' ) == true ) {
								if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
									 echo '<ul class="project-taxonomy">';
									foreach ( $terms as $term ) {
										echo '<li><h5>#' . $term->name . '</h5></li>';
									}
									 echo '</ul>';
								}
							}
							?>

					 </div>

			   </div>

		   </a>

	</article>

<?php
} //END if ( has_post_thumbnail )
