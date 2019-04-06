<?php
/**
 * The file is for creating the page post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

add_action( 'add_meta_boxes', 'bean_metabox_page' );
function bean_metabox_page() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'page-meta',
		'title'    => __( 'Hero Settings', 'harbor' ),
		'page'     => 'page',
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
				'name' => __( 'Hero Tagline:', 'harbor' ),
				'desc' => __( 'Insert an optional tagline to output in the page header, in lieu of the page title.', 'harbor' ),
				'id'   => $prefix . 'hero_tagline',
				'type' => 'textarea',
				'std'  => '',
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

	$meta_box = array(
		'id'       => 'page-settings',
		'title'    => __( 'Page Settings', 'harbor' ),
		'page'     => 'page',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name'    => __( 'Page Content Layout:', 'harbor' ),
				'desc'    => __( 'Select the text alignment style for this page.', 'harbor' ),
				'id'      => $prefix . 'page_content_layout',
				'type'    => 'select',
				'std'     => 'content-std',
				'options' => array(
					'content-std'           => __( 'Default', 'harbor' ),
					'content-centered'      => __( 'Center', 'harbor' ),
					'content-wide'          => __( 'Wide', 'harbor' ),
					'content-wide-centered' => __( 'Wide Center', 'harbor' ),
				),
			),
		),
	);
	bean_add_meta_box( $meta_box );

}
