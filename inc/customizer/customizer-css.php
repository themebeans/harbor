<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function harbor_customizer_css() {

	$wrapper_background_color = get_theme_mod( 'wrapper_background_color', '#FFF' );
	$theme_accent_color       = get_theme_mod( 'theme_accent_color', '#48b6c7' );
	$portfolio_loop_scaling   = get_theme_mod( 'portfolio_loop_scaling' );
	$portfolio_overlay_color  = get_theme_mod( 'portfolio_overlay_color' );
	$css_filter_style         = get_theme_mod( 'portfolio_css_filter' );

	$logo_maxwidth       = get_theme_mod( 'custom_logo_max_width', 100 );
	$logo_mobilemaxwidth = get_theme_mod( 'custom_logo_mobile_max_width', 100 );
?>
<style>
<?php
$customizations          =
'

@media screen and (max-width: 768px) {
    body .custom-logo-link img.custom-logo {
        width: ' . esc_attr( $logo_mobilemaxwidth ) . 'px;
    }
}

@media screen and (min-width: 769px) {
    body .custom-logo-link img.custom-logo {
        width: ' . esc_attr( $logo_maxwidth ) . 'px;
    }
}

.author-count, .address-circle { background-color:' . $theme_accent_color . '; }
body,
.page-inner,.footer,.header { background-color:' . $wrapper_background_color . '!important; }
.cats,
.project-filter a.active,
.project-filter a:hover,
.testimonial cite a:hover,
.menu-fullscreen ul li a:hover,
.toggle-title:hover,
h1 a:hover,
.inner.dark .contactform .button[type="submit"]:hover,
.contactform .button[type="submit"]:hover,
.showing-work .portfolio-fullscreen .toggle-title:hover,
.author-tag,
.reset_variations:hover,
.a-link:hover,
.widget a:hover,
.logo a h1:hover,
.widget li a:hover,
.entry-meta a:hover,
.pagination a:hover,
footer ul li a:hover,
.single-price .price,
.entry-title a:hover,
.comment-meta a:hover,
h2.entry-title a:hover,
.single-download .edd_price,
.comment-author a:hover,
.products li h2 a:hover,
.entry-link a.link:hover,
.team-content h3 a:hover,
.archives-list li a:hover,
.site-description a:hover,
.bean-tabs > li.active > a,
.bean-panel-title > a:hover,
.grid-item .entry-meta a:hover,
.project-meta a:hover,
.bean-tabs > li.active > a:hover,
.bean-tabs > li.active > a:focus,
#cancel-comment-reply-link:hover,
.shipping-calculator-button:hover,
.single-product ul.tabs li a:hover,
.grid-item.post .entry-meta a:hover,
.single-product ul.tabs li.active a,
.single-portfolio .sidebar-right a.url,
.grid-item.portfolio .entry-meta a:hover,
.portfolio.grid-item span.subtext a:hover,
.sidebar .widget_bean_tweets .button:hover,
.entry-content .portfolio-social li a:hover,
.product-content h2 a:hover,
#project-filter li a:hover,
.portfolio-tagline blockquote a,
#project-filter li a.active,
.comment-form input[type="submit"]:hover,
.entry-footer a:hover,
.posts-wide .published a:hover,
.tagcloud a:hover,
#BeanForm input:focus ~ label,
#BeanForm textarea:focus ~ label,
#project-filter li a.active:hover,
.single-portfolio .portfolio-social .bean-likes:hover,
#BeanForm .button:hover,
blockquote.tagline em,
.team-content .team-role,
.team-content .edit a:hover,
.continue-reading:hover,
.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-caption,
.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-caption,
.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-item-title,
.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-item-title { color:' . $theme_accent_color . '!important; }

.onsale,
.new-tag,
.bean-btn,
.btn:hover,
#place_order,
.button:hover,
nav a h1:hover,
div.jp-play-bar,
.bean-image-caption,
.pagination a:hover,
.after-post h6:hover,
.edd_checkout a:hover,
#fancybox-loading div,
div.jp-volume-bar-value,
.edd-submit.button:hover,
.avatar-list li a.active,
.edd-submit.button:hover,
.dark_style .pagination a,
.btn[type="submit"]:hover,
input[type="reset"]:hover,
input[type="button"]:hover,
#edd-purchase-button:hover,
input[type="submit"]:hover,
.button[type="submit"]:hover,
#load-more:hover .overlay h5,
.sidebar-btn .menu-icon:hover,
.pagination .page-portfolio a,
#theme-wrapper .edd-submit.button,
.widget .buttons .checkout.button,
.side-menu .sidebar-btn .menu-icon,
.dark_style .sidebar-btn .menu-icon,
input[type=submit].edd-submit.button,
.comment-form-rating p.stars a.active,
.comment-form-rating p.stars a.active:hover,
table.cart td.actions .checkout-button.button,
.subscribe .mailbag-wrap input[type="submit"]:hover,
.page-template-template-landing-php #load-more:hover,
.btn,
.button,
button,
.btn[type="submit"],
input[type="reset"],
input[type="button"],
input[type="submit"],
.button[type="submit"],
.call-to-action,
.products li a.added_to_cart,
.widget_bean_feature .feature-icon,
.post .post-inner .entry-title:after,
.single_portfolio_fullscreen.project-pagination a:hover,
#edd_checkout_wrap .edd-submit.button,
.header .nav li.current-menu-item a:after,
#BeanForm .bar:before,
#edd_checkout_wrap #edd_purchase_submit .edd-submit.button,
.entry-content .mejs-controls .mejs-time-rail span.mejs-time-current { background-color:' . $theme_accent_color . '; }

.entry-content .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current { background:' . $theme_accent_color . '; }


.single-product .price ins,
a:hover,
.project-meta a:hover,
.project-taxonomy a:hover,
.page .inner.dark h4 .bean-btn.small:hover,
.single-product ul.tabs li.active a { border-color:' . $theme_accent_color . '!important; }

.testimonials .owl-pagination div:hover,
.testimonials .owl-pagination div.active { box-shadow: 0 0 0 2px ' . $theme_accent_color . '!important; }

.bean-btn { border: 1px solid ' . $theme_accent_color . '!important; }

.bean-quote,
.products li a.added_to_cart,
.single_add_to_cart_button.button,
.cd-words-wrapper.selected,
.page .inner.dark h4 .bean-btn.small:hover,
.showing-work .portfolio-fullscreen .toggle-title:hover #nav-toggle span,
.showing-work .portfolio-fullscreen .toggle-title:hover #nav-toggle span:before,
.showing-work .portfolio-fullscreen .toggle-title:hover #nav-toggle span:after, .single-portfolio.single_portfolio_masonry_no_hero .project-caption.entry-content , .single-portfolio.single_portfolio_masonry .project-caption.entry-content { background-color:' . $theme_accent_color . '!important; }
';

if ( $portfolio_loop_scaling == false ) {
	echo '.masonry-project a:hover img,.masonry-project.quoted:hover img,.format-link .entry-media a:hover .post-cover,.format-quote .entry-media a:hover .post-cover {-webkit-transform: scale(1)!important;-moz-transform: scale(1)!important;-ms-transform: scale(1)!important;-o-transform: scale(1)!important;transform: scale(1)!important;}';
}

if ( $portfolio_overlay_color ) {
	echo '.masonry-project .overlay, .format-image .entry-media, .format-video .entry-media, .single-portfolio .masonry-project { background-color:' . $portfolio_overlay_color . '!important; }';
}

if ( $css_filter_style != '' ) {
	switch ( $css_filter_style ) {
		case 'none':
			// DO NOTHING
			break;
		case 'grayscale':
			echo '.project.masonry-project img { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
			break;
		case 'sepia':
			echo '.project.masonry-project img { -webkit-filter: sepia(50%); }';
			break;
		case 'saturation':
			 echo '.project.masonry-project img { -webkit-filter: saturate(150%); }';
			break;
	}
}

// COMBINE THE VARIABLES FROM ABOVE
$customizer_final_output = $customizations;

$final_output = preg_replace( '#/\*.*?\*/#s', '', $customizer_final_output );
$final_output = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $final_output );
$final_output = preg_replace( '/\s\s+(.*)/', '$1', $final_output );
echo balanceTags( $final_output );
?>
</style>
<?php
}

add_action( 'wp_head', 'harbor_customizer_css', 1 );
