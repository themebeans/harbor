<?php
/**
 * The file for displaying the portfolio filter.
 * It is called via header.php.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

$hero_area   = get_post_meta( $post->ID, '_bean_hero_area', true );
$terms       = get_terms( 'portfolio_category' );
$count_posts = wp_count_posts( 'portfolio' );
$count_posts = $count_posts->publish;
?>

<div id="sub-header" class="sub-header
<?php
if ( $hero_area == 'off' ) {
	echo 'no-hero'; }
?>
">

	<div id="post-count"><span class="project-number"><?php echo esc_html( $count_posts ); ?></span><span class="project-name"> / <?php echo apply_filters( 'harbor_projects_filter_title', esc_html( 'Projects', 'harbor' ) ); ?></span></div>

	<ul id="project-filter">

			<?php
			foreach ( $terms as $term ) {
				echo '<li><a href="' . get_term_link( $term ) . '" data-filter="' . $term->term_id . '">' . $term->name . '</a></li>';
			}
			?>

		 <li><a href="#" class="active" data-filter="project"><?php echo __( 'All', 'harbor' ); ?></a></li>

	</ul>

	<a id="filter-toggle" class="hover" href="javascript:void(0);"><span></span><span class="filter-circle"></span><span class="filter-circle2"></span></a>

</div>
