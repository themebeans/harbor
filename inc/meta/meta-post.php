<?php
/**
 * The file is for creating the blog post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

add_action( 'add_meta_boxes', 'bean_metabox_post' );
function bean_metabox_post() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'post-hero-meta',
		'title'    => __( 'Hero Settings', 'harbor' ),
		'page'     => 'post',
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
				'name' => __( 'Hero Content:', 'harbor' ),
				'id'   => $prefix . 'hero_content',
				'type' => 'checkbox',
				'desc' => __( 'Select to display the title in the hero area.', 'harbor' ),
				'std'  => true,
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
	  AUDIO POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-audio',
		'title'    => __( 'Audio Post Format Settings', 'harbor' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'MP3 File URL:', 'harbor' ),
				'desc' => __( 'Upload or link to an MP3 file.', 'harbor' ),
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
	  GALLERY POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-gallery',
		'title'    => __( 'Image/Gallery Post Format Settings', 'harbor' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => 'Gallery Images:',
				'desc' => 'Upload images here for your gallery post. Once uploaded, drag & drop to reorder.',
				'id'   => $prefix . 'post_upload_images',
				'type' => 'images',
				'std'  => __( 'Browse & Upload', 'harbor' ),
			),
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
	  LINK POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-link',
		'title'    => __( 'Link Post Format Settings', 'harbor' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Link Title:', 'harbor' ),
				'desc' => __( 'The title for your link.', 'harbor' ),
				'id'   => $prefix . 'link_title',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Link URL:', 'harbor' ),
				'desc' => __( 'ex: http://themebeans.com', 'harbor' ),
				'id'   => $prefix . 'link_url',
				'type' => 'text',
				'std'  => 'http://',
			),
		),

	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  QUOTE POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-quote',
		'title'    => __( 'Quote Post Format Settings', 'harbor' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Quote Text:', 'harbor' ),
				'desc' => __( 'Insert your quote into this textarea.', 'harbor' ),
				'id'   => $prefix . 'quote',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Quote Source:', 'harbor' ),
				'desc' => __( 'Who said the quote above?', 'harbor' ),
				'id'   => $prefix . 'quote_source',
				'type' => 'text',
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
		'id'       => 'bean-meta-box-video',
		'title'    => __( 'Video Post Format Settings', 'harbor' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Embeded Code:', 'harbor' ),
				'desc' => __( 'Include your video embed code here.', 'harbor' ),
				'id'   => $prefix . 'video_embed',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embeded Video URL:', 'harbor' ),
				'desc' => __( 'The direct URL to your embedded video.', 'harbor' ),
				'id'   => $prefix . 'video_embed_url',
				'type' => 'text',
				'std'  => 'http://player.vimeo.com/video/42411918',
			),
		),
	);
	bean_add_meta_box( $meta_box );
} // END function bean_metabox_post()
