<?php
/**
 * The file for displaying the $portfolio_layout, which is called by single-portfolio.php.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */
?>

<div class="project-assets clearfix">
	<?php bean_gallery( $post->ID, 'port-full', 'masonry-portfolio-single', '', true ); ?>
</div><!-- END .project-assets -->
