<?php
/**
 * Template Name: Post Archives
 * The template for displaying the post archives template.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header();

// META
$content             = $post->post_content;
$hero_area           = get_post_meta( $post->ID, '_bean_hero_area', true );
$page_content_layout = get_post_meta( $post->ID, '_bean_page_content_layout', true ); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class( $page_content_layout ); ?>>

	<article class="entry-content clearfix">

		<?php if ( $hero_area == 'off' ) { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } ?>

		<?php
		while ( have_posts() ) :
			the_post();
endwhile; // THE LOOP
?>

		<div class="archives-list">

			<h3><?php _e( 'Last 30 Posts', 'harbor' ); ?></h3>

			<ul>
				<?php
				$archive_30 = get_posts( 'numberposts=30' );
				foreach ( $archive_30 as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>

			<h3><?php _e( 'Monthly Archives', 'harbor' ); ?></h3>

			<ul><?php wp_get_archives( 'type=monthly' ); ?></ul>

			<h3><?php _e( 'Category Archives ', 'harbor' ); ?></h3>

			<ul><?php wp_list_categories( 'title_li=' ); ?></ul>

		</div><!-- END .archives-list -->

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-link"><span>' . __( 'Pages:', 'harbor' ) . '</span>',
				'after'  => '</div>',
			)
		);
		wp_reset_postdata();
?>

	</article>

</div>

<?php
get_footer();
