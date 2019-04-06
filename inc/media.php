<?php
/**
 * This file contains the media functions for the theme (Gallery, Audio, Video).
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

/*
===================================================================*/
/*
  GALLERY FUNCTIONS
/*===================================================================*/
if ( ! function_exists( 'bean_gallery' ) ) {
	function bean_gallery( $postid, $imagesize = '', $layout = '', $orderby = '', $single = false ) {
		$thumb_ID      = get_post_thumbnail_id( $postid );
		$image_ids_raw = get_post_meta( $postid, '_bean_image_ids', true );

		// POST META
		$hero_area = get_post_meta( $postid, '_bean_hero_area', true );

		$tc_single_portfolio_layout = get_theme_mod( 'single_portfolio_layout' );
		$portfolio_cite             = get_post_meta( $postid, '_bean_portfolio_cite', true );
		$portfolio_review           = get_post_meta( $postid, '_bean_portfolio_review', true );
		$portfolio_layout           = get_post_meta( $postid, '_bean_portfolio_layout', true );
		$content_area               = get_post_meta( $postid, '_bean_content_area', true );
		$portfolio_type_video       = get_post_meta( $postid, '_bean_portfolio_type_video', true );
		$embed                      = get_post_meta( $postid, '_bean_portfolio_embed_code', true );
		$embed2                     = get_post_meta( $postid, '_bean_portfolio_embed_code_2', true );
		$embed3                     = get_post_meta( $postid, '_bean_portfolio_embed_code_3', true );
		$embed4                     = get_post_meta( $postid, '_bean_portfolio_embed_code_4', true );

		if ( $portfolio_layout == 'customizer_option' ) {
			if ( $tc_single_portfolio_layout == 'single_portfolio_stacked_no_hero' or $tc_single_portfolio_layout == 'single_portfolio_carousel_no_hero' or $tc_single_portfolio_layout == 'single_portfolio_fullscreen_no_hero' or $tc_single_portfolio_layout == 'single_portfolio_masonry_no_hero' ) {
				$hero_area = 'off';

			}
		}

		wp_reset_postdata();

		if ( $image_ids_raw != '' ) {
			$image_ids   = explode( ',', $image_ids_raw );
			$post_parent = null;
		} else {
			$image_ids   = '';
			$post_parent = $postid;
		}

		$i = 1;

		// PULL THE IMAGE ATTACHMENTS
		$args        = array(
			'exclude'        => $thumb_ID,
			'include'        => $image_ids,
			'numberposts'    => -1,
			'orderby'        => 'post__in',
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => $post_parent,
			'post_mime_type' => 'image',
			'post_status'    => null,
		);
		$attachments = get_posts( $args );

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE SLIDER
		if ( $layout == 'slider' ) {
			// TRANSFER RANDO META FOR TRUE/FALSE SLIDE RANDOMIZE
			if ( $orderby == 'rand' ) {
				$orderby_slides = 'true';
			} else {
				$orderby_slides = 'false';
			}
			?>
				<script type="text/javascript">
					jQuery(document).ready(function($){
						var owl = $("#slider-<?php echo esc_js( the_ID() ); ?>");
						$(owl).owlCarousel({
							navigation : true,
							loop:true,
							stopOnHover : true,
							autoHeight: true,
							pagination: true,
							singleItem: true,
							slideSpeed: 400,
							paginationSpeed: 400,

							afterAction: function(){
									setTimeout(function(){
											var  $container = $('#projects');

										$container.imagesLoaded( function(){

										$container.isotope({
											itemSelector: '.masonry-project',
											 resizesContainer: true,
											});
										});
									},600);
								}
						});
					});
				</script>

				<div id="slider-<?php the_ID(); ?>" class="owl-slider">

					<?php
					if ( ! empty( $attachments ) ) {
						$i = 0;
						foreach ( $attachments as $attachment ) {
							$src     = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							$caption = $attachment->post_excerpt;
							$caption = ( $caption ) ? "<div class='slide-caption'>$caption</div>" : '';
							$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							echo "<div>$caption<img height='$src[2]' src='$src[0]' alt='$alt'/></div>";
						}
					} // END if( !empty($attachments) )
					?>

			</div><!-- END #slider-$postid -->

		<?php
		} // END if( $layout == 'slider' )

			// IF THE FUNCTION'S LAYOUT IS CALLING FOR LIGHTBOX
		if ( $layout == 'post-lightbox' ) {
			if ( ! empty( $attachments ) ) {
				$i = 1;

				foreach ( $attachments as $attachment ) {
					$hidden  = ( $i != 1 ) ? ' hidden' : '';
					$src     = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption = $attachment->post_excerpt;

					// Check for the grid image, fallback to featured image.
					$grid_image = get_post_meta( $postid, '_bean_grid_feat_img', true );
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );

					if ( $grid_image ) {
						$image = $grid_image;
					} elseif ( $feat_image ) {
						$image = $feat_image;
					} else {
						$image = $src[0];
					}

					echo "<a class='lightbox $hidden' rel='$postid' href='$src[0]' title=" . htmlspecialchars( $caption ) . '>';
						echo "<img src='$image' />";
						echo "<span class='lightbox-play'></span>";
					echo '</a>';

					$i++;
				}
			} // END if( !empty($attachments) )
		} // END if( $layout == 'post-lightbox' )

		if ( $layout == 'fullpage' ) {
			if ( ! empty( $attachments ) ) {
			?>

				<div id="project-assets-<?php echo esc_html( $postid ); ?>" class="projects projects-fullscreen">

					<?php
					$i = 0;
					foreach ( $attachments as $attachment ) {
						$caption = $attachment->post_excerpt;
						$caption = ( $caption ) ? "<div class='project-caption'><p>$caption</p></div>" : '';
						$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$src     = wp_get_attachment_image_src( $attachment->ID, $imagesize );

						$slide_bg_image = 'style="background-image: url(' . $src[0] . ');"';
						?>

						<div class="section project">

							  <div class="project-bg imagezoom" <?php echo balanceTags( $slide_bg_image ); ?>></div>

						 </div>

						<?php
						$i++;

					} //END foreach( $attachments as $attachment )
					?>

				</div>

				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('#project-assets-<?php echo esc_js( $postid ); ?>').fullpage({
							navigation: true,
							navigationPosition: 'right',
							continuousVertical: true,
							responsive: 768,
							fixedElements: '#header',
						});
					});
				</script>

				<ul class="projects-mobile">

					<?php
					if ( ! empty( $attachments ) ) {
						foreach ( $attachments as $attachment ) {
							$caption = $attachment->post_excerpt;
							$caption = ( $caption ) ? "<div class=project-caption'>$caption</div>" : '';
							$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							$src     = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
							?>

							<li><?php echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />"; ?></li>

							<?php
						} //END foreach( $attachments as $attachment )
					} // END if( !empty($attachments) )
					?>

				</ul><!-- END .projects-mobile -->

			<?php
			} // END if( !empty($attachments) )
		} // END if( $layout == 'std-portfolio-single' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE STACKED PORTFOLIO SINGLE
		if ( $layout == 'stacked' ) {
			if ( ! empty( $attachments ) ) {
			?>

				<ul id="project-assets-<?php echo esc_html( $postid ); ?>" class="stacked-assets
													<?php
													if ( $hero_area == 'off' ) {
														echo 'no-hero'; }
?>
">

					<?php if ( ! post_password_required() ) { ?>

						<?php if ( $content_area == 'on' ) { ?>

							<li class="entry-content percent-50">

								<div class="center-vertical">

									<div class="project-description">

										<?php if ( $hero_area == 'off' ) { ?>

											<header><h1 class="entry-title"><?php the_title(); ?></h1></header>

										<?php } ?>

										<?php the_content(); ?>

									</div><!-- END .project-description -->

									<?php if ( ! post_password_required() ) { ?>

										<div class="project-meta">

											<?php get_template_part( 'content', 'portfolio-meta' ); ?>

										</div><!-- END .project-meta -->

									<?php } ?>

								</div><!-- END .center-vertical -->

							</li>

						<?php } ?>

						<?php
						$i = 0;

						foreach ( $attachments as $attachment ) {

							$has_content = '';
							if ( $content_area == 'on' ) {
								$has_content = ( $i == 0 ) ? ' has-content' : '';
							}

							$caption = $attachment->post_excerpt;
							$caption = ( $caption ) ? "$caption" : '';

							$alt = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							$src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							?>

							<li class="
							<?php
							if ( $caption ) {
								echo 'percent-50 asset-' . $attachment->ID . ' has-caption'; }
?>

<?php
if ( $has_content ) {
								echo ' has-content percent-50';}
?>
"><?php echo '<a href="' . $src[0] . '" class="lightbox" title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><img src="' . $src[0] . '"/></a>'; ?>

							<?php if ( $has_content ) { ?>
								<script type="text/javascript">
									jQuery(document).ready(function($) {
										$(function(){
											$(window).load(function(){
												var $hasCaption = $('.single-portfolio').find('.has-content'),
													 hasCaption = $hasCaption.outerHeight(),
													$projectCaption = $('.entry-content');
												$projectCaption.animate({height: hasCaption}, 0);
											});

											$(window).resize(function(){
												var $hasCaption = $('.single-portfolio').find('.has-content'),
													 hasCaption = $hasCaption.outerHeight(),
													$projectCaption = $('.entry-content');
												$projectCaption.animate({height: hasCaption},0);
											});
										});
									});
								</script>
							<?php } ?>

							</li>

							<?php
							if ( $caption ) {
								echo '<li class="percent-50 asset-' . $attachment->ID . ' project-caption"><div class="center-vertical"><blockquote> ' . $caption . '</blockquote></div>';
								?>

								<script type="text/javascript">
									jQuery(document).ready(function($) {
										$(function(){
											$(window).load(function(){
												var $hasCaption = $('.single-portfolio').find('.has-caption.asset-<?php echo esc_js( $attachment->ID ); ?>'),
													 hasCaption = $hasCaption.outerHeight(),
													$projectCaption = $('.project-caption.asset-<?php echo esc_js( $attachment->ID ); ?>');
												$projectCaption.animate({height: hasCaption}, 0);
											});

											$(window).resize(function(){
												var $hasCaption = $('.single-portfolio').find('.has-caption.asset-<?php echo esc_js( $attachment->ID ); ?>'),
													 hasCaption = $hasCaption.outerHeight(),
													$projectCaption = $('.project-caption.asset-<?php echo esc_js( $attachment->ID ); ?>');
												$projectCaption.animate({height: hasCaption},0);
											});
										});
									});
								</script>

								</li>

							<?php
							}
							$i++;
						}
} //END foreach( $attachments as $attachment )

					/*
					===================================================================*/
					/*
					  VIDEO PORTFOLIO
					/*===================================================================*/
if ( $portfolio_type_video == 'on' ) {
	if ( $embed ) {
		if ( $portfolio_layout == 'std' ) {
			echo '<li class="masonry-item portfolio-content">';
		} else {
			echo '<li>';}
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed ) );
			echo '</div>';
		echo '</li>';

	} //END if($embed)

	if ( $embed2 ) {
		if ( $portfolio_layout == 'std' ) {
			echo '<li class="masonry-item portfolio-content">';
		} else {
			echo '<li>';}
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed2 ) );
			echo '</div>';
		echo '</li>';

	} //END if($embed2)

	if ( $embed3 ) {
		if ( $portfolio_layout == 'std' ) {
			echo '<li class="masonry-item portfolio-content">';
		} else {
			echo '<li>';}
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed3 ) );
			echo '</div>';
		echo '</li>';

	} //END if($embed3)

	if ( $embed4 ) {
		if ( $portfolio_layout == 'std' ) {
			echo '<li class="masonry-item portfolio-content">';
		} else {
			echo '<li>';}
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed4 ) );
			echo '</div>';
		echo '</li>';

	} //END if($embed4)
} // END if ( $portfolio_type_video == 'on')
					?>

				</ul>

			<?php
			} // END if( !empty($attachments) )
		} // END if( $layout == 'std-portfolio-single' )

		if ( $layout == 'superslides' ) {
			?>
			<div id="slider-<?php echo esc_html( $postid ); ?>" class="superslides">

			   <script type="text/javascript">
				   jQuery(document).ready(function($){
					   $('#slider-<?php echo esc_js( $postid ); ?>').superslides({
						   animation: 'slide',
						   play: 4000
					   });
				   });
			   </script>

			   <ul class="slides-container">

					<?php
					if ( ! empty( $attachments ) ) {
						foreach ( $attachments as $attachment ) {
							$caption    = $attachment->post_excerpt;
							$caption    = ( $caption ) ? "<div class='slide-caption'>$caption</div>" : '';
							$alt        = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							$src        = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							$caption_lb = $attachment->post_excerpt;
							?>

							<li>
								<?php echo "$caption<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' class='attachment-port-full' />"; ?>
							</li>

							<?php
						} //END foreach( $attachments as $attachment )
					} // END if( !empty($attachments) )
					?>

				</ul><!-- END .slides-container -->

				<nav class="slides-navigation">
					<a href="#" class="next"><?php _e( 'Next', 'harbor' ); ?></a>
					<a href="#" class="prev"><?php _e( 'Previous', 'harbor' ); ?></a>
				</nav>

			</div><!-- END #slider-$postid -->

			<ul class="projects-mobile">

				<?php
				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment ) {
						$caption = $attachment->post_excerpt;
						$caption = ( $caption ) ? "<div class='slide-caption'>$caption</div>" : '';
						$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$src     = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
						?>

						<li><?php echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption"; ?></li>

						<?php
					} //END foreach( $attachments as $attachment )
				} // END if( !empty($attachments) )
				?>

			</ul><!-- END .projects-mobile -->


		<?php
		} // END if( $layout == 'superslides' )

		 // IF THE FUNCTION'S LAYOUT IS CALLING FOR THE STACKED PORTFOLIO SINGLE
		if ( $layout == 'masonry-portfolio-single' ) {
			if ( ! empty( $attachments ) ) {

					/*
                    ===================================================================*/
					/*
                      VIDEO PORTFOLIO
                    /*===================================================================*/
				if ( $portfolio_type_video == 'on' ) {
					if ( $embed ) {
						if ( $portfolio_layout == 'std' ) {
							echo '<li class="masonry-item portfolio-content">';
						} else {
							echo '<li>';}
							echo '<div class="video-frame">';
								echo stripslashes( htmlspecialchars_decode( $embed ) );
							echo '</div>';
						echo '</li>';

					} //END if($embed)

					if ( $embed2 ) {
						if ( $portfolio_layout == 'std' ) {
							echo '<li class="masonry-item portfolio-content">';
						} else {
							echo '<li>';}
							echo '<div class="video-frame">';
								echo stripslashes( htmlspecialchars_decode( $embed2 ) );
							echo '</div>';
						echo '</li>';

					} //END if($embed2)

					if ( $embed3 ) {
						if ( $portfolio_layout == 'std' ) {
							echo '<li class="masonry-item portfolio-content">';
						} else {
							echo '<li>';}
							echo '<div class="video-frame">';
								echo stripslashes( htmlspecialchars_decode( $embed3 ) );
							echo '</div>';
						echo '</li>';

					} //END if($embed3)

					if ( $embed4 ) {
						if ( $portfolio_layout == 'std' ) {
							echo '<li class="masonry-item portfolio-content">';
						} else {
							echo '<li>';}
							echo '<div class="video-frame">';
								echo stripslashes( htmlspecialchars_decode( $embed4 ) );
							echo '</div>';
						echo '</li>';

					} //END if($embed4)
				} // END if ( $portfolio_type_video == 'on')
					?>

				<div id="projects" class="projects">

					<div class="grid-sizer"></div>

					<?php if ( $content_area == 'on' ) { ?>

						<article class="project masonry-project entry-content
						<?php
						if ( $hero_area == 'off' ) {
							echo 'no-hero'; }
?>
">


							<?php if ( $hero_area == 'off' ) { ?>

								<header><h1 class="entry-title"><?php the_title(); ?></h1></header>

							<?php } ?>


							<div class="project-description">

								<?php the_content(); ?>

							</div><!-- END .project-description -->

							<?php if ( ! post_password_required() ) { ?>

								<div class="project-meta">

									<?php get_template_part( 'content', 'portfolio-meta' ); ?>

								</div><!-- END .project-meta -->

							<?php } ?>

						</article>

					<?php } ?>

					<?php
					$i = 0;

					foreach ( $attachments as $attachment ) {

						$has_content = '';
						if ( $content_area == 'on' ) {
							$has_content = ( $i == 0 ) ? ' has-content' : '';
						}

						$caption = $attachment->post_excerpt;
						$caption = ( $caption ) ? "$caption" : '';

						$alt = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
						?>

						<article class="project masonry-project">
							<?php echo '<a href="' . $src[0] . '" class="lightbox" title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><img src="' . $src[0] . '"/>'; ?>
							<span class='lightbox-play'></span>
							</a>
						</article>

						<?php
						if ( $caption ) {
							echo '<article class="project entry-content masonry-project project-caption"><blockquote>' . $caption . '</blockquote></article>';
						}
						?>

						<?php

						$i++;

					} //END foreach( $attachments as $attachment )

					?>

				</ul>

			<?php
			} // END if( !empty($attachments) )
		} // END if( $layout == 'std-portfolio-single' )

		if ( $layout == 'carousel-portfolio-single' ) {
			?>
			<div class="carousel-wrap fadein">

			   <script type="text/javascript">
				   jQuery(document).ready(function($){
						var owl = $("#slider-<?php echo esc_js( the_ID() ); ?>");

						$(owl).owlCarousel({
					   navigation : true,
					   items : 2,
						itemsTablet: [2000,1],
					   loop: true,
					   stopOnHover : false,
					   autoHeight: true,
					   pagination: false,
					   autoPlay : true,
					   singleItem: false,
					   slideSpeed : 500,
						   paginationSpeed : 800,
					   addClassActive: true,
				   });

				   $(owl).trigger('owl.goTo',3)


				   });
			  </script>

			  <div id="slider-<?php the_ID(); ?>" class="crsl-slider">

				<?php
				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment ) {
						$caption    = $attachment->post_excerpt;
						$caption    = ( $caption ) ? "<div class='bean-image-caption subtext fadein'>$caption</div>" : '';
						$alt        = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$src        = wp_get_attachment_image_src( $attachment->ID, $imagesize );
						$src_lrg    = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
						$caption_lb = $attachment->post_excerpt;
						?>

						<article class="crsl-item">
							<?php echo '<a href="' . $src[0] . '" class="lightbox " title="' . htmlspecialchars( $caption_lb ) . '" rel="' . $postid . '" alt="' . $alt . '"><img height=' . $src[2] . ' width=' . $src[1] . ' src=' . $src[0] . ' alt=' . $alt . ' /></a>'; ?>
						   </article>

							<?php
					} //END foreach( $attachments as $attachment )
				} // END if( !empty($attachments) )
				?>

			</div><!-- END .crsl-slider -->

		<?php
		} // END if( $layout == 'carousel-portfolio-single' )

	} // END function bean_gallery
} // END if ( !function_exists( 'bean_gallery' ) )




/*
===================================================================*/
/*
  AUDIO POST FORMAT FUNCTION
/*===================================================================*/
if ( ! function_exists( 'bean_audio' ) ) {
	function bean_audio( $postid ) {
		// MP3 FROM POST/PORTFOLIO
		$mp3 = get_post_meta( $postid, '_bean_audio_mp3', true );
		?>

		<div id="jp_container_<?php echo esc_html( $postid ); ?>" class="jp-audio fullwidth" data-file="<?php echo esc_html( $mp3 ); ?>">
			<div id="jquery_jplayer_<?php echo esc_html( $postid ); ?>" class="jp-jplayer">
			</div><!-- END .jquery_jplayer -->
			<div class="jp-interface" style="display: none;">
				<ul class="jp-controls">
					<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span><?php _e( 'Play', 'harbor' ); ?></span></a></li>
					<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span><?php _e( 'Pause', 'harbor' ); ?></span></a></li>
				</ul><!-- END .jp-controls -->
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div><!-- END .jp-seek-bar -->
				</div><!-- END .jp-progress -->
			</div><!-- END .jp-interface -->
		</div><!-- END #jp_container-->

		<?php
	} // END function bean_audio($postid)
} // END if ( !function_exists( 'bean_audio' ) )
