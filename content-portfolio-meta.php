<?php
/**
 * The file for displaying the related portfolio loop below the portfolio single.
 * It is called via the related posts function in functions.php.
 * You can set the count via the $related_items_count variable.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// SETTING UP META
$portfolio_layout      = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
$portfolio_date        = get_post_meta( $post->ID, '_bean_portfolio_date', true );
$portfolio_url         = get_post_meta( $post->ID, '_bean_portfolio_url', true );
$portfolio_url_name    = get_post_meta( $post->ID, '_bean_portfolio_url_name', true );
$portfolio_client      = get_post_meta( $post->ID, '_bean_portfolio_client', true );
$portfolio_role        = get_post_meta( $post->ID, '_bean_portfolio_role', true );
$portfolio_cats        = get_post_meta( $post->ID, '_bean_portfolio_cats', true );
$portfolio_tags        = get_post_meta( $post->ID, '_bean_portfolio_tags', true );
$portfolio_custom_meta = get_post_meta( $post->ID, '_bean_portfolio_custom_meta', true );
?>

<?php if ( $portfolio_date == 'on' ) { ?>
	<p class="published">
		<?php the_time( 'M Y' ); ?>
	</p>
<?php } ?>

<?php if ( $portfolio_client ) { // DISPLAY CLIENT ?>
	<p class="client">
		<?php echo esc_html( $portfolio_client ); ?>
	</p>
<?php } ?>

<?php if ( $portfolio_role ) { // DISPLAY CLIENT ?>
	<p class="role">
		<?php echo esc_html( $portfolio_role ); ?>
	</p>
<?php } ?>

<?php if ( $portfolio_url ) { // DISPLAY CLIENT ?>

	<p class="url">
		<?php if ( $portfolio_url_name ) { // DISPLAY PORTFOLIO URL ?>
			<a href="<?php echo esc_url( $portfolio_url ); ?>" target="blank"><?php echo esc_html( $portfolio_url_name ); ?></a>
		<?php
} else {
	// CLEAN THE URL
	$portfolio_url_clean = str_replace( 'http://', '', $portfolio_url );
	$portfolio_url_clean = preg_replace( '/\s+/', '', $portfolio_url_clean );
	?>
	<a href="<?php echo esc_url( $portfolio_url ); ?>" target="blank"><?php echo esc_html( $portfolio_url_clean ); ?></a>
		<?php } // IF NO URL ?>
	</p>
<?php } ?>

<?php if ( $portfolio_custom_meta == 'on' ) { // DISPLAY CATEGORY ?>
	<?php the_meta(); ?>
<?php } ?>

<div>
<?php if ( $portfolio_cats == 'on' ) { // DISPLAY TAGS ?>
	<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
	<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
		<p class="project-taxonomy project-category">
			<?php the_terms( $post->ID, 'portfolio_category', '#', '&nbsp;&nbsp;&nbsp;#', '&nbsp;' ); ?>
		</p>
	<?php endif; ?>
<?php } ?>

<?php if ( $portfolio_tags == 'on' ) { // DISPLAY CATEGORY ?>
	<p class="project-taxonomy project-tags">
		<?php the_terms( $post->ID, 'portfolio_tag', '#', '&nbsp;&nbsp;&nbsp;#', '&nbsp;' ); ?>
	</p>
<?php } ?>
</div>

