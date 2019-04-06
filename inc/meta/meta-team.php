<?php
/**
 * The file is for creating the team post type meta.
 * Meta output is defined on the team single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */

function bean_metabox_team() {

	$prefix = '_bean_';

	/*
	===================================================================*/
	/*
	  TEAM META SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'          => 'portfolio-meta',
		'title'       => __( 'Team Member Settings', 'harbor' ),
		'description' => __( '', 'harbor' ),
		'page'        => 'team',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => __( 'Role:', 'harbor' ),
				'desc' => __( 'Display this team member&#39;s position on the team.', 'harbor' ),
				'id'   => $prefix . 'team_role',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Quote:', 'harbor' ),
				'desc' => __( 'Display a small quote on image hover.', 'harbor' ),
				'id'   => $prefix . 'team_quote',
				'type' => 'text',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'bean_metabox_team' );
