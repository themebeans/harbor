<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

if ( ! defined( 'HARBOR_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'HARBOR_DEBUG', true );
endif;

if ( ! defined( 'HARBOR_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'HARBOR_DEBUG' ) || true === HARBOR_DEBUG ) {
		define( 'HARBOR_ASSET_SUFFIX', null );
	} else {
		define( 'HARBOR_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function harbor_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Harbor, use a find and replace
	 * to change 'harbor' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'harbor', get_parent_theme_file_path( '/languages' ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 */
	add_theme_support(
		'custom-logo', array(
			'flex-height' => true,
		)
	);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140 );
	add_image_size( 'sml-thumbnail', 50, 50, true );
	add_image_size( 'post-feat', 755, 9999, false );
	add_image_size( 'port-full', 9999, 9999, false );
	add_image_size( 'grid-feat', 514, 380, array( 'center', 'top' ) );
	add_image_size( 'grid-feat-square', 514, 514, array( 'center', 'top' ) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary-menu'   => __( 'Primary Navigation', 'harbor' ),
			'secondary-menu' => __( 'Secondary Navigation', 'harbor' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Register post formats.
	add_theme_support(
		'post-formats', array(
			'aside',
			'audio',
			'image',
			'gallery',
			'link',
			'quote',
			'video',
		)
	);

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'harbor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function harbor_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'harbor_content_width', 700 );
}
add_action( 'after_setup_theme', 'harbor_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function harbor_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar Menu', 'harbor' ),
			'description'   => __( 'Widget area for the sidebar menu option.', 'harbor' ),
			'id'            => 'hidden-sidebar',
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);

}
add_action( 'widgets_init', 'harbor_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function harbor_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'harbor-fonts', harbor_fonts_url(), array(), null );

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'harbor-style', get_parent_theme_file_uri( '/style' . HARBOR_ASSET_SUFFIX . '.css' ) );
		wp_enqueue_style( 'harbor-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'harbor-style', get_theme_file_uri( '/style' . HARBOR_ASSET_SUFFIX . '.css' ) );
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( HARBOR_DEBUG ) {

		// Vendor scripts.
		wp_enqueue_script( 'validate', get_theme_file_uri( '/assets/js/vendors/validate.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'fitvids', get_theme_file_uri( '/assets/js/vendors/fitvids.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'harbor-custom-libraries', get_theme_file_uri( '/assets/js/vendors/custom-libraries.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'infinitescroll', get_theme_file_uri( '/assets/js/vendors/infinitescroll.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Custom scripts.
		wp_enqueue_script( 'harbor-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery', 'imagesloaded' ), '@@pkg.version', true );

		$translation_handle = 'harbor-global'; // Variable for wp_localize_script.

	} else {
		wp_enqueue_script( 'harbor-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'harbor-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery', 'imagesloaded' ), '@@pkg.version', true );

		$translation_handle = 'harbor-custom-min'; // Variable for wp_localize_script for minified javascript.
	}

	// Localize the script with new data.
	wp_localize_script( $translation_handle, 'WP_TEMPLATE_DIRECTORY_URI', array( 0 => get_theme_file_uri() ) );
}
add_action( 'wp_enqueue_scripts', 'harbor_scripts' );

/**
 * Remove the duplicate stylesheet enqueue for older versions of the child theme.
 *
 * Since v1.6.0 @@pkg.name has a built-in auto-loader for loading the appropriate
 * parent theme stylesheet, without the need for a wp_enqueue_scripts function within
 * the child theme. This means that stylesheets will "just work" and there's less chance
 * that users will accidently disrupt stylesheet loading.
 */
function harbor_remove_duplicate_child_parent_enqueue_scripts() {
	remove_action( 'wp_enqueue_scripts', 'harbor_child_scripts', 10 );
}
add_action( 'init', 'harbor_remove_duplicate_child_parent_enqueue_scripts' );

/**
 * Register Google fonts for Harbor.
 *
 * @return string Google fonts URL for the theme.
 */
function harbor_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = '';

	/* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'harbor' ) ) {
		$fonts[] = 'Lato:300,400,700';
	}

	/* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Lora font: on or off', 'harbor' ) ) {
		$fonts[] = 'Lora:400,700,400italic';
	}

	/* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Montserrat font: on or off', 'harbor' ) ) {
		$fonts[] = 'Montserrat:700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg(
			array(
				'family' => rawurlencode( implode( '|', $fonts ) ),
				'subset' => rawurlencode( $subsets ),
			), 'https://fonts.googleapis.com/css'
		);
	}

	return $fonts_url;
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array  $urls           URLs to print for resource hints.
 * @param  string $relation_type  The relation type the URLs are printed.
 * @return array  $urls           URLs to print for resource hints.
 */
function harbor_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'harbor-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'harbor_resource_hints', 10, 2 );

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function harbor_enqueue_admin_style() {
	wp_enqueue_style( 'harbor-admin-style', get_theme_file_uri( '/assets/css/admin-style.css' ), false, '@@pkg.version', 'all' );
	wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'harbor_enqueue_admin_style' );

/**
 * Enqueue a script in the WordPress admin, for edit.php, post.php and post-new.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function harbor_enqueue_admin_script( $hook ) {
	global $pagenow, $wp_customize;

	if ( 'edit.php' !== $hook ) {
		wp_enqueue_script( 'harbor-post-meta', get_theme_file_uri( '/assets/js/admin/post-meta.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'wp-color-picker' );
	}
}
add_action( 'admin_enqueue_scripts', 'harbor_enqueue_admin_script' );

if ( ! function_exists( 'bean_page_title' ) ) {
	function bean_page_title() {
		$page_title = '';

		if ( is_singular() ) {
			if ( is_page() ) {
					$page_title = get_the_title();
			} elseif ( is_single() ) {
				  $page_title = get_the_title();
			}
		} else {
			if ( is_archive() ) {
				if ( is_category() ) {
					$page_title = sprintf( __( 'Posts in: %s', 'harbor' ), single_cat_title( '', false ) );
				} elseif ( is_tag() ) {
					$page_title = sprintf( __( 'Tagged: %s', 'harbor' ), single_tag_title( '', false ) );
				} elseif ( is_date() ) {
					if ( is_month() ) {
						$page_title = sprintf( __( 'Archive: %s', 'harbor' ), get_the_time( 'F, Y' ) );
					} elseif ( is_year() ) {
						$page_title = sprintf( __( 'Archive: %s', 'harbor' ), get_the_time( 'Y' ) );
					} elseif ( is_day() ) {
						$page_title = sprintf( __( 'Archive: %s', 'harbor' ), get_the_time( get_option( 'date_format' ) ) );
					} else {
						$page_title = __( 'Archives', 'harbor' );
					}
				} elseif ( is_author() ) {
					if ( get_query_var( 'author_name' ) ) {
						$curauth = get_user_by( 'login', get_query_var( 'author_name' ) );
					} else {
						$curauth = get_userdata( get_query_var( 'author' ) );
					}
					$author_name = $curauth->display_name;
					$title       = sprintf( __( 'Posts by %s', 'harbor' ), $author_name );
					$page_title  = $title;

				} elseif ( is_tax() ) {
					$page_title = sprintf( __( 'Archive: %s', 'harbor' ), single_term_title( '', false ) );
				} else {
					$page_title = single_term_title( '', false ); }
			} elseif ( is_search() ) {
				$page_title = sprintf( __( 'Search Results for &#8220;%s&#8221;', 'harbor' ), get_search_query() );
			}
		} //END else
		return $page_title;

	}
}

/**
 * Convert HEX to RGB.
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 * HEX code, empty array otherwise.
 */
function harbor_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

if ( ! function_exists( 'oddeven_post_class' ) ) {
	function oddeven_post_class( $classes ) {
		global $current_class;
		$classes[]     = $current_class;
		$current_class = ( $current_class == 'odd' ) ? 'even' : 'odd';
		return $classes;
	} //END if ( function_exists( 'oddeven_post_class' ) )
	add_filter( 'post_class', 'oddeven_post_class' );

	global $current_class;
	$current_class = 'odd';
}

if ( ! function_exists( 'bean_portfolio_custom_styles' ) ) {
	function bean_portfolio_custom_styles() {
		$port_posts = get_posts(
			array(
				'numberposts' => -1,
				'post_type'   => 'portfolio',
			)
		);

		foreach ( $port_posts as $post ) {

			$postid  = $post->ID;
			$bgcolor = get_post_meta( $postid, '_bean_accent_color', true );

			if ( is_singular( 'portfolio' ) && $bgcolor ) {

				echo '<style>';

					echo '.postid-' . $postid . ' .call-to-action {background-color: ' . $bgcolor . '}';
					echo '.postid-' . $postid . ' .project-description p a {color: ' . $bgcolor . '}';
					echo '.postid-' . $postid . ' .project-meta a:hover {color: ' . $bgcolor . '!important}';
					echo '.single-portfolio.single_portfolio_masonry_no_hero.postid-' . $postid . ' .project-caption.entry-content {background-color: ' . $bgcolor . '!important}';
					echo '.single-portfolio.single_portfolio_masonry.postid-' . $postid . ' .project-caption.entry-content {background-color: ' . $bgcolor . '!important}';

				echo '</style>';

			}
		}
	}
}
add_action( 'wp_head', 'bean_portfolio_custom_styles' );


if ( ! function_exists( 'bean_no_single_cpt_redirect' ) ) {
	function bean_no_single_cpt_redirect() {
		$queried_post_type = get_query_var( 'post_type' );
		if ( is_single() && 'team' == $queried_post_type ) {
			wp_redirect( home_url(), 301 );
			exit;
		}

		if ( is_single() && 'testimonial' == $queried_post_type ) {
			wp_redirect( home_url(), 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'bean_no_single_cpt_redirect' );

function bean_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'bean_move_comment_field_to_bottom' );

if ( ! function_exists( 'bean_comment' ) ) {
	function bean_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="clearfix">

				<?php echo get_avatar( $comment, $size = '60' ); ?>

				<header class="comment-header">
					<div class="comment-author vcard">
						<?php printf( __( '<cite class="fn">%s</cite> ', 'harbor' ), get_comment_author_link() ); ?>
					</div><!-- END .comment-author.vcard -->
					<div class="comment-meta commentmetadata">
						<span class="at"><?php _e( 'at', 'harbor' ); ?></span> <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%2$s, %1$s', 'harbor' ), get_comment_date(), get_comment_time() ); ?></a><?php edit_comment_link( __( 'Edit', 'harbor' ), ' &middot; ', '' ); ?>  &middot;
													<?php
													comment_reply_link(
														array_merge(
															$args, array(
																'depth'     => $depth,
																'max_depth' => $args['max_depth'],
															)
														)
													);
?>
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<span class="moderation"><?php _e( 'Awaiting Moderation', 'harbor' ); ?></span>
						<?php endif; ?>
					</div><!-- END .comment-meta.commentmetadata -->
				</header>

				<div class="comment-body">
					<?php comment_text(); ?>
				</div><!-- END .comment-body -->

			</div><!-- END #comment-<?php comment_ID(); ?> -->
		</li>
		<?php
	}
}

if ( ! function_exists( 'harbor_ping' ) ) {
	/**
	 * Custom pingback output.
	 */
	function harbor_ping( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
			<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
		<?php
	}
}

/**
 * Custom comments form.
 */
function bean_custom_form_filters( $args = array(), $post_id = null ) {
	 global $id;

	if ( null === $post_id ) {
		$post_id = $id;
	} else {
		$id = $post_id;
	}

	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$fields = array(

		'author' => '
		<p class="comment-form-author">
			<label for="author">' . __( 'Name', 'harbor' ) . '<span class="required">*</span></label>
			<input id="author" name="author" type="text" tabindex="2" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required/>
		</p>',

		'email'  => '
		<p class="comment-form-email">
			<label for="email">' . __( 'Email', 'harbor' ) . '<span class="required">*</span></label>
			<input id="email" name="email" type="text" tabindex="3" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required/>
		</p>',

		'url'    => '
		<p class="comment-form-url">
			<label for="url">' . __( 'Website', 'harbor' ) . '</label>
			<input id="url" name="url" type="text" tabindex="4" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"/>
		</p>',
	);

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" tabindex="1" cols="45" rows="6" placeholder="Leave a comment here..." required></textarea></p><a href="#" id="cancel-comment">Cancel</a>',
		'',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'harbor' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as subtext">' . sprintf( __( 'Currently logged in as <a href="%1$s">%2$s</a> / <a href="%3$s" title="Log out of this account">Logout</a>', 'harbor' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => null,
		'comment_notes_after'  => null,
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'submit_field'         => '<p class="form-submit">%1$s %2$s</a>',
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		'title_reply'          => '',
		'title_reply_to'       => __( 'Leave a Reply to %s', 'harbor' ),
		'cancel_reply_link'    => __( 'Cancel', 'harbor' ),
		'label_submit'         => __( 'Submit Comment', 'harbor' ),
	);

	return $defaults;
}
add_filter( 'comment_form_defaults', 'bean_custom_form_filters' );

if ( ! function_exists( 'harbor_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function harbor_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'harbor_pingback_header' );
endif;

/**
 * Post meta.
 */
if ( is_admin() ) {
	require get_theme_file_path( '/inc/meta/metaboxes.php' );
	require get_theme_file_path( '/inc/meta/meta-page.php' );
	require get_theme_file_path( '/inc/meta/meta-portfolio.php' );
	require get_theme_file_path( '/inc/meta/meta-post.php' );
	require get_theme_file_path( '/inc/meta/meta-team.php' );
}

/**
 * Customizer.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/sanitization.php' );

/**
 * Add Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-flickr.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-menu.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-taxonomy.php' );

/**
 * Template Tags.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Template Functions.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * SVG icons functions and filters.
 */
require get_theme_file_path( '/inc/icons.php' );

/**
 * Media.
 */
require get_theme_file_path( '/inc/media.php' );

/**
 * Likes.
 */
require get_theme_file_path( '/inc/likes.php' );

/**
 * Shortcodes.
 */
require get_theme_file_path( '/inc/shortcodes.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}
