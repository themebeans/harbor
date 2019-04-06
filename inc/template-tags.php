<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

if ( ! function_exists( 'harbor_site_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 * Outputs an H1, if there is no logo uploaded.
	 */
	function harbor_site_logo() {

		if ( has_custom_logo() ) {

			echo '<div itemscope itemtype="http://schema.org/Organization">';
				the_custom_logo();
			echo '</div>';

		} else { ?>
			<h1 class="site-logo-link" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
		}
	}
endif;

/**
 * Retrieve Post Views
 */
function designer_get_post_views( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
		return '0';
	}
	return $count;
}

/**
 * Track Post Views
 */
function designer_set_post_views( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}
}

/**
 * Add Masonry to footer.
 */
if ( ! function_exists( 'bean_portfolio_masonry' ) ) {
	function bean_portfolio_masonry() {
		if ( ! is_404() ) {

			if ( is_page_template( 'template-portfolio.php' ) || is_page_template( 'template-portfolio-relative-grid.php' ) || is_page_template( 'template-portfolio-squared-grid.php' ) || is_home() || is_singular( 'portfolio' ) || is_archive() || is_search() ) {
			?>

				<script type="text/javascript">

				jQuery(document).ready(function($) {

				$(window).load(function() {

					  jQuery(window).trigger('resize');

					//ISOTOPE
					var $container = $('#projects');

					$container.imagesLoaded( function(){

					$container.isotope({
						itemSelector: '.masonry-project',
						 resizesContainer: true,
						});

					$container.isotope();

					var iso = $container.data('isotope');

					//ON PAGE LOAD, COUNT POSTS
					$("#post-count").find(".project-number").text(function() {
						var e = iso.filteredItems.length;
								  return 10 > e ? "0" + e : e
					})

					//FILTER
					$(function(){
						optionFilter = jQuery('#project-filter'),
						optionFilterLinks = optionFilter.find('a');

						optionFilterLinks.attr('href', '#');

						optionFilterLinks.click(function(){
							var selector = jQuery(this).attr('data-filter');
							$container.imagesLoaded( function(){
								$container.isotope({
									filter : '.' + selector,
									itemSelector : '.masonry-project',
									resizesContainer: true,
								});
							});

							//HIGHLIGHT ACTIVE FILTER ITEM
							optionFilterLinks.removeClass('active');
							jQuery(this).addClass('active');

							//ADD HIDING CLASS FOR THE COUNT
							$("#post-count").find(".project-number").addClass("not-showing")

							return false;
						});

						//ON COMPLETION OF THE LAYOUT CHANGE, UPDATE THE NUMBER OF FILTERED ITEMS.
						$container.isotope( 'on', 'arrangeComplete',
							function( filteredItems ) {
								$("#post-count").find(".project-number").text(function() {
										   var e = filteredItems.length;
										   return 10 > e ? "0" + e : e
								   }), $("#post-count").find(".project-number").addClass("showing").removeClass("not-showing")
						});
					});

				});

					//INFINITE
					if( $('body').is('.page-template-template-portfolio-php, .page-template-template-portfolio-relative-grid-php, .page-template-template-portfolio-squared-grid-php, .page-template-template-testimonials-php, .blog, .search, .archive') ) {
						$(function(){
							$container.infinitescroll({
								navSelector  : '#page_nav',
								nextSelector : '#page_nav a',
								itemSelector : '.masonry-project',
								loading: {
									loadingText: 'Loading',
									finishedMsg: 'Done Loading',
									img: ''
								}
							},

							function( newElements ) {
								var  $newElems = $( newElements ).css({ opacity: 0 });
									$newElems.imagesLoaded(function(){
									$newElems.animate({ opacity: 1 });
									$container.isotope( 'appended', $newElems, true );
									$('.format-video').fitVids('appended', $newElems);

									<?php
									// We're going to get the ID's for each slider post.
									$port_posts = get_posts(
										array(
											'numberposts' => -1,
											'post_type'   => 'post',
										)
									);

									foreach ( $port_posts as $post ) {
										$postid = $post->ID;
										$format = get_post_format();
										if ( false === $format ) {
											$format = 'standard'; }

										if ( $format === 'gallery' ) {
										?>

											var owl = $("#slider-<?php echo esc_js( the_ID() ); ?>");
											$(owl).owlCarousel({
												navigation : true,
												loop:true,
												stopOnHover : true,
												autoHeight: true,
												pagination: true,
												singleItem:true,
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
														},500);
													}
											});

										<?php
										} //END $format === 'gallery'
									} // END FOR EACH
									?>
								});

								$("#post-count").find(".project-number").text(function() {
									var e = iso.filteredItems.length;
											   return 10 > e ? "0" + e : e
								})

								for(var i = 0; i < Bean_Isotope.callAfterNewElements.length; i++) {
									  Bean_Isotope.callAfterNewElements[i].call();
								}
							});
						});
					}

					});

				});
				</script>
			<?php
			}
		}
	}
}
add_action( 'wp_footer', 'bean_portfolio_masonry' );
