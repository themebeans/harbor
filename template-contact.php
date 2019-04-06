<?php
/**
 * Template Name: Contact
 * The template for displaying the contact template.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

get_header();

// META
$content             = $post->post_content;
$hero_area           = get_post_meta( $post->ID, '_bean_hero_area', true );
$page_content_layout = get_post_meta( $post->ID, '_bean_page_content_layout', true );

// CONTACT CODE
if ( isset( $_POST['submitted'] ) ) {
	if ( trim( $_POST['contactName'] ) === '' ) {
		$hasError = true;
	} else {
		$name = trim( $_POST['contactName'] );
	}

	if ( trim( $_POST['email'] ) === '' ) {
		$hasError = true;
	} elseif ( ! is_email( trim( $_POST['email'] ) ) ) {
		$hasError = true;
	} else {
		$email = trim( $_POST['email'] );
	}

	if ( trim( $_POST['comments'] ) === '' ) {
		$hasError = true;
	} else {
		if ( function_exists( 'stripslashes' ) ) {
			$comments = stripslashes( trim( $_POST['comments'] ) );
		} else {
			$comments = trim( $_POST['comments'] );
		}
	}

		do_action( 'bean_after_contactform_errors' );

	if ( ! isset( $hasError ) ) {

		$site_name    = get_bloginfo( 'name' );
		$contactEmail = get_theme_mod( 'admin_custom_email' );

		if ( ! isset( $contactEmail ) || ( $contactEmail == '' ) ) {
			$contactEmail = get_option( 'admin_email' );
		}

		$subject_content = '[' . $site_name . ' Contact Form]';
		$subject         = apply_filters( 'bean_contactform_emailsubject', $subject_content );

		$body_content = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
		$body         = apply_filters( 'bean_contactform_emailbody', $body_content );

		$headers = 'Reply-To: ' . $email;
		/*
		By default, this form will send from wordpress@yourdomain.com in order to work with
		a number of web hosts' anti-spam measures. If you want the from field to be the
		user sending the email, please uncomment the following line of code.
		*/
		// $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
		wp_mail( $contactEmail, $subject, $body, $headers );
		$emailSent = true;
	}
} ?>

<div id="post-<?php the_ID(); ?>" <?php post_class( $page_content_layout ); ?>>

	<div class="contact-wrapper clearfix">

		<article class="entry-content clearfix percent-50">

			<?php if ( $hero_area == 'off' ) { ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php } ?>

			<div class="center-vertical">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
endwhile; // THE LOOP
?>
			</div>

		</article>

		<div class="contactform">

			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#BeanForm").validate({ errors: { contactName: '', email: { required: '', email: '' }, comments: '' } });
				});
			</script>

			<?php if ( isset( $emailSent ) && $emailSent == true ) { ?>

				<div class="contact-alert success">

					<div class="center-vertical">
						<?php echo apply_filters( 'bean_contactform_success_msg', esc_html__( 'Your message was sent. Thanks.', 'harbor' ) ); ?>
					</div>

				</div><!-- END .alert alert-success -->

			<?php } // END SUCCESS ALERT ?>

			<?php if ( isset( $hasError ) || isset( $captchaError ) ) { ?>

				<div class="contact-alert fail">

					<?php echo apply_filters( 'bean_contactform_error_msg', esc_html__( 'An error occured. Try again.', 'harbor' ) ); ?>

				</div><!-- END .alert alert-success -->

			<?php } // END FAIL ALERT ?>

			<?php $required = '<span class="required">*</span>'; ?>

			<form action="<?php the_permalink(); ?>" id="BeanForm" method="post">

				<div class="group">
					<input type="text" name="contactName" id="contactName" value="
					<?php
					if ( isset( $_POST['contactName'] ) ) {
						echo esc_html( $_POST['contactName'] );}
?>
" class="required requiredField" required/>
					<span class="bar"></span>
					<label for="contactName">
					<?php
					_e( 'Name', 'harbor' );
					echo balanceTags( $required );
?>
</label>
				</div>

				<?php do_action( 'bean_after_contactform_namefield' ); ?>

				<div class="group">
					<input type="text" name="email" id="email" value="
					<?php
					if ( isset( $_POST['email'] ) ) {
						echo esc_html( $_POST['email'] );}
?>
" class="required requiredField email" required/>
					<span class="bar"></span>
					<label for="email">
					<?php
					_e( 'Email', 'harbor' );
					echo balanceTags( $required );
?>
</label>
				</div>

				<?php do_action( 'bean_after_contactform_emailfield' ); ?>

				<div class="group last">
					<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField" required>
					<?php
					if ( isset( $_POST['comments'] ) ) {
						if ( function_exists( 'stripslashes' ) ) {
							echo stripslashes( $_POST['comments'] );
						} else {
							echo esc_html( $_POST['comments'] ); }
					}
?>
</textarea>
					<span class="bar"></span>
					<label for="commentsText">
					<?php
					_e( 'Message', 'harbor' );
					echo balanceTags( $required );
?>
</label>
				</div>

				<?php do_action( 'bean_after_contactform_allfields' ); ?>

				<div class="submit">
					<input type="hidden" name="submitted" id="submitted" value="true"  />
					<span class="bar"></span>
					<button type="submit" class="button"><?php _e( 'Send', 'harbor' ); ?></button>
				</div>

				<?php do_action( 'bean_after_contactform_submit' ); ?>

			</form><!-- END #BeanForm -->

		</div><!-- END .contactform -->

	</div><!-- END .contact-wrapper -->

	<?php if ( get_theme_mod( 'google_maps_code' ) ) { ?>

		<?php include_once ABSPATH . 'wp-admin/includes/plugin.php'; if ( is_plugin_active( 'google-maps-builder/google-maps-builder.php' ) ) { ?>

			<section class="g-map clearfix">

				<?php if ( get_theme_mod( 'gmap_address' ) ) { ?>

					<div class="center-vertical">
						<span class="address-circle">
							<span>
								<?php echo get_theme_mod( 'gmap_address' ); ?>
							</span>
						</span>
					</div>

				<?php } ?>

				<?php echo do_shortcode( get_theme_mod( 'google_maps_code' ) ); ?>

			</section>

		<?php } else { ?>
			 <div class="map-alert"><?php _e( 'Please install the Google Maps Builder WordPress plugin to display a map.', 'harbor' ); ?></div>
		<?php } ?>

	<?php
}

if ( get_theme_mod( 'show_testimonials' ) ) {
	get_template_part( 'content-testimonials' );
}
	?>

</div>

<?php
get_footer();
