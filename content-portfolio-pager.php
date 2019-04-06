<?php
/**
 *  The template for displaying the portfolio pagination.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

$portfolio_page = get_theme_mod( 'portfolio_page_selector' ); ?>

<div class="project-pagination clearfix">

	 <div class="prev"><?php previous_post_link( '%link', '<span class="title">%title</span><span class="arrow"></span>' ); ?></div>

			<?php if ( $portfolio_page ) { ?>
			   <div class="portfolio-page"><a href="<?php echo get_page_link( $portfolio_page ); ?>" rel="home"><span class="arrow"></span></a></div>
			<?php } ?>

	 <div class="next"><?php next_post_link( '%link', '<span class="title">%title</span><span class="arrow"></span>' ); ?></div>

</div><!-- END .project-pagination -->
