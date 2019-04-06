<?php
/**
 * The template for displaying the footer
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

if ( ! is_404() && ! is_page_template( 'template-underconstruction.php' ) ) { ?>

	</div>

	</section>

	<footer id="footer" class="footer">

		<?php if ( get_theme_mod( 'footer_copyright' ) ) { ?>
			<p class="copyright">&copy; <?php echo date( 'Y' ); ?> <?php echo get_theme_mod( 'footer_copyright' ); ?></p>
		<?php } else { ?>
			<p class="copyright">&copy; <?php echo date( 'Y' ); ?> Harbor by <a href="http://themebeans.com">ThemeBeans</a></p>
		<?php } ?>

		<ul class="footer-social">
			<?php if ( get_theme_mod( 'footer_social_twitter' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'footer_social_twitter' ) ); ?>" class="twitter-icon"></a></li>
			<?php } ?>

			<?php if ( get_theme_mod( 'footer_social_facebook' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'footer_social_facebook' ) ); ?>" class="facebook-icon"></a></li>
			<?php } ?>

			<?php if ( get_theme_mod( 'footer_social_dribbble' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'footer_social_dribbble' ) ); ?>" class="dribbble-icon"></a></li>
			<?php } ?>

			<?php if ( get_theme_mod( 'footer_social_email' ) ) { ?>
			<li><a href="mailto:<?php echo esc_url( get_theme_mod( 'footer_social_email' ) ); ?>" class="email-icon"></a></li>
			<?php } ?>

			<?php if ( get_theme_mod( 'footer_social_instagram' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'footer_social_instagram' ) ); ?>" class="instagram-icon"></a></li>
			<?php } ?>

			<?php if ( get_theme_mod( 'footer_social_linkedin' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'footer_social_linkedin' ) ); ?>" class="linkedin-icon"></a></li>
			<?php } ?>

			<?php if ( get_theme_mod( 'footer_social_behance' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'footer_social_behance' ) ); ?>" class="behance-icon"></a></li>
			<?php } ?>
		</ul>

		<?php if ( get_theme_mod( 'back_to_top' ) == true ) { ?>
			<p class="copyright to-top"><a href="#page-container" id="back-to-top"><?php echo __( 'To Top', 'harbor' ); ?></a></p>
		<?php } ?>

	</footer>

<?php
}

wp_footer();
?>

</body>
</html>
