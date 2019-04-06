<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header();

if ( get_theme_mod( 'blog_layout' ) != '' ) {
	switch ( get_theme_mod( 'blog_layout' ) ) {
		case 'blog_wide':
			include locate_template( 'template-parts/blogroll-wide.php' );
			break;

		case 'blog_standard':
			include locate_template( 'template-parts/blogroll-masonry.php' );
			break;
	}
} else {
	include locate_template( 'template-parts/blogroll-masonry.php' ); }
?>

<div id="page_nav" class="hide">
	<?php next_posts_link(); ?>
</div>

<?php
get_footer();
