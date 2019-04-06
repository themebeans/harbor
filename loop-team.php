<?php
/**
 * The content loop file for the team members grid.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// META
$role  = get_post_meta( $post->ID, '_bean_team_role', true );
$quote = get_post_meta( $post->ID, '_bean_team_quote', true );
$url   = get_post_meta( $post->ID, '_bean_team_url', true );

if ( $quote ) {
	 $quote_class = 'quoted';
} else {
	 $quote_class = '';
} ?>

<?php if ( has_post_thumbnail() ) { ?>

	 <article id="team-<?php the_ID(); ?>" <?php post_class( "$quote_class masonry-project team" ); ?>>

		  <div class="entry-media">
				<?php the_post_thumbnail( 'port-full' ); ?>

				<?php if ( $quote ) { ?>
					<div class="overlay"></div>

					<div class="center-vertical">

						 <div class="overlay-title">

							  <blockquote><?php echo esc_html( $quote ); ?></blockquote>

						  </div>

					</div>
				<?php } ?>

		  </div>

	 <div class="team-content">

		  <h3><?php the_title(); ?></h3>

			<?php if ( $role ) { ?>
			   <span class="team-role"><?php echo esc_html( $role ); ?></span>
			<?php } ?>

			<?php the_content(); ?>

			<?php edit_post_link( __( '[Edit]', 'harbor' ), '<span class="subtext edit">', '</span>' ); ?>

	 </div><!-- END .team-content -->

	 </article>

<?php
} //END if ( has_post_thumbnail() )
