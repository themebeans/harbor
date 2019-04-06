<?php
/**
 *  The template for displaying the hero area across most pages and portfolio posts.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

// Page Meta
$hero_tagline             = get_post_meta( $post->ID, '_bean_hero_tagline', true );
$hero_imagezoom           = get_post_meta( $post->ID, '_bean_hero_imagezoom', true );
$hero_content             = get_post_meta( $post->ID, '_bean_hero_content', true );
$hero_fullscreen          = get_post_meta( $post->ID, '_bean_hero_fullscreen', true );
$hero_gradient            = get_post_meta( $post->ID, '_bean_hero_gradient', true );
$hero_text_color          = get_post_meta( $post->ID, '_bean_hero_text_color', true );
$hero_video_background    = get_post_meta( $post->ID, '_bean_hero_video_background', true );
$hero_embedded_background = get_post_meta( $post->ID, '_bean_hero_embedded_background', true );

// Post Meta
$link         = get_post_meta( $post->ID, '_bean_link_url', true );
$link_title   = get_post_meta( $post->ID, '_bean_link_title', true );
$quote        = get_post_meta( $post->ID, '_bean_quote', true );
$quote_source = get_post_meta( $post->ID, '_bean_quote_source', true );

// Portfolio Meta
$portfolio_type_audio = get_post_meta( $post->ID, '_bean_portfolio_type_audio', true );
$portfolio_type_video = get_post_meta( $post->ID, '_bean_portfolio_type_video', true );

// Get the background color of the hero area
$hero_bg_color = get_post_meta( $post->ID, '_bean_hero_bg_color', true );
$hero_bg_color = 'background-color:' . $hero_bg_color . ';';

// This if statement guarentees we'll use a fullscreen hero area on the fullpage template.
if ( is_page_template( 'template-portfolio-fullpage.php' ) ) {
	 $hero_fullscreen = 'on';
}

// Get the post featured image for the post-cover background image, if uploaded
$fullscreen_img = get_post_meta( $post->ID, '_bean_hero_fullscreen_img', true );
$feat_image     = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$hero_bg_img    = '';

if ( $feat_image ) {
	 $hero_bg_img = 'background-image: url(' . $feat_image . ');';
}

if ( $fullscreen_img ) {
	 $hero_bg_img = 'background-image: url(' . $fullscreen_img . ');';
}

// Get the post format
$format = get_post_format();
if ( false === $format ) {
	$format = 'standard'; }
?>

<div class="hero-area clearfix
<?php
if ( $hero_fullscreen == 'on' ) {
	echo 'hero-fullscreen'; }
?>
	<?php
	if ( $hero_video_background or $hero_embedded_background ) {
		echo 'has-video'; }
?>
 " style="<?php echo esc_html( $hero_bg_color ); ?>">

	 <header class="center-vertical">

			<?php
			if ( is_singular( 'post' ) ) {

				if ( $hero_content == 'on' ) {

					// If this is a link format, let's show the link_title (if there is one).
					if ( $format == 'link' ) {
						if ( $link_title ) {
							 echo '<h2 class="entry-title" style="color: ' . esc_html( $hero_text_color ) . ';">' . stripslashes( esc_html( $link_title ) ) . '</h2>';
						} else {
							 echo '<h2 class="entry-title" style="color: ' . esc_html( $hero_text_color ) . ';">' . get_the_title() . '</h2>';
						}
						if ( $link ) {
							 echo '<h3><a target="blank" href="' . esc_url( $link ) . '" style="color: ' . esc_html( $hero_text_color ) . '!important;">' . stripslashes( esc_html( $link ) ) . '</a></h3>';
						}

						// If this is a quote format, let's show the quote meta.
					} elseif ( $format == 'quote' ) {

						echo '<h2 class="entry-title" style="color: ' . esc_html( $hero_text_color ) . ';">' . stripslashes( esc_html( $quote ) ) . '</h2>';
						echo '<h3 style="color: ' . esc_html( $hero_text_color ) . ';">' . stripslashes( esc_html( $quote_source ) ) . '</h3>';

					} else {
						 echo '<h2 class="entry-tagline" style="color: ' . esc_html( $hero_text_color ) . ';">' . get_the_title() . '</h2>';
					}
				} //$hero_video_background

			} else {
				if ( $hero_tagline ) {
					echo '<h2 class="entry-tagline cd-headline letters type" style="color: ' . esc_html( $hero_text_color ) . ';">' . $hero_tagline . '</h2>';
				} else {
					 echo '<h1 class="entry-title" style="color: ' . esc_html( $hero_text_color ) . ';">' . get_the_title() . '</h1>';
				}
			}
			?>

	 </header>

		<?php if ( $hero_video_background ) { ?>
			<video class="background-video" autoplay="" loop="" muted="" controls>
				<source src="<?php echo esc_url( $hero_video_background ); ?>" type="video/mp4">
			</video>

		<?php } elseif ( $hero_embedded_background ) { ?>
			<div class="background-video embedded">
				<?php echo stripslashes( htmlspecialchars_decode( $hero_embedded_background ) ); ?>
			</div>
		<?php
} else {
}
?>

		<?php if ( $format != 'gallery' ) { ?>
		  <div class="post-cover post-cover-<?php the_ID(); ?> <?php
			if ( $hero_imagezoom == 'on' ) {
				echo 'imagezoom'; }
?>
" style="<?php echo esc_html( $hero_bg_img ); ?>"></div>
		<?php } ?>

		<?php
		// Call the different post format sections here:
		if ( is_singular( 'post' ) and $format == 'audio' ) {
			bean_audio( $post->ID ); }
		if ( is_singular( 'post' ) and $format == 'image' and empty( $hero_video_background ) and empty( $hero_embedded_background ) ) {
			bean_gallery( $post->ID, '', 'post-lightbox', true ); }
		if ( is_singular( 'post' ) and $format == 'gallery' and empty( $hero_video_background ) and empty( $hero_embedded_background ) ) {
			bean_gallery( $post->ID, '', 'superslides', true ); }
		if ( is_singular( 'post' ) and $format == 'video' and empty( $hero_video_background ) and empty( $hero_embedded_background ) ) {
			get_template_part( 'inc/post-formats/content', 'video' ); }
		if ( is_singular( 'portfolio' ) and $portfolio_type_audio == 'on' ) {
			bean_audio( $post->ID ); }
		?>

		<?php if ( $hero_gradient == 'on' ) { ?>
		  <div class="fullscreen-gradient"></div>
		<?php } ?>

		<?php if ( $hero_fullscreen == 'on' ) { ?>
			<?php // Only want to show the down arrow on the fullscreen hero areas. ?>
		  <a class="down-arrow
			<?php
			if ( is_singular( 'portfolio' ) and $portfolio_type_audio == 'on' ) {
				echo 'audio-portfolio'; }
?>
" href="#page-inner"><i></i></a>
		<?php } ?>

</div><!-- END .hero-area -->
