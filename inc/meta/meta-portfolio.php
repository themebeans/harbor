<?php
/**
 * The file is for creating the portfolio post type meta.
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

add_action( 'add_meta_boxes', 'bean_metabox_portfolio' );
function bean_metabox_portfolio() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'portfolio-hero-meta',
		'title'    => __( 'Hero Settings', 'harbor' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Enable Hero Area:', 'harbor' ),
				'id'   => $prefix . 'hero_area',
				'type' => 'checkbox',
				'desc' => __( 'Display a hero area on this page.', 'harbor' ),
				'std'  => true,
			),
			array(
				'name' => __( 'Hero Fullscreen Effect:', 'harbor' ),
				'id'   => $prefix . 'hero_fullscreen',
				'type' => 'checkbox',
				'desc' => __( 'Enable the hero area to be fullscreen height and width.', 'harbor' ),
				'std'  => true,
			),
			array(
				'name' => __( 'Hero Zoom Effect:', 'harbor' ),
				'id'   => $prefix . 'hero_imagezoom',
				'type' => 'checkbox',
				'desc' => __( 'Add a subtle zooming animation to your hero background.', 'harbor' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Hero Gradient Effect:', 'harbor' ),
				'id'   => $prefix . 'hero_gradient',
				'type' => 'checkbox',
				'desc' => __( 'Add a subtle dark gradient behind your hero text content.', 'harbor' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Hero Text Color:', 'harbor' ),
				'desc' => __( 'Modify the text color of the hero area.', 'harbor' ),
				'id'   => $prefix . 'hero_text_color',
				'type' => 'color',
				'val'  => '#FFF',
				'std'  => '#FFF',
			),
			array(
				'name' => __( 'Hero Background Color:', 'harbor' ),
				'desc' => __( 'Modify the background color of the hero area.', 'harbor' ),
				'id'   => $prefix . 'hero_bg_color',
				'type' => 'color',
				'val'  => '#000',
				'std'  => '#000',
			),
			array(
				'name' => __( 'Hero Header Image:', 'harbor' ),
				'desc' => __( 'Upload an image to deploy in your hero area. This will replace the featured image.', 'harbor' ),
				'id'   => $prefix . 'hero_fullscreen_img',
				'type' => 'file',
				'std'  => '',
			),
			array(
				'name' => __( 'Hero Background Video URL:', 'harbor' ),
				'desc' => __( 'Upload an video instead of using the featured image - or add embed code below.', 'harbor' ),
				'id'   => $prefix . 'hero_video_background',
				'type' => 'file',
				'std'  => '',
			),
			array(
				'name' => __( 'Hero Background Video Embed:', 'harbor' ),
				'desc' => __( 'Add a video embed iframe instead of using the featured image.', 'harbor' ),
				'id'   => $prefix . 'hero_embedded_background',
				'type' => 'textarea',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  PORTFOLIO FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'          => 'portfolio-type',
		'title'       => __( 'Portfolio Format', 'harbor' ),
		'description' => __( '', 'harbor' ),
		'page'        => 'portfolio',
		'context'     => 'side',
		'priority'    => 'core',
		'fields'      => array(
			array(
				'name' => __( 'Gallery', 'harbor' ),
				'desc' => __( '', 'harbor' ),
				'id'   => $prefix . 'portfolio_type_gallery',
				'type' => 'checkbox',
				'std'  => true,
			),
			array(
				'name' => __( 'Audio', 'harbor' ),
				'desc' => __( '', 'harbor' ),
				'id'   => $prefix . 'portfolio_type_audio',
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name' => __( 'Video', 'harbor' ),
				'desc' => __( '', 'harbor' ),
				'id'   => $prefix . 'portfolio_type_video',
				'type' => 'checkbox',
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  PORTFOLIO META SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'          => 'portfolio-meta',
		'title'       => __( 'Portfolio Settings', 'harbor' ),
		'description' => __( '', 'harbor' ),
		'page'        => 'portfolio',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => __( 'Portfolio External URL:', 'harbor' ),
				'desc' => __( 'Link this portfolio post to an external URL. For example, link this post to your Behance portfolio post.', 'harbor' ),
				'id'   => $prefix . 'portfolio_external_url',
				'type' => 'text',
				'std'  => '',
			),

			array(
				'name' => __( 'Porfolio Images:', 'harbor' ),
				'desc' => __( 'Upload images here for your portfolio post. Once uploaded, drag & drop to reorder.', 'harbor' ),
				'id'   => $prefix . 'portfolio_upload_images',
				'type' => 'images',
				'std'  => __( 'Browse & Upload', 'harbor' ),
			),

			array(
				'name'    => __( 'Portfolio Layout:', 'harbor' ),
				'desc'    => __( 'Choose the layout for this post. If set to "Global Setting", the value is set via the "Theme Customizer - Layout - Single Portfolio" section.', 'harbor' ),
				'id'      => $prefix . 'portfolio_layout',
				'type'    => 'select',
				'std'     => 'customizer_option',
				'options' => array(
					'customizer_option'           => __( 'Global Setting', 'harbor' ),
					'single_portfolio_stacked'    => __( 'Stacked', 'harbor' ),
					'single_portfolio_fullscreen' => __( 'Fullscreen', 'harbor' ),
					'single_portfolio_masonry'    => __( 'Masonry', 'harbor' ),
					'single_portfolio_carousel'   => __( 'Carousel', 'harbor' ),
				),
			),

			array(
				'name' => __( 'Portfolio Accent Color:', 'harbor' ),
				'desc' => __( 'Apply a custom accent color of the call to action and content links.', 'harbor' ),
				'id'   => $prefix . 'accent_color',
				'type' => 'color',
				'val'  => '',
				'std'  => '',
			),

			array(
				'name' => __( 'Featured Portfolio:', 'harbor' ),
				'id'   => $prefix . 'portfolio_feature',
				'type' => 'checkbox',
				'desc' => __( 'Feature this post on the portfolio templates.', 'harbor' ),
				'std'  => false,
			),

			array(
				'name' => __( 'Portfolio Content:', 'harbor' ),
				'id'   => $prefix . 'content_area',
				'type' => 'checkbox',
				'desc' => 'Display the content.',
				'std'  => true,
			),

			array(
				'name' => __( 'Portfolio Date:', 'harbor' ),
				'id'   => $prefix . 'portfolio_date',
				'type' => 'checkbox',
				'desc' => __( 'Display the date.', 'harbor' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Portfolio Client:', 'harbor' ),
				'desc' => __( 'Display the client meta.', 'harbor' ),
				'id'   => $prefix . 'portfolio_client',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Portfolio URL:', 'harbor' ),
				'desc' => __( 'Insert a URL to link your post to.', 'harbor' ),
				'id'   => $prefix . 'portfolio_url',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Portfolio URL Name:', 'harbor' ),
				'desc' => __( 'Insert a name for your URL (optional).', 'harbor' ),
				'id'   => $prefix . 'portfolio_url_name',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Display Custom Meta:', 'harbor' ),
				'id'   => $prefix . 'portfolio_custom_meta',
				'type' => 'checkbox',
				'desc' => __( 'Display any custom meta fields.', 'harbor' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Display Categories:', 'harbor' ),
				'id'   => $prefix . 'portfolio_cats',
				'type' => 'checkbox',
				'desc' => __( 'Display the portfolio categories.', 'harbor' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Display Tags:', 'harbor' ),
				'id'   => $prefix . 'portfolio_tags',
				'type' => 'checkbox',
				'desc' => __( 'Display the portfolio tags.', 'harbor' ),
				'std'  => false,
			),

			// array(
			// 'name' => __('Portfolio Review:', 'harbor'),
			// 'desc' => __('Display a review.', 'harbor'),
			// 'id' => $prefix . 'portfolio_review',
			// 'type' => 'textarea',
			// 'std' => ''
			// ),
			// array(
			// 'name' => __('Portfolio Cite:', 'harbor'),
			// 'desc' => __('Display a review cite.', 'harbor'),
			// 'id' => $prefix . 'portfolio_cite',
			// 'type' => 'text',
			// 'std' => 'John Smith / Creative Director'
			// ),
			array(
				'name' => __( 'Grid Image:', 'harbor' ),
				'desc' => __( 'Upload an image for grid layouts instead of your featured image.', 'harbor' ),
				'id'   => $prefix . 'grid_feat_img',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  AUDIO POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-audio',
		'title'    => __( 'Audio Settings', 'harbor' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'MP3 File URL:', 'harbor' ),
				'desc' => __( '', 'harbor' ),
				'id'   => $prefix . 'audio_mp3',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  VIDEO POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-video',
		'title'    => __( 'Video Settings', 'harbor' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Embed 1:', 'harbor' ),
				'desc' => __( 'Insert your embeded code here.', 'harbor' ),
				'id'   => $prefix . 'portfolio_embed_code',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embed 2:', 'harbor' ),
				'desc' => __( 'Insert your embeded code here.', 'harbor' ),
				'id'   => $prefix . 'portfolio_embed_code_2',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embed 2:', 'harbor' ),
				'desc' => __( 'Insert your embeded code here.', 'harbor' ),
				'id'   => $prefix . 'portfolio_embed_code_3',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embed 3:', 'harbor' ),
				'desc' => __( 'Insert your embeded code here.', 'harbor' ),
				'id'   => $prefix . 'portfolio_embed_code_4',
				'type' => 'textarea',
				'std'  => '',
			),
		),

	);
	bean_add_meta_box( $meta_box );
} // END function bean_metabox_portfolio()
