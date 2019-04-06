<?php
/**
 * The file for displaying the portfolio filter.
 * It is called via header.php.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

$terms       = get_terms( 'portfolio_category' );
$count_posts = wp_count_posts( 'portfolio' )->publish;

if ( is_post_type_archive( 'portfolio' ) ) {
	$title = __( 'Projects', 'harbor' );
} else {
	$title = __( 'Posts', 'harbor' );
}
?>

<div id="sub-header" class="sub-header no-hero">

	<ul>

		<li id="post-count"><span class="project-number"><?php echo esc_html( $count_posts ); ?></span><span class="project-name"> / <?php echo esc_html( $title ); ?></span></li>

			<li id="post-taxonomy"><?php echo bean_page_title(); ?></li>

	</ul>

</div>
