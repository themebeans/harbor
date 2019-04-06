<?php
/**
 * The template for displaying comments.
 * The area of the page that contains comments and the comment form.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

if ( post_password_required() ) {
	return;
} ?>

<div class="comments-wrap clearfix
<?php
if ( ! comments_open() && '0' == get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	echo 'zero-comments'; }
?>
">

		<div class="comments-title-wrap">
			<h3 class="comments-title"><?php comments_number( __( '0 Comments', 'harbor' ), __( '1 Comment', 'harbor' ), __( '% Comments', 'harbor' ) ); ?></h3>

			<?php if ( ! comments_open() && is_page() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>

				<span class="nocomments"><?php _e( 'Comments are now officially closed.', 'harbor' ); ?></span>

			<?php } ?>
		</div>

		<?php
		/*
		===================================================================*/
		/*
		 COMMENT FORM
		/*===================================================================*/
		if ( comments_open() ) {
			comment_form();
		}

		if ( ! comments_open() && have_comments() && ! is_page() ) :
		?>
			<span class="nocomments"><?php _e( 'Comments are now officially closed.', 'harbor' ); ?></span>
		<?php
		endif;

		// DISPLAY COMMENTS
		if ( have_comments() ) {
		?>

			<div id="comments" class="clearfix">

				<?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>

					<div id="comments-list" class="comments">

						<?php
						// PAGINATION
						$total_pages = get_comment_pages_count();
						if ( $total_pages > 1 ) {
						?>
							<div id="comments-nav-above" class="comments-navigation">
								<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
							</div><!-- END #comments-nav-above -->
						<?php } ?>

							<ol class="commentlist block">
								<?php wp_list_comments( 'type=comment&callback=bean_comment' ); ?>
							</ol>

						<?php
						$total_pages = get_comment_pages_count();
						if ( $total_pages > 1 ) {
						?>
							<div id="comments-nav-below" class="comments-navigation">
								<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
							   </div><!-- END #comments-nav-below -->
						<?php } ?>

					</div><!-- END #comments-list.comments -->

				<?php } //END if ( ! empty($comments_by_type['comment']) ) ?>


				<?php if ( ! empty( $comments_by_type['pings'] ) ) { ?>

					<div id="comments-list" class="comments">
						<h3 class="comments-title"><?php _e( 'Trackbacks.', 'harbor' ); ?></h3>

						<ol class="pinglist">
							<?php wp_list_comments( 'type=pings&callback=harbor_ping' ); ?>
						</ol>
					</div><!-- END #comments-list .comments -->

				<?php } //END if ( ! empty($comments_by_type['pings']) ) ?>

			</div><!-- END #comments -->

		<?php }  //END if ( have_comments() ) ?>

</div><!-- END #comments -->
